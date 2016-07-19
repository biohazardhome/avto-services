<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;

class CatalogController extends Controller
{
    
    public function index() {
		$catalog = Catalog::withCount('comments')
		    ->orderBy('sort', 'desc')
			->paginate(20);

		return view('catalog.index', compact('catalog'));
	}
	
	public function show($slug) {
		$catalog = Catalog::with('comments')
			->whereSlug($slug)
			->first();

		if ($catalog) {
			$catalogMap = Catalog::transformForMap($catalog);

			return view('catalog.show', compact('catalog', 'catalogMap'));
		}
		return abort(404);
	}

    public function search($query) {
        $catalog = Catalog::search($query)
            ->get();

        $catalog = Catalog::paginateCollection($catalog, 15);

        return view('catalog.index', compact('catalog'));
    }

    public function sitemapGenerate() {
    	$sitemap = app('sitemap');

		if (!$sitemap->isCached()) {
	    	$catalog = Catalog::all();
	    	$catalog->each(function($catalog) use(&$sitemap) {
	    		$sort = $catalog->sort;
	    		$priority = 0.0;
	    		if ($sort >= 10) $priority = log10($sort) / 10;
	        	$sitemap->add(route('catalog.show', $catalog->slug) .'/', $catalog->updated_at->toW3cString(), $priority, 'daily');
	    	});
	       	$sitemap->store('xml','sitemap_catalog');
	    }
    }
}
