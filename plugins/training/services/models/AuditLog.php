<?php

namespace Training\Services\Models;

use Model;

class AuditLog extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'training_services_audit_logs';

    protected $guarded = [];

    protected $jsonable = [
        'metadata',
    ];

    public $rules = [
        'action' => 'required|max:50',
        'module' => 'required|max:100',
        'description' => 'required|string',
    ];

    public function getMetadataDisplayAttribute(): string
    {
        if (empty($this->metadata)) {
            return '-';
        }

        if (is_array($this->metadata)) {
            return json_encode(
                $this->metadata,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        }

        return (string) $this->metadata;
    }
}
