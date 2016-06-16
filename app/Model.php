<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel {

	public function getAttributes(array $attr = array()) {
		return array_only(parent::getAttributes(), $attr);
	}

}