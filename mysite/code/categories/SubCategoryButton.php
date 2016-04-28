<?php

class SubCategoryButton extends DataObject {

  private static $db = array(
    'Title' => 'Varchar(255)',
    'HtmlTitle' => 'Varchar(255)',
    'SortOrder' => 'Int'
  );

  private static $has_one = array (
    'Image' => 'Image',
    'Category' => 'Category'
  );

  // private static $api_access = array(
  //    'view' => array('ID','Title')
  // );


  function canDelete($member = NULL) {
    return Permission::check('CMS_ACCESS_CMSMain');
  }

  function canCreate($member = NULL) {
    return Permission::check('CMS_ACCESS_CMSMain');
  }


  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->addFieldsToTab("Root.Main", TextField::create("Title"));
    $fields->insertAfter(TextField::create("HtmlTitle"), "Title");
    $fields->removeByName("SortOrder");
    return $fields;
  }



  // public function Link() {
  //   return 'make/' . $this->URLSegment;
  // }

  // function AbsoluteLink() {
  //   return Director::absoluteBaseURL()."/make/".urlencode($this->Title);
  // }

}
