<?php

class ProjectImage extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)'
	);
	
	private static $has_one = array (
		'Project' => 'Project',
		'Image' => 'Image'
	);
	
	private static $many_many = array(
		'Category' => 'Category',
		'Color' => 'Color'
	);
	
	private static $default_sort = "SortOrder ASC, Created DESC";
		
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Category');
		$fields->removeByName('Color');
		if($this->ID) {

			$c = Category::get()->sort("Title ASC");
			if($c) {
			   $fields->addFieldToTab("Root.Main", new CheckboxSetField('Category', 'Categories', $c->map("ID","Title")));
			}
			
			$b = $this->Project()->Colors();
			if($b) {
			   $fields->addFieldToTab("Root.Main", new CheckboxSetField('Color', 'Colors', $b->map("ID","Title")));
			}
		}
		else {
			$fields->addFieldToTab("Root.Main", new ReadonlyField("Note","Note","Save Project image first to tag categories and colors."));
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
	
//	function SmallView() {
//		return $this->renderWith('HasManyObject_small');
//	}
//	
//	function forTemplate() {
//		return $this->renderWith('PageImage');
//	}
//	function LeadingImageURL() {
//		if($this->Image()) {
//			if( $this->Image()->getWidth()==1280 && $this->Image()->getHeight()==408 ) {
//				return $this->Image()->URL;	
//			}
//			else {
//				return $this->Image()->CroppedImage(1280,408)->URL;	
//			}
//		}
//	}

	function Large($maxsize=1600, $mobileFactor = 1) {
		if($i = $this->Image()) {
			if($i->getOrientation == "ORIENTATION_PORTRAIT") {
//				if($i->getWidth() < $maxsize) {
//					return $i->URL;
//				}
//				else {
					return $i->setWidth($maxsize)->URL;
//				}
			}
			else {
//				if($i->getHeight() < $maxsize) {
//					return $i->URL;
//				}
//				else {
					return $i->setHeight($maxsize)->URL;
//				}
			}
		}
	}

	function Link() {
		return $this->Project()->Link()."/image/".$this->ID;
	}
	
	function AbsoluteLink() {
		return Director::AbsoluteBaseURL().$this->Project()->Link()."/image/".$this->ID;
	}
}



?>