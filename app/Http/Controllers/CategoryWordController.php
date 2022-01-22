<?php

namespace App\Http\Controllers;


use App\Models\CategoryWord;
use Illuminate\Http\Request;

class CategoryWordController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
           'category_id' => 'required',
           'word_id' => 'required'
        ]);

        CategoryWord::create($attributes);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        CategoryWord::findOrFail($request->input('id'))->delete();

        return redirect()->back();
    }
}
