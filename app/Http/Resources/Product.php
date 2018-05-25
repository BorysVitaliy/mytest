<?php

namespace MyApp\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Product extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->getID(),
            'slug' => $this->slug,
            'title' => $this->title,
            'url' => $this->getUrl(),
            'stock' => new CityCollection($this->cities)
        ];
    }
}
