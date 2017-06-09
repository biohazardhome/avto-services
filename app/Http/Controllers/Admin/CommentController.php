<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Model;
use App\Comment;

class CommentController extends Controller
{
    
	public function index(Request $request) {
		$sort = $this->sortable($request, 'comment');

        $comments = Comment::sortable($sort['sortField'], $sort['sortType'])
            ->searchable($request->get('query'))->get()/*
            ->paginate(self::PAGINATE_COUNT)*/;

        $comments = Model::paginateCollection($comments, self::PAGINATE_COUNT);

        $grid = new \Datagrid($comments, $request->get('f', []));
        $grid->setColumn('id', 'ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.comment.show', $value) .'">' . $value . '</a>';
                }
            ])->setColumn('catalog_id', 'Catalog ID', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="'. route('admin.catalog.show', $value) .'">' . $value . '</a>';
                }
            ])
            ->setColumn('name', 'Name', [
                'sortable'    => true,
                'has_filters' => true,
            ])
            ->setColumn('email', 'Email', [
                'sortable'    => true,
                'has_filters' => true,
                'wrapper'     => function($value, $row) {
                    return '<a href="mailto:'. $value .'">' . $value . '</a>';
                }
            ])
            ->setColumn('msg', 'Message', [
                'sortable'    => true,
                'has_filters' => true,
            ])
            ->setActionColumn([
                'wrapper' => function($value, $row) {
                    return '<a href="'. route('admin.comment.edit', $row->id) .'" title="Edit" class="btn btn-xs">Edit<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            <a href="'. route('admin.comment.delete', $row->id) .'" title="Delete" data-method="DELETE" class="btn btn-xs text-danger" data-confirm="Are you sure?">Delete<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }
            ]);

        return view('admin.index', [
            'content' => $grid->show('grid-table'),
            'table' => str_singular($comments->first()->getTable()),
            'columns' => array_keys($comments->first()->getAttributes()),
        ]);
	}

    public function show($id) {
        $comment = Comment::find($id);
        return view('admin.show', ['model' => $comment]);
    }

	public function create() {
		return view('admin.comment.create');
	}

	public function store(Request $request) {
		$this->validate($request, [
			'catalog_id' => 'required|exists:catalog,id',
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
		]);

		$comment = Comment::create($request->all());

        return redirect()
            ->route('admin.comment.show', $comment->id);
	}

	public function edit($id) {
		$comment = Comment::find($id);
		return view('admin.comment.edit', compact('comment'));
	}

	public function update(Request $request, $id) {

        // dd($request->all());
		$this->validate($request, [
            'catalog_id' => 'required|exists:catalog,id',
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
        ]);
		
		Comment::find($id)
            ->update($request->all());

        return redirect()
            ->route('admin.comment.show', $id);
	}

    public function delete($id) {
        Comment::destroy($id);
        return back();
    }
}
