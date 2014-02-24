<?php

class Color extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Color' => 'Varchar(8)',
		'SortOrder' => 'Int'
	);
	
	private static $belongs_many_many = array(
		'Projects' => 'Project',
		'ProjectImages' => 'ProjectImage'
	);
	
	private static $summary_fields = array(
		'Title',
		'NiceColor'
	);
	private static $searchable_fields = array(
		'Title',
		'Color'
	);
	
	private static $default_sort = "SortOrder";
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Main", new TextField("Title","Friendly color name"));
		$fields->addFieldToTab("Root.Main", new ColorField("Color"));
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
	
	function NiceColor() {
		return "<span style='background:#".$this->Color.";padding:3px 5px; color:#555555;font-weight:bold; text-decoration:none !important;'>".$this->Title."</span>";
	}
	
	function Link() {
		return "color/".($this->ID);
	}
}