<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ListingCreateForm extends Component
{
    public $title;
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

    public $rules = [
        'title' => 'required',
        'description' => 'required',
        'onlineAt' => 'required',
        'offlineAt' => 'required',
        'price' => 'required',
        'currency' => 'required',
        'contactMobile' => 'required',
        'contactEmail' => 'required|email',
        'categoryId' => 'required',
    ];

    public function mount($categories)
    {
        $this->categories = $categories;
    }

    public function updated($field)
    {
        $this->validateOnly(
            $field,
            $this->rules,
        );
    }

    public function submit()
    {
        $this->validate($this->rules);

        Listing::create([
            'title' => $this->title,
            'slug' => $this->generateSlug(),
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

        return $this->redirectToHome();
    }

    public function render()
    {
        return view('livewire.listing-create-form');
    }

    public function generateSlug()
    {
        $slug = Str::slug($this->title, '-');

        if (
            Listing::query()
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = uniqid($slug);
        }

        return $slug;
    }

    public function redirectToHome()
    {
        return $this->redirectRoute('home');
    }
}
