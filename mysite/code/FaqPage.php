<?php

class FaqPage extends Page {

   	private static $db = array(
   	);

	private static $has_one = array(
	);
	
	private static $has_many = array(
		'Questions' => 'FaqItem'
	);
	
	private static $defaults = array(
	);
		
	private static $allowed_children = array("none");
	
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		
		$gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
		$gridFieldConfig->addComponent(new GridFieldBulkManager());
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    

		$faqManager = new GridField("Questions", "Questions", $this->Questions()->sort("SortOrder"), $gridFieldConfig);
		
		$fields->addFieldToTab('Root.FAQs', $faqManager);
		return $fields;
	}
		
}
 
class FaqPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
}


class FaqItem extends DataObject {

	private static $db = array(
		"Question" => "Varchar(255)",
		"Answer" => "Text"
	);
	
	private static $has_one = array(
		'FaqPage' => 'FaqPage'
	);
	
	private static $summary_fields = array(
		"Question"
	);
}