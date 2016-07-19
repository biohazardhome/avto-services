<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

use App\Comment;

class CommentsIndexComposer
{

    protected
        $view;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->view = $view;

        $comments = Comment::limit(3)
            ->get();

        /*$content = $this->compileFromString(
            '<div class="col-md-12 col-lg-12" style="margin-top: 15px; background-color: white; padding: 15px;">
                <h2 class="text-center">Отзывы о автосервисах в Одинцово</h2>
                
                @include(\'comment.index\', [\'comments\' => $comments])
            </div>',
            compact('comments')
        );*/

        $content = view('partials.sections.comment', compact('comments'));

        $view->with('composerCommentsIndex', $content);
    }

    public function compileFromString($value, array $data = []) {
        $compiler = $this->view->getEngine()->getCompiler();

        $compile = $compiler->compileString($value);

        $data['__env'] = $this->view->getFactory();
        $data = $this->view->getEngine()->getFromString($compile, $data);

        return $data;
    }
}