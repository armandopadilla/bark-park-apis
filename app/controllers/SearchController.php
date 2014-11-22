<?php
/**
 * Search Controller 
 * Listens for Search API calls
 */
class SearchController extends BaseController {

        
	public function index(){

		$location = Input::get("location");
	
		//Check if the input is latln vs string
		if(!preg_match("/^-?[0-9\.]+,-?[0-9\.]+$/", $location)){
			$latlng = GooglePlacesService::fetchLatLng($location);	
		}
		else{
			$latlng = explode(",", $location);
			$latlng = array('lat' => $latlng[0], 'lng' => $latlng[1]);
		}

		//Do search
		$places = GooglePlacesService::search($latlng);

		//Response		
		return Response::json($places);	

	}

}
