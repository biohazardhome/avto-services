<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Catalog;

class CatalogController extends Controller
{
    
    public function index(Request $request) {
        $catalog = Catalog::orderBy('sort', 'desc')
            ->paginate(15);

    	$grid = new \Datagrid($catalog, $request->get('f', []));
        $grid
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true
            ])
            ->setColumn('email', 'Email', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="mailto:' . $value . '">' . $value . '</a>';
                }
            ])
            /*->setColumn('role_id', 'Role', [
                // If you want to have role_id in the URL query string but you need to show role.name as value (dot notation for the user/role relation)
                'refers_to'   => 'role.name',
                'sortable'    => true,
                'has_filters' => true,
                // Pass array of data to the filter. It will generate select field.
                'filters'     => Role::all()->lists('title', 'id'),
                // Define HTML attributes for this column
                'attributes'  => [
                    'class'         => 'custom-class-here',
                    'data-custom'   => 'custom-data-attribute-value',
                ],
            ])*/->setActionColumn([
                'wrapper' => function($value, $row) {
                    return '<a href="' . route('admin.catalog.edit', [$row->id]) . '" title="Edit" class="btn btn-xs">Edit<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="' . route('admin.catalog.delete', [$row->id]) . '" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?">Delete<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        return $grid->show('grid-table');
    }

    public function show() {

    }

    public function create() {
        return view('admin.catalog.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:catalog',
            'phones' => 'required',
            'address' => 'required',
            'email' => 'email',
            'description' => 'required',
            'sort' => 'integer',
        ]);

        Catalog::create($request->all());

        return redirect()
            ->route('admin.catalog.create');
    }

    public function edit($id) {
        $item = Catalog::find($id);
        return view('admin.catalog.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:catalog,id,'. $id .'',
            'phones' => 'required',
            'address' => 'required',
            'email' => 'email',
            // 'site' => 'active_url',
            // 'site' => 'url',
            //'site' => ['regex' => '^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$'],
            'description' => 'required',
            //'content' => '',
            'sort' => 'integer',
        ]);
        Catalog::find($id)
            ->update($request->all());

        return redirect()
            ->route('admin.catalog.edit', [$id])/*->withInput()*/;
    }

    public function delete($id) {
        Catalog::destroy($id);
        return back();
    }
}
