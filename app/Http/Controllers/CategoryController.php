<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['listings' => function ($query) {
            $query->withFilters();
        }])->get();

        return CategoryResource::collection($categories);
    }
}
