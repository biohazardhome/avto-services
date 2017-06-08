<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;
use App\City;
use App\Service;

class MapController extends Controller
{
    
    public function index() {
		/*$catalog = Catalog::get();

		$catalog = Catalog::transformForMap($catalog);*/

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

			return response()->json($catalog);
		}
		return abort(404);
	}

	public function cityAjax($slug) {
		$catalog = Catalog::byCity($slug)->get();

		if ($catalog->count()) {
			$catalog = Catalog::transformForMap($catalog)->toArray();

			return response()->json($catalog);
		}
		return abort(404);
	}

	public function serviceAjax($slug) {
		$catalog = Catalog::byService($slug)->get();

		if ($catalog->count()) {
			$catalog = Catalog::transformForMap($catalog)->toArray();

			return response()->json($catalog);
		}
		return abort(404);
	}

	public function serviceCityAjax($slug, $slug2) {
		$catalog = Catalog::byService($slug)
			->byCity($slug2)
			->get();

		if ($catalog->count()) {
			$catalog = Catalog::transformForMap($catalog)->toArray();

			return response()->json($catalog);
		}
		return abort(404);
	}

	public function city($city) {
		/*$city = City::whereSlug($slug)
			->first();*/

		if ($city) {
			// dd('odintsovo', $city);
			/*$catalog = Catalog::whereCityId($city->id)
				->orderBy('sort', 'desc')
				->limit(6)
				->get();*/

			/*$city->with(['catalog' => function($q) {
				return $q->orderBy('sort', 'desc')
					->limit(6)
					->get();
			}]);*/

			$catalog = $city->catalog()->orderBy('sort', 'desc')
					->limit(6)
					->get();

			// dd($catalog);

			return view('map-all', compact('city', 'catalog'));
		} 

		
	}

	public function cityService($city, $service) {
		$city = City::whereSlug($slug)
			->first();

		dd(123);

		return view('map-all', compact('city'));
	}
    
}
