<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $imageUrl = !empty($this->getFirstMediaUrl('images', 'thumb')) ? $this->getFirstMediaUrl('images', 'thumb') : 'http://placehold.it/400x300';

        return [
            'id'          => $this->id,
            'slug'        => $this->slug,
            'title'       => $this->title,
            'description' => $this->description,
            'currency'    => $this->currency,
            'imageUrl'    => $imageUrl,
            'price'       => number_format($this->price, 2),
        ];
    }
}
