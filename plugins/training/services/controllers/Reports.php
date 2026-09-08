<?php

namespace Training\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Training\Services\Models\BlogPost;
use Training\Services\Models\Document;
use Training\Services\Models\ContactMessage;
use Training\Services\Models\Service;
use Training\Services\Models\AuditLog;

class Reports extends Controller
{
    public $requiredPermissions = [
        'training.services.view_reports',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext(
            'Training.Services',
            'reports'
        );
    }

    public function index()
    {
        $this->pageTitle = 'Reports';

        /*
         * Part 6 - Reporting Page
         *
         * Real data is loaded from the existing CMS modules.
         * Filters will be added in Part 7.
         */
        $this->vars['reportRows'] = AuditLog::orderBy(
            'created_at',
            'desc'
        )
            ->paginate(10);

        $this->vars['summary'] = [
            'total_records' => AuditLog::count(),

            'create_actions' => AuditLog::where(
                'action',
                'create'
            )->count(),

            'update_actions' => AuditLog::where(
                'action',
                'update'
            )->count(),

            'delete_actions' => AuditLog::where(
                'action',
                'delete'
            )->count(),
        ];
    }
}
