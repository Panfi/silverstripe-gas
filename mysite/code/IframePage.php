<?php

class IframePage extends Page {

  private static $db = array(
    'IframeURL' => 'Varchar(255)',
    'FullWidth' => 'Boolean'
  );

  private static $has_one = array(
  );

  private static $has_many = array(
  );

  private static $defaults = array(
  );

  private static $allowed_children = array("none");

  public function getCMSFields()
  {
    $fields = parent::getCMSFields();

    $fields->removeByName("CallToAction");
    $fields->removeByName("Summary");
    $fields->removeByName("CustomHtml");

    $fields->insertAfter(TextField::create("IframeURL", "URL to load the iframe"), "URLSegment");
    $fields->insertAfter(CheckboxField::create("FullWidth", "Check to enable full width"), "URLSegment");

    return $fields;
  }

}

class IframePage_Controller extends Page_Controller {

  public function init() {
    parent::init();
  }

}
