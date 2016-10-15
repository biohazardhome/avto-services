<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// include(base_path('My/kladr.php'));

use \My\Kladr\Api;
use \My\Kladr\ObjectType;
use \My\Kladr\Query;


class KladrController extends Controller
{
	protected
		$api;
    
	private function query($search, $type, \My\Kladr\Object $parent = null, $limit = 10) {
		$this->api = new Api('5787efab0a69de955e8b45de');

		// Формирование запроса
		$query = new Query();
		$query->ContentName = trim($search);
		$query->ContentType = $type;
		$query->WithParent = false;
		if ($parent) {
			$query->WithParent = true;
			$query->ParentType = $parent->type;
			$query->ParentId = $parent->id;
		}
		$query->Limit = $limit;

		return $query;
	}

	protected function queryToJson($search, $type, \My\Kladr\Object $parent = null, $limit) {
		$query = $this->query($search, $type, $parent);
		// $data = $this->api->QueryToJson($query);
		$data = $this->api->QueryToArray($query);
		// dd($regions);
		return response()->json($data);
	}

	protected function queryToObject($search, $type, \My\Kladr\Object $parent = null, $limit) {
		$query = $this->query($search, $type, $parent);
		return $this->api->QueryToObjects($query);
	}

	public function index($region, $district, $city, $street, $build) {
		// dump($region);
		$region = $this->region($region, null, 10);
		// dump(head($region));
		$district = $this->district($district, head($region), 10);
		// dd($district, head($district));
		$city = $this->city($city, head($district), 10);
		dd($city);
		$street = $this->street($street, $city, 10);
		$build = $this->build($build, $street, 10);

		dd($region, $district, $city, $street, $build);
	}

	public function region($value, $parent, $limit) {
		return $this->queryToObject($value, ObjectType::Region, $parent, $limit);
	}

	public function district($value, $parent, $limit) {
		return $this->queryToObject($value, ObjectType::District, $parent, $limit);
	}
	
	public function city($value, $parent, $limit) {
		return $this->queryToObject($value, ObjectType::City, $parent, $limit);
	}

	public function street($value, $parent, $limit) {
		return $this->queryToObject($value, ObjectType::Street, $parent, $limit);
	}

	public function building($value, $parent, $limit) {
		// dd($value);
		return $this->queryToObject($value, ObjectType::Building, $parent, $limit);
	}
}
