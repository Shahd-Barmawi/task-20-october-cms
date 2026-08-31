<?php

namespace Training\Services\Models;

use Model;

/**
 * Service Model
 */
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
    ];

    public $rules = [
        'title' => 'required|max:255',
        'short_description' => 'nullable|max:500',
        'content' => 'nullable',
        'is_active' => 'boolean',
        'display_order' => 'required|integer|min:0',
    ];
}
