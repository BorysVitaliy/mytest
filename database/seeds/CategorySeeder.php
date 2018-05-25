<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use MyApp\Entity\Category;

class CategorySeeder extends Seeder
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

        Category::truncate();

        $level = 1;

        $categories = [];

        for ($i = 0; $i <= 20; $i++)
        {
            $categories[$level][] = Category::create([
                'title' => $this->faker->unique()->category,
                'parent_id' => isset($categories[($level - 1)])
                    ? $this->faker->randomElement($categories[$level - 1])->id
                    : 0
            ]);
            if (($i % 10 === 0) && (0 !== $i))
            {
                $level++;
            }

        }
    }
}
