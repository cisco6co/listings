<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListingCreateForm extends Component
{
    public $title;
    public $slug;
    public $description;
    public $onlineAt;
    public $offlineAt;
    public $price;
    public $currency;
    public $contactMobile;
    public $contactEmail;
    public $categoryId;

    // Mountings.
    public $categories;

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function submit()
    {
        Listing::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'online_at' => Carbon::parse($this->onlineAt),
            'offline_at' => Carbon::parse($this->offlineAt),
            'price' => $this->price,
            'currency' => $this->currency,
            'contact_mobile' => $this->contactMobile,
            'contact_email' => $this->contactEmail,
            'category_id' => $this->categoryId,
            'user_id' => Auth::user()->id,
        ]);

        return $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.listing-create-form');
    }
}
