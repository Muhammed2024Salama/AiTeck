<?php

namespace App\Models;

use App\Http\Controllers\Api\Category\Models\Category;
use App\Http\Controllers\Api\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'author_id', 'published_at'];

    // Define many-to-many relationship with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Define many-to-many relationship with Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
