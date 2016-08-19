<?php

namespace My\Service;

use Storage;

use My\Model\Image as ImageModel;

class Image {

	const DIR = '/upload/images/';

	protected
		// $renameFilenameUseFolderName = false,
		$dir = '/upload/images/',
		/*$oldPathDir,
		$oldFilename,*/
		$errors = [],
		$storage;

	public
		$filename,
		$alt,
		$title,
		$folder;

	public function __construct($filename, $folder = null, $dir = null, $alt = null, $title = null, $renameUseFolder = false) {
		$this->dir = $dir === null ? $this->dir : $dir;
		$this->filename = $filename;
		// $this->oldFilename = $filename;
		$this->folder = $folder;
		$this->alt = $alt === null ? $filename : $alt;
		$this->title = $title === null ? $filename : $title;

		$this->storage = Storage::disk('local');

		$this->renameFilenameUseFolderName($renameUseFolder);
	}

	public function addedFolderToDir($folder) {
		$this->dir .= $folder .'/';
	}

	public function renameFilenameUseFolderName($rename = false) {
		if ($rename && $this->folder) {
			$this->rename($this->folder);
		}
	}

	public function getDir() {
		if ($this->folder !== null) {
			return $this->dir . $this->folder .'/';
		}
		return $this->dir;
	}

	public function getPathDir() {
		return public_path() . $this->getDir();
	}

	public function getPathFilename() {
		return $this->getPathDir() . $this->filename;
	}

	public function getPath() {
		return $this->getPathDir() . $this->filename;
	}

	/*public function getPathOld() {
		return $this->oldPathDir . $this->oldFilename;
	}*/

	public function getUrl() {
		return $this->getDir() . $this->filename;
	}

	public function getFilename() {
		return $this->filename;
	}

	public function exists() {
		return file_exists($this->getPath());
	}

	public function transliteration($filename) {
		return trim(str_slug($filename));
	}

	public function isUnique() {
		return !$this->exists();
	}

	public function toUnique() {
		/*$this->oldFilename = */$filename = $this->filename;
		$i = 0;
		list($name, $ext) = explode('.', $filename);
		while (file_exists($this->getPathDir() . $filename)) {
			$filename = $name .'-'. $i .'.'. $ext;
			$i++;
		}
		$this->filename = $filename;
	}

	public function rename($filename) { // changeFilename
		if ($filename === '' && $filename === null) return false; 
		list($name, $ext) = explode('.', $this->filename);
		return $this->filename = $filename .'.'. $ext;
	}

	public function setFolder($folder, $name = bull) {
		// $this->oldPathDir = $this->getPathDir();
		$oldPath = $this->getPath();
		$this->rename($name);
		// dd($oldPath);
		$this->folder = $folder;

		$this->createFolders();
		$this->moveFolder($oldPath);

		return $this;
	}

	public function createFolders() {
		$pathDir = $this->getPathDir();
		if (!file_exists($pathDir)) {
			if (!mkdir($pathDir, 0777, true)) $this->errors[] = 'Не может создать каталоги для ижображений';
		}
		return null;
	}

	public function moveFolder($oldPath/*$folder = null*/) {
		// if ($folder !== null) $this->setFolder($folder);

		if (!$this->isUnique()) {
			$this->toUnique();
		}
		return $this->move($oldPath, $this->getPath());
	}

	public function move($oldPath, $newPath) {
		$r = rename($oldPath, $newPath);
		if (!$r) {
			$this->errors[] = 'Неудалось перенести изображение в каталог '. $oldPath .' -> '. $newPath;
		}
		return $r;
		// return rename($oldPath, $newPath);
	}

	public function save($filename, $data) {
		$this->storage->put($this->getPath(), $data);
	}

	public function getErrors() {
		return $this->errors;
	}

	public function isErrors() {
		return count($this->errors);
	}

}