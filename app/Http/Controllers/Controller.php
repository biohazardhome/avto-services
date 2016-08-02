<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    const PAGINATE_COUNT = 15;

    protected $sortableField = 'id';

    protected function sortable(Request $request, $table) {
        $sortField = $request->get('sortField', null);
        $sortType = $request->get('sortType', null);

        $sortField = !isset($sortField) ? session('sortableField-'. $table) : $sortField;
        $sortType = !isset($sortType) ? session('sortableType-'. $table) : $sortType;

        $sortField = !isset($sortField) ? $this->sortableField : $sortField;

        session(['sortableField-'. $table => $sortField, 'sortableType-'. $table => $sortType]);

        return compact('sortField', 'sortType');
    }
}
