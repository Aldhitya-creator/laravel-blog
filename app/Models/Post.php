<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'thumbnail', 'slug', 'category_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function takeImage()
    {
        return "/storage/" . $this->thumbnail;
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}