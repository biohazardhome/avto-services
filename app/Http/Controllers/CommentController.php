<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

class CommentController extends Controller
{
    
    public function index() {
    	$comments = Comment::all();

    	return view('comment.index', compact('comments'));
    }

    public function create() {
    	return view('comment.create');
    }

    public function store(Request $request) {
        $fields = $request->all();

        // dd($fields);

        $this->validate($request, [
            'catalog_id' => 'required|exists:catalog,id',
            'name' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
        ]);

        \Mail::send('emails.comment', $fields, function($m) use($fields) {
            $m->subject('Форма комментариев');
            $m->from($fields['email'], 'Автосервисы в одинцово');
            // $m->to('info@avto-services-odintsovo.ru');
            $m->to('stalker-nikko@yandex.ru');
        });

        Comment::create($fields);

    	return back();
    }
}
