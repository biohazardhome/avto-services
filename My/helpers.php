<?php

function str_limit_with($s, $limit = null, $end = '.', $withEnd = true) {
	$s = substr($s, 0, $limit ? $limit : strlen($s));
	var_dump($s);

	if (($pos = strrpos($s, $end)) !== false) {
		// var_dump($pos);
		$s = substr($s, 0, $withEnd ? $pos + 1 : $pos);
	}
	return $s;
}

function mb_ucfirst($value) {
	$value = mb_strtolower(trim($value));
	return mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1);
}