<?php

namespace MyApp\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class City extends Resource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'price' => $this->nomenclature->price,
            'qty' => $this->nomenclature->qty
        ];
    }
}
