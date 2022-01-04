<?php

namespace App\Http\Controllers;

use App\Models\WordCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WordCategoryController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Categories/Index', [
            'categories' => WordCategory::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(function ($category) {
                    return ['name' => $category->name, 'wordsCount' => count($category->CategoryWords)];
                }),
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }
}
