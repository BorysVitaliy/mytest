<?php

namespace MyApp\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $table = 'products';


    public function getID() : int
    {
        return $this->id;
    }

    public function cities() : Relation
    {
        return $this->belongsToMany(City::class, 'city_to_product', 'product_id', 'city_id')
            ->as('nomenclature')->withPivot('price', 'qty');
    }

    public function categories() : Relation
    {
        return $this->belongsToMany(Category::class, 'category_to_product', 'product_id', 'category_id');
    }

    public function getTitleAttribute(string $value) : string
    {
        return $value;
    }

    public function getUrl()
    {
        return url('catalog/product/' . $this->slug);
    }

    public function scopeCategory(Builder $query, string $slug): Builder
    {
        return $query->whereHas('categories', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function scopeCity(Builder $quesy,int $city_id) : Builder
    {
        return $quesy->join('city_to_product','city_to_product.product_id','products.id')->where('city_id',$city_id)
            ->select('products.*','price')->distinct('products.*','price');
    }

}
