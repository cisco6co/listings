@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-3/4 md:mx-auto sm:mx-auto">
            <section class="text-gray-700 body-font overflow-hidden bg-white">
                <div class="px-5 py-24 mx-auto">
                    <div class="mx-auto flex flex-wrap">
                        <img class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200
                                    hover:grow hover:shadow-lg"
                             src="@if ($listing->getFirstMediaUrl('images', 'detail') != '')
                                    {{ $listing->getFirstMediaUrl('images', 'detail') }}
                                 @else
                                    {{ 'https://via.placeholder.com/400x300?text=' }}{{$listing->category->name}}
                                @endif" alt="{{ $listing->title }} image">
                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $listing->title }}</h1>
                            <p class="leading-relaxed mt-4">{{ $listing->description }}</p>
                            <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5"></div>
                            <div class="pb-4">
                                <div class="title-font font-medium text-2xl text-gray-900 pb-4">{{ $listing->price }} {{ $listing->currency }}</div>
                                <p class="text-gray-900 my-2">Date Online: {{ \Carbon\Carbon::parse($listing->online_at)->format('j F, Y') }}</p>
                                <p class="text-gray-900 my-2 mb-4">Date Offline: {{ \Carbon\Carbon::parse($listing->offline_at)->format('j F, Y') }}</p>
                                <div class="font-medium text-gray-900 my-2">Contact Mobile: {{ $listing->contact_mobile }}</div>
                                <div class="font-medium text-gray-900 my-2">Contact Email: {{ $listing->contact_email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
@endsection
