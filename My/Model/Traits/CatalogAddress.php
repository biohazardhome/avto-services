<?php

namespace My\Model\Traits;

trait CatalogAddress {

	/*const SEGMENTS = [
		'zip' => 0,
		'region' => 1,
		'city' => 2,
		'street' => 3,
		'build' => 4,
	];*/

	protected $SEGMENTS = [
		// 'zip' => 0,
		'region' => 0,
		'district' => 1,
		'city' => 2,
		'street' => 3,
		'build' => 4,
	];

	public function getAddressSegmentsAttribute($type) {
		if ($this->address) {
			$segments = explode(',', $this->address);
			if (count($segments)) {
				$segment = array_get($this->SEGMENTS, $type);
				return trim(array_get($segments, $segment));
			}
		}
		return null;
	}

	public function getAddressRegionAttribute() {
		return $this->getAddressSegmentsAttribute('region');
	}

	public function getAddressDistrictAttribute() {
		return $this->getAddressSegmentsAttribute('district');
	}

	public function getAddressCityAttribute() {
		return $this->getAddressSegmentsAttribute('city');
	}

	public function getAddressStreetAttribute() {
		return $this->getAddressSegmentsAttribute('street');
	}

	public function getAddressBuildingAttribute() { // Здание
		return $this->getAddressSegmentsAttribute('build');
	}

	

}
