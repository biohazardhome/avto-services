<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

use App\Http\Requests\CatalogRequest;
use App\Model;
use App\Catalog;
use App\City;
use App\Service;
use App\Mark;
use My\Model\Image;
use My\Command\ImageUploadCommand;

class CatalogController extends Controller
{
    // const PAGINATE_COUNT = 15;

    const FOLDER_IMAGE = 'catalog';
    
    protected $sortableField = 'sort';

    public function index(Request $request) {
        $sort = $this->sortable($request, 'catalog');

        $catalog = Catalog::sortable($sort['sortField'], $sort['sortType'])
            ->searchable($request->get('query'))->get()/*
            ->paginate(self::PAGINATE_COUNT)*/;

        $catalog = Model::paginateCollection($catalog, self::PAGINATE_COUNT);
        // dd($catalog);

    	$grid = new \Datagrid($catalog, $request->get('f', []));
        $grid->setColumn('id', 'ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.catalog.show', $value) .'" title="Show admin">' . $value . '</a>';
                }
            ])
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.catalog.edit', $row->id) .'" title="Edit">' . $value . '</a>';
                }
            ])
            ->setColumn('slug', 'URL', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    // return '<a href="/catalog/' . $value . '">' . $value . '</a>';
                    return '<a href="'. route('catalog.show', $value) .'" title="Show">' . $value . '</a>';
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
                    return '<a href="' . route('admin.catalog.edit', $row->id) . '" title="Edit" class="btn btn-xs">Edit<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="' . route('admin.catalog.delete', $row->id) . '" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?">Delete<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        return view('admin.index', [
            'content' => $grid->show('grid-table'),
            'table' => str_singular($catalog->first()->getTable()),
            'columns' => array_keys($catalog->first()->getAttributes()),
        ]);
    }

    public function show($id) {
        $catalog = Catalog::find($id);
        return view('admin.show', ['model' => $catalog]);
    }

    public function create() {
        $cities = City::all();
        $services = Service::all();
        $marks = Mark::all();

        return view('admin.catalog.create', compact('cities', 'services', 'marks'));
    }

    public function store(CatalogRequest $request) {

        $entity = Catalog::create($request->all());
        if ($entity->isInvalid()) {
            return back()->withErrors($entity->getErrors())
                ->withInput();
        }

        if ($request->has('marks')) {
            $marks = $request->get('marks');
            // dd($marks);
            $entity->marks()->attach($marks);
        }
        

        $files = $request->file('images', []);
        $folder = self::FOLDER_IMAGE .'/'. $entity->slug;
        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                // $image = command(new ImageUploadCommand(), compact('file', 'folder'));
                $image = command(new ImageUploadCommand($file, $folder));

                $oldPath = $image->getPath();
                $image->renameFilename($entity->name);
                $path = $image->getPath();

                $image->move($oldPath, $path);

                if (!$image->isErrors()) {
                    $entity->images()->save(new Image([
                        'filename' => $image->filename,
                        'path' => $path,
                    ]));
                } else {
                    $errors = $image->getErrors();
                }
            } else {
                $errors[] = 'Невалидный файл';
            }
        }

        return redirect()
            ->route('admin.catalog.show', $entity->id);
    }

    public function edit($id) {
        $item = Catalog::with('city', 'marks')
            ->find($id);

        $cities = City::all();
        $services = Service::all();
        $marks = Mark::all();

        return view('admin.catalog.edit', compact('item', 'cities', 'services', 'marks'));
    }

    public function update(CatalogRequest $request, $id) {
        /*$this->validate($request, [
            // 'name' => 'required|unique:catalog,id,'. $id .'',
            'regenerateSlug' => 'boolean',
            'city_id' => 'required|exists:cities,id',
            // 'phones' => 'required',
            // 'address' => 'required',
            // 'email' => 'email',
            // 'description' => 'required',
            // 'sort' => 'integer',
        ]);*/

        $entity = Catalog::find($id);
        if ($entity->isInvalid()) {
            return back()->withErrors($entity->getErrors())
                ->withInput();
        }

        if ($request->regenerateSlug) {
            $entity->getSlugOptions()->regenerateOnUpdate = true;
        }

        $entity->update($request->except(['regenerateSlug']));

        if ($request->has('marks')) {
            $marks = $request->get('marks');
            $entity->marks()->sync($marks);
        }

        return redirect()
            ->route('admin.catalog.show', $id);
    }

    public function delete($id) {
        Catalog::destroy($id);
        return back();
    }
}
