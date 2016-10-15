<?php

namespace My\Service;

class ImageCatalog extends Image {

	protected
		$dir = '/upload/images/catalog/';

	public function __construct($filename, $folder = null, $alt = null, $title = null, $renameUseFolder = false) {
		parent::__construct($filename, $folder, $alt, $title, $renameUseFolder);
	}

}
/*
class ImageCatalog {

	protected
		$instance;

	public function __construct($filename, $folder = null, $alt = null, $title = null, $renameUseFolder = false) {
		$this->instance = new Image($filename, $folder, $alt, $title, $renameUseFolder);
	}

	public function getInstance() {
		return $this->instance;
	}

}*/