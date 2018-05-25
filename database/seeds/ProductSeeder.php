<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use MyApp\Entity\Product;

class ProductSeeder extends Seeder
{
    private $faker;


    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($this->faker));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::truncate();

        for ($i = 0; $i <= 2000; $i++) {
            Product::create([
                'title' => $this->faker->unique()->productName
            ]);
        }
    }
}
