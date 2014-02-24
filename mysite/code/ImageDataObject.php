<?php

class ImageDataObject extends DataExtension {

	private static $summary_fields = array( 
	   'Thumbnail' => 'Thumbnail',
	   'Title' => 'Title'
	);
	
	public function getThumbnail() { 
		return $this->owner->Image()->CMSThumbnail();
	}
	
}