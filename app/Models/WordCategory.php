<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'translate'];

    public function CategoryWords()
    {
        return $this->hasMany(CategoryWord::class);
    }
}
