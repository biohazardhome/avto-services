<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

use Nicolaslopezj\Searchable\SearchableTrait;

class Model extends BaseModel {

	use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'catalog.name' => 10,
            'catalog.description' => 7,
            'catalog.content' => 9,
            'catalog.address' => 8,
            'catalog.phones' => 2,
            'catalog.email' => 1,
        ]/*,
        'joins' => [
            'posts' => ['users.id','posts.user_id'],
        ],*/
    ];

	public function getAttributesOnly(array $attr = array()) {
		return array_only(parent::getAttributes(), $attr);
	}

	public static function paginateCollection($collection, $perPage = 15, $pageName = 'page', $page = null)
	{
	    $page = $page ?: \Illuminate\Pagination\Paginator::resolveCurrentPage($pageName);
	    $page = (int) max(1, $page); // Handle pageResolver returning null and negative values
	    $path = \Illuminate\Pagination\Paginator::resolveCurrentPath();

	    return new \Illuminate\Pagination\LengthAwarePaginator(
	        $collection->forPage($page, $perPage),
	        count($collection),
	        $perPage,
	        $page,
	        compact('path', 'pageName')
	    );
	}

    public function scopeRemember($q, $minutes, $key = null) {
        $name = $this->connection ? $this->connection->getName() : '';
        $newKey = md5($name . $this->toSql() . serialize($this->getBindings()));
        $key = $key ? $key : $newKey;
        return \Cache::remember($key, $minutes, function() use ($q) {
            return $q->get();
        });
    }

    public function scopeRandom($q, $limit = 0) {
        $count = $q->count() - 1;
        $skip = $count > 0 ? mt_rand(0, $count) : 0;
        return $q->skip($skip)
            ->limit($limit);
    }

}