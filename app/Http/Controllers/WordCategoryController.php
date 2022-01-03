<?php

namespace App\Http\Controllers;

use App\Models\WordCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WordCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'categories' => WordCategory::All()
        ]);
    }
}
