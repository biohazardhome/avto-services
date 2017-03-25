<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Catalog;

class PhoneController extends Controller
{
    
	public function index() {
		$catalog = Catalog::paginate();
		return view('catalog.phone.index', compact('catalog'));
	}

}
