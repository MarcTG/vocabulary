<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryWord extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'word_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
