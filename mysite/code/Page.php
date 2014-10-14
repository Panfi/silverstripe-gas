<?php
class Page extends SiteTree {
	
	private static $db = array(
		'CustomHtml' => 'Text',
		'Summary' => 'Varchar(500)',
		'ActionText' => 'HTMLText',
		'ActionButtonLabel' => 'Varchar(32)',
		'ActionButtonLink' => 'Varchar(255)',
		'ActionEnabled' => 'Boolean'
	);
	
	private static $has_one = array(
		'Sections' => 'WidgetArea',
		'Image' => "Image",
		'ActionImage' => 'Image'
	);
	
	private static $has_many = array(
		'Images' => 'PageImage'
	);
	
	function getCMSFields() {
	    $fields = parent::getCMSFields();
//	    $fields->removeByName('MetaTitle');
//	    $fields->addFieldToTab("Root.Widgets", new WidgetAreaEditor("Sections"));

	 	if(!Permission::check('ADMIN')){ 
	 		$fields->removeByName(_t('SiteTree.TABTODO')); 
	 		$fields->removeByName(_t('SiteTree.TABBEHAVIOUR'));
	 		$fields->removeByName('Access');
	 		$fields->removeByName('Google Sitemap');
	 	}
	 	
	 	$gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
		$gridFieldConfig->addComponent(new GridFieldBulkManager());
		$gridFieldConfig->addComponent(new GridFieldBulkUpload());   
    $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
    $gridFieldConfig->getComponentByType('GridFieldBulkUpload')
      ->setUfSetup('setFolderName', 'images')
      ->setUfConfig('sequentialUploads', true);

		$photoManager = new GridField("Images", "Images", $this->Images()->sort("SortOrder"), $gridFieldConfig);
	 	
//	 	$photoManager = new ImageDataObjectManager(
//	 		$this, // Controller
//	 		'Images', // Source name
//	 		'PageImage', // Source class
//	 		'Image', // File name on DataObject
//	 		array(
//	 			'Caption' => 'Name'
//	 		), // Headings 
//	 		'getCMSFields_forPopup' // Detail fields (function name or FieldSet object)
	 		// Filter clause
	 		// Sort clause
	 		// Join clause
//	 	);
//	 	$photoManager->setUploadFolder("images/pages");
	 	
	 	$fields->removeByName('Content.Content');
	 	$fields->addFieldToTab("Root.Main", new HTMLEditorField("Content","Content",15));
	 	
	 	$imageField = UploadField::create('Image','Choose main image')->setAllowedFileCategories('image');
	 	$imageField->setFolderName("images"); 
	 	
	 	$actionimageField = UploadField::create('ActionImage','Choose action image')->setAllowedFileCategories('image');
	 	$actionimageField->setFolderName("images/cta"); 
	 	
	 	$fields->addFieldToTab("Root.Images",new HeaderField("ImageNote","Main image",3));
	 	$fields->addFieldToTab("Root.Images",$imageField);
	 	$fields->addFieldToTab("Root.Images",new LiteralField("ImageNote2","<br/>"));
	 	$fields->addFieldToTab("Root.Images",new HeaderField("ImageNote3","Photos / leading images",3));
	 	$fields->addFieldToTab("Root.Images",$photoManager);
	 	
	 	$fields->addFieldToTab("Root.CallToAction",new HeaderField("ActionNote","Call to Action",3));
	 	$fields->addFieldToTab("Root.CallToAction",new CheckboxField("ActionEnabled","Check to enable Call to Action"));
	 	$fields->addFieldToTab("Root.CallToAction", new HTMLEditorField("ActionText","Enter action text",10));
	 	$fields->addFieldToTab("Root.CallToAction", new TextField("ActionButtonLabel", "Label on the button"));
	 	$fields->addFieldToTab("Root.CallToAction", new TextField("ActionButtonLink", "URL of Action button"));
	 	$fields->addFieldToTab("Root.CallToAction",$actionimageField);
	 	
	 	$fields->addFieldToTab("Root.Main", new TextareaField("Summary","Enter summary"));
	 	$fields->addFieldToTab("Root.Main", new TextareaField("CustomHtml","Custom HTML code",4));
	 	
		return $fields;
	}
	
	public function onBeforeWrite () {
		parent::onBeforeWrite();
	}
	
    public function IsAdmin() {
      return Permission::check('ADMIN') ? 1 : 0;
     }

	public function canDelete($member = null) {
		return Permission::check('ADMIN');
	}
	
	static $api_access = true;
		
}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		'index',
		'ContactForm',
		'mailtest'
	);

	public function init() {
		Requirements::clear('jsparty/prototype.js');
		Requirements::combine_files(
		    'javascript.js',
		    array(
//		    	'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
//		    	'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
		    	'mysite/foundation/js/vendor/custom.modernizr.js',
		    	'mysite/foundation/js/foundation.min.js',
		    	'mysite/js/perfect-scrollbar-0.4.3.with-mousewheel.min.js',
		        'mysite/js/jquery.unveil.js',
		        'mysite/js/jquery.mobile.touch.js',
		        'themes/gas/js/script.js'
		    )
		);
		parent::init();
	}
	    
//	public function Breadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
//			$page = $this;
//			$parts = array();
//			$i = 0;
//			while(
//				$page  
//	 			&& (!$maxDepth || sizeof($parts) < $maxDepth) 
//	 			&& (!$stopAtPageType || $page->ClassName != $stopAtPageType)
//	 		) {
//				if($showHidden || $page->ShowInMenus || ($page->ID == $this->ID)) { 
//					if($page->URLSegment == 'home') $hasHome = true;
//					if(($page->ID == $this->ID) || $unlinked) {
//					
//						$ttitle=Convert::raw2xml($page->Title);
//						if(str_word_count($ttitle) > 9) {
//							$shortened = implode(' ',array_slice(str_word_count($ttitle,1),0,9));
//							$ttitle= $shortened."...";	
//						}
//						
//					 	$parts[] = "<li>".$ttitle."</li>";
//					} else {
//						$parts[] = ("<li><a href=\"" . $page->Link() . "\">" . Convert::raw2xml($page->Title) . "</a><span class=\"divider\">/</span></li>"); 
//					}
//				}
//				$page = $page->Parent;
//			}
//	
//			return implode("", array_reverse($parts));
//		}

//	public function PrevNextPage($Mode = 'next') {
//	   
//	  if($Mode == 'next'){
//	    $Where = "ParentID = $this->ParentID AND Sort > $this->Sort";
//	    $Sort = "Sort ASC";
//	  }
//	  elseif($Mode == 'prev'){
//	    $Where = "ParentID = $this->ParentID AND Sort < $this->Sort";
//	    $Sort = "Sort DESC";
//	  }
//	  else{
//	    return false;
//	  }
//	  
//	  $dob= DataObject::get("Page", $Where, $Sort, null, 1);
//	  return $dob ? $dob : false;
//	     
//	}
	
	function Siblings() {
		if($this->ParentID) {
		  $whereStatement = "ClassName!='ErrorPage' AND ParentID = ".$this->ParentID;
		  return DataObject::get("Page", $whereStatement);
		 }
	 }
	 
	 function getMetaTitle() {
	 	return $this->Title;
	 }
	
	public function setMessage($type, $message)
	   {   
	       Session::set('Message', array(
	           'MessageType' => $type,
	           'Message' => $message
	       ));
	   }
	
	public function getMessage(){
		if($message = Session::get('Message')){
			Session::clear('Message');
			$array = new ArrayData($message);
			return $array->renderWith('Message');
		}
	}
	
	public function IsAdmin() {
	  return Permission::check('ADMIN');
	 }
	
	
	public function YouTubeID($embedcode) {
		preg_match('/youtube[.]com\/(v|embed)\/([^"?]+)/', $embedcode, $match);
		return $match[2];
	}
	
	function ThumbnailURL($width=300) {
		if($this->VideoEmbed) {
			return "http://img.youtube.com/vi/".singleton("Page_Controller")->YouTubeID($this->VideoEmbed)."/0.jpg";
		}
		if($this->ImageID) {
			return $this->Image()->SetWidth($width)->URL;
		}
		if($this->Images()->Count()>0) {
			return $this->Images()->First()->Image()->SetWidth($width)->URL;
		}
		return "http://www.placehold.it/300x200&text=No+image";
	}
	
	function RandomPages($n=5) {
		$i = DataObject::get("Page","ImageID > 0","RAND()","",$n);
		if($i) {
			return($i);
		}
	}
	
	public function getBrands() {
		$br = DataObject::get("Brand","ImageID!=0","SortOrder ASC","",18);
		if($br) {
			return $br;
		}
	}
	
	public function getColors() {
		$c = DataObject::get("Color","","SortOrder ASC");
		if($c) {
			return $c;
		}
	}
	
	public function getTags() {
		$t = DataObject::get("Tag","");
		if($t) {
			return $t;
		}
	}
	
	public function getRecentSpecials() {
		$s = DataObject::get("Special","","Created DESC","",5);
		if($s) {
			return $s;
		}
	}
	
	public function getRecentArticles() {
		$s = DataObject::get("Article","","Created DESC","",5);
		if($s) {
			return $s;
		}
	}
	
	public function getRecentNews() {
		$s = DataObject::get("Article","BlogrollID=27","Created DESC","",5);
		if($s) {
			return $s;
		}
	}
	
	public function getRecentEvents() {
		$s = DataObject::get("Article","BlogrollID=48","Created DESC","",5);
		if($s) {
			return $s;
		}
	}
	
	public function getInstagram() {
		$instagram_id = "37926823";
		$token = INSTAGRAM_ACCESS_TOKEN;
		
		$instagram = new RestfulService("https://api.instagram.com/v1/users/".$instagram_id."/media/recent", 900);
		$params = array("access_token" => $token);
		$instagram->setQueryString($params);
		$iconn = $instagram->request();
		
		$iarray = json_decode($iconn->getBody(), true);		
		$results = ArrayList::create();
		//print_r($results->First()); //->images->thumbnail->url
		$count=0;
		foreach($iarray["data"] as $item) {
			if($count++<5) {
				//print_r($item["images"]["thumbnail"]["url"]."<br/>");
				 $results->push(
					new ArrayData(
						array(
							'ImageURL' => $item["images"]["low_resolution"]["url"],
							'Link' => $item["link"],
							'InstagramID' => $item["id"],
							'ClassName' => 'instagram'
						)
					)
				);
			}
			else {
				break;
			}
		}
		return $results;
	}
	
	public function getTwitter() {
		$twitter = new RestfulService("https://api.twitter.com/1.1/statuses/user_timeline.json", 900);
		$twitter->httpHeader('GET /1.1/search/tweets.json? HTTP/1.1');
		$twitter->httpHeader('Host: api.twitter.com');
		$twitter->httpHeader( "User-Agent: GalpinAutoSports.com v.1");
		$twitter->httpHeader('Content-Type: application/x-www-form-urlencoded;charset=UTF-8');
		$twitter->httpHeader('Authorization: Bearer '.TWITTER_BEARER_TOKEN);
		
		$screen_name = "galpinautosport";

		$params = array('screen_name' => $screen_name,"include_entities"=>"true","result_type"=>"mixed","count"=>"1");
		$twitter->setQueryString($params);
		$conn = $twitter->request();
		$tarray = json_decode($conn->getBody(), true);
//		print_r($tarray);
				
		if(isset($tarray[0])) {
			$t = $tarray[0];
			//print_r($t);
			$image="";
			if(isset($t["entities"]["media"])) {
				$image = $t["entities"]["media"][0]["media_url"].":thumb";
			}
				//print_r($t["entities"]["media"][0]["media_url"]);
				return new ArrayData(
					array(
						'Content' => $t["text"],
						'ImageURL' => $image,
						'Link' => "http://twitter.com/".$t["user"]["screen_name"]."/status/".$t["id_str"],
						'TwitterID' => $t["id_str"]
					)
				);
			//}
		}
		return false;
	}
	
	function FacebookPost(){
		$fbid = 96140524893;
		//$token = "1417590485135903|eypxvgf7p65Gk0EdSltGng2bsOY";
		
		$facebook = new RestfulService("https://www.facebook.com/feeds/page.php?format=json&id=".$fbid, 900);
		//$params = array("access_token" => $token, "limit" => 3);
		//$facebook->setQueryString($params);
		$fconn = $facebook->request();
		$farray = json_decode($fconn->getBody(), true);		
		
		$e = $farray["entries"][0];
		if($e) {
			return new ArrayData(array(
				"Content" => $e["content"],
				"Link" => $e["alternate"]
			));
		}
	}
	
	function Sections() {
		return false;
	}
	
	/** 
	* Just get the current URL 
	* @return string 
	*/ 
	static function curPageURL() { 
	      $pageURL = 'http'; 
	      if (Director::protocol() == 'https') {$pageURL .= "s";} 
	      $pageURL .= "://"; 
	      if ($_SERVER["SERVER_PORT"] != "80") { 
	         $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
	      } else { 
	         $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
	      } 
	      return $pageURL; 
	   }
	
	public function ContactForm() {
		return new ContactForm($this, "ContactForm");
	}
	
	public function doSubmit($data, Form $form) {
		$from = "no-reply@galpinautosports.com";
		if($data["Email"]!="") {
		    $from = $data["Email"];
		}
//	    $to = "rbull@sixthhouse.com	";
	    $to = "klempo@gmail.com";
	    $subject = "New online inquiry";
	    $body = $data["FirstName"]." ".$data["LastName"]." has submitted the following information: <br/><br/>";
	    $body = $body."<h3>USER INFORMATION</h3>";
	    $body = $body."First name: ".$data["FirstName"]." <br/>";
		$body = $body."Last name: ".$data["LastName"]." <br/>";
		$body = $body."E-mail: ".$data["Email"]." <br/>";
		$body = $body."City: ".$data["City"]." <br/>";
		$body = $body."State: ".$data["State"]." <br/>";
		$body = $body."ZIP: ".$data["ZIP"]." <br/>";
		$body = $body."<hr />";
		$body = $body."<h3>VEHICLE INFORMATION: </h3>";	
		$body = $body."Year: ".$data["CarYear"]." <br/>";
		$body = $body."Make: ".$data["CarMake"]." <br/>";
		$body = $body."Model: ".$data["CarModel"]." <br/>";
		$body = $body."<hr />";
		$body = $body."<h3>USER INTERESTED IN: </h3>";
		$ca = "General inquiry";
		if(($cid = (int)$data["ContactAction"])>0) {
			$caDo = Category::get()->where("Category_Live.ID = $cid")->limit(1)->First();
			if($caDo) {
				$ca = $caDo->Title;
//				$to = $caDo->SendToEmail;
			}
		}
		$body = $body."Interested in: ".$ca."<br/>";
		$body = $body."Message: \n";
		$body = $body."<p>".$data["Message"]."</p>";
		$body = $body."<hr/>";
		$body = $body."Add to mailing list: ".($data["Subscribe"] ? "Yes" : "No")."<br/>";
		$body = $body."<hr/>";
	    $body .= "<br/><br/>Sent:".date("r");
	    $email = new Email($from, $to, $subject, $body);
	    $email->send();
	    Controller::curr()->setMessage("success","Thank you! Your e-mail inquiry has been sent!");
	    Controller::curr()->redirectBack();
	}
	
	public function mailtest() {
		$from = "no-reply@galpinautosports.com";
		$to = "klemen@kinkcreative.com";
		$subject = "Test subject";
		$body = "Fuck it";
		$email = new Email($from, $to, $subject, $body);
		$email->send();
		return array();
	}
	
}


class ContactForm extends Form {
 
    public function __construct($controller, $name) {
    	
    	$actionField = new HiddenField("ContactAction",0);
    	$c = Category::get()->sort("Title ASC"); //ContactAction::get();
    	if($c->map()) {
	    	$actionField = DropdownField::create("ContactAction","Interested in", $c->map(), Controller::curr()->ID);
	    	$actionField->setEmptyString("General Inquiry");
	    }
        $fields = new FieldList(
        	TextField::create("FirstName"),
        	TextField::create("LastName"),
        	TextField::create("City"),
        	TextField::create("State"),
        	TextField::create("ZIP"),
        	TextField::create("CarYear"),
        	TextField::create("CarMake"),
        	TextField::create("CarModel"),
        	TextField::create("Safety"),
        	$actionField,
        	TextField::create("Phone")->setAttribute('data-validation-regex', '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'),
            EmailField::create("Email"),
            TextareaField::create("Message","Please describe your needs in detail"),
            CheckboxField::create("Subscribe","Add me to the mailing list"),
            HiddenField::create("CurrentURL", Controller::curr()->curPageURL())
        );
        
        $requiredFields = new RequiredFields(
        	'FirstName',
        	'LastName',
        	'Email',
        	'Phone'
        );

        $actions = new FieldList(FormAction::create("doSubmit")->setTitle("Submit"));
        
        parent::__construct($controller, $name, $fields, $actions, $requiredFields);
    }
     
    public function forTemplate() {
        return $this->renderWith(array($this->class, 'Form'));
    }

}