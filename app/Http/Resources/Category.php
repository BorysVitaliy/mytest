<?php

namespace MyApp\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Category extends Resource
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
           'name' => $this->title,
           'url' => url('catalog/'.$this->slug)
       ];
    }
}
