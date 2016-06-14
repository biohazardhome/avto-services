<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{
    
    public function index($address) {
		//dd($address);
		return view('map', compact('address'));
	}
    
}
