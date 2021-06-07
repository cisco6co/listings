<?php

namespace App\Models;

use App\Enums\PriceFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Listing extends Model implements HasMedia
{
    use HasMediaTrait, Searchable, HasFactory;

    protected $guarded = [];

    protected $dates = [
        'online_at',
        'offline_at',
    ];

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        if (app()->environment('testing')) {
            return 'testing_listings_index';
        }

        return 'listings_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return [
            'id' => $array['id'],
            'title' => $array['title'],
            'price' => $array['price'],
            'category_id' => $array['category_id'],
            'category' => $this->category->name,
        ];
    }

    /**
     * The category to which the listing belongs.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('categories', [])), function ($query) {
            $query->whereIn('category_id', request()->input('categories'));
        })
            ->when(count(request()->input('prices', [])), function ($query) {
                $query->where(function ($query) {
                    $query->when(in_array(PriceFilter::LESS_THAN_50, request()->input('prices')), function ($query) {
                        $query->orWhere('price', '<', '50');
                    })
                    ->when(in_array(PriceFilter::FROM_50_TO_100, request()->input('prices')), function ($query) {
                        $query->orWhereBetween('price', ['50', '100']);
                    })
                    ->when(in_array(PriceFilter::FROM_100_TO_500, request()->input('prices')), function ($query) {
                        $query->orWhereBetween('price', ['100', '500']);
                    })
                    ->when(in_array(PriceFilter::FROM_500_TO_1000, request()->input('prices')), function ($query) {
                        $query->orWhereBetween('price', ['500', '1000']);
                    })
                    ->when(in_array(PriceFilter::MORE_THAN_1000, request()->input('prices')), function ($query) {
                        $query->orWhere('price', '>', '1000');
                    });
                });
            })
            ->when(!empty(request()->input('search', '')), function ($query) {
                $search = request()->input('search', '');
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })->orderBy('created_at', 'desc');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(230)
            ->height(173)
            ->sharpen(10);

        $this->addMediaConversion('detail')
            ->width(408)
            ->height(306)
            ->sharpen(10);
    }

    /**
     * Attribute returning the image url.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return !empty($this->getFirstMediaUrl('images', 'thumb'))
            ? $this->getFirstMediaUrl('images', 'thumb')
            : 'https://via.placeholder.com/400x300?text=' . $this->category->name;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
