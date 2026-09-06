<?php

namespace Training\Services\Models;

use Model;

class BlogPost extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'blog_category_id',
        'status',
        'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_blog_posts,slug',
        'excerpt' => 'nullable|max:1000',
        'body' => 'required',
        'blog_category_id' => 'required|exists:training_services_blog_categories,id',
        'status' => 'required|in:draft,published',
        'published_at' => 'nullable|date',
    ];

    public $customMessages = [
        'title.required' => 'Please enter the post title.',
        'slug.required' => 'Please enter the post slug.',
        'slug.unique' => 'The post slug has already been taken.',
        'body.required' => 'Please enter the post content.',
        'blog_category_id.required' => 'Please select a category.',
        'blog_category_id.exists' => 'The selected category is invalid.',
        'status.required' => 'Please select a publication status.',
        'status.in' => 'The selected publication status is invalid.',
        'published_at.date' => 'Please enter a valid publication date.',
    ];

    public $belongsTo = [
        'category' => [
            BlogCategory::class,
            'key' => 'blog_category_id',
        ],
    ];

    public $attachOne = [
        'featured_image' => \System\Models\File::class,
    ];

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function getBlogCategoryIdOptions()
    {
        return BlogCategory::where('status', 'active')
            ->orderBy('display_order')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
