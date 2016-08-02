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

function routeSame($name, $controller, array $params = [], $type = 'get') { // параметры
	Route::$type('/'. $name .'/{' . $name . '}', $controller .'@'. $name)->name($name);
}

/*Route::group(['as' => 'kladr.', 'prefix' => 'kladr'], function() {
	Route::get('/{region}/{district}/{city}/{street}/{building}', 'KladrController@index')->name('index');
	Route::get('/region/{region}', 'KladrController@region')->name('region');
	Route::get('/district/{district}', 'KladrController@district')->name('district');
	Route::get('/city/{city}', 'KladrController@city')->name('city');
	Route::get('/street/{street}', 'KladrController@street')->name('street');
	routeSame('building', 'KladrController');
});*/

// Route::get('/home', 'HomeController@index');

Route::get('/', 'Catalog\CatalogController@index')->name('index');

Route::group(['as' => 'catalog.', 'namespace' => 'Catalog', 'prefix' => 'catalog'], function() {
	Route::get('/', 'CatalogController@index')->name('index');
	Route::get('/{slug}', 'CatalogController@show')->name('show');
	Route::get('/search/{query?}', 'CatalogController@search')->name('search');
	Route::post('/search', 'CatalogController@search')->name('search');
	Route::get('/sitemap-generate', 'CatalogController@sitemapGenerate')->name('sitemap-generate');
});

Route::group(['as' => 'comment.', 'prefix' => 'comment'], function() {
	// Route::get('/create', 'CommentController@create')->name('create');
	Route::get('/', 'CommentController@index')->name('index');
	Route::put('/store', 'CommentController@store')->name('store');
	Route::get('/catalog/{slug}', 'CommentController@catalog')->name('catalog');
	Route::get('/sitemap-generate', 'CommentController@sitemapGenerate')->name('sitemap-generate');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function() {
	Route::auth();

	Route::get('/', 'CatalogController@index')->name('index');

	Route::group(['as' => 'catalog.', 'prefix' => 'catalog', ], function() {
		Route::any('/', 'CatalogController@index')->name('index');
		Route::get('/show/{id}', 'CatalogController@show')->name('show');
		Route::get('/create', 'CatalogController@create')->name('create');
		Route::put('/store', 'CatalogController@store')->name('store');
		Route::get('/edit/{id}', 'CatalogController@edit')->name('edit');
		Route::post('/update/{id}', 'CatalogController@update')->name('update');
		Route::get('/delete/{id}', 'CatalogController@delete')->name('delete');
	});

	Route::group(['as' => 'comment.', 'prefix' => 'comment', ], function() {
		Route::any('/', 'CommentController@index')->name('index');
		Route::get('/show/{id}', 'CommentController@show')->name('show');
		Route::get('/create', 'CommentController@create')->name('create');
		Route::put('/store', 'CommentController@store')->name('store');
		Route::get('/edit/{id}', 'CommentController@edit')->name('edit');
		Route::post('/update/{id}', 'CommentController@update')->name('update');
		Route::get('/delete', 'CommentController@delete')->name('delete');
	});

	Route::group(['as' => 'city.', 'prefix' => 'city', ], function() {
		Route::any('/', 'CityController@index')->name('index');
		Route::get('/show/{id}', 'CityController@show')->name('show');
		Route::get('/create', 'CityController@create')->name('create');
		Route::put('/store', 'CityController@store')->name('store');
		Route::get('/edit/{id}', 'CityController@edit')->name('edit');
		Route::post('/update/{id}', 'CityController@update')->name('update');
		Route::get('/delete', 'CityController@delete')->name('delete');
	});
});

Route::group(['as' => 'map.', /*'namespace' => '',*/ 'prefix' => 'map'], function() {
	Route::get('/', 'MapController@index')->name('index');
	Route::get('/{address}', 'MapController@showOld')->name('show.old');
	Route::get('/{name}/{address}', 'MapController@show')->name('show');
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

Route::get('/{city}', 'Catalog\CatalogController@city')->name('catalog-city');
// Route::get('/{city}/{catalog-type}', 'Catalog\CatalogController@city')->name('catalog-type');



/*Route::get('/', function () {
    return view('welcome');
});*/
