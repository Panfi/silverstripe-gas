<?php
class Manage extends ModelAdmin {
	
	private static $url_segment = 'configure';
	
	private static $menu_title = 'Configure';
	
	private static $managed_models = array(
		'ContactAction',
		'Brand',
		'Tag',
		'Color'
	);
		
	public $showImportForm = true;
	
	function SearchClassSelector(){
		return "dropdown";
	}
	
}