<?php

namespace App;

use My\Model\Slug\Slug;
use App\Catalog;

class City extends Model
{
    use Slug;

    protected
    	$table = 'cities',
        $fillable = [
            'id',
            'name',
            'slug',
            'title',
            'description',
            'text'
        ],
        $rules = [
            'name' => 'required|unique:cities,id',
        ],
        $searchable = [
            'columns' => [
                'title' => 10,
                'description' => 10,
                'text' => 10,
                'name' => 9,
                'slug' => 8,
            ]
        ];

    public static function slugGenerate() {
        return static::slugOptions()
            ->slugColumn('slug')
            ->generateFromColumn('name')
            ->regenerateOnUpdate(false);
    }

	public function getRouteKeyName() {
		return 'slug';
	}

	/*public function setNameAttribute($value) {
		$this->name = mb_ucfirst($value);
	}*/

    /*public function catalog() {
        return $this->belongsToMany(Catalog::class, 'catalog_cities', 'city_id', 'catalog_id');
    }*/

    public function catalog() {
    	return $this->hasMany(Catalog::class/*, 'id', 'city_id'*/);
    }

}
