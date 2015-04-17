<?php

global $dir;
$dir = dirname(__FILE__);

function readCSV($csvFile) {
  global $dir;
  $csvFile = $dir . "/../../csv/" . $csvFile;

  print_r("<h1>Opening: $csvFile</h1>");
  $items = array();
  $file = fopen($csvFile, 'r');
  $indexes = array();
  $count = 0;
  if($file) {
    while (($line = fgetcsv($file, 0, "@", "^")) !== FALSE) {
      if($count++ == 0) {
        $indexes = $line;
      }
      else {
        $temp = array();
        $j = 0;
        foreach($line as $field) {
          $temp[$indexes[$j]] = $line[$j];
          $j++;
        }
        $items[] = $temp;
      }
    }
    
    fclose($file);
    return $items;
  }
  echo("Can't open CSV.");
  return false;
}


function get_image($url,$saveto){
  $ch = curl_init ($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
  $raw=curl_exec($ch);
  curl_close ($ch);
  if(file_exists($saveto)){
      unlink($saveto);
  }
  $fp = fopen($saveto,'x');
  fwrite($fp, $raw);
  fclose($fp);
}

function get_file_extension($file_name) {
  return substr(strrchr($file_name,'.'),1);
}


/* THE ACTUAL IMPORTER CLASS */

class LoadProduct_Controller extends Page_Controller {

  var $imageUploadDir = "assets/products/imported/",
      $folderObject,
      $brandName,
      $brandID,
      $csvFile,
      $groupMap,
      $count,
      $start,
      $limit,
      $variationsEnabled,
      $defaultImageExtension;

  private static $allowed_actions = array (
    'index',
    'steeda',
    'roush',
    'jlaudio',
    'advwheels',
    'pirelli',
    'roush',
    '3dcarbon',
    'steeda',
    'hr',
    'shelby',
    'mhtwheels',
    'fuelgrills',
    'borla',
    'fordracing',
    'tsw',
    'whipple',
    'bassani',
    'kn',
    'magnaflow',
    'tdcarbon'
  );
  
  public function init() {

    set_time_limit(0);

    $folderToSave = $this->imageUploadDir;
    $this->folderObject = DataObject::get_one("Folder", "`Filename` = '{$folderToSave}'");

    if(isset($_GET['start'])) {
      $this->start=$_GET['start'];
    }
    else {
      $this->start=0;
    }

    if(isset($_GET['limit'])) {
      $this->limit = $_GET['limit'];
    }
    else {
      $this->limit = 99999;
    }

    parent::init();
  }
  
  public function index() {
    // if(!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0; 
    // $SQL_start = (int)$_GET['start'];
  }

  // ROUSH */
  public function roush() {
    $this->brandName = "Roush";
    // $this->brandID = 0; //?
    $this->csvFile = "roush.csv";

    $this->groupMap = array(
      'F-150 Exhaust' => 'Paint & Body',
      'Car Care Products' => '',
      'F-150 Accessories' => '',
      'F-150 Air Filters' => 'Performance',
      'F-150 Badges' => 'Paint & Body',
      'F-150 Cold Air Intakes' => 'Performance',
      'F-150 Door Sill Plates' => 'Paint & Body',
      'F-150 Engine Belts' => 'Performance',
      'F-150 Floor Mats' => 'Interiors',
      'F-150 Gauges' => 'Performance',
      'F-150 Graphics' => 'Design & Rendering',
      'F-150 Grilles' => 'Design & Rendering',
      'F-150 Hood Scoops' => 'Design & Rendering',
      'F-150 Lug Nuts' => 'Wheels & Tires',
      'F-150 Seat Belts' => 'Interiors',
      'F-150 Superchargers' => 'Performance',
      'F-150 Suspension' => 'Performance',
      'F-150 Wheels' => 'Wheels & Tires',
      'Focus Cold Air Intakes' => 'Performance',
      'Focus Exhaust' => 'Performance',
      'Mustang Accessories' => 'Performance',
      'Mustang Air Filters' => 'Performance',
      'Mustang Badges' => '',
      'Mustang Belts' => 'Interiors',
      'Mustang Body Kits' => 'Paint & Body',
      'Mustang Brakes' => 'Performance',
      'Mustang Buttons' => 'Paint & Body',
      'Mustang Chin Spoilers' => 'Paint & Body',
      'Mustang Cold Air Intakes' => 'Performance',
      'Mustang Complete Body Kit' => 'Paint & Body',
      'Mustang Convertible Light Bars' => 'Paint & Body',
      'Mustang Cooling and Radiator' => 'Performance',
      'Mustang Covers' => 'Paint & Body',
      'Mustang Crate Engine' => 'Paint & Body',
      'Mustang Door Sill' => 'Paint & Body',
      'Mustang Drivetrain' => 'Performance',
      'Mustang Engine Bay Styling' => 'Paint & Body',
      'Mustang Engine Components' => 'Performance',
      'Mustang Exhausts' => 'Paint & Body',
      'Mustang Fenders' => 'Paint & Body',
      'Mustang Floor Mats' => 'Interiors',
      'Mustang Front Fascias' => 'Paint & Body',
      'Mustang Gauges' => 'Performance',
      'Mustang Graphics' => 'Design & Rendering',
      'Mustang Grilles' => 'Paint & Body',
      'Mustang Hood Scoops' => 'Paint & Body',
      'Mustang Hoods' => 'Paint & Body',
      'Mustang Interior' => 'Interiors',
      'Mustang Interior Trim Kits' => 'Interiors',
      'Mustang Leather Seats' => 'Interiors',
      'Mustang Lighting' => 'Electronics',
      'Mustang Lug Nuts' => 'Wheels & Tires',
      'Mustang Pedals' => 'Interiors',
      'Mustang Quarter Window Louvers' => 'Paint & Body',
      'Mustang Rear Seat Delete' => 'Interiors',
      'Mustang Rear Valances' => 'Paint & Body',
      'Mustang Rear Wings' => 'Paint & Body',
      'Mustang Seat Belts' => 'Interiors',
      'Mustang Shifters' => 'Interiors',
      'Mustang Side Valances' => 'Paint & Body',
      'Mustang Spark Plug' => 'Performance',
      'Mustang Splitters' => 'Paint & Body',
      'Mustang Superchargers' => 'Performance',
      'Mustang Suspension Parts' => 'Performance',
      'Mustang Tires' => 'Wheels & Tires',
      'Mustang Wheel and Tire Packages' => 'Wheels & Tires',
      'Mustang Wheels' => 'Wheels & Tires',
      'Parts' => '',
      'Phase 1 Mustang Superchargers' => 'Performance',
      'Phase 2 Mustang Superchargers' => 'Performance',
      'Phase 3 Mustang Superchargers' => 'Performance',
      'ROUSH Tools' => '',
      'Superduty Cold Air Intakes' => 'Performance',
      'Taurus SHO Cold Air Intake Kits' => 'Performance'
    );

    $this->runImport();
  }


  // STEEDA */
  public function steeda() {
    $this->brandName = "Steeda";
    $this->brandID = 58;

    $this->groupMap = array(
      'Mustang Induction'=>14,
      'Mustang Electric'=>16,
      '2005-2010 Induction'=>14,
      'Mustang Suspension'=>14,
      'Mustang Wheels & Tires'=>13,
      'Mustang Body Kits'=>12,
      'Mustang Drivetrain'=>14,
      'Mustang Engine'=>14,
      'Mustang Chassis'=>12,
      'Mustang Exhaust'=>14,
      'Mustang Steering'=>14,
      'Mustang Dress Up'=>12,
      '2011-2014 Chassis'=>14,
      'Mustang Brakes'=>14,
      '1999-2004 Suspension'=>14,
      '2005-2010 Chassis'=>14,
      'Mustang Accessories'=>0,
      'Mustang Cooling'=>14,
      '2011-2014 Exhaust'=>14,
      '2005-2010 Exhaust'=>14,
      '2005-2010 Body Kits'=>12,
      '2011-2014 Brakes'=>14,
      'Mustang Fuel'=>14,
      'Steeda Lifestyle'=>0,
      '1999-2004 Body Kits'=>12,
      '2011-2014 Wheels & Tires'=>13,
      '2005-2010 Dress Up'=>12,
      '1994-1998 Body Kits'=>12,
      '1979-1993 Engine'=>14
    );

    $this->runImport();
  }


  // JL AUDIO */
  public function jlaudio() {
    $this->brandName = "JL Audio";
    $this->brandID = 34;
    $this->csvFile = "jlaudio.csv";

    $this->groupMap = array(
      'Amplifier Accessories'=>16,
      'Amplifiers'=>16,
      'Connection Systems'=>16,
      'Evolution Speaker Systems'=>16,
      'OEM Interface'=>16,
      'StealthBox'=>16,
      'Subwoofer Drivers'=>16,
      'Subwoofer Systems'=>16
    );

    $this->runImport();
  }

  // ADV WHEELS */
  public function advwheels() {
    $this->brandName = "ADV1 Wheels";
    $this->brandID = 165;
    $this->csvFile = "advwheels.csv";

    $this->groupMap = array(
      'Wheels'=>16
    );

    $this->runImport();
  }

   // JL AUDIO */
  public function shelby() {
    $this->brandName = "Shelby";
    $this->brandID = 93;
    $this->csvFile = "shelby.csv";

    $this->groupMap = array(
      'Brakes'=>14,
      'Clutch'=>14,
      'Cooling'=>14,
      'Engine'=>14,
      'Engine Parts'=>14,
      'Exhaust'=>14,
      'Gauges'=>15,
      'Shifters'=>15,
      'Suspension'=>14,
      'Wheels'=>13,
      'Electrical'=>16
    );

    $this->runImport();
  }

  // HR SPRINGS */
  public function hr() {
    $this->brandName = "HR Springs";
    $this->brandID = 126;
    $this->csvFile = "hr.csv";

    $this->groupMap = array(
      'Springs'=>14,
      'ETS'=>14,
      'Cup Kits'=>14,
      'Sway Bars'=>14,
      'I.D. Race Springs'=>14,
      'Wheel Spacers'=>14,
      'Coil Overs'=>14,
      'Accessories'=>14
    );

    $this->runImport();
  }


  // MHTWHEELS */
  public function mhtwheels() {
    $this->brandName = "MHT Wheels";
    $this->brandID = 166;
    $this->csvFile = "mhtwheels.csv";

    $this->groupMap = array(
      'Fuel Dually'=>13,
      'Fuel Forged'=>13,
      'Niche 3 Piece'=>13,
      'Niche Competition'=>13,
      'Niche Monotec'=>13,
      'Niche Racing'=>13,
      'Niche Sport'=>13,
      'Niche Track'=>13
    );

    $this->runImport();
  }

  // FUEL GRILLS */
  public function fuelgrills() {
    $this->brandName = "FUEL Grills";
    $this->brandID = 169;
    $this->csvFile = "fuelgrills.csv";

    $this->groupMap = array(
      'GMC Fuel Grills'=>12,
      'Jeep Fuel Grills'=>12,
      'Nissan Fuel Grilles'=>12,
      'Chevrolet Fuel Grills'=>12,
      'Dodge Fuel Grills'=>12,
      'Ford Fuel Grills'=>12,
      'Toyota Fuel Grills'=>12
    );

    $this->runImport();
  }

  // BORLA */
  public function borla() {
    $this->brandName = "Borla";
    $this->brandID = 17;
    $this->csvFile = "borla.csv";

    $this->groupMap = array(
      'Cat-Back™ Exhaust'=>12,
      'Header/Manifold-Back Exhaust'=>12,
      'Headers'=>12,
      'Muffler'=>12,
      'Polished Tips'=>12,
      'Rear Section Exhaust'=>12,
      'X-Pipes, Mid-Pipes, & Down-Pipes'=>12
    );

    $this->runImport();
  }

  // FORD RACING */
  public function fordracing() {
    $this->brandName = "Ford Racing";
    $this->brandID = 26;
    $this->csvFile = "fordracing.csv";

    $this->groupMap = array(
      'Appearance: Decals/Graphics'=>18,
      'Appearance: Trim'=>14,
      'Body: Functional'=>12,
      'Chassis: Brake Kits / Components'=>14,
      'Chassis: Control Arms / Stabilizers'=>14,
      'Chassis: Handling Packs'=>14,
      'Chassis: Shocks / Adj Suspension'=>14,
      'Chassis: Springs'=>14,
      'Chassis: Steering Systems'=>14,
      'Chassis: Wheels'=>13,
      'D-Line: Automatic Transmission'=>14,
      'D-Line: Axle Components'=>14,
      'D-Line: Axle Shafts'=>14,
      'D-Line: Clutch Related'=>14,
      'D-Line: Differentials'=>14,
      'D-Line: Drive Shafts'=>14,
      'D-Line: Manual Trans'=>14,
      'D-Line: Ring & Pinion'=>14,
      'D-Line: Shifters'=>14,
      'Electrical: Air Metering'=>16,
      'Electrical: Analyzers / Calibrators'=>16,
      'Electrical: Driving Lights'=>16,
      'Electrical: Fuel Metering'=>16,
      'Electrical: Gauges'=>16,
      'Electrical: Ignition Related'=>16,
      'Electrical: Microprocessors'=>16,
      'Electrical: Wiring'=>16,
      'Engine: Air Cleaner'=>14,
      'Engine: Cam/Tappets/Pushrods'=>14,
      'Engine: Complete Engines'=>14,
      'Engine: Cooling'=>14,
      'Engine: Crankshafts'=>14,
      'Engine: Cylinder Heads'=>14,
      'Engine: Dress-Up Kits'=>12,
      'Engine: Engine Blocks'=>14,
      'Engine: Exhaust Related'=>14,
      'Engine: Fasteners'=>14,
      'Engine: Flywheels'=>14,
      'Engine: Fuel Delivery'=>14,
      'Engine: Gaskets'=>14,
      'Engine: Intake Related'=>14,
      'Engine: Oil Pumps/Pans'=>14,
      'Engine: Power Packs'=>14,
      'Engine: Superchargers'=>14,
      'Engine: Timing Drive Related'=>14,
      'Engine: Valve Covers'=>14,
      'Engine: Valves / Springs'=>14,
      'Seats'=>15,
      'Tools: Fender Covers'=>12,
      'Vehicle: Ford Racing'=>14
    );

    $this->runImport();
  }


  /* MAGNAFLOW */

  public function magnaflow() {
    $this->brandName = "Magnaflow";
    $this->brandID = 39;
    $this->csvFile = "magnaflow.csv";

    $this->variationsEnabled = true;

    $this->groupMap = array(
      "Performance Exhaust"=>14,
      "Black Series Mufflers with Tips"=>14,
      "Glass Pack"=>14,
      "Polished Stainless Steel Mufflers"=>14,
      "Polished Stainless Steel Mufflers With Tips"=>14,
      "Race/Specialty Series"=>14,
      "Satin Stainless Steel Mufflers"=>14,
      "XL Mufflers"=>14
    );
    $this->runImport();
  }

   public function kn() {
    $this->brandName = "KN Filters";
    $this->brandID = 35;
    $this->csvFile = "kn.csv";

    $this->variationsEnabled = true;

    $this->groupMap = array(
      'Air Filters - Automotive' => 14,
      'Air Filters - SUV' => 14,
      'Air Filters - Van' => 14,
      'Air Filters - Truck' => 14
    );
    $this->runImport();
  }


   public function tdcarbon() {
    $this->brandName = "3D Carbon";
    $this->brandID = 7;
    $this->csvFile = "3dcarbon.csv";
    $this->variationsEnabled = true;
    $this->groupMap = array(
      "Style Kits" => 12
    );
    $this->runImport();
  }

  public function whipple() {
    $this->brandName = "Whipple";
    $this->brandID = 119;
    $this->csvFile = "whipple.csv";

    $this->groupMap = array(
    );
    $this->runImport();
  }

  public function tsw() {
    $this->brandName = "TSW";
    $this->brandID = 170;
    $this->csvFile = "tsw.csv";

    $this->groupMap = array(
        "Alloy Wheels" => 13
    );
    $this->runImport();
  }

   public function pirelli() {
    $this->brandName = "Pirelli";
    $this->brandID = 48;
    $this->csvFile = "pirelli.csv";

    $this->defaultImageExtension = ".png";
    $this->groupMap = array(
      "Tires" => 13
    );
    $this->runImport();
  }

   public function bassani() {
    $this->brandName = "Bassani";
    $this->brandID = 15;
    $this->csvFile = "bassani.csv";

    $this->groupMap = array(
        "Accessories"=>14,
        "Aft-Cat System"=>14,
        "X-Y Crossover / Mid Pipes"=>14,
        "Mufflers"=>14,
        "Headers"=>14
    );
    $this->runImport();
  }

  //  public function magnaflow() {
  //   $this->brandName = "";
  //   $this->brandID = ;
  //   $this->csvFile = ".csv";

  //   $this->groupMap = array(
  //   );
  //   $this->runImport();
  // }


  /* THE ACTUAL IMPORT */

  public function import() {
    if($this->request->getVars("brand")) {
      echo("Jup");
      $brand = $_GET("brand");
      // echo($brand);
      // $this->csvFile = $brand . ".csv";
      // $this->$brand();
    }
    return false;
  }

  function runImport() {
    
    /* AUTOMATIC */
    echo("<p>".$this->brandName." with BrandID ".$this->brandID."</p>");

    if($items = readCSV($this->csvFile)) {
      print_r("<p>Found <strong>".sizeof($items)."</strong> items.\n");

      // HEADER TEXT
      if(isset($_GET['import'])) {
        echo("Import enabled.");
      }
      else if(isset($_GET['update'])) {
        echo("Update.");
      }
      else {
        echo("Preview only, no import.");
      }
      echo("</p>");
      // END HEADER TEXT

      $items = array_slice($items,$this->start,$this->length);
      echo("Items $this->start through $this->length\n");
      echo("\n\n---------------Item list\n");
      $categories = array();

      foreach($items as $item) {
        if($this->count++ < $this->limit) {
          // print_r($item);
          echo($this->count.". ".$item["title"]."\n");
          echo($item["main_image"]."\n");
          $categories[] = $item["category"];
          if(isset($_GET['import'])) {
            $this->addProduct($item);
          }
          else if(isset($_GET['update'])) {
            $this->updateProduct($item);
          }
          else {
            
          }
        }
      }
      echo("\n\n----------Unique Product Groups marked by Vendor\n");
      $unique_categories= array_unique($categories);
      foreach($unique_categories as $uc) {
        echo($uc."\n");
      }
      
    };
    return false;

  }

  function addProduct($item) {
    $title = str_replace("'","\'",$item["title"]);
    $part_number = $item["part_number"];
    $brandID = isset($item["brandid"]) ? $item["brandid"] : $this->brandID;
    $wherefilter = "Title='".$title."' AND BrandID = ".$brandID;
    if($part_number!="") {
      $wherefilter = $wherefilter." AND PartNumber = '".$part_number."'";
    }
    $p = DataObject::get_one("Product",$wherefilter);
    echo("<b>".$item['title']."</b>\n");
    
    if($p) {
      echo("> Product already exists - will update.\n");
    }
    else {
      echo("> New product.\n");
      $p = new Product();
      $p->Title = $title;
      $p->PartNumber = $item["part_number"];
    }
    
    $p->Content = $item["description"];
    $p->Price = $item["price"];
    $p->ProductGroup = $item["category"];
    // OPTIONAL 2ND SUB CATEGORY
    if(isset($item["category2"])) {
      $p->ProductGroup2 = $item["category2"];
    }
    $p->MakeText = $item["make"];
    $p->ModelText = $item["model"];
    $p->ModelYears = $item["model_years"];
    if(isset($item["extra"])) {
      $p->ExtraText = $item["extra"];
    }
    $p->BrandID = $brandID;
    $p->OriginalURL = $item["_pageUrl"];

    if(isset($this->groupMap[$item["category"]])) {
      $categoryID = $this->groupMap[$item["category"]];
      echo("> Adding to category ".$categoryID."\n");
      $p->CategoryID = $categoryID;
    }

    if($this->variationsEnabled) {

      if($item["is_variation"]=="N") {
        $p->write();

        if(isset($item["main_image"])) {
          $pi = $this->saveImage($item["main_image"], $item, $p->ID,  0);
          // if($pi) {
          //   $p->Images()->add($pi);
          // }
        }
        if(isset($item["images"])) {
          echo("Product has images.</br>");
          $images = explode(";",$item["images"]);
          if(count($images)>0) {
            for($i=0;$i<count($images);$i++) {
              // echo($images[$i]);
              $this->saveImage($images[$i], $item, $p->ID, $i+1);
            }
          }
          else {
            $clean =implode("", explode(" ",$item["images"]));
            echo("***".$clean."***");
            echo("***".$clean."***");
            $this->saveImage($clean, $item, $p->ID, $i+1);
          }
        }
      }
      elseif($item["is_variation"]=="Y") {
        echo("Variation here!\n");
        $v = new ProductVariation();
        $v->Title = $item["variation_title"];
        if(isset($item["variation_description"])) {
          $v->Description = $item["variation_description"];
        }
        $v->Year = $item["model_years"];
        $v->ModelText = $item["variation_model"];
        $v->MakeText = $item["make"];
        $v->VersionText = $item["variation_version"];
        $v->Extra = $item["variation_extra"];
        $v->PartNumber = $item["variation_part_number"];
        $v->ProductID = $p->ID;
        $v->VariationPrice = $item["price"];
        $v->write();
        echo("Variation added.\n");
      }
    }
    else {

      $p->write();

      if(isset($item["main_image"])) {
        $pi = $this->saveImage($item["main_image"], $item, $p->ID,  0);
        // if($pi) {
        //   $p->Images()->add($pi);
        // }
      }
      if(isset($item["images"])) {
        echo("Product has images.</br>");
        $images = explode(";",$item["images"]);
        if(count($images)>0) {
          for($i=0;$i<count($images);$i++) {
            // echo($images[$i]);
            $this->saveImage($images[$i], $item, $p->ID, $i+1);
          }
        }
        else {
          $clean =implode("", explode(" ",$item["images"]));
          echo("***".$clean."***");
          echo("***".$clean."***");
          $this->saveImage($clean, $item, $p->ID, $i+1);
        }
      } 
    }

    // $p->write();
    //echo($item["image"]);
  }

  function updateProduct($item) {
    $title = $item["title"];
    $title = str_replace("'","\'",$item["title"]);
    $part_number = $item["part_number"];
    $brandID = isset($item["brandid"]) ? $item["brandid"] : $this->brandID;
    $p = DataObject::get_one("Product","Title='".$title."' AND BrandID = ". $brandID ." AND PartNumber = '".$part_number."'"); 
    if($p) {
      $p->Content = $item["description"];
      $p->Price = $item["price"];
      $p->ProductGroup = $item["category"];
      // OPTIONAL 2ND SUB CATEGORY
      if(isset($item["category2"])) {
        $p->ProductGroup2 = $item["category2"];
      }
      $p->MakeText = $item["make"];
      $p->ModelText = $item["model"];
      $p->ModelYears = $item["model_years"];
      $p->ExtraText = $item["extra"];
      $p->BrandID = $brandID;
      $p->OriginalURL = $item["_pageUrl"];
      $p->PartNumber = $part_number;

      if(isset($this->groupMap[$item["category"]])) {
        $categoryID = $this->groupMap[$item["category"]];
        echo("> Adding to category ".$categoryID."\n");
        $p->CategoryID = $categoryID;
      }
      $p->write();
    }
    else {
      echo("Product not found.\n");
    }
  }


  function saveImage($imageURL, $item, $productID, $n = 0) {

    if(!$productID) { return false; }
    // if(strpos($imageURL, "_th")) { return false; }

    $image_extension = $this->defaultImageExtension ? $this->defaultImageExtension : ".jpg";
    if(strtolower(get_file_extension($imageURL))=="png") { $image_extension = ".png"; } 
    
    global $dir;

    $brandTag = implode("", explode(" ",$this->brandName));
    $part_no = $item["part_number"] ? implode("-", explode("/", $item["part_number"])) : $item["_num"];
    $image_base = $brandTag."_".$part_no."_".$n;

    $imageName = $image_base . $image_extension;
    $imageFullPath = $dir.'/../../'.$this->imageUploadDir.$imageName;

    $cleanURL =implode("", explode(" ",$imageURL));
    $image = file_get_contents($cleanURL);
    if($image) {
      file_put_contents($imageFullPath, $image);
      
      $imageObject = DataObject::get_one('Image', "`Name` = '{$imageName}'");
      if(!$imageObject) //checks if dataObject already exists, stops multiple records being created.
      {
        $imageObject = new Image();
        $imageObject->setFilename($imageFullPath);
        $imageObject->ParentID = $this->folderObject->ID; //assign folder of image as parent
        // $imageObject->Name = $imageName; //this function also sets the images Filename and title in a round about way. (see setName() in File.php)
        $imageObject->OwnerID = 0; //(Member::currentUser() ? Member::currentUser()->ID : 0); //assign current user as Owner
        $imageObject->write(); //write the object to the database
        echo("-> Saved image $imageURL with ID ".$imageObject->ID."\n");
      }
      else {
        echo("-> Image $imageName exists with ID ".$imageObject->ID."\n");
      }

      $pi = DataObject::get_one("ProductImage","ImageID = ".$imageObject->ID." AND ProductID=".$productID);
      if($pi) {
        echo("--> Image already attached to product {$productID}.\n");
      }
      else {
        $pi = new ProductImage();
        $pi->ImageID = $imageObject->ID;
        $pi->ProductID = $productID;
        $pi->write();  
        echo("Attached ProductImage with ID ".$pi->ID." to Product ".$productID."\n");
      }

      return $pi;
    }

  }
  
}