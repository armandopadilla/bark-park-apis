<?php
/***
 * GooglePlaces API
 *
 */
class GooglePlacesService {

        private static $key = "";

	public static function fetchLatLng($input){

		$location = urlencode($input);


		$curlHandler = curl_init();
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$location&key=".self::$key;
		//curl 
		curl_setopt($curlHandler, CURLOPT_URL, $url);
                curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

                $response    = curl_exec($curlHandler);
                $dataAsArray = json_decode($response, 1);

                if(isset($dataAsArray['results'][0]['geometry']['location'])){
			
			return $dataAsArray['results'][0]['geometry']['location'];

                }

		return array("lat" => '', "lng" => '');

	}


        public static function search($latlng){

		$curlHandler = curl_init();

		$type   = urlencode("park");
		$term   = urlencode("dog park");
		$radius = 500;

		//Australia Works - $location = urlencode("-33.8670522,151.1957362"); 
		$location = urlencode("".$latlng['lat'].", ".$latlng['lng']."");
		$searchType = "textsearch";
		//$url = "https://maps.googleapis.com/maps/api/place/$searchType/json?location=$location&radius=$radius&types=$type&name=$term&key=$key";
		$url = "https://maps.googleapis.com/maps/api/place/$searchType/json?location=$location&radius=$radius&types=$type&query=$term&key=".self::$key;


		curl_setopt($curlHandler, CURLOPT_URL, $url);
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);

		$response    = curl_exec($curlHandler);
		$dataAsArray = json_decode($response, 1);

		if(isset($dataAsArray['results'])){

        		$items = $dataAsArray['results'];
        		foreach($items as $item){
				
        		}

		}

		return $dataAsArray;

        }

}
