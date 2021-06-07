<?php

use App\Enums\Currency;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create ten Furnitures.
        Listing::factory()->count(10000)->make([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 1,
            'user_id'     => 1,
        ]);

        // Create ten Electronics.
        Listing::factory()->count(10000)->make([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 2,
            'user_id'     => 1,
        ]);

        // Create ten Cars.
        Listing::factory()->count(10000)->make([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 3,
            'user_id'     => 1,
        ]);

        // Create ten Properties.
        Listing::factory()->count(10000)->make([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 4,
            'user_id'     => 1,
        ]);
    }
}
