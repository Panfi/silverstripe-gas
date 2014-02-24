<?php

class Tag extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)'
	);
	
	private static $belongs_many_many = array(
		'Projects' => 'Project',
		'Articles' => 'Article'
	);
	
	private static $has_one = array (
	);
	
	private static $api_access = array(
		 'view' => array('ID','Title')
	);
	
	private static $default_sort = "Title ASC";
	
		
	function canDelete($member = NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	function canCreate($member = NULL) { 
		return Permission::check('CMS_ACCESS_CMSMain'); 
	}
	
	function Link($member = NULL) {
		return "tags/".urlencode($this->Title);
	}
	
	function AbsoluteLink() {
		return Director::absoluteBaseURL()."/tag/".urlencode($this->Title);
	}
	
	function onBeforeWrite() {
		parent::onBeforeWrite();
		$this->Title = strtolower($this->Title);
	}
	
}