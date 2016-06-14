<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected
		$table = '',
		$fillable = ['path', 'alt', 'title'];
		
	public function imageable() {
		return $this->morphTo();
	}
}
