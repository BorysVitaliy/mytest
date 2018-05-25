<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use MyApp\Entity\Product;
use MyApp\Entity\City;
use Illuminate\Support\Facades\DB;

class ProductToCity extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_to_product')->truncate();

        $cities = array_pluck(City::all()->toArray(), 'id');

        Product::chunk(200, function ($products) use ($cities) {
            foreach ($products as $product) {

                $city_to_product = [];

                //Товар может относиться к разным категорим
                //randomNumber - количество категорий, к которым относиться товар
                $randomNumber = $this->faker->numberBetween(0, count($cities));

                while ($randomNumber) {

                    $city_id = $this->faker->randomElement($cities);

                    if (in_array($city_id, $city_to_product)) continue;

                    $city_to_product[] = $city_id;

                    $product->cities()->attach($city_id, [
                        'created_at' => Carbon::now()->addDays($this->faker->numberBetween(0, 60)),
                        'qty' => $this->faker->randomDigit,
                        'price' => $this->faker->randomFloat(1, 1, 1000)
                    ]);

                    $randomNumber--;
                }
            }
        });
    }
}
