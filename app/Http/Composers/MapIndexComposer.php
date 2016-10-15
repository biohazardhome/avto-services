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
            $catalog = Catalog::with('service')
                ->get(/*[
                    'name',
                    'description',
                    'address',
                    'site',
                    'email',
                    'phones'
                ]*/)->keyBy('name');
        }

        $catalogMap = Catalog::transformForMap($catalog);

        $content = view('partials.sections.map-all', compact('city') + ['catalog' => $catalogMap, 'service' => $catalog->first()->service]);

        // dd($city);
        // $content .= '<a href="/map/'. $city->slug .'/">Все '. $catalog->first()->service->name .' в '. $city->name .'</a>';

        $view->with('composerMapIndex', $content);
    }

    protected function getCity($citySlug) {
        $city = City::with(['catalog'/* => function($q) {
                $q->get([
                    'name',
                    'description',
                    'address',
                    'site',
                    'email',
                    'phones',
                ]);
            }*/, 'catalog.service'])
            ->whereSlug($citySlug)
            ->first();

        return $city;
    }

}