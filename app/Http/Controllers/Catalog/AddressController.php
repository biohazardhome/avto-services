<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Catalog;

class AddressController extends Controller
{
    
<<<<<<< HEAD
	public function index() {
=======
	public function __construct() {

		// Замена конструкции __call()
		$parameters = \Route::getCurrentRoute()->parameters();
		if ($parameters) {
			$action = key($parameters);
			$value = $parameters[$action];
			
			// return $this->sameAction($action, $value);
			$this->callAction($action, [$value]);
		}

>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297

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

<<<<<<< HEAD
	public function region($region) {
		$entities = $this->findAddressSegment('region', $region);
=======
	public function index() {

	}

	public function region($region) {
		/*$entities = $this->findAddressSegment('region', $region);
>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
<<<<<<< HEAD
		}
	}

	public function district($district) {
		$entities = $this->findAddressSegment('district', $district);
=======
		}*/

		return $this->sameAction('region', $region);
	}

	public function district($district) {
		/*$entities = $this->findAddressSegment('district', $district);
>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
<<<<<<< HEAD
		}
=======
		}*/

		return $this->sameAction('district', $district);
>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
	}

	public function street($street) {
		// $entities = $this->findAddressSegment('streetShort', $street);
<<<<<<< HEAD
		$entities = $this->findAddressSegment('street', $street);
=======
		/*$entities = $this->findAddressSegment('street', $street);
>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
<<<<<<< HEAD
		}
	}

	public function build($build) {
		$entities = $this->findAddressSegment('building', $build);
=======
		}*/

		return $this->sameAction('street', $street);
	}

	public function build($build) {
		/*$entities = $this->findAddressSegment('building', $build);
>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
		// dd($entities->count());
		if ($entities->count()) {
			$entities = Catalog::paginateCollection($entities);
			return view('catalog.address', ['catalog' => $entities] + compact(''));
<<<<<<< HEAD
		}
	}

=======
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

>>>>>>> b687a396cd009e159ec825ebd5b93514b3f71297
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
