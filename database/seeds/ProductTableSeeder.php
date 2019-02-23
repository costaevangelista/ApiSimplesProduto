<?php

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $i) {
            Product::create([
                'name' => $faker->lastName,
                'sku' => rand(1, 99999),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
            ]);
        }
    }
}
