<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Catalog;

class AddressController extends Controller
{
    
	public function __construct() {

		// Замена конструкции __call()
		$parameters = \Route::getCurrentRoute()->parameters();
		if ($parameters) {
			$action = key($parameters);
			$value = $parameters[$action];
			
			// return $this->sameAction($action, $value);
			$this->callAction($action, [$value]);
		}


	}

	/*public function __call($method, $args) {
		dd($method, $args);

		$types = [
			'region',
			'district',
			'street',
			'building',
		];

		if (in_array($method, $types)) {

			$entities = $this->findAddressSegment($method, $arg[0]);
			// dd($entities->count());
			if ($entities->count()) {
				$entities = Catalog::paginateCollection($entities);
				return view('catalog.address', ['catalog' => $entities] + compact(''));
			}
		} else {
			return call_user_func_array(array($this, $method), $args);
		}
	}*/

	public function index() {

	}

	public function region($region) {
		/*$entities = $this->findAddressSegment('region', $region);
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
		}*/

		return $this->sameAction('region', $region);
	}

	public function district($district) {
		/*$entities = $this->findAddressSegment('district', $district);
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
		}*/

		return $this->sameAction('district', $district);
	}

	public function street($street) {
		// $entities = $this->findAddressSegment('streetShort', $street);
		/*$entities = $this->findAddressSegment('street', $street);
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
		}*/

		return $this->sameAction('street', $street);
	}

	public function build($build) {
		/*$entities = $this->findAddressSegment('building', $build);
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
		}*/

		return $this->sameAction('building', $build);
	}

	private function sameAction($type, $value) {
		$entities = $this->findAddressSegment($type, $value);
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities]);
		}

		return abort(404);
	} 

	private function findAddressSegment($segmentName, $value) {
		if (empty($value)) {
			return null;
		}

		return Catalog::with('city', 'service')
			->withCount('comments')
			->orderBy('sort', 'desc')
			// ->paginate(20)
			->get()
			->filter(function($catalog) use($segmentName, $value) {
				$segmentValue = $catalog->{'address'. $segmentName};
				// if (!empty($segmentValue) && $segmentValue === $value) {
					// dump($segmentValue);
					return !empty($segmentValue) && $segmentValue === $value;
				// }

				return false;
			});
	}

}
