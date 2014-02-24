<?php
class SpecialAdmin extends ModelAdmin {
	
	private static $url_segment = 'specials';
	
	private static $menu_title = 'Specials';
	
	private static $managed_models = array(
		'Special'
	);
		
	public $showImportForm = false;
	
//	function SearchClassSelector(){
//		return "dropdown";
//	}
	
}