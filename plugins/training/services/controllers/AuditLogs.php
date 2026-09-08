<?php

namespace Training\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Audit Logs Backend Controller
 */
class AuditLogs extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * Only users with Audit Log permission can access this controller.
     */
    public $requiredPermissions = [
        'training.services.review_audit_logs',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext(
            'Training.Services',
            'audit',
            'auditlogs'
        );
    }

    /**
     * Audit log records are read-only.
     */
    public function create()
    {
        return $this->makeRedirect(
            'training/services/auditlogs'
        );
    }

    /**
     * Audit log records cannot be edited.
     */
    public function update($recordId = null)
    {
        return $this->makeRedirect(
            'training/services/auditlogs'
        );
    }
}
