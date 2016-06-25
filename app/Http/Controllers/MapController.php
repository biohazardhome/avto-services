<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class MapController extends Controller
{
    
    public function index() { // all avtoservices in map
		// return view('map');
		$catalog = Catalog::get(['name', 'description', 'address', 'site', 'phones', 'email'])
		    // ->pluck('address', 'name')
			->keyBy('name')
		    ->map(function($i, $k) {
		    	// return $i->toArray();
		    	return collect($i->toArray())
		    	    ->map(function($i, $k) {
			    		// dd($i, $k);			    	
					    if ($k === 'site') {
					    	return urlencode($i);
					    } else {
					    	return addslashes($i);
					    }
		    	});
		    })/*->toJson()*/;

		return view('map-all', compact('catalog'));
	}

	public function show($name, $address) {
		$catalog = Catalog::whereName($name)
			->orWhereAddress($address)
			->first();

		if ($catalog) {
			list($name, $address) = $catalog->getAttributes(['name', 'address']);
			return view('map', compact('name', 'address'));
		}

		return abort(404);
	}

	public function showOld($address) {
		$catalog = Catalog::whereAddress($address)
		    ->first();

		if ($catalog) {
		    $catalog->getAttributes(['name', 'address']);

			return redirect()
		    	->route('map.show', $catalog, 301);
		}

		return abort(404);
	}
    
}
