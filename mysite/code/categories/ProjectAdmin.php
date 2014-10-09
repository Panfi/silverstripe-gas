<?php

class ProjectAdmin extends ModelAdmin {
	
	private static $url_segment = 'vehicles';
	
	private static $menu_title = 'Vehicles';
	
	private static $managed_models = array(
		'Project',
		'CarMake',
		'CarModel'
	);
		
	public $showImportForm = true;
	
	function SearchClassSelector(){
		return "dropdown";
	}
	
}