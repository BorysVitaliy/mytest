<?php

namespace MyApp\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use MyApp\Entity\City;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return parent::toArray($request);
    }

    public function with($request) : array
    {
        return [
            'child_categories' => $this[0]->categories->first()->children()->select('title','slug')->get(),
            'breadcrumbs'=> $this[0]->categories->first()->getBreadCrumbs(),
            'cities' => $this[0]->categories->first()->getCities()
        ];
    }

}
