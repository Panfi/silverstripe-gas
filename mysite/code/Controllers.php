<?php

class Search_Controller extends Page_Controller {

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/search';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
		
		$q="";
		if(isset($_GET["q"])) {
			$q = convert::raw2sql($_GET["q"]);
		}
		$fword = "'%$q%'";
		$query = "Title LIKE $fword";
		
		if(Director::is_ajax() == true){ 
			$result = DataObject::get("Page",$query,"Title ASC")->limit(10);
			
			if(!$result) { return false; }
			$json = new JSONDataFormatter(); 
			echo($json->convertDataObjectSet($result));
		}
		else {
			$title = "Search results".($q!="" ? " for '$q'" : "");
			$Data = array(
				'Title' => $title,
				'MetaTitle' => $title,
			);
			return $this->customise($Data)->renderWith(array('SearchResults','Page'));
		}
	}
	
	public function SearchResults() {
		$q="";
		if(isset($_GET["q"])) {
			$q = convert::raw2sql($_GET["q"]);
		}
		$fword = "'%$q%'";
		$query = $pquery = "Title LIKE $fword";
		$query2 = $pquery2 = " OR Content LIKE $fword";
		
		$sqlQuery = new SQLQuery("Project.ID, Project.Title","Project");

		$join = "";
		
		if(($c=(int)$this->request->getVar('Category')) && $c>0 ) {
			$pquery.= " AND Category_Projects.CategoryID = $c";
			$sqlQuery->addInnerJoin("Category_Projects","Category_Projects.ProjectID = Project.ID");
			$sqlQuery->setDistinct(true);
		}
		
		if(($b=(int)$this->request->getVar('Brand')) && $b>0 ) {
			$pquery.= " AND Project_Brands.BrandID = $b";
			$sqlQuery->addInnerJoin("Project_Brands","Project_Brands.ProjectID = Project.ID");
		}
		
		if(($co=(int)$this->request->getVar('Color')) && $co>0 ) {
			$pquery.= " AND Project_Colors.ColorID = $co";
			$sqlQuery->addInnerJoin("Project_Colors","Project_Colors.ProjectID = Project.ID");
		}
		
		if(($t=(int)$this->request->getVar('Tag')) && $t>0 ) {
			$pquery.= " AND Project_Tags.TagID = $t";
			$sqlQuery->addInnerJoin("Project_Tags","Project_Tags.ProjectID = Project.ID");
		}
		
		if($model = CarMake::get()->where("Title LIKE $fword")->limit(1)->First()) {
			$pquery.= " OR Project.CarModelID = ".$model->ID;
		};
		
		
		$sqlQuery->addWhere("Project.Published=1 AND ".$pquery.$pquery2);
		$result = $sqlQuery->execute();
		$arrayList = new ArrayList();
		foreach($result as $rowArray) {
			$p = new Project($rowArray);
			$arrayList->push($p);
		}
		
		return new ArrayData(
			array(
				'Pages' => DataObject::get("Page",$query.$query2,"Title ASC")->limit(20),
				'Tags' => DataObject::get("Tag",$query,"Title ASC")->limit(20),
				'Articles' => $articles = DataObject::get("Article",$query.$query2,"Title ASC")->limit(20),
				'Specials' => $specials = DataObject::get("Special",$query.$query2,"Title ASC")->limit(20),
				'Projects' => $arrayList
			)
		);
	}
	
	public function SearchTerm() {
		$q="";
		if(isset($_GET["q"])) {
			return $q;
		}
	}
	
}


class Brand_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/brands';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
		
		$Params = $this->getURLParams();
		$URLSegment = Convert::raw2sql($Params['ID']);
		if($URLSegment && $Item = DataObject::get_one('Brand', "URLSegment = '" . urldecode($URLSegment) . "'")) {
			$Data = array(
				'Title' => "Brand: '".$Item->Title."'",
				'MetaTitle' => $Item->Title,
				'Content' => $Item->Content,
				'Brand' => $Item,
				'Projects' => $Item->Projects(),
				'Categories' => $Item->Categories()
			);
			return $this->customise($Data)->renderWith(array('Brand','Page'));
		}
		else {
			$b = null;
			$title = "All our brands";
			
			if(($c=(int)$this->request->getVar('Category')) && $c>0 ) {
				$cat = Category::get()->where("SiteTree_Live.ID = $c")->limit(1)->first();
				$b = $cat->Brands();
				$title = "All our ".$cat->Title." brands";
			}
			else {
				$b = DataObject::get("Brand","ImageID>0","Title ASC");
			}
			$Data = array(
				'Title' => $title,
				'MetaTitle' => $title,
				"Brands" => $b,
				"Category" => $cat
			);
			return $this->customise($Data)->renderWith(array('AllBrands','Page'));
		}
		
		
	}
	
	public function Brands() {
		if(($c=(int)$this->request->getVar('Category')) && $c>0 ) {
			$cat = Category::get()->where("SiteTree_Live.ID = $c")->limit(1)->first();
			return $cat->Brands();
		}
		else {
			return DataObject::get("Brand","ImageID>0","Title ASC");
		}
	}
	
}


class Project_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'index',
		'image'
	);
	
	private static $url_handlers = array(
	    '$URLSegment/image/$ID' => 'image',
	    '//$URLSegment' => 'index'
	);
	
	public function init() {
		require_once 'Mobile_Detect.php';
		parent::init();
	}
	
	public function index() {
			
		Requirements::css("mysite/galleria/themes/twelve/galleria.twelve.css");
		
		if(!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0; 
		$SQL_start = (int)$_GET['start'];
		
		if($Item = $this->getCurrentItem()) {
		
			$Data = array(
				'Title' => $Item->Title,
				'MetaTitle' => $Item->Title,
//				'AbsoluteLink' =>$Item->AbsoluteLink(),
				'Item' => $Item,
				'ThumbnailURL' => $Item->ThumbnailURL(),
				'AbsoluteLink' => $Item->AbsoluteLink(),
				'ClassName' => 'Project'
			);
			return $this->customise($Data)->renderWith(array('Project','Page'));	
		}
		else {
			return $this->httpError(404, _t("Project.NOTFOUND","Project not found."));
		}
	}
	
	public function image() {
		if($Item = $this->getCurrentItem()) {

			$imageID = $this->request->param("ID");
			$images = ProjectImage::get()->where("ProjectID = ".$Item->ID);
			
			$image = ProjectImage::get()->where("ID = $imageID")->First(); //$images->filter("SortOrder",$imageID)->First();
			
			if($image) {
				$Data = array(
					'MetaTitle' => $Item->Title." - Image ".$image->SortOrder,
					'Title' => $Item->Title." - Image ".$image->SortOrder,
					'Item' => $Item,
					'Image' => $image,
					'ThumbnailURL' => $image->Image()->CroppedImage(400,300)->URL,
					'AbsoluteLink' => $image->AbsoluteLink(),
					'ClassName' => 'ProjectImage'
				);
				return $this->customise($Data)->renderWith(array('ProjectImage','Page'));
			}
			else {
				echo("Kurc");
				//$this->redirect($Item->Link());
				return false;
			}
		}
	}
	
	public function getCurrentItem()
	    {
	        $URLSegment = $this->request->param('URLSegment');  
			if($URLSegment && $Item = DataObject::get_one('Project',
	        	"URLSegment = '" . urldecode($URLSegment) . "'"))
			{       
			return $Item;
		}
	}
	
	public function ImageData() {
		$detect = new Mobile_Detect;
		$factor = 1;
		if ($detect->isMobile()) {
			$factor = 0.5;
		}
		else if( $detect->isTablet() ){
		 	$factor = 0.75;
		}
		
		$item = $this->getCurrentItem();
		
		$images = $item->Images();
		
		$imagedata = array();
		$count = 1;
		foreach($images as $image) {
			$imagedata[] = array(
				"image" => $image->Large(1000*$factor),
				"thumb" => $image->Image()->CroppedImage(100,80)->URL,
				"big" => $image->large(1600*$factor),
				"title" => $item->Title,
				"description" => "Photo ".$count++,
				"layer" => '<div class="photoshare"><span class="addthis_toolbox addthisphoto addthis_default_style " addthis:url="'.$image->AbsoluteLink().'">'.
				'<a class="addthis_button_facebook"></a>'.
				'<a class="addthis_button_twitter"></a>'.
				'<a class="addthis_button_google"></a>'.
				'<a class="addthis_button_email"></a><a class="addthis_button_compact"></a>'.
				'</span></div>'
			);
		}
		
		return str_replace('\/','/',json_encode($imagedata));
	}
	
	public function ExtraJavascript() {
		if($this->getAction() == "index") {
			return 	'<script src="mysite/galleria/galleria-1.3.3.min.js"></script>'.
					'<script src="mysite/zoom/jquery.zoom.min.js"></script>'.
					'<script>'.
					'Galleria.loadTheme("mysite/galleria/themes/twelve/galleria.twelve.min.js");'.
					'var data = '.$this->ImageData().';'.
					'var width = $(document).width();'.
					'Galleria.on("fullscreen_enter", function(e) {'.
						
						'console.log("fullscreen");'.
	//				    'var gallery = this;'.
	//				    'this.addElement("fscr");'.
	//				    'this.appendChild("stage","fscr");'.
	//				    'var fscr = this.$("fscr")'.
	//				        '.click(function() {'.
	//				            'gallery.toggleFullscreen();'.
	//				        '});'.
	//				    'this.addIdleState(this.get("fscr"), { opacity:0 });'.
					'});'.
					'var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);'.
					'if(isSafari) {'.
						'Galleria.configure({_showFullscreen: false});'.
					'}'.
					'Galleria.run(".galleria", { height: 0.5625, _showPopout: false, dataSource: data });'.
					'Galleria.on("image",function(e){'.
					   'if(width > 780) {'.
					   	'$(e.imageTarget).parent().zoom();'.
					   	'addthis.toolbox(".addthisphoto");'.
					   '}'.
					'});'.
					'</script>';
			}
	}
	
}



class Color_Controller extends Page_Controller {

	static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/colors';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
		
		$Params = $this->getURLParams();
		$ID = Convert::raw2sql($Params['ID']);
		if($ID && $Item = DataObject::get_one('Color', "ID = $ID")) {
			$Data = array(
				'Title' => "Projects with color '".$Item->Title."'",
				'MetaTitle' => "Projects with color '".$Item->Title."'",
				'Projects' => $Item->Projects(),
				'Color' => $Item
			);
			return $this->customise($Data)->renderWith(array('ProjectsBaseView','Page'));
		}
//		else {
//			$Data = array(
//				'Title' => "All our brands",
//				'MetaTitle' => "All our brands"
//			);
//			return $this->customise($Data)->renderWith(array('AllBrands','Page'));
//		}		
		
	}
	
	public function Brands() {
		return DataObject::get("Brand","ImageID>0","Title ASC");
	}
	
}

class Tag_Controller extends Page_Controller {

	static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/tags';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
		
		$Params = $this->getURLParams();
		$URLSegment = Convert::raw2sql($Params['ID']);
		if($URLSegment && $Item = DataObject::get_one('Tag', "LOWER(Title) = '" . urldecode($URLSegment) . "'")) {
			$Data = array(
				'Title' => "Tag: ".$Item->Title,
				'MetaTitle' => $Item->Title,
				'Projects' => $Item->Projects(),
				'Tag' => $Item
			);
			return $this->customise($Data)->renderWith(array('ProjectsBaseView','Page'));
		}
		else {
			$Data = array(
				'Title' => "All keywords",
				'MetaTitle' => "All keywords",
				'Tags' => $this->Tags()
			);
			return $this->customise($Data)->renderWith(array('AllTags','Page'));
		}
		
	}
	
	public function Tags() {
		return DataObject::get("Tag","","Title ASC");
	}
	
}


class AllCategory_Controller extends Page_Controller {

	static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/categories';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
			$Data = array(
				'Title' => "All categories",
				'MetaTitle' => "All categories"
			);
			return $this->customise($Data)->renderWith(array('AllCategories','Page'));
	}
	
	public function Categories() {
		return DataObject::get("Category","Status='Published' AND ImageID>0","Title ASC");
	}
	
}

class Image_Controller extends Page_Controller {

	static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/image';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
			$Params = $this->getURLParams();
			$URLSegment = Convert::raw2sql($Params['ID']);
			if($URLSegment && $Item = DataObject::get_one('Image', "LOWER(Title) = '" . urldecode($URLSegment) . "'")) {
				$Data = array(
					'Title' => $Item->Title,
					'MetaTitle' => $Item->Title,
					'Image' => $Item
				);
				return $this->customise($Data)->renderWith(array('ImageView','Page'));
			}
			else {
				Controller::redirectBack();
			}
	}
	
}

class Product_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'index'
	);

	public function init() {	
		parent::init();
	}
	
	const URLSegment = '/product';
	
	public function getURLSegment() { 
		return self::URLSegment; 
	}
	
	public function Link($action = null, $id = null) {
		//$action = $this->request->param('Action');
		//$id = $this->request->param('ID');
		return Controller::join_links(self::URLSegment, $action, $id);
	} 
	
	
	public function index() {
			$Params = $this->getURLParams();
			$URLSegment = Convert::raw2sql($Params['ID']);
			if($URLSegment && $Item = DataObject::get_one('Product', "URLSegment = '" . $URLSegment . "'")) {
				$Data = array(
					'Title' => "Tag: ".$Item->Title,
					'MetaTitle' => $Item->Title,
					'Image' => $Item->Images() ? $Item->Images()->First() : null,
					'Item' => $Item
				);
				return $this->customise($Data)->renderWith(array('ProductView','Page'));
			}
			else {
				Controller::redirectBack();
			}
	}
	
}