<?php
namespace Database\Seeders;

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
        // Create one thousand Furnitures.
        Listing::factory()->count(1000)->create([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 1,
            'user_id'     => 1,
        ]);

        // Create one thousand Electronics.
        Listing::factory()->count(1000)->create([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 2,
            'user_id'     => 1,
        ]);

        // Create one thousand Cars.
        Listing::factory()->count(1000)->create([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 3,
            'user_id'     => 1,
        ]);

        // Create one thousand Properties.
        Listing::factory()->count(1000)->create([
            'currency'    => Currency::getRandomValue(),
            'category_id' => 4,
            'user_id'     => 1,
        ]);
    }
}
