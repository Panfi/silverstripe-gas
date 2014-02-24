<?php

class TimelineItem extends DataObject {
	
	private static $db = array(
		'Headline' => 'Varchar(255)',
		'Text' => 'Text',
		'ExtraClass' => 'Varchar(64)',
		'Media' => 'Text',
		'Credit' => 'Varchar(128)',
		'Caption' => 'Varchar(255)',
		'StartDate' => 'Date',
		'EndDate' => 'Date'
	);
	
	private static $has_one = array (
		'TimelinePage' => 'TimelinePage',
		'Image' => 'Image'
	);
	
	private static $default_sort = "StartDate DESC, Created DESC";
		
	function getCMSFields() {

		$myField = new ImageUploadField('Image','Select image');
		$myField->setUploadFolder("images/timeline");
		
		$sfield = new DateField('StartDate','Start date');
		$sfield->setConfig('showcalendar', 1); // field-specific setting

		$efield = new DateField('EndDate','End date');
		$efield->	setConfig('showcalendar', 1); // field-specific setting
		
		return new FieldSet(
			new TextField('Headline'),
			$sfield,
			$efield,
			new TextField('Media'),
			new TextField('Caption'),
			new TextField('Credit'),
			new TextareaField('Text',"Text"),
			$myField,
			new TextField('ExtraClass')
		);
	}
		
	function canDelete($member=NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	function canCreate($member=NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	function canEdit($member=NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	/*	
	public function Landscape()
	{
		return $this->File()->getWidth() > $this->File()->getHeight();
	}
	
	public function Portrait()
	{
		return $this->File()->getWidth() < $this->File()->getHeight();
	}
	
	public function Large()
	{
		if($this->Landscape())
			return $this->File()->SetWidth(740);
		else {
			return $this->File()->CroppedFromTopImage(740,450);
		}
	}
	*/
	
//	function Link() {
//		if($this->Link) {
//			return $this->Link;
//		}
//		else {
//			return $this->Page()->AbsoluteLink();
//		}
//	}
//	function getTitle() {
//		return $this->Page()->Title;
//	}
}



?>