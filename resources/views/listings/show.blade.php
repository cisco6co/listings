@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">
            <section class="text-gray-700 body-font overflow-hidden bg-white">
                <div class="container px-5 py-24 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <img class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="{{ $listing->getFirstMediaUrl('images', 'detail') }}" alt="">
                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $listing->title }}</h1>
                            <p class="leading-relaxed mt-4">{{ $listing->description }}</p>
                            <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">

                            </div>
                            <div class="flex">
                                <span class="title-font font-medium text-2xl text-gray-900">${{ $listing->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
@endsection
