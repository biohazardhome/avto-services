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

Route::get('/', 'Catalog\CatalogController@index');

Route::group(['as' => 'catalog.', 'namespace' => 'Catalog', /*'middleware' => '', */'prefix' => 'catalog'], function() {
	Route::get('/', 'CatalogController@index')->name('index');
	Route::get('/{slug}', 'CatalogController@show')->name('show');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'CatalogController@index')->name('index');

	Route::group(['as' => 'catalog.', 'prefix' => 'catalog', ], function() {
		Route::get('/', 'CatalogController@index')->name('index');
		Route::get('/create', 'CatalogController@create')->name('create');
		Route::put('/store', 'CatalogController@store')->name('store');
		Route::get('/edit/{id}', 'CatalogController@edit')->name('edit');
		Route::post('/update/{id}', 'CatalogController@update')->name('update');
		Route::get('/delete/{id}', 'CatalogController@delete')->name('delete');
	});
});

Route::group(['as' => 'map.', /*'namespace' => '',*/ 'prefix' => 'map'], function() {
	Route::get('/', 'MapController@index')->name('index');
	Route::get('/{address}', 'MapController@show')->name('show');
});


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
