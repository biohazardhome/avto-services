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

	public function getAttributes(array $attr = array()) {
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

}