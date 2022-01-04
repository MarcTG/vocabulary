<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(function ($category) {
                    return ['name' => $category->name, 'wordsCount' => count($category->categoryWords), 'slug' => $category->slug];
                }),
            'filters' => $request->only(['search'])
        ]);
    }

    public function show(Category $category)
    {
        $words = [];
        foreach ($category->categoryWords as $word) {
            $words[] = [
                'singular' => $word->word->singular,
                'plural' => $word->word->plural,
                'translation' => $word->word->translation
            ];
        }

        return Inertia::render('Categories/Show', [
            'category' => [
                'name' => $category->name,
                'translation' => $category->translation
            ],
            'words' => $words
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }
}
