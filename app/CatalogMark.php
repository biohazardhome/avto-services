<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Catalog;

class CatalogMark extends Model
{
    
	protected
		$table = 'catalog_marks',
		$fillable = [
			'id',
			'catalog_id',
			'mark_id',
		];

	public function catalog() {
		return $this->belongsToMany(Catalog::class, 'catalog_marks', 'mark_id', 'catalog_id');
	}


}
