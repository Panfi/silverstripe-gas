<?php

class ContactAction extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'SendToEmail' => 'Varchar(255)',
		'Active' => 'Boolean',
		'SortOrder' => 'Int'
	);
	
	private static $defaults = array(
		'SendToEmail' => 'info@galpinautosports.com',
		'Active' => 1
	);
	
	private static $summary_fields = array(
		'Title',
		'SendToEmail',
		'Active'
	);
	
	function onBeforeWrite() {
		parent::onBeforeWrite();
		if(!$this->ID) {
			$max = (ContactAction::get()->max("SortOrder")) + 1;
			$this->SortOrder = $max;
		};
	}
	
	private static $default_sort = "SortOrder ASC, Title ASC";
	
}