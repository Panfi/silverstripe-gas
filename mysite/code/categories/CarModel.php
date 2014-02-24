<?php

class CarModel extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)',
		'URLSegment' => 'Varchar(255)'
	);
	
	private static $has_many = array(
		'Projects' => 'Project',
	); 
	
	private static $has_one = array (
		'CarMake' => 'CarMake'
	);
	
	private static $api_access = array(
		 'view' => array('ID','Title')
	);
	
		
	function canDelete($member=NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	function canCreate($member=NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	
	function onBeforeWrite() {
		if((!$this->URLSegment || $this->URLSegment=='new-model') && $this->Title !='New model') {
			$this->URLSegment = SiteTree::generateURLSegment($this->Title);
		}
		else if ($this->isChanged('URLSegment')) {
			$segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
			$segment = preg_replace('/-+/','-',$segment);
			
			if(!$segment) {
				$segment="model-$this->ID";
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
		return(DataObject::get_one('CarModel', "URLSegment = '".$URLSegment."' AND CarModel.ID != ".$this->ID));
	}
	
	public function Link() {
		return 'model/' . $this->URLSegment;       
	}
	
	function AbsoluteLink() {
		return Director::absoluteBaseURL()."/model/".urlencode($this->Title);
	}
	
}