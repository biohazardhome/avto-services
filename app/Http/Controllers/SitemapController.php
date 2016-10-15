<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SitemapController extends Controller
{
    
    public function index() {

    }

    private function catalog() {
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

    private function map() {
    	
    }
}
