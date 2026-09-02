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
        'display_order' => 'required|integer|min:0',
        'is_active' => 'boolean',
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
}
