<?php

class CustomFilterPage extends Page {

   private static $db = array(
   		'FilterType' => "Enum('ForSale,PickYourRide')"
   	);

	private static $allowed_children = array("none");
	
	function DropdownTitle() {
		$String = '' . $this->Parent()->Title . ' --- ' . $this->Title;
		return $String;
	}
	
	function getCMSFields() {
	    $fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Content.Settings", new DropdownField("FilterType","Set page type", singleton('CustomFilterPage')->dbObject('FilterType')->enumValues()));
		return $fields;
	}
	
}
 
class CustomFilterPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
		"index",
		"FilterForm",
		"getmodels"
	);
	
	private static $length = 20;
	
	public function index() {
		if(Director::is_ajax() || $_GET["Ajax"]==1) {
			return $this->renderWith("CustomFilterPage_reload");
		}
		else {
			return array();
		}
	}
	
//	public function Projects() {
//		return DataObject::get("Project","ForSale=1");
//	}

	public function Projects() {
		$where = "1";
		$sqlQuery = new SQLQuery("Project.*","Project");
		
		if(($c=(int)$this->request->getVar('Category')) && $c>0 ) {
			$where.= " AND Category_Projects.CategoryID = $c";
			$sqlQuery->addLeftJoin("Category_Projects","Category_Projects.ProjectID = Project.ID");
//			$join.= " LEFT JOIN Category_Projects ON Category_Projects.ProjectID = Project.ID";
		}
		
		if(($b=(int)$this->request->getVar('Brand')) && $b>0 ) {
			$where.= " AND Project_Brands.BrandID = $b";
			$sqlQuery->addLeftJoin("Project_Brands","Project_Brands.ProjectID = Project.ID");
//			$join.= " LEFT JOIN Project_Brands ON Project_Brands.ProjectID = Project.ID";
		}
		
		if(($co=(int)$this->request->getVar('Color')) && $co>0 ) {
			$where.= " AND Project_Colors.ColorID = $co";
			$sqlQuery->addLeftJoin("Project_Colors","Project_Colors.ProjectID = Project.ID");
//			$join.= " LEFT JOIN Project_Colors ON Project_Colors.ProjectID = Project.ID";
		}
		
		if(($t=(int)$this->request->getVar('Tag')) && $t>0 ) {
			$where.= " AND Project_Tags.TagID = $t";
			$sqlQuery->addLeftJoin("Project_Tags","Project_Tags.ProjectID = Project.ID");
//			$join.= " LEFT JOIN Project_Tags ON Project_Tags.ProjectID = Project.ID";
		}
		
		if(($ma=(int)$this->request->getVar('Make')) && $ma>0 ) {
			$where.= " AND CarMakeID = $ma";
		}
		
		if(($mo=(int)$this->request->getVar('Model')) && $mo>0 ) {
			$where.= " AND CarModelID = $mo";
		}
		//if($where!="1") {
			if($this->FilterType=="ForSale") {
				$where.=" AND ForSale=1 AND Sold!=1";
			}
			$p=0;
			if($this->request->getVar('p')>0) {
				$p = (int)$this->request->getVar('p');
			}
			$sqlQuery->addWhere($where);
			$sqlQuery->setDistinct(true);
			$sqlQuery->setLimit(12,$p*12);
			$result = $sqlQuery->execute();
			$arrayList = new ArrayList();
			foreach($result as $rowArray) {
				$p = new Project($rowArray);
				$arrayList->push($p);
			}
			return $arrayList;
		//}
	}
	
	
	
	//The function which generates our form
	function Form() 
	{
		
		$page = 0;
		if((int)$_GET["p"]>0) {
			$page = (int)$_GET["p"];
		}
		$pagefield = new HiddenField("p","p",$page);
		
		/* Filters:
			Brands
			Categories
			Colors
			Keywords */
		if($this->FilterType=="ForSale") {
			$bf = new LiteralField("Brands","Brands");
			$b = DataObject::get("Brand");
			if($b) {
				$bf = new DropdownField("Brand","Brand",$b->map("ID","Title"),$this->request->getVar('Brand'));
				$bf->setEmptyString("All brands");
			}
			
			$cf = new LiteralField("Categories","Categories");
			$c = DataObject::get("Category");
			if($c) {
				$cmap = $c->map("ID","Title");
				$cf = new DropdownField("Category","Category",$cmap,$this->request->getVar('Category'));
				$cf->setEmptyString("All categories");
			}
			
			$cof = new LiteralField("Color","Color");
			$co = DataObject::get("Color");
			if($co) {
				$comap = $co->map("ID","Title");
				$cof = new DropdownField("Color","Color",$co->map("ID","Title"),$this->request->getVar('Color'));
				$cof->setEmptyString("All colors");
			}
			
			$tf = new LiteralField("Tag","Tag");
			$t = DataObject::get("Tag");
			if($t) {
				$tmap = $t->map("ID","Title");
				$tf = new DropdownField("Tag","Tag",$tmap,$this->request->getVar('Tag'));
				$tf->setEmptyString("All tags");
			}
	
			$typeField = new DropdownField("Type","Type",array(0=>"All","news"=>"News","projects" => "Projects","specials" => "Specials"),$this->request->getVar('Type'));
							
	      	// Create fields
		    $fields = new FieldList(
		    	new LiteralField("Test", '<h4>Filter vehicles <img src="mysite/images/loader-small.gif" class="loader" alt="Loading" /></h4>'),
				$cf,
				$bf,
				$cof,
				$tf,
				$pagefield
			);
		}
		elseif ($this->FilterType=="PickYourRide") {
		
			$maf = new LiteralField("Make","Make");
			$ma = DataObject::get("CarMake");
			if($ma) {
				$mamap = $ma->map("ID","Title");
				$maf = new DropdownField("Make","Make",$mamap,$this->request->getVar('Make'));
				$maf->setEmptyString("All makes");
			}
			
			/* MODELS IF LOADED */
			$momap = array("0" => "First select make");			
			$m = (int)$this->request->getVar('Make');
			$emptymo="";
			if($m>0) {
				$models = DataObject::get("CarModel","CarMakeID = $m","Title ASC");
				if($models) {
					$momap = $models->map("ID","Title");
					$emptymo="All models";
				}
				else {
					$momap = array("0" => "No models available");	
				}
			}
			$mof = new DropdownField("Model","Model",$momap,$this->request->getVar('Model'));
			if($emptymo) {
				$mof->setEmptyString($emptymo);
			};
			if(!$m) {
				$mof->setDisabled(true);
			}
			$fields = new FieldList(
				new LiteralField("Test", '<h4>Filter vehicles <img src="mysite/images/loader-small.gif" class="loader" alt="Loading" /></h4>'),
				$maf,
				$mof,
				$pagefield
			);
			
		}
	 	
	    // Create action
	    $a = new FormAction('getResults', _t("SHOWRESULTS",'Update'));
	    $a->addExtraClass("small");
	    $a->addExtraClass("collapse");
	    $actions = new FieldList(
	    	$a
	    );
		
		// Create action
		$validator = new RequiredFields();
			
	    $f = new Form($this, 'FilterForm', $fields, $actions, $validator);
	    $f->setFormMethod('GET');
	    $f->setStrictFormMethodCheck("GET");
//	    $f->disableSecurityToken();
	    return $f;

	}
	
	public function Makes() {
		return DataObject::get("CarMake","","Title ASC");
	}
	public function getmodels() {
		$m = (int)$this->request->getVar('make');
		if(!is_numeric($m) || $m<=0) {
			return false;
		}
		
		$response = '<select id="Form_FilterForm_Model" name="Model">';
		
		$models = CarModel::get()->where("CarMakeID = $m")->sort("Title ASC");
		if($models) {
			$response.=("<option selected='selected' value=''>Select model</option>");
			$response.=("<option value='0'>All models</option>");
			foreach($models as $model) {
				$response.=("<option value='".$model->ID."'>".$model->Title."</option>");
			}
		}
		else {
			$response.=("<option selected='selected' value=''>No models available</option>");
		}
		$response.="</select>";
		echo($response);
		return false;
	}
	
}

