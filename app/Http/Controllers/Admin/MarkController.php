<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Model;
use App\Mark;

class MarkController extends Controller
{
    
	public function index(Request $request) {
		$sort = $this->sortable($request, 'mark');

        $collect = Mark::sortable($sort['sortField'], $sort['sortType'])
            ->searchable($request->get('query'))->get();

        // $collect = Mark::all();

        $collect = Model::paginateCollection($collect, self::PAGINATE_COUNT);
        // dd($catalog);

    	$grid = new \Datagrid($collect, $request->get('f', []));
        $grid->setColumn('id', 'ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.mark.show', $value) . '" title="Show admin">' . $value . '</a>';
                }
            ])
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.mark.edit', $row->id) .'" title="Edit">' . $value . '</a>';
                }
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
                    return '<a href="' . route('admin.mark.edit', $row->id) . '" title="Edit" class="btn btn-xs">Edit<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="' . route('admin.mark.delete', $row->id) . '" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?">Delete<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        return view('admin.index', [
            'content' => $grid->show('grid-table'),
            'table' => str_singular($collect->first()->getTable()),
            'columns' => array_keys($collect->first()->getAttributes()),
        ]);
	}

    public function show($id) {
        $mark = Mark::find($id);
        return view('admin.show', ['model' => $mark]);
        // return view('admin.mark.show', compact($id));
    }

	public function create() {
		return view('admin.mark.create');
	}

	public function store(Request $request) {
		$mark = Mark::create($request->all());

        return redirect()
            ->route('admin.mark.show', $mark->id);    
	}

	public function edit($id) {
        $mark = Mark::find($id);
        return view('admin.mark.edit', compact('mark'));
	}

	public function update(Request $request, $id) {

        Mark::find($id)
            ->update($request->all());

        return redirect()->route('admin.mark.show', $id);

	}

	public function delete($id) {
		Mark::destroy($id);
        return back();
        // return redirect()->route('admin.mark.index');
	}

}
