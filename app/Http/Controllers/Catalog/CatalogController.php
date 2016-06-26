<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class CatalogController extends Controller
{
    
    public function index() {
		$catalog = Catalog::orderBy('sort', 'desc')
			->paginate(20);
		return view('catalog.index', compact('catalog'));
	}
	
	public function show($slug) {
		//dd(123);
		$catalog = Catalog::whereSlug($slug)
			->first();

		$catalogMap = Catalog::transformForMap($catalog);

		if ($catalog) {
			return view('catalog.show', compact('catalog', 'catalogMap'));
		}
		return abort(404);
	}

    public function search($query) {
        $catalog = Catalog::search($query)
            ->get();

        $catalog = Catalog::paginateCollection($catalog, 2);

        return view('catalog.index', compact('catalog'));
    }
}
