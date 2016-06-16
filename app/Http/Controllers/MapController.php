<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{
    
    public function index() { // all avtoservices in map
		return view('map');
	}

	public function show($address) {
		return view('map', compact('address'));
	}
    
}
