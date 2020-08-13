@extends('layouts.app-livewire')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!--<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">-->
                @livewire('listing-create-form', ['categories' => $categories])
                <!--</div>-->
            </div>
        </div>
@endsection
