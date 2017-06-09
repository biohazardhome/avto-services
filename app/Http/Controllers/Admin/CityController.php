<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model;
use App\City;

class CityController extends Controller
{
    
	public function index(Request $request) {
		$sort = $this->sortable($request, 'city');

        $cities = City::sortable($sort['sortField'], $sort['sortType'])
            ->searchable($request->get('query'))->get();
		// $cities = City::paginate(15);

		$grid = new \Datagrid($cities, $request->get('f', []));
        $grid->setColumn('id', 'ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="' . route('admin.city.show', $value) . '">' . $value . '</a>';
                }
            ])
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="' . route('admin.city.edit', $row->id) . '">' . $value . '</a>';
                }
            ])
            ->setColumn('slug', 'Slug', [
                'sortable'    => true,
                'has_filters' => true,
            ])
            ->setColumn('title', 'Title', [
                'sortable'    => true,
                'has_filters' => true,
            ])
            ->setColumn('description', 'Description', [
                'sortable'    => true,
                'has_filters' => true,
            ])
            ->setActionColumn([
                'wrapper' => function($value, $row) {
                    return '<a href="' . route('admin.city.edit', $row->id) . '" title="Edit" class="btn btn-xs">Edit<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="' . route('admin.city.delete', $row->id) . '" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?">Delete<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        return view('admin.index', [
			'content' => $grid->show('grid-table'),
			'table' => str_singular($cities->first()->getTable()),
            'columns' => array_keys($cities->first()->getAttributes()),
		]);
	}

	public function show($id) {
		$city = City::find($id);
		return view('admin.show', ['model' => $city]);
	}

	public function create(/*Request $request*/) {
		return view('admin.city.create');
	}

	public function store(Request $request) {
		/*$this->validate($request, [
			'name' => 'required',
		]);*/

		$city = City::create($request->all());

		return redirect()
			->route('admin.city.show', $city->id);	
	}

	public function edit($id) {
		$city = City::find($id);

		return view('admin.city.edit', compact('city'));
	}

	public function update(Request $request, $id) {
		/*$this->validate($request, [
			'name' => 'required',
		]);*/

		City::find($id)
			->update($request->all());

		return redirect()
			->route('admin.city.show', $id);
	}

	public function delete($id) {
		City::destroy($id);
		return back();
	}

}
