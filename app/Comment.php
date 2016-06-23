<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use App\Catalog;

class Comment extends Model
{
    protected
    	$fillable = ['catalog_id', 'name', 'email', 'msg', 'rating', 'car_brand', 'car_model'];

    public function catalog() {
    	return $this->belongsTo(Catalog::class, 'catalog_id');
    	// return $this->hasOne(Catalog::class, 'id', 'catalog_id');
    }
}
