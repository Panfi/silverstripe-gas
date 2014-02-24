<?php

class Special extends DataObject {
	
	private static $db = array(
			'Title' => 'Varchar(255)',
			'Content' => 'HTMLText',
			'URLSegment' => 'Varchar(255)',
			'VideoEmbed' => 'Text',
			'Published' => 'Boolean',
			'Featured' => 'Boolean'
		);
		
		private static $has_one = array(
			'Image' => 'Image'
		);
		
//		private static $has_many = array(
//			'Images' => 'SpecialImage'
//		);
		
		private static $casting = array(
			"LastEdited" => "SS_Datetime",
			"Created" => "SS_Datetime"
		);
		
		private static $summary_fields = array(
			'Title',
			'Created',
			'Published' => 'IsPublished',
			'Featured'
		);
		
		private static $searchable_fields = array(
			'Title',
			'Published'
		); 	
		
		private static $indexes = array (
			'URLSegment' => true
		);
		
		private static $default_sort = 'Created DESC';
		
		private static $singular_name = "Special";
		private static $plural_name = "Specialss";
		
		private static $defaults = array(
			'Title'=>'New special',
			'URLSegment'=>'new-special',
			'Published' => 1
		);
		
		public function getCMSFields()
		{
			
			//$imageField = new ImageUploadField("Image","Upload image");
			//$imageField->setUploadFolder("specials/images");
			
			$myField = new UploadField('Image','Select image');
			$myField->setFolderName("images/specials");
			
//			$pf = new DatetimeField("PublishDate",$this->fieldLabel('PublishDate'));
//			$pf->getDateField()->setConfig('showcalendar', true);
//			$pf->getTimeField()->setConfig('showdropdown', true); 
//			$date = date('d/m/Y h:i:s a');
			
			$tabPublish = new Tab(_t('BlogItem.TABPUBLISH', 'Publish'),
//				$pf,
				new TextField("URLSegment", $this->fieldLabel('URLSegment')),
				new DatetimeField_Readonly("LastEdited",$this->fieldLabel('LastEdited')),
				new CheckboxField("Published",$this->fieldLabel('Published'))
//					new CheckboxField("ShowComments",$this->fieldLabel('ShowComments'))
			);
			
			$previewField = $this->ID ? new LiteralField("Link","<div id='Link' class='field readonly'><div class='middleColumn'><span class='readonly right'><a href='".$this->Link()."' target='_blank'>Preview special</a></span></div></div>") : new LiteralField("Link","<div id='Link' class='field readonly'><div class='middleColumn'><span class='readonly right'>Save to preview.</span></div></div>");
		
			
			$extraFields = new TabSet ("Root",
				$contentTab = new Tab(_t("BlogItem.TABCONTENT", "Content"),
					new TextField("Title", $this->fieldLabel('Title')),
					new HtmlEditorField("Content", "Content",10),
//					$imageField,
					new TextareaField("VideoEmbed", "Enter Custom Embed Code",5),
					new CheckboxField('Featured', "Featured"),
					$myField,
					$previewField
				),
				$tabPublish
			);
			
			$f = new FieldList(
				$extraFields
			);
				
			return $f;
		}
		
		
		function canDelete($member = NULL) { 
			return Permission::check('CMS_ACCESS_CMSMain'); 
		}
		
		function canCreate($member = NULL) { 
			return true; //return Permission::check('CMS_ACCESS_CMSMain'); 
		}
		function canEdit($member = NULL) { 
			return true; //return Permission::check('CMS_ACCESS_CMSMain'); 
		}
		
		function onBeforeWrite() {
			if((!$this->URLSegment || $this->URLSegment=='new-special') && $this->Title !='New special') {
				$this->URLSegment = SiteTree::generateURLSegment($this->Title);
			}
			else if ($this->isChanged('URLSegment')) {
				$segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
				$segment = preg_replace('/-+/','-',$segment);
				
				if(!$segment) {
					$segment="special-$this->ID";
				}
				$this->URLSegment = $segment;	
			}
			
			$count=2;
			while($this->LookForExistingURLSegment($this->URLSegment)) {
				$this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment).'-'.$count;
				$count++;
			}
			
			parent::onBeforeWrite();
		}
		
		function LookForExistingURLSegment($URLSegment) {
			return(DataObject::get_one('Special', "URLSegment = '".$URLSegment."' AND Special.ID != ".$this->ID));
		}
		
		public function Link() {
			return 'specials/special/' . $this->URLSegment;       
		}
		
		public function AbsoluteLink() {
			return $this->Link();
		}
		
		public function Permalink() {
			return $this->Link();
		}
		
		public function IsPublished() {
			return $this->Published ? "Yes" : "No";
		}
		
		public function FirstImage() {
			if($this->Images()->First()) {
				return $this->Images()->First()->Image();
			}
		}
		
		function ThumbnailURL() {
			if($this->VideoEmbed) {
				return "http://img.youtube.com/vi/".singleton("Page_Controller")->YouTubeID($this->VideoEmbed)."/0.jpg";
			}
			if($this->ImageID) {
				return $this->Image()->setWidth(300)->URL;
			}
			return "http://www.placehold.it/300x200&text=No+image";
		}
		
		
}



?>