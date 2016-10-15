<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Catalog;
use App\City;
use App\Service;

class CatalogController extends Controller
{
    
    public function index() {
		$catalog = Catalog::with('city', 'service')
			->withCount('comments')
			->orderBy('sort', 'desc')
			->paginate(20);

		$service = $catalog->first()->service;
		// dump($service);

		return view('index', compact('catalog', 'service'));
	}

	public function showRedirect($slug) {
		$catalog = Catalog::whereSlug($slug)
			->first();

		if ($catalog) {
			return redirect()->route('main', [$slug]);
		}
		return abort(404);
	}
	
	public function show($slug) {
		$catalog = Catalog::with('city', 'service', 'comments')
			->whereSlug($slug)
			->first();

		if ($catalog) {
			$catalogMap = Catalog::transformForMap($catalog);

			return view('catalog.show', compact('catalog', 'catalogMap'));
		}
		return abort(404);
	}

	public function city($city) {
		$city = City::with(['catalog' => function($q) {
				$q->withCount('comments')
					->orderBy('sort', 'desc');
			}])
			->whereSlug($city)
			->first();
		
		if ($city) {
			$catalog = $city->catalog;
			if ($catalog->count()) {
				$catalog = Catalog::paginateCollection($catalog, 20);

				return view('catalog.city', compact('catalog', 'city'));
			} else {
				// return 'Нет элементов';
				return 'Раздел пуст';
			}
		} else {
			return 'Нет такого города в каталоге';
		}
	}

	public function service($slug) {
		$service = Service::with(['catalog' => function($q) {
				$q->withCount('comments')
					->orderBy('sort', 'desc');
			}])
			->whereSlug($slug)
			->first();

		if ($service) {
			$catalog = $service->catalog;
			$catalog = Catalog::paginateCollection($catalog);
			// $city = City::find($catalog->first()->city_id);
			// dump($catalog, $service, $city);
			if ($catalog) {
				return view('catalog.service', compact('catalog', 'service'));
			}
		}
	}

	public function cityService($city, $service) {
		$catalog = Catalog::with('city', 'service')
			->whereHas('service', function($q) use($service) {
				$q->whereSlug($service);
			})->whereHas('city', function($q) use($city) {
				$q->whereSlug($city);
			})->get();

			// dump($catalog->first()->city);
		if ($catalog) {
			$catalog = Catalog::paginateCollection($catalog);

			$city = $catalog->first()->city;
			$service = $catalog->first()->service;

			return view('catalog.service', compact('catalog', 'city', 'service'));
		}
		return abort(404);
	}

    public function search(Request $request, $query = null) {

    	// dd($request->isMethod('post'), $request);
    	if ($request->isMethod('post')) {
    		$query = $request->get('query');

    		$this->validate($request, [
    			'query' => 'required',
			]);
    	}

        $catalog = Catalog::withCount('comments')->search($query)
            ->get();


        $catalog = Catalog::paginateCollection($catalog, 15);

        // dd($catalog);
        return view('catalog.index', compact('catalog'));
    }

    /*public function sitemapGenerate() {
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
    }*/
}
