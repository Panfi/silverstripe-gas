<?php

class ProductVariation extends DataObject {
	
  private static $db = array(
    'Title' => 'Varchar(255)',
    'PartNumber' => 'Varchar(255)',
    'Description' => 'Text',
    'Extra' => 'Text',
    'VersionText' => 'Varchar(255)',
    'Year' => 'Varchar(255)',
    'ModelText' => 'Varchar(255)',
    'MakeText' => 'Varchar(255)',
    'VariationPrice' => 'Currency'
  );
  
  private static $has_one = array (
    'Product' => 'Product'
  );

}