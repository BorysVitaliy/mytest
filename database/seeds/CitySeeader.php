<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use MyApp\Entity\City;

class CitySeeader extends Seeder
{
    private $faker;


    public function __construct()
    {
        $this->faker = Factory::create('uk_UA');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        for ($i = 0; $i <= 20; $i++) {
            City::create([
                'title' => $this->faker->unique()->city
            ]);
        }
    }
}
