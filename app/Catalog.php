<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use My\Model\Slug\Slug;

use App\Image;
use App\Comment;

class Catalog extends Model
{

	use Slug;

    protected
		$table = 'catalog',
		$fillable = ['slug', 'name', 'description', 'content', 'address', 'phones', 'email', 'site', 'sort'];

	public function slugGenerate() {
        return static::slugOptions()
            ->slugColumn('slug')
            ->generateFromColumn('name')
            ->regenerateOnUpdate(false);
    }

	public function getRouteKeyName() {
		return 'slug';
	}
	
	public function images() {
		return $this->morphMany(Image::class, 'imageable');
	}

	public function comments() {
		// return $this->belongsTo(Comment::class, 'id', 'catalog_id');
		return $this->hasMany(Comment::class, 'catalog_id');
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

	public static function transformForMap($catalog) {
		if ($catalog instanceof Collection) {
			return $catalog->map(function($i, $k) {
		    	return collect($i->toArray())
		    	    ->map(function($i, $k) {
					    if ($k === 'site') {
					    	return urlencode($i);
					    } else {
					    	return addslashes($i);
					    }
		    	});
		    });
		} else {
			// dd($catalog->getAttributes());
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
