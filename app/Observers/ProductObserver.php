<?php

namespace MyApp\Observers;


use Illuminate\Support\Str;
use MyApp\Entity\Product;

class ProductObserver
{
    // Before creating the Product, create the correct slug
    public function saving(Product $product)
    {
        $product->slug = Str::slug($product->title);
    }
}