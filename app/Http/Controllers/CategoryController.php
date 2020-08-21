<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

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
