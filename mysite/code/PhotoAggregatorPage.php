<?php

class PhotoAggregatorPage extends Page {

	private static $allowed_children = array("none");
	
	function DropdownTitle() {
		$String = '' . $this->Parent()->Title . ' --- ' . $this->Title;
		return $String;
	}
	
}
 
class PhotoAggregatorPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
		"index",
		"FilterForm",
		"getmodels"
	);
	
	public function index() {
		if(Director::is_ajax() || $_GET["Ajax"]==1) {
			return $this->renderWith("PhotoAggregatorPage_reload");
		}
		else {
			return array();
		}
	}
	
	public function Photos() {
				
		$sqlQuery = new SQLQuery("*","ProjectImage");
		
		$where = "1";
		$join = "";
		
		if(($c=(int)$this->request->getVar('Category')) && $c>0 ) {
			$where.= " AND ProjectImage_Category.CategoryID = $c";
			$sqlQuery->addInnerJoin("ProjectImage_Category","ProjectImage_Category.ProjectImageID = ProjectImage.ID");
		}
		
		if(($b=(int)$this->request->getVar('Brand')) && $b>0 ) {
			$where.= " AND Project_Brands.BrandID = $b";
			$sqlQuery->addInnerJoin("Project_Brands","Project_Brands.ProjectID = ProjectImage.ProjectID");
		}
		
		if(($co=(int)$this->request->getVar('Color')) && $co>0 ) {
			$where.= " AND ProjectImage_Color.ColorID = $co";
			$sqlQuery->addInnerJoin("ProjectImage_Color","ProjectImage_Color.ProjectImageID = ProjectImage.ID");
		}
		
		if(($t=(int)$this->request->getVar('Tag')) && $t>0 ) {
			$where.= " AND Project_Tags.TagID = $t";
			$sqlQuery->addInnerJoin("Project_Tags","Project_Tags.ProjectID = ProjectImage.ProjectID");
		}
		
		if(($mk=(int)$this->request->getVar('Make')) && $mk>0 ) {
			$where.= " AND Project.CarMakeID = $mk";
			$sqlQuery->addInnerJoin("Project","Project.ID = ProjectImage.ProjectID");
		}
		
		if(($mo=(int)$this->request->getVar('Model')) && $mo>0 ) {
			$where.= " AND Project.CarModelID = $mo";
			$sqlQuery->addInnerJoin("Project","Project.ID = ProjectImage.ProjectID");
		}
		
		$p=0;
		if($this->request->getVar('p')>0) {
			$p = (int)$this->request->getVar('p');
		}
		$sqlQuery->addWhere($where);
		$sqlQuery->addInnerJoin("Project","Project.Published = 1 AND Project.ID = ProjectImage.ProjectID");
		$sqlQuery->setDistinct(true);
		$sqlQuery->setLimit(12,$p*12);
		$sqlQuery->setOrderBy("ProjectImage.Created DESC");
		$result = $sqlQuery->execute();
		
		$arrayList = new ArrayList();
		foreach($result as $rowArray) {
			$p = new ProjectImage($rowArray);
			$arrayList->push($p);
		}
		return $arrayList;
	}
	
	function Form() 
	{
	
		$bf = new LiteralField("Brands","Brands");
		$b = DataObject::get("Brand");
		if($b) {
			$bf = new DropdownField("Brand","Brand",$b->map("ID","Title"),$this->request->getVar('Brand'));
			$bf->setEmptyString("All brands");
		}
		$bf->addExtraClass("normalSelect");
		
		$cf = new LiteralField("Categories","Categories");
		$c = Category::get()->where("HideFromPhotos != 1");
		if($c) {
			$cf = new DropdownField("Category","Category",$c->map("ID","Title"),$this->request->getVar('Category'));
			$cf->setEmptyString("All categories");
		}
		$cf->addExtraClass("normalSelect");
		
		$cof = new LiteralField("Color","Color");
		$co = DataObject::get("Color");
		if($co) {
			$cof = new DropdownField("Color","Color",$co->map("ID","Title"),$this->request->getVar('Color'));
			$cof->setEmptyString("All colors");
		}
		$cof->addExtraClass("normalSelect");
		
		$tf = new LiteralField("Tag","Tag");
		$t = DataObject::get("Tag");
		if($t) {
			$tf = new DropdownField("Tag","Tag",$t->map("ID","Title"),$this->request->getVar('Tag'));
			$tf->setEmptyString("All tags");
		}
		$tf->addExtraClass("normalSelect");

//		$typeField = new DropdownField("Type","Type",array(0=>"All","news"=>"News","projects" => "Projects","specials" => "Specials"),$this->request->getVar('Type'));
		
		/* $maf = new LiteralField("Make","Make");
		$ma = DataObject::get("CarMake");
		if($ma) {
			$maf = new DropdownField("Make","Make",$ma->map("ID","Title"),$this->request->getVar('Make'));
			$maf->setEmptyString("All makes");
		}
		
		$mof = new LiteralField("Model","Model");
		$mo = DataObject::get("CarModel");
		if($mo) {
			$mof = new DropdownField("Model","Model",$mo->map("ID","Title"),$this->request->getVar('Model'));
			$mof->setEmptyString("All models");
		} */
		
		$maf = new LiteralField("Make","Make");
		$ma = DataObject::get("CarMake");
		if($ma) {
			$mamap = $ma->map("ID","Title");
			$maf = new DropdownField("Make","Make",$mamap,$this->request->getVar('Make'));
			$maf->setEmptyString("All makes");
		}
		
		/* MODELS IF LOADED */
		$momap = array("0" => "First select make");			
		$m = (int)$this->request->getVar('Make');
		$emptymo="";
		if($m>0) {
			$models = DataObject::get("CarModel","CarMakeID = $m","Title ASC");
			if($models) {
				$momap = $models->map("ID","Title");
				$emptymo="All models";
			}
			else {
				$momap = array("0" => "No models available");	
			}
		}
		$mof = new DropdownField("Model","Model",$momap,$this->request->getVar('Model'));
		if($emptymo) {
			$mof->setEmptyString($emptymo);
		};
		if(!$m) {
			$mof->setDisabled(true);
		}
		
		
		$page = 0;
		if((int)$_GET["p"]>0) {
			$page = (int)$_GET["p"];
		} 
		$pagefield = new HiddenField("p","p",$page);
		
      	// Create fields
	    $fields = new FieldList(
	    	new LiteralField("FormHeader",'<h4>Filter photos <img src="mysite/images/loader-small.gif" class="loader" alt="Loading" /></h4>'),
			$cf,
			$maf,
			$mof,
			$bf,
			$cof,
			$pagefield
		);

	 	
//	 	$fields->push($pageField);
	 	
	    // Create action
	    $a = new FormAction('getResults', _t("SHOWRESULTS",'Update'));
	    $a->addExtraClass("small");
	    $a->addExtraClass("collapse");
	    $actions = new FieldList(
	    	$a
	    );
		
		// Create action
		// $validator = new RequiredFields();
			
	    $f = new Form($this, 'FilterForm', $fields, $actions);
	    $f->setFormMethod('GET');
	    $f->setStrictFormMethodCheck("GET");
	    
	    return $f;

	}
	
	public function getmodels() {
		$m = (int)$this->request->getVar('make');
		if(!is_numeric($m) || $m<=0) {
			return false;
		}
		
		$response = '<select id="Form_FilterForm_Model" name="Model">';
		
		$models = CarModel::get()->where("CarMakeID = $m")->sort("Title ASC");
		if($models) {
			/* $response.=("<option selected='selected' value=''>Select model</option>"); */
			$response.=("<option value='0'>All models</option>");
			foreach($models as $model) {
				$response.=("<option value='".$model->ID."'>".$model->Title."</option>");
			}
		}
		else {
			$response.=("<option selected='selected' value=''>No models available</option>");
		}
		$response.="</select>";
		echo($response);
		return false;
	}
	
//	function PhotosCacheKey() {
//	    $start = (isset($_GET["start"]) && is_numeric($_GET["start"])) ? (int)$_GET["start"] : 0;
//	    return implode('_', array(
//	        'photos',
//	        $start,
//	        $this->Aggregate("Image")->Max("LastEdited"),
//	        $this->Aggregate("PageImage")->Max("LastEdited"),
//	        $this->Aggregate("Article")->Max("LastEdited"),
//	        $this->Aggregate("ArticleImage")->Max("LastEdited"),
//	        $this->Aggregate("Project")->Max("LastEdited"),
//	        $this->Aggregate("ProjectImage")->Max("LastEdited"),
//	    ));
//	}
	
}

