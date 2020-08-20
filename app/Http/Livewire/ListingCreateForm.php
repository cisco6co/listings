<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Listing;
use Livewire\Component;
use App\Enums\Currency;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingCreateForm extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $onlineAt;
    public $offlineAt;
    public $price;
    public $currency;
    public $contactMobile;
    public $contactEmail;
    public $categoryId;
    public $image;

    // Mountings.
    public $categories;
    public $currencies;

    public function mount($categories = [], $currencies = [])
    {
        $this->categories = $categories;
        $this->currencies = $currencies;
        $this->onlineAt   = Carbon::now()->toDateString();
        $this->offlineAt  = Carbon::now()->add(10, 'day')->toDateString();
    }

    public function updated($field)
    {
        $this->validateOnly(
            $field,
            $this->rules()
        );
    }

    public function submit()
    {
        $this->validate($this->rules());

        $listing = Listing::create([
            'title'          => $this->title,
            'slug'           => $this->generateSlug(),
            'description'    => $this->description,
            'online_at'      => Carbon::parse($this->onlineAt),
            'offline_at'     => Carbon::parse($this->offlineAt),
            'price'          => $this->price,
            'currency'       => $this->currency,
            'contact_mobile' => $this->contactMobile,
            'contact_email'  => $this->contactEmail,
            'category_id'    => $this->categoryId,
            'user_id'        => Auth::user()->id,
        ]);

        if ($this->image) {
            $path = $this->image->store('images');

            $listing->addMedia(storage_path('app/' . $path))
                ->toMediaCollection('images');
        }

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

    public function rules()
    {
        return [
            'title'         => 'required',
            'description'   => 'required',
            'onlineAt'      => 'required',
            'offlineAt'     => 'required',
            'price'         => 'required|numeric',
            'currency'      => [
                'required',
                Rule::in(Currency::getValues()),
            ],
            'contactMobile' => 'required',
            'contactEmail'  => 'required|email',
            'categoryId'    => 'required',
            'image'         => 'nullable|sometimes|image|max:2048',
        ];
    }
}
