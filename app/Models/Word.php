<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['singular', 'plural', 'translation', 'example', 'word_type_id'];

    public function word_type()
    {
        return $this->hasOne(WordType::class);
    }

    public function category_words()
    {
        return $this->hasMany(CategoryWord::class);
    }
}
