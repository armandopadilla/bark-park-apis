<?php 
class ParkController extends BaseController {
	
	public function index(){
		
		$name          = Input::get("name");
		$streetAddress = Input::get("street");
		$cityState     = Input::get("citystate");
		$gps 	       = Input::get("gps");
		
		$name 		   = strip_tags(trim($name));
		$streetAddress = strip_tags(trim($streetAddress));
		$cityState 	   = strip_tags(trim($cityState));
		$gps 		   = strip_tags(trim($gps));
		
		$errorCount = 0;
		$errorMessages = array();
		
		//Sanatize and validate
		if($name === "")
		{
			//error
			$errorCount++;
			$errorMessages[] = "Park/Location name can not be empty";
		}
		
		if(($streetAddress === "" || $cityState === "") && ($gps === "")){
			//error
			$errorCount++;
			$errorMessages[] = "Address or GPS not supplied.";
		}
		
		//Break up the city and state
		$city  = "";
		$state = ""; 
		$cityStateElems = explode(",", $cityState);
		if(isset($cityStateElems[0])){
			$city = $cityStateElems[0];
		}
		
		if(isset($cityStateElems[1])){
			$state = $cityStateElems[1];
		}
			
		//Save to database.
		DB::insert("INSERT INTO parks (name, streetaddress, city, state, date_created, verified) 
				VALUES (?, ?, ?, ?, NOW(), 'no')", array($name, $streetAddress, $city, $state));	
		
		
		//Response
		$responseArray = array("status" => "OK",
							   "error_count" => $errorCount, 
							   "error_messages" => $errorMessages);
		
		$response = json_encode($responseArray);
		return Response::json($response);
		
	}
	
	
}
