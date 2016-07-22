<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use My\Model\Slug\Slug;
use App\Catalog;

class City extends Model
{
    use Slug;

    protected
    	$table = 'cities',
        $fillable = ['id', 'name', 'slug'];

    public static function slugGenerate() {
        return static::slugOptions()
            ->slugColumn('slug')
            ->generateFromColumn('name')
            ->regenerateOnUpdate(false);
    }

	public function getRouteKeyName() {
		return 'slug';
	}

	public function setNameAttribute($value) {
		$this->name = mb_ucfirst($value);
	}

    public function catalog() {
    	return $this->belongsToMany(Catalog::class, 'catalog_cities', 'city_id', 'catalog_id');
    }

}