<?php

namespace MyApp\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class City extends Model
{
    protected $table = 'cities';


    public function products() : Relation
    {
        return $this->belongsToMany(Product::class,'city_to_product','city_id','product_id');
    }


    public function categories() : Relation
    {
        return $this->hasManyThrough(Category::class,Product::class);
    }

    public function getID(){
        return $this->id;
    }
}
