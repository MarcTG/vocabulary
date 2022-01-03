<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryWord extends Model
{
    use HasFactory;

    protected $fillable = ['word_category_id', 'word_id'];

    public function WordCategory()
    {
        return $this->hasOne(WordCategory::class);
    }

    public function Word()
    {
        return $this->hasOne(Word::class);
    }
}
