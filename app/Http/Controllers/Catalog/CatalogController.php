<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class CatalogController extends Controller
{
    
    public function index() {
		$catalog = Catalog::paginate(20);
		return view('catalog.index', compact('catalog'));
	}
	
	public function show($slug) {
		//dd(123);
		$catalog = Catalog::whereSlug($slug)
			->first();

		if ($catalog) {
			return view('catalog.show', compact('catalog'));
		}
		return abort(404);
	}
}
