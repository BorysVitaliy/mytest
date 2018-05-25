<?php

namespace MyApp\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

class Category extends Model
{
    protected $table ='categories';

   protected $hidden = ['created_at','updated_at','parent_id'];


    /**
     * The products that belong to the category.
     */

    public function products() : Relation
    {
        return $this->belongsToMany(Product::class,'category_to_product','category_id','product_id');
    }

    public function getCities() : Collection {
        return City::join('city_to_product','city_to_product.city_id','cities.id')
                    ->join('category_to_product','category_to_product.product_id','city_to_product.product_id')
                    ->where('category_to_product.id',$this->id)
                    ->where('city_to_product.qty','>=',1)
                    ->distinct('cities.slug','cities.title')
                    ->select('cities.slug','cities.title')
                    ->get();
    }

    public function children() : Relation
    {
        return $this->hasMany(Self::class,'parent_id','id');
    }

    public function getBreadCrumbs() : array
    {
        return [
            [
                'name' => 'Главная',
                'url' => url("/")
            ],[
                'name' => 'Каталог',
                'url' => url("catalog")
            ],[
                'name' => $this->title,
                'url' => url("catalog/".$this->slug)
            ]
        ];
    }
}
