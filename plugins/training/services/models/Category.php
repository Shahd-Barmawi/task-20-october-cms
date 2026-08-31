<?php namespace Training\Services\Models;

use Model;

class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_categories';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'display_order',
    ];

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_categories,slug',
        'is_active' => 'boolean',
        'display_order' => 'required|integer|min:0',
    ];

    public $hasMany = [
        'services' => [
            \Training\Services\Models\Service::class,
            'key' => 'category_id'
        ]
    ];
}