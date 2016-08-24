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
			$count = count($segments);
			if ($count) {
				$segment = array_get($this->SEGMENTS, $type);
				if ($count > count($this->SEGMENTS)) {
					$segments = $this->buildingGlue($segments);
				}
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

	public function getAddressCityShortAttribute() {
		$delimiter = ' ';
		$city = $this->getAddressSegmentsAttribute('city');
		$chunks = explode($delimiter, $city);
		if (count($chunks) > 1) { // города с пробелом
			$prefix = array_shift($chunks);
			$city = implode($delimiter, $chunks);
		}
		return $city;
	}

	public function getAddressBuildingShortAttribute() {
		$delimiter = ' ';
		$city = $this->getAddressSegmentsAttribute('build');
		$chunks = explode($delimiter, $city);
		if (count($chunks) > 1) { // города с пробелом
			$prefix = array_shift($chunks);
			$city = implode($delimiter, $chunks);
		}
		return $city;
	}


	/*
		в последнем сегменте может встречаться разделитель, в других нет
		если в последнем сегменте встречается разделитель, то частей получится больше, поэтому мы их склеиваем
	*/
	public function buildingGlue(array $segments = []) { // склеить
		$countPossible = count($this->SEGMENTS); // возмоное количество сегментов
		$building = implode(array_slice($segments, count($this->SEGMENTS)-1));
		$segments = array_slice($segments, 0, count($this->SEGMENTS)-1) ;
		$segments = array_merge($segments, [$building]);
		return $segments;
	}

}
