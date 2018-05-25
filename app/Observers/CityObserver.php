<?php

namespace MyApp\Observers;

use Illuminate\Support\Str;
use MyApp\Entity\City;

class CityObserver
{

    // Before creating the City, create the correct slug
    public function creating(City $city)
    {
        $city->slug = Str::slug($city->title);
    }
}