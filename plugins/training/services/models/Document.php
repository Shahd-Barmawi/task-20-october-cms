<?php

namespace Training\Services\Models;

use Model;

class Document extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_documents';

    protected $guarded = [];

    protected $dates = [
        'published_at',
    ];

    public $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|max:255|unique:training_services_documents,slug',
        'description' => 'nullable|string',
        'document_category_id' => 'required|exists:training_services_document_categories,id',
        'status' => 'required|in:draft,published',
        'published_at' => 'nullable|date',
    ];

    public $belongsTo = [
        'category' => [
            \Training\Services\Models\DocumentCategory::class,
            'key' => 'document_category_id',
        ],
    ];

    public $attachOne = [
        'file' => [
            \System\Models\File::class,
        ],
    ];

    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->where(function ($query) {
                $query
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function getFileNameAttribute()
    {
        if (!$this->file) {
            return 'No file';
        }

        return $this->file->file_name;
    }

    public function getFileTypeAttribute()
    {
        if (!$this->file || !$this->file->file_name) {
            return '-';
        }

        return strtoupper(
            pathinfo(
                $this->file->file_name,
                PATHINFO_EXTENSION
            )
        );
    }
}
