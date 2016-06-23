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
					    }/* else {
					    	return addslashes($i);
					    }*/
		    	});
		    })/*->toJson()*/;

		return view('map-all', compact('catalog'));
	}

	public function show($name, $address) {
		return view('map', compact('name', 'address'));
	}

	public function showOld($address) {
		$catalog = Catalog::whereAddress($address)
		    ->first()
		    ->getAttributes(['name', 'address']);

		return redirect()
		    ->route('map.show', $catalog, 301);
	}
    
}
