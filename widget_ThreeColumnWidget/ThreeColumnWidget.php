<?php
 
class ThreeColumnWidget extends Widget {
	private static $db = array(
		'WidgetTitle' => 'Varchar(255)',
		'TitleOne' => 'Varchar(255)',
		'TitleTwo' => 'Varchar(255)',
		'TitleThree' => 'Varchar(255)',
		'ContentOne' => 'Text',
		'ContentTwo' => 'Text',
		'ContentThree' => 'Text',
		'LinkOne' => 'Varchar(255)',
		'LinkTwo' => 'Varchar(255)',
		'LinkThree' => 'Varchar(255)'
	);
	
	private static $has_one = array(
		'ImageOne' => 'Image',
		'ImageTwo' => 'Image',
		'ImageThree' => 'Image'
	);
 
	private static $title = "";
	private static $cmsTitle = 'Three Columns';
	private static $description = 'Adds a thee-column section with images, text and links.';
	
	function Title() {
		return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
	}
	
//	function output() {
//		return $this->Content;
//	}
 
	function getCMSFields() {
		$images = DataObject::get("Image");
		$imap = $images->toDropdownMap("ID","Title","Select");
		$imageField1 = new DropdownField('ImageOneID','Choose image 1', $imap);
		$imageField2 = new DropdownField('ImageTwoID','Choose image 2', $imap);
		$imageField3 = new DropdownField('ImageThreeID','Choose image 3', $imap);
		return new FieldSet(
			new TextField('WidgetTitle', _t('TITLE', 'Title (optional)')),
			new TextField('TitleOne'),
			new TextField('LinkOne'),
			$imageField1,
			new TextareaField('ContentOne'),
			new TextField('TitleTwo'),
			new TextareaField('ContentTwo'),
			new TextField('LinkTwo'),
			$imageField2,
			new TextField('TitleThree'),
			new TextareaField('ContentThree'),
			new TextField('LinkThree'),
			$imageField3
		);
	}
}
 
?>
