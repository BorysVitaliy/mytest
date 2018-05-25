<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use MyApp\Entity\Category;
use MyApp\Entity\Product;
use Illuminate\Support\Facades\DB;

class ProductToCategorySeeder extends Seeder
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

        DB::table('category_to_product')->truncate();

        $categories = array_pluck(Category::all()->toArray(), 'id');

        Product::chunk(200, function ($products) use ($categories) {
            foreach ($products as $product) {

                //Массим существующих категорий товара
                $categories_this_product = [];

                //Товар может относиться к разным категорим
                //randomNumber - количество категорий, к которым относиться товар
                $randomNumber = $this->faker->numberBetween(1, 3);


                while ((bool)$randomNumber) {

                    $category_id = $this->faker->randomElement($categories);

                    if (in_array($category_id, $categories_this_product)) continue;

                    $categories_this_product[] = $category_id;

                    $product->categories()
                        ->attach($category_id, [
                            'created_at' => Carbon::now()->addDays($this->faker->numberBetween(0, 60))
                        ]);

                    $randomNumber--;
                }
            }
        });
    }
}
