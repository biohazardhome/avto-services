<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;
// use App\Repositories\UserRepository;

use App\Comment;
use App\City;

class CommentsIndexComposer
{

    const COMMENTS_COUNT = 3;

    protected
        $view,
        $request;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $url = $this->request->path();
        $city = $this->getCity($url);

        if ($city) {
            $comments = $this->getComments($city);
        } else { // main page
            $comments = Comment::with('catalog')
                ->limit(self::COMMENTS_COUNT)
                ->get();
        }

        /*$this->view = $view;

        $comments = Comment::limit(3)
            ->get();*/

        /*$content = $this->compileFromString(
            '<div class="col-md-12 col-lg-12" style="margin-top: 15px; background-color: white; padding: 15px;">
                <h2 class="text-center">Отзывы о автосервисах в Одинцово</h2>
                
                @include(\'comment.index\', [\'comments\' => $comments])
            </div>',
            compact('comments')
        );*/

        $content = view('partials.sections.comment', compact('city', 'comments'));

        $view->with('composerCommentsIndex', $content);
    }

    protected function getCity($citySlug) {
        // $city = City::with(['catalog', 'catalog.comments'])
        $city = City::with('catalog')
            ->whereSlug($citySlug)
            ->first();

        return $city;
    }

    protected function getComments($city) {

        $comments = Comment::whereIn('catalog_id', $city->catalog->pluck('id'))
            ->limit(self::COMMENTS_COUNT)
            ->get();

        /*$comments = $city->catalog->reduce(function($collect, $item) {
                // dump($item->comments);
                return $collect->merge($item->comments);
            }, collect());

        if ($comments->count() === 0) {
            $comments = collect();
        } else {
            $comments = $comments->count() >= self::COMMENTS_COUNT ? $comments->random(self::COMMENTS_COUNT) : $comments;
        }*/
        return $comments;
    }

    public function compileFromString($value, array $data = []) {
        $compiler = $this->view->getEngine()->getCompiler();

        $compile = $compiler->compileString($value);

        $data['__env'] = $this->view->getFactory();
        $data = $this->view->getEngine()->getFromString($compile, $data);

        return $data;
    }
}