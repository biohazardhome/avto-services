<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class MapController extends Controller
{
    
    public function index() {
		$catalog = Catalog::get()
			->keyBy('name');

		$catalog = Catalog::transformForMap($catalog);

		return view('map-all', compact('catalog'));
	}

	public function show($name, $address) {
		$catalog = Catalog::whereName($name)
			->orWhere('address', $address)
			->first();

		$catalog = Catalog::transformForMap($catalog);
		
		if ($catalog) {
			return view('map', compact('catalog'));
		}

		return abort(404);
	}

	public function showOld($address) {
		$catalog = Catalog::whereAddress($address)
		    ->first();

		if ($catalog) {
		    $params = $catalog->getAttributes(['name', 'address']);

			return redirect()
		    	->route('map.show', $params, 301);
		}

		return abort(404);
	}
    
}
