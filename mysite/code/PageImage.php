<?php

class PageImage extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'Link' => 'Varchar(255)'
	);

	private static $has_one = array (
		'Page' => 'Page',
		'Image' => 'Image'
	);

//	function getCMSFields_forPopup() {
//
//		$myField = new ImageUploadField('Image','Select image');
//		$myField->setUploadFolder("images/pages");
//		return new FieldSet(
//			new TextField('Caption'),
//			new TextField("Link"),
//			$myField
//		);
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

	function SmallView() {
		return $this->renderWith('HasManyObject_small');
	}

	function forTemplate() {
		return $this->renderWith('PageImage');
	}

	function LargeImageURL() {
		if($this->Image() && $this->Image()->CroppedImage(1812,612)) {
			if( $this->Image()->getWidth()==1812 && $this->Image()->getHeight()==612 ) {
				return $this->Image()->URL;
			}
			else {
				return $this->Image()->CroppedImage(1812,612)->URL;
			}
		}
	}

	function MediumImageURL() {
		if($this->Image() && $this->Image()->CroppedImage(1280,408)) {
			return $this->Image()->CroppedImage(1280,408)->URL;
		}
	}

	function SmallImageURL() {
		if($this->Image() && $this->Image()->CroppedImage(800,255)) {
			return $this->Image()->CroppedImage(800,255)->URL;
		}
	}

}



?>
