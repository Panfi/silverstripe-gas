<?php

class Product extends DataObject {
  
  private static $db = array(
    'Title' => 'Varchar(255)',
    'ProductCode' => 'Varchar(255)',
    'PartNumber' => 'Varchar(255)',
    'AvailableSizes' => 'Varchar(255)',
    'ModelYears' => 'Varchar(512)',
    'MakeText' => 'Varchar(255)',
    'ModelText' => 'Varchar(255)',
    'Price' => 'Currency',
    'Content' => 'HTMLText',
    'URLSegment' => 'Varchar(255)',
    'Published' => 'Boolean',
    'Featured' => 'Boolean',
    'ProductGroup' => 'Varchar(64)',
    'ProductGroup2' => 'Varchar(64)',
    'OriginalURL' => 'Varchar(255)'
  );
  
  private static $belongs_many_many = array(
    'Projects' => 'Project'
    // 'Categories' => 'Category'
  );

  private static $has_one = array (
    'Brand' => 'Brand',
    'Category' => 'Category'
  );
  
  private static $has_many = array (
    'Images' => 'ProductImage'
  );

  private static $defaults = array(
    'Title' => 'New product'
  );

  /* INDEXES AND SUMMARY FIELDS */
  
  private static $indexes = array (
    'URLSegment' => true
  );
  
  private static $summary_fields = array(
    "ID" => "ID",
    "Title" => "Title",
    "BrandID" => "BrandID",
    "CategoryID" => "CategoryID"
  );

  static $api_access = array(
    'view' => array('ID',"Title","Link","Image")
  );
  
 function getCMSFields() {
  $fields = parent::getCMSFields();
  

  $fields->removeByName("Categories");
  $fields->removeByName("Projects");
  $fields->removeByName("Brand");
  $fields->removeByName("Root.Images");

  if(!$this->ID) {
    $fields->removeByName("Projects");
    $fields->addFieldToTab("Root.Main", new ReadonlyField("Note","Images","Please save the product before attaching images."));
  }
  else {
    $gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
    $gridFieldConfig->addComponent(new GridFieldBulkManager());
    $gridFieldConfig->addComponent(new GridFieldBulkUpload());   
    $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
    $gridFieldConfig->getComponentByType('GridFieldBulkUpload')
      ->setUfSetup('setFolderName', 'products')
      ->setUfConfig('sequentialUploads', true);
    $photoManager = new GridField("Images", "Product images", $this->Images()->sort("SortOrder"), $gridFieldConfig);
    $fields->addFieldToTab("Root.Images", $photoManager);
  }

  $fields->addFieldToTab("Root.Main", new HtmlEditorField("Content","Description"), "AvailableSizes");

  $b = DataObject::get("Brand","1","Title ASC");
  if($b) {
    $brandfield = new DropdownField('BrandID', 'Brand', $b->map("ID","Title"));
    $brandfield->setEmptyString('(Select)');
    $fields->addFieldToTab("Root.Main", $brandfield, "Content");
  }

  $c = DataObject::get("Category","Status='Published'","Title ASC");
  if($c) {
    $fields->addFieldToTab("Root.Main", new CheckboxSetField('Categories', 'Mark categories ths product belongs to', $c->map("ID","Title")));
  }

  $v = DataObject::get("Project","Published=1","Title ASC");
  if($v) {
    $fields->addFieldToTab("Root.Main", new CheckboxSetField('Projects', 'Mark the projects ths product is found in', $v->map("ID","CMSListPreview")));
  }

  return $fields;
 }
    
  function canDelete($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }
  function canCreate($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }
  function canEdit($member = NULL) { 
    return Permission::check('CMS_ACCESS_CMSMain'); 
  }
  
  function onBeforeWrite() {
    if((!$this->URLSegment || $this->URLSegment=='new-product') && $this->Title !='New product') {
      $this->URLSegment = SiteTree::generateURLSegment($this->Title);
    }
    else if ($this->isChanged('URLSegment')) {
      $segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
      $segment = preg_replace('/-+/','-',$segment);
      
      if(!$segment) {
        $segment="product-$this->ID";
      }
      $this->URLSegment = $segment; 
    }
    
    $count=2;
    while($this->LookForExistingURLSegment($this->URLSegment)) {
      $this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment).'-'.$count;
      $count++;
    }
    
    parent::onBeforeWrite();
  }
  
  function LookForExistingURLSegment($URLSegment) {
    return(DataObject::get_one("Product","URLSegment = '".$URLSegment."' AND Product.ID != ".$this->ID));
  }
  
  public function Image() {
    return $this->Images()->Count()>0 ? $this->Images()->First() : false;
  }

  public function ImageCount() {
    return $this->Images() ? $this->Images()->Count() : 0;
  }

  function ThumbnailURL($width=300) {
    if($this->Image()) {
      $i = $this->Image()->Image();
      if($i) {
        return $i->PaddedImage($width,$width)->URL;
      }
    }
    else {
      return "http://www.placehold.it/".$width."x".$width."&text=No+image";
    }
  }

  public function Link() {
    return 'product/' . $this->URLSegment;       
  }
  
  public function AbsoluteLink() {
    return $this->Link();
  }
  
  // function onAfterWrite() {
  //   parent::onAfterWrite();
  //   if(!$this->SortOrder) {
  //     $max = Brand::get()->Max("SortOrder");
  //     $this->SortOrder = $max + 1;
  //     $this->write();
  //   }
  // }
}

