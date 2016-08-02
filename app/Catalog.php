<?php

namespace App;

use Illuminate\Support\Collection;

use My\Model\Slug\Slug;

use App\Image;
use App\Comment;
use App\City;

class Catalog extends Model
{

	use Slug;

    protected
		$table = 'catalog',
		$fillable = ['slug', 'name', 'description', 'content', 'address', 'phones', 'email', 'site', 'sort'];

	public static function slugGenerate() {
        return static::slugOptions()
            ->slugColumn('slug')
            ->generateFromColumn('name')
            ->regenerateOnUpdate(false);
    }

	public function getRouteKeyName() {
		return 'slug';
	}

	public function getAddressSegmentsAttribute() {
		if ($this->address) {
			return explode(',', $this->address);
		}
		return null;
	}

	public function getAddressStreetAttribute() {
		$segments = $this->getAddressSegmentsAttribute();
		return $segments !== null ? $segments[1] : null; 
	}

	public function getAddressBuildingAttribute() { // Здание
		$segments = $this->getAddressSegmentsAttribute();
		return $segments !== null ? $segments[2] : null; 
	}

	public function getAddressCityAttribute() {
		$segments = $this->getAddressSegmentsAttribute();
		return $segments !== null ? $segments[0] : null; 
	}
	
	public function images() {
		return $this->morphMany(Image::class, 'imageable');
	}

	public function comments() {
		return $this->hasMany(Comment::class, 'catalog_id');
	}

	public function city() {
		return $this->belongsToMany(City::class, 'catalog_cities', 'catalog_id', 'city_id');
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
