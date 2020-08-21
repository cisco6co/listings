<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'        => 'Furniture',
                'description' => 'Furniture listings',
            ],
            [
                'name'        => 'Electronics',
                'description' => 'Electronics listings',
            ],
            [
                'name'        => 'Cars',
                'description' => 'Cars listings',
            ],
            [
                'name'        => 'Property',
                'description' => 'Property listings',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
