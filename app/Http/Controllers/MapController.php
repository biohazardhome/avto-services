<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class MapController extends Controller
{
    
    public function index() { // all avtoservices in map
		return view('map');
	}

	public function show($name, $address) {
		return view('map', compact('name', 'address'));
	}

	public function showOld($address) {
		$catalog = Catalog::whereAddress($address)
		    ->first()
		    ->getAttributes(['name', 'address']);
		    
		return redirect()
		    ->route('map.show', $catalog);
	}
    
}
