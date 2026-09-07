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
}