<?php

class HomePage extends Page {

//   	private private static $db = array(
//   /*		'BlockList' => "Text" */
//   	);

//	private private static $has_one = array(
//	);
//	
//	private private static $defaults = array(
//	);
//		
//	private  private static $allowed_children = array("none");
	
//	public function getCMSFields()
//	{
//		$fields = parent::getCMSFields();
//		$c = DataObject::get("Category","");
//		if($c) {
//			$fields->addFieldToTab("Root.Content.Categories",  new MultiSelectField("FeaturedCategories", "Featured categories", $c->map("ID","Title")));
//			$fields->addFieldToTab("Root.Content.Main", new TextareaField("BlockList", "Fan item blocklist"));
//		}
//		return $fields;
//	}
//		
}
 
class HomePage_Controller extends Page_Controller {
	
	private static $allowed_actions = array (
		'index',
//		'addfanitem',
//		'hidefanitem',
		'devupdate'=> 'ADMIN',
		'pngtojpg' => 'ADMIN'
	);
	
	public function init() {
		parent::init();
		//if(isset($_GET["test"])==1) {
			//$this->getInstagram();
			//$this->getTwitter();
		//}
	}
	
	public function getBlogroll() {
		$blogroll = DataObject::get("Article","Published=1 AND Featured=1","Created DESC","","",10);
		return $blogroll ? $blogroll : null;
	}
	
	public function getFeaturedCategories() {
		$c = DataObject::get("Category","FeaturedHome=1","FeaturedOrder ASC");
		if($c) {
			return $c;
		}
	}
	
	public function devupdate() {
		$d = DataObject::get("Project");
		foreach($d as $br) {
			$br->write();
			echo($br->Title."<br/>");
		}
	}
	
		
	public function SocialCacheKey() {
		$numberKey = Permission::check("ADMIN") ? "_1" : "_0";
		return 'socialimages_'.$numberKey;
	}
	
	public function pngtojpg() {
		$files = DataObject::get("Image","Filename LIKE '%.png'");
		foreach($files as $f) {
			$fp = $f->getFullPath();
			if($f) {
				echo("Getting File: ".$fp);
				echo("<br/>");
			}
			$ext=$f->getExtension();
			if($ext=="png" || $ext=="PNG") {
				echo("File is PNG. ");
				$image = imagecreatefrompng($fp);
				$newpath = str_replace(".png",".jpg",$fp);
				$newname = str_replace(".png",".jpg",$f->Filename);
				echo("Creating JPG version. ");
				imagejpeg($image, $newpath, 95);
				$f->Filename = $newname;
				$f->write();
				imagedestroy($image);
				echo("JPG version done: ".$f->Filename);
				echo("<br/>");
			}
			else {
				echo("File not a PNG.");
			}
		}

		return null;
	}
	
	
//	function addfanitem() {
//		if($this->request->postVar('InstagramID') || $this->request->postVar('TwitterID')) {
//			$f = new FanItem();
//			$f->InstagramID = $this->request->postVar('InstagramID');
//			$f->TwitterID = $this->request->postVar('TwitterID');
//			$f->write();
//			return "New fan item has been added to the database!";
//		}
//	}
//	
//	function hidefanitem() {
//		if($itemID = $this->request->postVar('ItemID')) {
//			$page = DataObject::get_by_id("SiteTree",$this->ID);
//			$page->BlockList.= ",.".$itemID;
//			$page->writeToStage('Stage');
//			$page->publish("Stage", "Live");
//			echo "Item $itemID has been hidden.";
//		}
//		else {
//			echo "Nothing happened.";
//		}
//	}
	
	
}