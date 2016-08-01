<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Catalog;
use App\City;

class MapIndexComposer
{

    protected
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
            $catalog = $city->catalog->keyBy('name');
        } else {
            $catalog = Catalog::all([
                'name',
                'description',
                'address',
                'site',
                'email',
                'phones'
            ])->keyBy('name');
        }

        $catalog = Catalog::transformForMap($catalog);

        $content = view('partials.sections.map-all', compact('city', 'catalog'));

        $view->with('composerMapIndex', $content);
    }

    protected function getCity($citySlug) {
        $city = City::with(['catalog' => function($q) {
                $q->get([
                    'name',
                    'description',
                    'address',
                    'site',
                    'email',
                    'phones',
                ]);
            }])
            ->whereSlug($citySlug)
            ->first();

        return $city;
    }

}