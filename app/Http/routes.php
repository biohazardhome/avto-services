<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
	$catalog = App\Catalog::whereSlug('vfm-autoservis-45')->first();
	return view('catalog.show', compact('catalog'));
});

Route::group(['as' => 'catalog.', 'namespace' => 'Catalog', /*'middleware' => '', */'prefix' => 'catalog'], function() {
	Route::get('/', 'CatalogController@index')->name('index');
	Route::get('/{slug}', 'CatalogController@show')->name('show');
});

Route::get('/map/{address}', 'MapController@index');

//Route::group('as' => 'images', function() {
	//dd(123);
	Route::get('/images/{file}', function($file = null) {
		$path = storage_path('app/public/images/') . $file;
		dd($path, file_exists($path));
		if (file_exists($path)) {
			//return response()->download($path);
			echo file_get_contents($path);
		}
	});
	Route::get('/images/{catalog}/{file}', function($catalog, $file = null) {
		$path = storage_path('app/public/images/') . $catalog .'/'. $file;
		//dd($path, file_exists($path));
		if (file_exists($path)) {
			return response()->download($path);
			//echo file_get_contents($path);
		}
	});
	Route::get('/images/catalog/{catalog}/{file}', function($catalog, $file = null) {
		$path = storage_path('app/public/images/catalog/') . $catalog .'/'. $file;
		//dd($path, file_exists($path));
		if (file_exists($path)) {
			return response()->download($path);
			//echo file_get_contents($path);
		}
	});
//});

/*Route::get('/', function () {
    return view('welcome');
});*/
