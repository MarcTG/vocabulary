<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Word;
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
                ->orderBy('name', 'asc')
                ->paginate(10)
                ->withQueryString()
                ->through(function ($category) {
                    return ['name' => $category->name, 'wordsCount' => count($category->categoryWords), 'slug' => $category->slug, 'image' => $category->getFirstMediaUrl('image', 'thumb')];
                }),
            'filters' => $request->only(['search'])
        ]);
    }

    public function show(Category $category, Request $request)
    {
        $words = [];
        $wordsId = [];
        foreach ($category->categoryWords as $word) {
            $words[] = [
                'id' => $word->word->id,
                'singular' => $word->word->singular,
                'plural' => $word->word->plural,
                'translation' => $word->word->translation,
                'categoryWordId' => $word->id
            ];
            $wordsId[] = $word->word->id;
        }


        $newWords = Word::query()
            ->when($wordsId, function ($query, $wordsId) {
                $query->whereNotIn('id', $wordsId);
            })
            ->when($request->input('search'), function ($query, $search) {
                $query->where('singular', 'like', '%'.$search.'%');
            })
            ->paginate(10)
            ->withQueryString()
            ->through(function ($word) {
                return ['id' => $word->id, 'singular' => $word->singular, 'plural' => $word->plural, 'translation' => $word->translation];
            });

        return Inertia::render('Categories/Show', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'translation' => $category->translation,
                'slug' => $category->slug,
                'image' => $category->getFirstMediaUrl('image', 'main')
            ],
            'words' => $words,
            'newWords' => $newWords
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'translation' => 'required',
            'slug' => 'required',
            'image' => 'required'
        ]);

        $category = Category::create($attributes);

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect("/categories/$category->slug");
    }
}
