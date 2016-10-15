<?php

namespace App;

use Illuminate\Support\Collection;

use My\Model\Slug\Slug;
use My\Model\Traits\CatalogAddress;

use My\Model\Image;
use App\Comment;
use App\City;
use App\Service;

class Catalog extends Model
{

	use Slug;
	use CatalogAddress;

    protected
		$table = 'catalog',
		$fillable = [
			'slug', 'city_id', 'service_id', 'name', 'description', 'content', 'address', 
			'phones', 'email', 'site', 'sort'
		],
		$rules = [
			// 'slug' => 'required|unique:catalog',
			'name' => 'required|unique:catalog',
			'city_id' => 'required|exists:cities,id',
			'service_id' => 'required|exists:services,id',
            // 'phones' => 'required',
            'address' => 'required',
            'email' => 'email',
            'description' => 'required',
            'sort' => 'integer',
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

	/*public function getCityAttribute() {
		return $this->getRelationValue('city')->first();
	}*/

	public function service() {
		return $this->belongsTo(Service::class);
	}

	public function images() {
    	return $this->morphMany(Image::class, 'imageable');
    }

	public function comments() {
		return $this->hasMany(Comment::class, 'catalog_id');
	}

	/*public function city() {
		return $this->belongsToMany(City::class, 'catalog_cities', 'catalog_id', 'city_id');
	}*/

	public function city() {
		return $this->belongsTo(City::class);
	}
	
	// similar
	public function similarities() {
		return self::take(5);
	}

	public function scopeLikeByAddress($q, $street, $limit = 0/*, $cacheKey = ''*/) {
		return $q->where('address', 'like', '%'. $street .'%')
		    ->random($limit)
		    // ->remember(5)
		    ->get();
	}

	public static function transformForMap($catalog, array $except = []) {
		if ($catalog instanceof Collection) {
			return $catalog->keyBy('name')
				->map(function($i, $k) use($except) {

					$except = array_merge($except, ['pivot']);
					$attributes = array_except($i->toArray(), $except);

			    	return collect($attributes)
			    	    ->map(function($i, $k) {
						    if ($k === 'site') {
						    	return urlencode($i);
						    } else if (is_string($i)) {
						    	return addslashes($i);
						    }/* else if (is_array($i)) {
						    	dump($k, $i);
						    }*/
			    	});
			    });
		} else {
			return (object) collect($catalog->getAttributes())->map(function($i, $k) {
			    if ($k === 'site') {
			    	return urlencode($i);
			    } else {
			    	return addslashes($i);
			    }
	    	})->toArray();
		}
	}
	
}
