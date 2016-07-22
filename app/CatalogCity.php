<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use App\Catalog;

class CatalogCity extends Model
{
    
	protected
		$table = 'catalog_cities',
		$fillable = ['id', 'catalog_id', 'city_id'];

}
