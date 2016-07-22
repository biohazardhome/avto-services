<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Catalog;
use App\City;

class CatalogController extends Controller
{
    
    public function index(Request $request) {
        $catalog = Catalog::orderBy('sort', 'desc')
            ->paginate(15);

    	$grid = new \Datagrid($catalog, $request->get('f', []));
        $grid
            ->setColumn('id', 'ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.catalog.show', [$value]) . '">' . $value . '</a>';
                }
            ])
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="/admin/catalog/edit/' . $row->id . '">' . $value . '</a>';
                }
            ])
            ->setColumn('slug', 'URL', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="/catalog/' . $value . '">' . $value . '</a>';
                }
            ])
            ->setColumn('email', 'Email', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="mailto:' . $value . '">' . $value . '</a>';
                }
            ])
            ->setColumn('sort', 'Sort', [
                'sortable'    => true,
                'has_filters' => true,
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

        return view('admin.index', ['content' => $grid->show('grid-table')]);
    }

    public function show($id) {
        $catalog = Catalog::find($id);
        return view('admin.show', ['model' => $catalog]);
    }

    public function create() {
        $cities = City::all();

        return view('admin.catalog.create', compact('cities'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:catalog',
            'city_id' => 'required|exists:cities,id',
            'phones' => 'required',
            'address' => 'required',
            'email' => 'email',
            'description' => 'required',
            'sort' => 'integer',
        ]);

        $entity = Catalog::create($request->except('city_id'));
        $entity->city()->attach($request->get('city_id'));

        return redirect()
            ->route('admin.comment.show', [$entity->id]);
    }

    public function edit($id) {
        $item = Catalog::with('city')
            ->find($id);

        $cities = City::all();
        return view('admin.catalog.edit', compact('item', 'cities'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|unique:catalog,id,'. $id .'',
            'regenerateSlug' => 'boolean',
            'city_id' => 'required|exists:cities,id',
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

        $entity = Catalog::find($id);

        if ($request->regenerateSlug) {
            $entity->getSlugOptions()->regenerateOnUpdate = true;
        }

        $entity->update($request->except(['regenerateSlug', 'city_id']));
        $entity->city()->detach($entity->city->first()->id);
        $entity->city()->attach($request->get('city_id'));

        return redirect()
            ->route('admin.catalog.show', [$id]);
    }

    public function delete($id) {
        Catalog::destroy($id);
        return back();
    }
}
