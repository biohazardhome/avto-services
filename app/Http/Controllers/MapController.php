<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;
use App\City;

class MapController extends Controller
{
    
    public function index() {
		$catalog = Catalog::get();

		$catalog = Catalog::transformForMap($catalog);

		return view('map-all', compact('catalog'));
	}

	public function show($slug, $address) {
		$catalog = Catalog::whereSlug($slug)
			->where('address', $address)
			->first();

		// dump(123);
		if ($catalog) {
			$catalog = Catalog::transformForMap($catalog);
			return view('map', compact('catalog'));
		} else { // redirect old url path
			$catalog = Catalog::whereName($slug)
				->first();

			if ($catalog) {
				return redirect()->route('map.show', $catalog->getAttributesOnly(['slug', 'address']));
			}
		}

		return abort(404);
	}

	public function showOld($address) {
		$catalog = Catalog::whereAddress($address)
		    ->first();

		if ($catalog) {
		    $params = $catalog->getAttributesOnly(['name', 'address']);

			return redirect()
		    	->route('map.show', $params, 301);
		}

		return abort(404);
	}

	public function allAjax() {
		$catalog = Catalog::all();

		if ($catalog->count()) {
			$catalog = Catalog::transformForMap($catalog)->toArray();
			// var_dump($catalog);

			return response()->json($catalog);
			// return json_encode($catalog);
		}
		return abort(404);
	}

	public function cityAjax($city) {
		$city = City::with('catalog')
			->whereSlug($city)
			->first();

		// dd($city);
		$catalog = $city->catalog;

		if ($catalog->count()) {
			$catalog = Catalog::transformForMap($catalog)->toArray();
			// var_dump($catalog);

			return response()->json($catalog);
			// return json_encode($catalog);
		}
		return abort(404);
	}

	public function city($slug) {
		$city = City::whereSlug($slug)
			->first();

		return view('map-all', compact('city'));
	}

	public function cityService($city, $service) {
		$city = City::whereSlug($slug)
			->first();

		return view('map-all', compact('city'));
	}
    
}
