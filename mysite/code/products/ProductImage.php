<?php

class ProductImage extends DataObject {
  
  private static $db = array(
  );
  
  private static $has_one = array (
    'Product' => 'Product',
    'Image' => 'Image',
    'SortOrder' => 'Int'
  );
  
  private static $default_sort = "SortOrder ASC, Created DESC";
  
  function canDelete($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }
  function canCreate($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }
  function canEdit($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }

  function Large($maxsize=1600, $mobileFactor = 1) {
    if($i = $this->Image()) {
      if($i->getOrientation == "ORIENTATION_PORTRAIT") {
//        if($i->getWidth() < $maxsize) {
//          return $i->URL;
//        }
//        else {
          return $i->setWidth($maxsize)->URL;
//        }
      }
      else {
//        if($i->getHeight() < $maxsize) {
//          return $i->URL;
//        }
//        else {
          return $i->setHeight($maxsize)->URL;
//        }
      }
    }
  }

}



?>