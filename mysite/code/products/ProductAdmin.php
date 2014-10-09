<?php

class ProductAdmin extends ModelAdmin {
  
  private static $url_segment = 'products';
  
  private static $menu_title = 'Products';
  
  private static $managed_models = array(
    'Product'
  );
    
  public $showImportForm = true;
  
  function SearchClassSelector(){
    return "dropdown";
  }
  
}