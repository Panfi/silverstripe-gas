<?php

class SocialFeedPage extends Page {

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
 
class SocialFeedPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
		'picks'
	);
	
	public function init() {
		parent::init();
	}
	
	public function getTwitter() {
			$twitter_search = "@chiquis626 filter:images";
			$twitter = new RestfulService("https://api.twitter.com/1.1/search/tweets.json", 900);
			$twitter->httpHeader('GET /1.1/search/tweets.json? HTTP/1.1');
			$twitter->httpHeader('Host: api.twitter.com');
			$twitter->httpHeader( "User-Agent: MundoTrevi.com v.1");
			$twitter->httpHeader('Content-Type: application/x-www-form-urlencoded;charset=UTF-8');
			$twitter->httpHeader('Authorization: Bearer '.TWITTER_BEARER_TOKEN);
	
			$params = array('q' => $twitter_search,"include_entities"=>"true","result_type"=>"mixed","count"=>"50");
			$twitter->setQueryString($params);
			$conn = $twitter->request();
			$tarray = json_decode($conn->getBody(), true);
			
			if(Permission::check("ADMIN")) {
			//print_r($conn->getBody());
			}
			//print_r($tarray);
			
			$results = new DataObjectSet();
			if(isset($tarray["statuses"])) {
				foreach($tarray["statuses"] as $item) {
					if(isset($item["entities"]["media"])) {
						$t=$item;
						//print_r($item["entities"]["media"][0]["media_url"]);
						$results->push(
							new ArrayData(
								array(
									'ImageURL' => $t["entities"]["media"][0]["media_url"].":medium",
									'Link' => "http://twitter.com/".$t["user"]["screen_name"]."/status/".$t["id_str"],
									'TwitterID' => $t["id_str"],
									'Class' => 'twitter'
								)
							)
						);
					}
				}
		
				$results->removeDuplicates("ImageURL");
				return $results;
			}
			return false;
		
		}
				
		public function getInstagram() {
			$instagram_id = "338958";
			$instagram_tag = "chiquis0626";
			$instagram = new RestfulService("https://api.instagram.com/v1/tags/".$instagram_tag."/media/recent", 900);
			$params = array("client_id" => INSTAGRAM_CLIENT_ID);
			$instagram->setQueryString($params);
			$iconn = $instagram->request();
			
			$iarray = json_decode($iconn->getBody(), true);
			
			$results = new DataObjectSet();
			//print_r($results->First()); //->images->thumbnail->url
			foreach($iarray["data"] as $item) {
				//print_r($item["images"]["thumbnail"]["url"]."<br/>");
				 $results->push(
					new ArrayData(
						array(
							'ImageURL' => $item["images"]["low_resolution"]["url"],
							'Link' => $item["link"],
							'InstagramID' => $item["id"],
							'Class' => 'instagram'
						)
					)
				); 
			}
			return $results;
		}
		
		public function SocialImages() {
			$results = new DataObjectSet();
			$results->merge($this->getInstagram());
			$results->merge($this->getTwitter());
			$results->sort("ID","RAND()");
			return $results;
		}
		
		public function getSocialPicks() {
			$picks = DataObject::get("FanItem");
			if($picks) {
				return $picks;
			}
		}
		
}

