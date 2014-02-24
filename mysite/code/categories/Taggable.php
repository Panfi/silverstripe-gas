<?php 

class Taggable extends DataExtension {

	static private $many_many = array(
		'Tags' => 'Tag'
	);

	public function updateCMSFields(FieldList $fields) {
	   $tags = DataObject::get("Tag");
	   $fields->removeByName("Tags");
	   if($tags) {
		   $fields->addFieldToTab("Root.Organize", new CheckboxSetField('Tags', 'Tags', $tags->map("ID","Title")));
		}
	}

}