<?php

namespace MyApp\Providers;

use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use MyApp\Entity\Category;
use MyApp\Entity\City;
use MyApp\Entity\Product;
use MyApp\Observers\CategoryObserver;
use MyApp\Observers\CityObserver;
use MyApp\Observers\ProductObserver;
use Illuminate\Http\Resources\Json\Resource;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        City::observe(CityObserver::class);
        Resource::wrap('products');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
