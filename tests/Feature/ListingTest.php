<?php

namespace Tests\Feature;

use App\Enums\Currency;
use App\Enums\PriceFilter;
use App\Http\Livewire\ListingCreateForm;
use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_listing_creation_page_contains_livewire_component()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/listing/create')->assertSeeLivewire('listing-create-form');
    }

    /** @test */
    public function test_it_can_create_listing()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $category = Category::factory()->create();

        Livewire::test(ListingCreateForm::class)
            ->set('title', 'Test')
            ->set('description', 'Test description')
            ->set('onlineAt', '2020-08-17')
            ->set('offlineAt', '2020-08-30')
            ->set('price', '100')
            ->set('currency', Currency::EUR)
            ->set('contactMobile', '1234567890')
            ->set('contactEmail', 'test@listingtest.com')
            ->set('categoryId', $category->id)
            ->call('submit');

        $this->assertTrue(Listing::whereTitle('Test')->exists());
    }

    /** @test */
    public function test_title_is_required()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(ListingCreateForm::class)
            ->set('title', '')
            ->call('submit')
            ->assertHasErrors(['title' => 'required']);
    }

    /** @test */
    public function test_contactEmail_format_is_ok()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(ListingCreateForm::class)
            ->set('contactEmail', 'notAnEmail')
            ->call('submit')
            ->assertHasErrors(['contactEmail' => 'email']);
    }

    /** @test */
    public function test_it_is_redirected_to_home_page_after_creation()
    {
        $this->actingAs(User::factory()->create());

        $category = Category::factory()->create();

        Livewire::test(ListingCreateForm::class)
            ->set('title', 'Test')
            ->set('description', 'Test description')
            ->set('onlineAt', '2020-08-17')
            ->set('offlineAt', '2020-08-30')
            ->set('price', '100')
            ->set('currency', Currency::EUR)
            ->set('contactMobile', '1234567890')
            ->set('contactEmail', 'test@listingtest.com')
            ->set('categoryId', $category->id)
            ->call('submit')
            ->assertRedirect('/');
    }

    /** @test */
    public function test_it_can_show_a_listing_details()
    {
        $listing = Listing::factory()->withCategory()->withUser()->create();

        $response = $this->get(route('listings.show', $listing));

        $this->assertDatabaseHas('listings', [
            'id' => $listing->id,
        ]);

        $response->assertOk();
    }

    /** @test */
    public function test_it_can_search_by_listing_title()
    {
        $listing = Listing::factory()->withCategory()->withUser()->create([
            'title' => 'Test title',
        ]);

        Listing::factory()->withCategory()->withUser()->create();

        $response = $this->get(route('listings', ['search' => $listing->title]));

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function test_it_can_search_by_category()
    {
        $category = Category::factory()->create([
            'name' => 'Category 1',
         ]);

        Listing::factory()->withUser()->create([
            'category_id' => $category->id,
        ]);

        $anotherCategory = Category::factory()->create([
            'name' => 'Category 2',
        ]);

        Listing::factory()->withUser()->create([
            'category_id' => $anotherCategory->id,
        ]);

        $response = $this->get(route('listings', ['search' => $category->name]));

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function test_it_can_filter_by_category()
    {
        $category = Category::factory()->create([
            'name' => 'Category 1',
        ]);

        Listing::factory()->withUser()->create([
            'category_id' => $category->id,
        ]);

        $anotherCategory = Category::factory()->create([
            'name' => 'Category 2',
        ]);

        Listing::factory()->withUser()->create([
            'category_id' => $anotherCategory->id,
        ]);

        $response = $this->get(route('listings', ['categories' => [$category->id]]));

        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function test_it_can_filter_by_price()
    {
        Listing::factory()->withCategory()->withUser()->create([
            'price' => 100,
        ]);

        Listing::factory()->withCategory()->withUser()->create([
            'price' => 1000,
        ]);

        $response = $this->get(route('listings', ['prices' => [PriceFilter::FROM_100_TO_500]]));

        $response->assertJsonCount(1, 'data');
    }

    protected function tearDown(): void
    {
        $this->artisan('scout:flush', ['model' => 'App\Models\Listing']);

        parent::tearDown();
    }
}
