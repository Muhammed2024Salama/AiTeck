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

    /**
     * The categories that belong to the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    /**
     * The tags that belong to the post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

}
