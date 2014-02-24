<?php

class TimelinePage extends Page {

   	private static $db = array(
   		'AggregateProjects' => 'Boolean'
   	);

//	private static $has_one = array(
//	);
	
	private static $has_many = array(
		'TimelineItems' => 'TimelineItem'
	);
	
//	private static $defaults = array(
//	);
		
	private static $allowed_children = array("none");
	
	function getCMSFields() {
		    $fields = parent::getCMSFields();
		 	
//		 	$timelineManager = new DataObjectManager(
//		 		$this, // Controller
//		 		'TimelineItems', // Source name
//		 		'TimelineItem', // Source class
//		 		array(
//		 			'Headline' => 'Headline'
//		 		), // Headings 
//		 		'getCMSFields' // Detail fields (function name or FieldSet object)
		 		// Filter clause
		 		// Sort clause
		 		// Join clause
//		 	);
//		 	$timelineManager->setUploadFolder("images/pages");
		 	$fields->addFieldToTab("Root.Content.Timeline",new CheckboxField("AggregateProjects","Check if you want to aggregate projects into the timeline instead"));
//		 	if($this->AggregateProjects==false) {
//			 	$fields->addFieldToTab("Root.Content.Timeline",$timelineManager);
//			 }
		 	
			return $fields;
		}
	
		
}
 
class TimelinePage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function Projects() {
		$p = DataObject::get("Project","","Created ASC");
		if($p){ 
			return $p;
		}
	}
			
}

