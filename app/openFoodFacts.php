<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class openFoodFacts extends Model
{
    //Class/Model to consume the Open Food Facts API
	function __construct() {
		$this->pageSize = 20; // set value globally to be used several times
	}
	function storeItem($item) {
		try {
			$openFoodFactID = DB::table('open_food_facts')->where('ID', $item["ID"])->pluck('ID');;
			
			if (isset($openFoodFactID) && count($openFoodFactID) >= 1) {
				$updated = DB::table('open_food_facts')->where("ID", $item["ID"])->update(["Image" => $item["Image"], "Name" => $item["Name"], "Category" => $item["Category"]]);
				return 2;
			} else {
				$inserted = DB::table('open_food_facts')->insert(["ID" => $item["ID"], "Image" => $item["Image"], "Name" => $item["Name"], "Category" => $item["Category"]]);
				return 1;
			}
			return 1;
		} catch (Exception $e) {
			return 0;
		}
	}
	function getURL($pageNo = 1, $productName = "") { // function will compose and return the urls required for pagination and search
		// Default values
		$action = "process";
		$sortBy = "unique_scans_n";
		$pageSize = $this->pageSize;
		$baseUrl = "https://world.openfoodfacts.org/cgi/search.pl";
		$returned = ""; // returned URL to be stored here
		if ($productName == "") {
			// Default URL with current page
			$returned = sprintf("%s?action=%s&sort_by=%s&page_size=%s&page=%s&json=1",$baseUrl,$action,$sortBy,$pageSize,$pageNo);
		} else {
			// URL with search term to search
			$productName = urlencode($productName);
			$returned = sprintf("%s?action=%s&sort_by=%s&page_size=%s&page=%s&search_terms=%s&json=1",$baseUrl,$action,$sortBy,$pageSize,$pageNo,$productName);
		}
		return $returned;
	}
	public function getResponse($pageNo = 1, $productName = "") { // Function to get and parse response
		$APIUrl = $this->getURL($pageNo, $productName); // Get API URL
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $APIUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		if (curl_errno($curl)) {
			curl_close($curl);
			return [];
		}
		curl_close($curl);
		$responseJSON = json_decode($result); // Decode result
		$pageSize = $this->pageSize;
		$result = array(); // Planning the response structure		
		if ($productName != "") {
			$resultsCount = intval($responseJSON->count); // Needed to calculate page size
			$result["lastPage"] = round($resultsCount/$pageSize,0); //Approximate count of the last page for pagination
		} else {
			$result["lastPage"] = 1000;
		}
		// if we are on the first page then previous page is the last one by defualt
		if ($pageNo <= 1) {
			$result["prevPage"] = $result["lastPage"];
			$result["nextPage"] = 2;
		// if we are on last page then next page is the first one
		} else if ($pageNo >= $result["lastPage"]) {
			$result["prevPage"] = $result["lastPage"] - 1;
	                $result["nextPage"] = 1;
		// In all other cases just add 1 to next page and subtract 1 for previous page
		} else {
			$result["prevPage"] = $pageNo - 1;
			$result["nextPage"] = $pageNo + 1;
		}
		$result["currentPageLink"] = "/".$pageNo;
		$result["currentProductName"] = "";
		if ($productName != "") {
			$result["prevPage"] .= "/" . $productName . "/";
			$result["nextPage"] .= "/" . $productName . "/";
			$result["currentPageLink"] .= "/" . $productName . "/";
			$result["currentProductName"] = $productName;
		}
		$result["currentPage"] = $pageNo;
		$result["products"] = array(); // Actual product list goes here
		$responseJSON = $responseJSON->products;
		foreach ($responseJSON as $foodFact) { // loop through API results to parse the data expected
			$returnedItem = array();
			if (isset($foodFact->id) && isset($foodFact->image_url) && isset($foodFact->product_name) && isset($foodFact->categories)) {
				$returnedItem["ID"] = strval($foodFact->id) ?: "N/A";
				$returnedItem["Image"] = strval($foodFact->image_url) ?: "N/A";
				$returnedItem["Name"] = strval($foodFact->product_name) ?: "N/A";
				$returnedItem["Category"] = strval($foodFact->categories) ?: "N/A";
				array_push($result["products"],$returnedItem);
			}
		}
		return $result;
	}
}
