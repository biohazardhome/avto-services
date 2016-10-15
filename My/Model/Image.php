<?php

namespace My\Model;

use Illuminate\Database\Eloquent\Model;

use My\Service\Image as ImageService;

class Image extends Model
{
    
	protected
		$table = 'images',
		$fillable = ['id', 'filename', 'path', 'alt', 'title', 'imageable_id', 'imageable_type'];

	public function imageable() {
		return $this->morphTo();
	}

	/*public function newCollection(array $models = []) {
		dump(123);
		// dd($models);
		$collect = parent::newCollection($models);
		// dump($collect);
		return $collect->transform(function($model) {
			// dump($model);
			// dd($model, $model->imageable_type);
			$filename = $model->filename;
			$folder = $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null;
			// dd($folder);
			$image = new ImageService($filename, $folder);
			// dd($image);
			return $image;
			// return new ImageService($model->filename, $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null);
		});
	}*/

	/*public static function hydrate(array $items, $connection = null) {
		dump(123);
		return parent::hydrate($items, $connection);
	}*/

	public function wrap() {

	}

}


/*My\Model\Image::all()->transform(function($a, $b, $c) {dd($a, $b, $c);});
My\Model\Image::all()->transform(function($model) { return new My\Service\Image($model->filename, $model->imageable_type ? lcfirst(get_basename($model->imageable_type)) : null); });*/