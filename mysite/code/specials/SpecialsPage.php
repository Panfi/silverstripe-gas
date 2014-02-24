<?php

class SpecialsPage extends Page implements PermissionProvider {

//   	private static $db = array(
//   	);
//
//	private static $has_one = array(
//	);
//	
//	private static $has_many = array(
//	);
//	
//	private static $defaults = array(
//	);
		
	private static $allowed_children = array("none");
	
}
 
class SpecialsPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'special'
	);

	public function getSpecials() {
		$specials = DataObject::get("Special","Published=1");
		return $specials ? $specials : null;
	}
	
	function special()
	{	
		if($Item = $this->getCurrentItem()) {
			$Data = array(
				'Title' => $Item->Title,
				'Content' => $Item->Content,
				'MetaTitle' => $Item->Title,
				'Image' => $Item->Image(),
				'Item' => $Item,
				'ThumbnailURL' =>$Item->ThumbnailURL(),
				'AbsoluteLink' =>$Item->AbsoluteLink()
			);
			return $this->customise($Data)->renderWith(array('Special','Page'));	
		}
	    else {
			return $this->httpError(404, _t("Special.NOTFOUND","Special not found."));
		}
	}
	
	public function getCurrentItem()
	    {
	        $Params = $this->getURLParams();
	        $URLSegment = Convert::raw2sql($Params['ID']);  
			if($URLSegment && $Item = DataObject::get_one('Special',
	        	"URLSegment = '" . $URLSegment . "'"))
			{       
			return $Item;
		}
	}	
}

