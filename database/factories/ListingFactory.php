<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(3, true);
        $slug = Str::slug($title, '-');
        return [
            'title'          => $title,
            'slug'           => $slug,
            'description'    => $this->faker->realText(),
            'online_at'      => $this->faker->dateTime(),
            'offline_at'     => $this->faker->dateTime(),
            'price'          => $this->faker->randomNumber(),
            'currency'       => $this->faker->currencyCode,
            'contact_mobile' => $this->faker->phoneNumber,
            'contact_email'  => $this->faker->email,
        ];
    }

    /**
     * Indicate that the listing has a category.
     *
     * @return Factory
     */
    public function withCategory()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::factory()->create()->id,
            ];
        });
    }

    /**
     * Indicate that the listing has a user.
     *
     * @return Factory
     */
    public function withUser(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory()->create()->id,
            ];
        });
    }
}
