<?php

namespace Training\Services\Models;

use Model;

class PageSection extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_page_sections';

    protected $fillable = [
        'page_id',
        'section_type',
        'content',
        'display_order',
        'is_active',
    ];

    protected $jsonable = [
        'content',
    ];

    public $rules = [
        'page_id' => 'required|integer',
        'section_type' => 'required|in:hero,text,image_text,cta',
        'content' => 'nullable|array',
        'display_order' => 'required|integer|min:0',
        'is_active' => 'boolean',
    ];

    public $customMessages = [
        'page_id.required' => 'The page is required.',
        'section_type.required' => 'Please select a section type.',
        'section_type.in' => 'The selected section type is invalid.',
        'display_order.required' => 'Please enter a display order.',
        'display_order.integer' => 'Display order must be a whole number.',
        'display_order.min' => 'Display order cannot be negative.',

        'content.title.required' =>
            'Please enter a title or heading.',

        'content.body.required' =>
            'Please enter the section body content.',

        'content.text.required' =>
            'Please enter the call to action text.',

        'content.image_position.in' =>
            'Image position must be left or right.',

        'content.button_label.required_with' =>
            'Please enter a button label when a button URL is provided.',

        'content.button_url.required_with' =>
            'Please enter a button URL when a button label is provided.',

        'content.button_url.regex' =>
            'Button URL must be a valid site path or HTTP/HTTPS URL.',
    ];

    public $belongsTo = [
        'page' => [
            \Training\Services\Models\Page::class,
            'key' => 'page_id',
        ],
    ];

    public const TYPE_HERO = 'hero';
    public const TYPE_TEXT = 'text';
    public const TYPE_IMAGE_TEXT = 'image_text';
    public const TYPE_CTA = 'cta';

    public static function getSectionTypeOptions()
    {
        return [
            self::TYPE_HERO => 'Hero / Banner',
            self::TYPE_TEXT => 'Text Content',
            self::TYPE_IMAGE_TEXT => 'Image + Text',
            self::TYPE_CTA => 'Call to Action',
        ];
    }

    public function beforeValidate()
    {
        $this->rules['content.title'] =
            'required|max:255';

        $this->rules['content.button_label'] =
            'nullable|max:255|required_with:content.button_url';

        $this->rules['content.button_url'] = [
            'nullable',
            'max:2048',
            'required_with:content.button_label',
            'regex:/^(\/[^\s]*|https?:\/\/[^\s]+)$/i',
        ];

        $this->rules['content.image'] =
            'nullable|string|max:2048';

        if ($this->section_type === self::TYPE_HERO) {
            $this->rules['content.subtitle'] =
                'nullable|max:500';
        }

        if ($this->section_type === self::TYPE_TEXT) {
            $this->rules['content.body'] =
                'required|max:5000';
        }

        if ($this->section_type === self::TYPE_IMAGE_TEXT) {
            $this->rules['content.body'] =
                'required|max:5000';

            $this->rules['content.image_position'] =
                'required|in:left,right';
        }

        if ($this->section_type === self::TYPE_CTA) {
            $this->rules['content.text'] =
                'required|max:2000';
        }
    }

    public function scopeActiveOrdered($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('display_order', 'asc');
    }
}