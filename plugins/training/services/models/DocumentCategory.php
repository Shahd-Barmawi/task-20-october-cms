<?php

namespace Training\Services\Models;

use Model;

class DocumentCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_document_categories';

    protected $guarded = [];

    public $rules = [
        'name' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_document_categories,slug',
        'status' => 'required|in:active,inactive',
        'display_order' => 'required|integer|min:0',
    ];
}
