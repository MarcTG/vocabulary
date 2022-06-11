<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Word;

class WordController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Words/Index', [
            'words' => Word::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('singular', 'like', '%'.$search.'%');
                })
                ->orderBy('singular', 'asc')
                ->paginate(10)
                ->withQueryString()
                ->through(function ($word) {
                    return ['id' => $word->id,'singular' => $word->singular, 'plural' => $word->plural, 'translation' => $word->translation];
                }),
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(Request $request)
    {
        $validations = $request->validate([
            'singular' => 'required',
            'plural' => 'required',
            'translation' => 'required',
            'example' => 'required',
            'word_type_id' => 'required'
        ]);

        Word::create($validations);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Word::findOrFail($request->id)->delete();

        return redirect()->back();
    }
}
