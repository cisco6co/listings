<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Listing;
use App\Models\Category;
use App\Http\Livewire\ListingCreateForm;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function listing_creation_page_contains_livewire_component()
    {
        $this->actingAs(factory(User::class)->create());

        $this->get('/listing/create')->assertSeeLivewire('listing-create-form');
    }

    /** @test */
    function can_create_listing()
    {
        $this->actingAs(factory(User::class)->create());

        $category = factory(Category::class)->create();

        Livewire::test(ListingCreateForm::class)
            ->set('title', 'Test')
            ->set('description', 'Test description')
            ->set('onlineAt', '2020-08-17')
            ->set('offlineAt', '2020-08-30')
            ->set('price', '100')
            ->set('currency', 'usd')
            ->set('contactMobile', '1234567890')
            ->set('contactEmail', 'test@listingtest.com')
            ->set('categoryId', $category->id)
            ->call('submit');

        $this->assertTrue(Listing::whereTitle('Test')->exists());
    }

    /** @test */
    function title_is_required()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(ListingCreateForm::class)
            ->set('title', '')
            ->call('submit')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    function contactEmail_format_is_ok()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(ListingCreateForm::class)
            ->set('contactEmail', 'notAnEmail')
            ->call('submit')
            ->assertHasErrors(['contactEmail' => 'email']);
    }

    /** @test */
    function is_redirected_to_home_page_after_creation()
    {
        $this->actingAs(factory(User::class)->create());

        $category = factory(Category::class)->create();

        Livewire::test(ListingCreateForm::class)
            ->set('title', 'Test')
            ->set('description', 'Test description')
            ->set('onlineAt', '2020-08-17')
            ->set('offlineAt', '2020-08-30')
            ->set('price', '100')
            ->set('currency', 'usd')
            ->set('contactMobile', '1234567890')
            ->set('contactEmail', 'test@listingtest.com')
            ->set('categoryId', $category->id)
            ->call('submit')
            ->assertRedirect('/');
    }

    /** @test */
    function it_can_show_a_listing_details()
    {
        $listing = factory(Listing::class)->create();

        $response = $this->get(route('listings.show', $listing));

        $this->assertDatabaseHas('listings', [
            'id' => $listing->id,
        ]);

        $response->assertOk();
    }

    /** @test */
    function it_can_search_by_category()
    {
        $listings = factory(Listing::class, 2)->create([

        ]);

        $category = $listings->first()->category()->get();

        $response = $this->get(route('listings', ['search' => '']));
        //$response->assertJsonCount(1, 'data');

        $response->assertOk();
    }
}
