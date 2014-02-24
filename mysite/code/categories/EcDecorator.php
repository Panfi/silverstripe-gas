<?php 

class EcDecorator extends DataExtension {

	private static $db = array(
		'EcommerceLink' => 'Varchar(255)'
	);
	
//	public function updateCMSFields(FieldSet $fields) {
//		if($this->owner->ClassName=="Category") {
//		   $fields->addFieldToTab("Root.Content.Main", new TextField("EcommerceLink","E-commerce link"));
//		}
//		else {
//			$fields->addFieldToTab("Root.Main", new TextField("EcommerceLink","E-commerce link"));
//		}
//	}

}