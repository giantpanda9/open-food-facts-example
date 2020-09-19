<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\openFoodFacts;

class openFoodFactsController extends Controller
{
    //
	function __construct() {
	}

	public function storeItem(Request $request) {
		if ($request->isMethod('post')) {
			$openFoodFacts = new openFoodFacts;
			$item = array();
			$input = $request->input();
			$item["ID"] = $input["ID"];
			$item["Image"] = $input["Image"];
			$item["Name"] = $input["Name"];
			$item["Category"] = $input["Category"];
			$response = $openFoodFacts->storeItem($item);
			if ($response == 1) {
				$redirectURL = "/openFoodFactStored/" . $input["pageNo"];
			}
			if ($response == 2) {
                                $redirectURL = "/openFoodFactUpdated/" . $input["pageNo"];
                        }
			if ($response == 0) {
                                $redirectURL = "/openFoodFactStorageError/" . $input["pageNo"];
                        }
			if ($input["productName"] != "") {
				$redirectURL .= "/" . $input["productName"];
			}
			return redirect($redirectURL);
		}
	}

	public function correctStartPath() {
		return redirect("/openFoodFacts/1");
	}

	public function dispatcher(Request $request) {
		if ($request->isMethod('post')) {
                        $input = $request->input();
			$redirectURL = "/openFoodFacts/" . $input["pageNo"] . "/" . $input["productName"] . "/";
			if ($input["actionDispatched"] == "Search") {
                        	$redirectURL = "/openFoodFacts/1/" . $input["productName"] . "/";
                        }
			return redirect($redirectURL);
                }
		return 1;
        }

	public function getData($pageNo = 1, $productName = "") {
		$openFoodFacts = new openFoodFacts;
		$foodFacts = $openFoodFacts->getResponse($pageNo,$productName);
		return view("pages.openFoodFactsHome", ["foodFacts" => $foodFacts ]);
	}
        public function getDataUpdated($pageNo = 1, $productName = "") {
                $openFoodFacts = new openFoodFacts;
                $foodFacts = $openFoodFacts->getResponse($pageNo,$productName); 
                $foodFacts["Message"] = "Item data updated successfuly.";
                return view("pages.openFoodFactsHome", ["foodFacts" => $foodFacts ]);
        }
        public function getDataStored($pageNo = 1, $productName = "") {
                $openFoodFacts = new openFoodFacts;
                $foodFacts = $openFoodFacts->getResponse($pageNo,$productName); 
                $foodFacts["Message"] = "Item data stored successfuly.";
                return view("pages.openFoodFactsHome", ["foodFacts" => $foodFacts ]);
        }
        public function getDataError($pageNo = 1, $productName = "") {
                $openFoodFacts = new openFoodFacts;
                $foodFacts = $openFoodFacts->getResponse($pageNo,$productName); 
                $foodFacts["Message"] = "Error saving item data.";
                return view("pages.openFoodFactsHome", ["foodFacts" => $foodFacts ]);
        }
}
