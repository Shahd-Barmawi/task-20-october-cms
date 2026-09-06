<?php

namespace Training\Services\Models;

use Model;

class BlogCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_blog_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'display_order',
    ];

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_blog_categories,slug',
        'status' => 'required|in:active,inactive',
        'display_order' => 'required|integer|min:0',
    ];

    public $customMessages = [
        'name.required' => 'Please enter the category name.',
        'slug.required' => 'Please enter the category slug.',
        'slug.unique' => 'The category slug has already been taken.',
        'status.required' => 'Please select a category status.',
        'status.in' => 'The selected category status is invalid.',
        'display_order.required' => 'Please enter a display order.',
        'display_order.integer' => 'Display order must be a whole number.',
        'display_order.min' => 'Display order cannot be negative.',
    ];
}
