<?php
 
class HtmlContentWidget extends Widget {
	private static $db = array(
		'WidgetTitle' => 'Varchar(255)',
		'Content' => 'Text'
	);
 
	private static $title = "";
	private static $cmsTitle = 'HTML Content';
	private static $description = 'Adds HTML content to the widget sidebar.';
	
//	function getTitle() {
//		return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
//	}
 
	function getCMSFields() {
		return new FieldSet(
			new TextField('WidgetTitle', _t('TITLE', 'Title (optional)')),
			new TextareaField('Content', _t('CONTENT', 'Content'))
		);
	}
}
 
?>
