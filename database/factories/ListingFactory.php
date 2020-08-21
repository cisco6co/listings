<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Listing::class, function (Faker $faker) {
    $title = $faker->words(3, true);
    $slug = Str::slug($title, '-');
    return [
        'title'          => $title,
        'slug'           => $slug,
        'description'    => $faker->realText(),
        'online_at'      => $faker->dateTime(),
        'offline_at'     => $faker->dateTime(),
        'price'          => $faker->randomNumber(),
        'currency'       => $faker->currencyCode,
        'contact_mobile' => $faker->phoneNumber,
        'contact_email'  => $faker->email,
    ];
});

$factory->state(Listing::class, 'with_category', function ($faker) {
    return [
        'category_id' => factory(Category::class)->create()->id,
    ];
});

$factory->state(Listing::class, 'with_user', function ($faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
    ];
});
