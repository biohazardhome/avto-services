<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use My\Model\Image;

use My\Service\Image as ImageService;

use My\Command\ImageUploadCommand;

class ImageController extends Controller
{

	public function index() {
		$images = Image::paginate(10);
		return view('image.index', compact('images'));
	}

	public function show($id) {
		$image = Image::find($id);
		return view('image.image', compact('image'));
	}

	public function catalogs($id) {
		$images = Image::whereImageableType('catalog')
			->whereImageableId($id)
			->paginate(10);
		return view('image.index', compact('images'));
	}

	public function create() {
		// $images = Image::paginate(10);
		return view('image.upload');
	}

	public function upload(Request $request) {

		$this->validate($request, [
			'*' => 'image:jpeg,png,gif',
		]);

		$success = false;
		$errors = [];
		$data = [];
		$data['files'] = [];
		$files = $request->file();

		foreach ($files as $file) {
			if ($file && $file->isValid()) {
				// $image = command(new ImageUploadCommand(), compact('file'));
				$image = command(new ImageUploadCommand($file)/*, compact('file')*/);

				$filename = $file->getClientOriginalName();
				$data['files'][] = $filename;

				$success = true;
			} else {
				$errors[] = 'Невалидный файл';
				// dump($file);
			}
		}

		return compact('success', 'errors', 'data');
	}

	public function store(Request $request) {
		$success = false;

		$this->validate($request, [
		    'files' => 'required',
			'files.*.file' => 'image:jpeg,png,gif|size:3145728|dimensions:min_width=200,min_height=200',
			'filename' => 'string',
			'folder' => 'string',
			'alt' => 'string',
			'title' => 'string',
			'imageable_type' => 'string',
			'imageable_id' => 'integer',
		]);

		// $fields = $request->all();

		$files = $request->get('files', []);

		if (count($files)) {
			$success = true;
			$errors = [];
			// $data = [];

			foreach ($files as $k => $file) {
				$image = new ImageService($file);
				
				/*if ($request->has('filename')) {
				    $image->rename($request->get('filename'));
				}*/

				if ($request->has('folder')) {
					$folder = $request->get('folder');
					$newFilename = $request->get('filename');
					$image->setFolder($folder, $newFilename);
				}

				if (!$image->isErrors()) {

					$filename = $image->filename;
					$path = $image->getPath();

					$alt = !empty($alt) ? $alt : $filename;
					$title = !empty($title) ? $title : $filename;

					// dump($request->get('alt'));

					// $fields = $request->only(['alt', 'title', 'imageable_type', 'imageable_id']);

					Image::create(
						array_merge($request->except([
							'filename',
							'path',
							'alt',
							'title',
						]), [
							'filename' => $filename,
							'path' => $path,
							'alt' => $alt,
							'title' => $title,
						])
					);
				} else {
					$errors = $image->getErrors();
				}
			}
		}

		return compact('success', 'errors');
	}

	public function edit($id) {
		return response('edit-'. $id);
	}

	public function update($id) {
		
	}

	public function delete($id) {
		$image = Image::find($id);
		if ($image) {
			if (file_exists($image->path)) {
				unlink($image->path);
			} else {
				echo 'Файла нет, что-то не так';
			}
			$image->delete();
		} else {
			echo 'Нет такого изображения';
		}
		return back();
	}
    
}
