<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

use App\Catalog;

class MapIndexComposer
{

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

        $catalog = Catalog::transformForMap(Catalog::all([
            'name',
            'description',
            'address',
            'site',
            'email',
            'phones'
        ])->keyBy('name'));

        $content = view('partials.sections.map-all', compact('catalog'));

        $view->with('composerMapIndex', $content);
    }

}