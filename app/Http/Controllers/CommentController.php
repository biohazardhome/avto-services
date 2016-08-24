<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model;
use App\Comment;
use App\Catalog;

class CommentController extends Controller
{
    const PAGINATION_COUNT = 10;
    
    public function index() {
    	$comments = Comment::paginate(self::PAGINATION_COUNT);

    	return view('comment.index', compact('comments'));
    }

    public function show($id) {
        $comment = Comment::find($id);
        return view('comment.show', $comment);
    }

    public function catalog($slug) {
        $entity = Catalog::with('comments')
            ->whereSlug($slug)
            ->first();

        $entity->comments = Model::paginateCollection($entity->comments, self::PAGINATION_COUNT);

        return view('comment.catalog-page', compact('entity'));
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
            $m->from('info@avto-services.ru', 'Автосервисы в одинцово');
            // $m->to('info@avto-services-odintsovo.ru');
            $m->to('stalker-nikko@yandex.ru');
        });

        Comment::create($fields);

    	return back();
    }


    public function sitemapGenerate() {
        $sitemap = app('sitemap');

        if (!$sitemap->isCached()) {
            Comment::all()
                ->chunk(self::PAGINATION_COUNT)
                ->each(function($comments, $index) use(&$sitemap) {
                    if ($comments->count()) {                        // dd($comments->first());
                        $comment = $comments->first();
                        $date = $comment->updated_at ? $comment->updated_at->toW3cString() : null;
                        
                        $sitemap->add(route('comment.index', ['page' => $index+1]), $date, null, 'daily');
                    }
            });
            $sitemap->store('xml', 'sitemap_comments');



            Catalog::with('comments')
                ->get()
                ->each(function($entity, $index) use($sitemap) {
                    $date = $entity->updated_at ? $entity->updated_at->toW3cString() : null;

                    $sitemap->add(route('comment.catalog', [$entity->slug]), $date, null, 'daily');                    
                });

            $sitemap->store('xml', 'sitemap_catalog_comments');
        }
    }
}
