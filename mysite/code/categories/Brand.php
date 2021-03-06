<?php

class Brand extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Content' => 'HTMLText',
		'Website' => 'Varchar(255)',
		'URLSegment' => 'Varchar(255)',
		'SortOrder' => 'Int'
	);
	
	private static $has_many = array(
		'Products' => 'Product'
	);

	private static $belongs_many_many = array(
		'Projects' => 'Project',
		'Categories' => 'Category'
	);
	
	private static $has_one = array (
		'Image' => 'Image'
	);
	
	/* INDEXES AND SUMMARY */

	private static $default_sort = "Title ASC";

	private static $indexes = array (
		'URLSegment' => true,
		'SortOrder' => true
	);
	
	private static $summary_fields = array(
		"ID",
		"Title",
		"SortOrder"
	);

	static $api_access = array(
      'view' => true
    );
	
//	function getCMSFields() {
//		$fields = parent::getCMSFields();
//		$myField = new ImageUploadField('Image','Select image');
//		$myField->setUploadFolder("images/brands");
//		$fields->addFieldToTab("Root.Image",$myField);
//		
//		$fields->addFieldToTab("Root.Main", new TextField("SortOrder","Brand priority"),"Content");
//		
//		$c = DataObject::get("Category","Status='Published'","Title ASC");
//		if($c) {
//		   $fields->addFieldToTab("Root.Categories", new CheckboxSetField('Categories', 'Mark categories brand belongs to', $c->toDropdownMap("ID","Title")));
//		}
//		
//		return $fields;
//	}
		
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
		if((!$this->URLSegment || $this->URLSegment=='new-brand') && $this->Title !='New brand') {
			$this->URLSegment = SiteTree::generateURLSegment($this->Title);
		}
		else if ($this->isChanged('URLSegment')) {
			$segment = preg_replace('/[^A-Za-z0-9]+/','-',$this->URLSegment);
			$segment = preg_replace('/-+/','-',$segment);
			
			if(!$segment) {
				$segment="brand-$this->ID";
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
		return(DataObject::get_one('Brand', "URLSegment = '".$URLSegment."' AND Brand.ID != ".$this->ID));
	}
	
	public function Link() {
		return 'brands/' . $this->URLSegment;       
	}
	
	public function AbsoluteLink() {
		return $this->Link();
	}
	
	function onAfterWrite() {
		parent::onAfterWrite();
		if(!$this->SortOrder) {
			$max = Brand::get()->Max("SortOrder");
			$this->SortOrder = $max + 1;
			$this->write();
		}
	}


	/* PRODUCT STUFF */

	function ProductsByCategory($categoryID) {
		// $mylimit = 24;

		// if(!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0; 
		// $SQL_start = (int)$_GET['start'];

		if(!$categoryID) {
			$products = $this->Products()->sort("Title ASC"); //->limit($mylimit,$SQL_start);
		}
		else {
			// echo($categoryID);
			$products = Product::get()->where("BrandID = ".$this->ID." AND CategoryID = $categoryID")->sort("Title ASC"); //->limit($mylimit,$SQL_start);
			//return $this->Products()->where("CategoryID = $category->ID")->limit($mylimit,$SQL_start);
				
			/*
				$sqlQuery = new SQLQuery("Product.ID","Product");
				$join = "";
				$sqlQuery->addInnerJoin("Category_Products","Category_Products.ProductID = Product.ID");
				$where= "Category_Products.CategoryID = ".$categoryID." AND Product.BrandID = ".$this->ID;
				$sqlQuery->addWhere($where);
				$sqlQuery->setDistinct(true);
				$sqlQuery->setLimit($mylimit,$SQL_start);
				// $sqlQuery->setOrderBy("Project.Created DESC");
				$result = $sqlQuery->execute();
				
				$product_ids = array();

				foreach($result as $rowArray) {
					$product_ids[] = $rowArray["ID"];
				}
					
				if(count($product_ids)>0) {
					$p = Product::get()->where("Product.ID IN (0, ".implode(",", $product_ids).")");
					return $p;
				}
          */
				//return $this->Products(); //->where("CategoryID", $category->ID); //->where("BrandID = " . $this->ID . " AND CategoryID",$category->ID);
				// $p = Product::get();
				//return $p;
		}
		if($products->count()>0) {
			return $products;
		}
		// 	}
		// 	else {
		// 		echo("Category not found, redirect back");
		// 		Controller::curr()->Redirect($this->Link());
		// 	}
		// }
	}

	function ProductCategories() {
		$cats = $this->Products()->column("CategoryID");
		return($cats);
	}
}