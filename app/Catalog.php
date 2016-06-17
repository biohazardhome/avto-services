<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use App\Image;

class Catalog extends Model
{
    protected
		$table = 'catalog',
		$fillable = ['slug', 'name', 'description', 'content', 'address', 'phones', 'email', 'site', 'sort'];
		
	public function getRouteKeyName() {
		return 'slug';
	}
	
	public function images() {
		return $this->morphMany(Image::class, 'imageable');
	}
	
	// similar
	public function similarities() {
		return self::take(5);
	}
	
	public function scopeRandom($q, $take = 1) {
		$count = static::count() -1;
		$skip = $count > 0 ? mt_rand(0, $count) : 0;
		return $q->skip($skip)->take($take)->get();
	}
	
}
