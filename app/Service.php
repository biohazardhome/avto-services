<?php

namespace App;

use App\Catalog;

class Service extends Model
{
    
	protected
		$table = 'services',
		$fillable = [];

	public static function slugGenerate() {
        return static::slugOptions()
            ->slugColumn('slug')
            ->generateFromColumn('name')
            ->regenerateOnUpdate(false);
    }

    public function getRouteKeyName() {
		return 'slug';
	}

	public function catalog() {
		return $this->hasMany(Catalog::class, 'service_id');
	}

}
