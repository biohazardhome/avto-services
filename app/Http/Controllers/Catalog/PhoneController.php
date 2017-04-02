<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Catalog;
use App\City;

class PhoneController extends Controller
{

	const PAGINATION_COUNT = 50;
    
	public function index() {
		$catalog = Catalog::paginate(self::PAGINATION_COUNT);
		return view('catalog.phone.index', compact('catalog'));
	}

	public function city(City $city) {
		// $catalog = Catalog::whereCity($city)->paginate();
		$catalog = $city->catalog()->paginate(self::PAGINATION_COUNT);
		return view('catalog.phone.index', compact('catalog', 'city'));
	}

}
