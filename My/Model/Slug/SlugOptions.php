<?php

namespace My\Model\Slug;

class SlugOptions {

	public
		$slugColumn = 'slug',
		$generateFromColumn = 'title',
		$generateUnique = true,
		$maxLength = 255,
		$regenerateOnUpdate = false;

	public function create() {
		return new static;
	}

	public function slugColumn($column) {
		$this->slugColumn = $column;
		return $this;
	}
	
	public function generateFromColumn($column) {
		$this->generateFromColumn = $column;
		return $this;
	}

	public function generateUnique($flag) {
		$this->generateUnique = $flag;
		return $this;
	}

	public function maxLength($length) {
		$this->maxLength = $length;
		return $this;
	}

	public function regenerateOnUpdate($flag) {
		$this->regenerateOnUpdate = $flag;
		return $this;
	}

}