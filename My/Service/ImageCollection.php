<?php

namespace My\Service;

// use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection;

use My\Model\Image;
use My\Service\Image as ImageService;


/*
	При выборке из модели Image модели оборачивать в My\Service\Image, чтоб получилась коллекция c элементами экземляра класса My\Service\Image
*/

class ImageCollection extends Collection {

	// protected $collect; 

	public function __construct($items = []) {
		parent::__construct($items);
		$this->prepareData();
	}

	// wrap, transformData, changeData, replaceData
	protected function prepareData() {
		foreach ($this->items as $key => $value) {
			$model = $value;
			$filename = $model->filename;
			$folder = null;
			// $folder = $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null;
			// dd($model->imageable()->get());
			$catalog = $model->imageable()->first();
			if ($catalog) {
				$dirFolder = $model->imageable_type ? lcfirst(class_basename($model->imageable_type)): null;
				$folder = $catalog->slug;
				$image = new ImageService($filename, $catalog->slug);
				$image->addedFolderToDir($dirFolder);
				// dump($image->getDir(), $image->getFilename());
			} else {
				$image = new ImageService($filename);
			}
			// dd($image);
			$this->items[$key] = $image;
			// return new ImageService($model->filename, $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null);
		}

		return $this->items;
	}

}

class ImageCatalogCollection extends Collection {

	// protected $collect; 

	public function __construct($items = []) {
		parent::__construct($items);
		$this->replaceData();
	}

	// wrap, transformData, changeData
	protected function replaceData() {
		foreach ($this->items as $key => $value) {
			$model = $value;
			$filename = $model->filename;
			// $folder = $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null;
			$folder = $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null;
			// dd($folder);
			$image = new ImageService($filename, $folder);
			// $image->addedFolderToDir('catalog');
			// dd($image);
			$this->items[$key] = $image;
			// return new ImageService($model->filename, $model->imageable_type ? lcfirst(class_basename($model->imageable_type)) : null);
		}

		return $this->items;
	}

}
