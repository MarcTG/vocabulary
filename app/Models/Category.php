<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'translation', 'slug'];

    public function categoryWords()
    {
        return $this->hasMany(CategoryWord::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
