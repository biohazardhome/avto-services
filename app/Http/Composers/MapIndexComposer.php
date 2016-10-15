<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Catalog;
use App\City;
use App\Service;

class MapIndexComposer
{

    protected
        $request,
        $typeMap = 'all';

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
        $urlSegments = explode('/', $url);

        $builder = call_user_func_array([$this, 'getCatalog'], $urlSegments);
        if ($builder) {
            $catalog = $builder->get();

            $catalogMap = Catalog::transformForMap($catalog);
            $content = view('partials.sections.map-all', [
                'catalog' => $catalogMap,
                'city' => $catalog->first()->city,
                'service' => $catalog->first()->service,
                'type' => $this->typeMap]);
            $view->with('composerMapIndex', $content);
        }
    }

    protected function getCatalog($slug = null, $slug2 = null) {
        if (Service::whereSlug($slug)->first() && City::whereSlug($slug2)->first()) {
            $this->typeMap = 'serviceCity';
            return Catalog::byServiceAndCity($slug, $slug2);
        } else if (Service::whereSlug($slug)->first()) {
            $this->ttypeMap = 'service';
            return Catalog::byService($slug);
        } else if (City::whereSlug($slug)->first()) {
            $this->typeMap = 'city';
            return Catalog::byCity($slug);
        } else {
            $this->typeMap = 'all';
            return Catalog::with('service', 'city');
        }
    }

}