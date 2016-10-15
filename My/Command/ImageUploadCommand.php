<?php

namespace My\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use My\Service\Image;

class ImageUploadCommand {

	protected
		$file,
		$folder,
		$alt,
		$title;

	public function __construct(UploadedFile $file, $folder = null, $alt = null, $title = null) {
		$this->file = $file;
		$this->folder = $folder;
		$this->alt = $alt;
		$this->title = $title;
	}

	public function handle(/*UploadedFile $file, $folder = null, $alt = null, $title = null*/) {

		$file = $this->file;
		$folder = $this->folder;
		
		$filename = $file->getClientOriginalName();
		$image = new Image($filename, $folder/*, null, null, true*/);

		$pathDir = $image->getPathDir();
		/*if (!file_exists($pathDir)) {
			mkdir($pathDir, 0777, true);
		}*/
		
		if (!$image->isUnique()) {
			$image->toUnique();
		}

		$file->move($pathDir, $image->filename);

		return $image;
	}

}