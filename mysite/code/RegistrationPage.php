<?php

class RegistrationPage extends Page {

//   	private static $db = array(
//   	);
//
//	private static $has_one = array(
//	);
//	
//	private static $has_many = array(
//	);
//	
//	private static $defaults = array(
//	);
		
	private static $allowed_children = array("none");
		
}
 
class RegistrationPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
		if(Member::currentUserID()) {
			//Director::redirect('/');
		}
		
	}
		
}