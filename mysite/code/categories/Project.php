<?php

class Project extends DataObject implements PermissionProvider {
	
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Content' => 'HTMLText',
		'ForSale' => 'Boolean',
		'Sold' => 'Boolean',
		'Price' => 'Currency',
		'Website' => 'Varchar(255)',
		'Published' => 'Boolean',
		'URLSegment' => 'Varchar(255)'
	);
	
	private static $has_one = array(
		'CarMake' => 'CarMake',
		'CarModel' => 'CarModel'
	);
	
	private static $has_many = array(
		'Images' => 'ProjectImage'
	);
	
	private static $many_many = array(
		'Brands' => 'Brand',
		'Colors' => 'Color'
	);
	
	private static $belongs_many_many = array(
		'Categories' => 'Category'
	);
	
	private static $summary_fields = array(
		"Title",
		"Created",
		"ForSale",
		"Sold",
		"Published"
	);
	
	private static $defaults = array(
		"URLSegment" => "new-project",
		"Title" => "New project"
	);
	
//	static $casting = array( 
//		'Published' => 'Boolean.Nice',
//		'Sold' => 'Text',
//		'ForSale' => 'Text'
//	); 
	
	/* public function getPublished(){ 
		return $this->Published ? 'Yes' : 'No'; 
	}
	public function getSold(){ 
		return $this->Sold ? 'Yes' : 'No'; 
	} 
	public function getForSale(){ 
		return $this->ForSale ? 'Yes' : 'No'; 
	}  */
	
//	private static $has_many = array (
//		'Images' => 'ProjectImage'
		//Downloadable files
		//Press links
		//Website
//	);
	
	public function providePermissions() {
	    return array(
	      "PUBLISH_PROJECTS" => "Publish projects",
	      "EDIT_PROJECTS" => "Edit projects"
	    );
	  }
	
//	private static $searchabe_fields = array(
//		'Title',
//		'ForSale',
//		'Price',
//		'Brands',
//		'Colors',
//		'Categories'
//	);
	
//	private static $defaults = array();
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$cfield = new DateTimeField('Created','Created date');
		$cfield->getDateField()->setConfig('showcalendar', 1); // field-specific setting
		$fields->addFieldToTab("Root.Main",$cfield,"Content");
		
		//$fields->removeByName('Content.Content');
		$fields->removeByName('Content.Images');
		$fields->removeByName('Categories');
		$fields->removeByName('Brands');
		$fields->removeByName('Colors');
		$fields->removeByName('CarMake');
		$fields->removeByName('CarModel');
		$fields->removeByName('Sold');
		$fields->removeByName('ForSale');
		
		
		if(!$this->ID) {
			$fields->removeByName("Root.Images");
			$fields->removeByName("Categories");
			$fields->removeByName("Tags");
			$fields->removeByName("Colors");
			$fields->removeByName("Brands");
			$fields->addFieldToTab("Root.Main", new ReadonlyField("Note","Images","Please save project before attaching images."));
		}
		else {
			$gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
			$gridFieldConfig->addComponent(new GridFieldBulkManager());
			$gridFieldConfig->addComponent(new GridFieldBulkImageUpload());   
			$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
			$photoManager = new GridField("Images", "Project images", $this->Images()->sort("SortOrder"), $gridFieldConfig);
			$fields->addFieldToTab("Root.Images", $photoManager);
	//			->setFolderName('images/projects')
	//			->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'))
	//			->setPreviewMaxWidth(200)
	//			->setPreviewMaxHeight(140);
			
			//SortableUploadField::create("Images","Select images",$this->Images());
			//->setSortField("SortOrder");
		}
		
		//$fields->addFieldToTab("Root.Main", new HTMLEditorField("Content","Content",15), "Sold");
		
		if(Permission::check("PUBLISH_PROJECTS")) {
			$uf = SiteTreeURLSegmentField::create("URLSegment","URL Segment");
			$uf->setURLPrefix(Director::BaseURL() . "project/");
			$fields->addFieldToTab("Root.Publish", $uf);
			$fields->addFieldToTab("Root.Publish", new CheckboxField('Published', "Check to publish"));
			
			$c = DataObject::get("Category","Status='Published'","Title ASC");
			if($c) {
			   $fields->addFieldToTab("Root.Organize", new CheckboxSetField('Categories', 'Categories', $c->map("ID","Title")));
			}
			
			$col = DataObject::get("Color");
			if($col) {
			   $fields->addFieldToTab("Root.Organize", new CheckboxSetField('Colors', 'Colors', $col->map("ID","NiceColor")));
			}
			
			$b = DataObject::get("Brand","","Title ASC");
			if($b) {
			   $fields->addFieldToTab("Root.Organize", new CheckboxSetField('Brands', 'Brands', $b->map("ID","Title")));
			}
			
			$ma = DataObject::get("CarMake","","Title ASC");
			if($ma) {
			   $fields->addFieldToTab("Root.Organize", new DropdownField('CarMakeID', 'Car make', $ma->map("ID","Title")));
			}
			
			$mo = DataObject::get("CarModel","","Title ASC");
			if($ma) {
			   $fields->addFieldToTab("Root.Organize", new DropdownField('CarModelID', 'Car make', $mo->map("ID","Title")));
			}
			$previewField = $this->ID ? new LiteralField("Link","<div id='Link' class='field readonly'><div class='middleColumn'><span class='readonly right'><a href='".$this->Link()."' target='_blank'>Preview project gallery</a></span></div></div>") : new LiteralField("Link","<div id='Link' class='field readonly'><div class='middleColumn'><span class='readonly right'>Save to preview.</span></div></div>");
			
			$fields->addFieldToTab("Root.Publish", $previewField);
			
			$fields->addFieldToTab("Root.Main", new CheckboxField("ForSale","For sale"));
			$fields->addFieldToTab("Root.Main", new CheckboxField("Sold","Sold"));
			
		}
			
		
//		$myField = new ImageUploadField('Image','Select image');
//		$myField->setUploadFolder("images/pages");
//		return new FieldSet(
//			new TextField('Caption'),
//			new TextField("Link"),
//			$myField
//		);
		return $fields;
	}
		
	function canDelete($member = NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	function canCreate($member = NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	function canEdit($member = NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	function FirstImage() {
		if($this->Images()->count() > 0) {
			return $this->Images()->first()->Image();
		}
	}
	
	public function Link() {
		/* return Controller::curr()->Link() . */ return 'project/' . $this->URLSegment;       
	}
	
	public function AbsoluteLink() {
//		return Controller::curr()->AbsoluteLink() . 'project/' . $this->URLSegment;       
		return Director::AbsoluteBaseURL(). $this->Link();
	}
	
	function onBeforeWrite() {
		if((!$this->URLSegment || $this->URLSegment=='new-project') && $this->Title !='New project') {
			$this->URLSegment = SiteTree::generateURLSegment($this->Title);
		}
		else if ($this->isChanged('URLSegment')) {
			$segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
			$segment = preg_replace('/-+/','-',$segment);
			
			if(!$segment) {
				$segment="project-$this->ID";
			}
			$this->URLSegment = $segment;	
		}
		
		$count=2;
		while($this->LookForExistingURLSegment($this->URLSegment)) {
			$this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment).'-'.$count;
			$count++;
		}
		
		if(!$this->Created) {
			$this->Created = date("Y-m-d H:i:s");
		}
		
		parent::onBeforeWrite();
	}
	
	function LookForExistingURLSegment($URLSegment) {
		return(DataObject::get_one('Project', "URLSegment = '".$URLSegment."' AND Project.ID != ".$this->ID));
	}
//	
//	function ThumbnailURL($width=300) {
//		if($this->VideoEmbed) {
//			return "http://img.youtube.com/vi/".singleton("Page_Controller")->YouTubeID($this->VideoEmbed)."/0.jpg";
//		}
//		if($this->Images()->Count()>0) {
//			return $this->Images()->First()->Image()->setWidth($width)->URL;
//		}
//		return "http://www.placehold.it/300x200&text=No+image";
//	}
	function ThumbnailURL($width=300) {
		$i = $this->FirstImage();
		if($i) {
			return $i->CroppedImage($width,$width)->URL;
		}
		else {
			return "http://www.placehold.it/".$width."x".$width."&text=No+image";
		}
	}
	
	function ProjectCategories() {
		if($this->Categories()) {
			$results = new ArrayList();
			foreach($this->Categories()->limit(5,0) as $c) {
				$results->push(
					new ArrayData(array(
						"Title" => $c->Title,
						"Link" => $c->Link(),
						"Projects" => $c->ProjectsExcept($this->ID)
					))
				);
			}
			return $results;
		}
	}
	
}

function hex2rgb($hex, $opacity="0.5") {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
   return "rgba($r, $g, $b, $opacity)";
}