<?php

namespace Training\Services\Models;

use Model;
use System\Models\File;

class Service extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_services';

    protected $fillable = [
        'title',
        'short_description',
        'content',
        'is_active',
        'display_order',
        'category_id',
    ];

    public $rules = [
        'title' => 'required|max:255',
        'short_description' => 'nullable|max:500',
        'content' => 'nullable',
        'is_active' => 'boolean',
        'display_order' => 'required|integer|min:0',
        'category_id' => 'nullable|integer',
    ];

    public $belongsTo = [
        'category' => [
            \Training\Services\Models\Category::class,
            'key' => 'category_id',
        ],
    ];

    public $attachOne = [
        'image' => File::class,
    ];
}