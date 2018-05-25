<?php


namespace MyApp\Observers;

use Illuminate\Support\Str;
use MyApp\Entity\Category;

class CategoryObserver
{
    // Before creating the Category, create the correct slug
    public function saving(Category $category)
    {
        $category->slug = Str::slug($category->title, '-');
    }
}