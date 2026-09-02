<?php

namespace Training\Services\Models;

use Model;

class Page extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * Database table used by this model.
     */
    public $table = 'training_services_pages';

    /**
     * Fields that can be mass assigned.
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'seo_title',
        'seo_description',
    ];

    /**
     * Model validation rules.
     */
    public $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_pages,slug',
        'status' => 'required|in:draft,published',
        'seo_title' => 'nullable|max:255',
        'seo_description' => 'nullable|max:500',
    ];

    /**
     * A dynamic page can contain multiple content sections.
     */
    public $hasMany = [
        'sections' => [
            \Training\Services\Models\PageSection::class,
            'key' => 'page_id',
            'order' => 'display_order asc',
        ],
    ];
}
