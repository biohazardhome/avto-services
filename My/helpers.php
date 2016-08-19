<?php

function command($command, array $args = array()) {
	return call_user_func_array([$command, 'handle'], $args);
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
	$value = mb_strtolower(trim($value));
	return mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1);
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