<?php

function command($command, array $args = array()) {
	return call_user_func_array([$command, 'handle'], $args);
}

// Склонение слова по числу
function decline_number($number, $after) {
  $cases = array (2, 0, 1, 1, 1, 2);
  return $after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

function str_limit_with($s, $limit = null, $end = '.', $withEnd = true) {
	$s = substr($s, 0, $limit ? $limit : strlen($s));
	// var_dump($s);

	if (($pos = strrpos($s, $end)) !== false) {
		// var_dump($pos);
		$s = substr($s, 0, $withEnd ? $pos + 1 : $pos);
	}
	return $s;
}

function mb_ucfirst($value) {
	$value = mb_strtolower($value);
	return mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1);
}

function mb_lcfirst($value) {
	return mb_strtolower($value);
}

// input url with protocol http://example.com
function url_host($url) { // rename url_to_host()
	if (filter_var($url, FILTER_VALIDATE_URL)) {
		$url = parse_url($url);

		if ($url && isset($url['host'])) {
			$host = $url['host'];
			$host = str_replace('www.', '', $host);
			return $host;
		}/* else {
			echo 'Нет хоста';
		}*/
	}
	return null;
}