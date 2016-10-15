<?php

use Illuminate\Support\Collection;

Collection::macro('pipe', function($callback) { // $collect->map(function() { // do some; })->pipe(function($collect) { $collect->sum()})
    return $callback($this);
});

Collection::macro('dd', function() {
    return dd($this);
});

Collection::macro('dump', function() {
    return dump($this);
});

Collection::macro('uppercase', function() {
	return $this->map(function($word) {
        return mb_strtoupper($word);
    });
});

Collection::macro('strtoupper', function() {
	return $this->map(function($word) {
        return mb_strtoupper($word);
    });
});

Collection::macro('lowercase', function() {
	return $this->map(function($word) {
        return mb_strtoupper($word);
    });
});

Collection::macro('strtolower', function() {
	return $this->map(function($word) {
        return mb_strtoupper($word);
    });
});

Collection::macro('second', function() {
	return $this->take(2)
		->last();
	// return $this->get(1);
});

Collection::macro('is', function($key, $fn) {
	// dd($this->get($key));
	if ($this->has($key)) return $fn($this->get($key));
	else return null;
});

Collection::macro('notEmpty', function($fn) {
	// dd($this->get($key));
	if ($this->count()) return $fn($this);
	else return null;
});

Collection::macro('if', function($expression, $fn) {
	if ($expression) return $fn($this);
	return $this;
});

Collection::macro('some', function($fn = null) {
	foreach ($this as $v) {
		if ($fn && $fn($v) || $v) {
			return true;
			break;
		}
	}
	return false;
});

Collection::macro('add', function() { // sum
	$additional = func_get_args(); // additional sum items 
	return $this->if(count($additional), function($collect) use($additional) {
			return $collect->merge($additional);
		})
		->reduce(function($sum, $item) {
			return $sum + $item;
		}, 0);
});

Collection::macro('sub', function() { // subtraction
	$additional = func_get_args(); // additional sub items 
	return $this->forget(0)
		->if(count($additional), function($collect) use($additional) {
			return $collect->merge($additional);
		})
		->reduce(function($sub, $item) {
			return $sub - $item;
		}, $this->items[0]);
});

Collection::macro('filterEmpty', function($key) {
	return $this->pluck($key)
		->filter(function($item) {
			// dd($item, $item->get($key));
			return $item;
		});
});