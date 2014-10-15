<?php

class Product extends DataObject {
  
  private static $db = array(
    'Title' => 'Varchar(255)',
    'ProductCode' => 'Varchar(255)',
    'AvailableSizes' => 'Varchar(255)',
    'Price' => 'Currency',
    'Content' => 'HTMLText',
    'URLSegment' => 'Varchar(255)',
    'Published' => 'Boolean',
    'Featured' => 'Boolean'
  );
  
  private static $belongs_many_many = array(
    'Projects' => 'Project',
    'Categories' => 'Category'
  );

  private static $has_one = array (
    'Brand' => 'Brand'
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
    "Title" => "Title",
    "Brand.Title" => "Brand"
  );
  
 function getCMSFields() {
  $fields = parent::getCMSFields();
  

  $fields->removeByName("Categories");
  $fields->removeByName("Projects");
  $fields->removeByName("Brand");

  if(!$this->ID) {
    $fields->removeByName("Projects");
    $fields->removeByName("Root.Images");
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

  $b = DataObject::get("Brand","1","Title ASC");
  if($b) {
     $fields->addFieldToTab("Root.Main", DropdownField::create('BrandID', 'Brand', $b->map("ID","Title")));
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