<?php

namespace Training\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
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

        $dateFrom = trim((string) input('date_from'));
        $dateTo = trim((string) input('date_to'));
        $module = trim((string) input('module'));
        $action = trim((string) input('action'));

        $query = AuditLog::query();

        if ($dateFrom !== '') {
            $query->whereDate(
                'created_at',
                '>=',
                $dateFrom
            );
        }

        if ($dateTo !== '') {
            $query->whereDate(
                'created_at',
                '<=',
                $dateTo
            );
        }

        if ($module !== '') {
            $query->where(
                'module',
                $module
            );
        }

        if ($action !== '') {
            $query->where(
                'action',
                $action
            );
        }

        /*
         * Summary values must reflect
         * the currently filtered result set.
         */
        $this->vars['summary'] = [
            'total_records' => (clone $query)->count(),

            'create_actions' => (clone $query)
                ->where('action', 'create')
                ->count(),

            'update_actions' => (clone $query)
                ->where('action', 'update')
                ->count(),

            'delete_actions' => (clone $query)
                ->where('action', 'delete')
                ->count(),
        ];

        /*
         * Detailed filtered report.
         */
        $this->vars['reportRows'] = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends([
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'module' => $module,
                'action' => $action,
            ]);

        /*
         * Current filter values.
         */
        $this->vars['filters'] = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'module' => $module,
            'action' => $action,
        ];

        /*
         * Dropdown options from real Audit Log data.
         */
        $this->vars['modules'] = AuditLog::query()
            ->whereNotNull('module')
            ->where('module', '!=', '')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        $this->vars['actions'] = AuditLog::query()
            ->whereNotNull('action')
            ->where('action', '!=', '')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');
    }
}
