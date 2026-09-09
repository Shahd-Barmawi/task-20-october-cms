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

        $filters = $this->getFilters();

        /*
         * Validate the selected date range.
         */
        $dateRangeError = $this->getDateRangeError($filters);

        $this->vars['dateRangeError'] = $dateRangeError;

        /*
         * Build the filtered database query.
         */
        $query = $this->buildFilteredQuery(
            $filters,
            $dateRangeError !== null
        );

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
            ->appends($filters);

        /*
         * Current filter values.
         */
        $this->vars['filters'] = $filters;

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

    /*
     * CSV Export
     */
    public function export()
    {
        $filters = $this->getFilters();

        /*
         * Do not export an invalid date range.
         */
        $dateRangeError = $this->getDateRangeError($filters);

        if ($dateRangeError !== null) {
            return redirect(
                BackendMenu::url('training/services/reports')
            );
        }

        $query = $this->buildFilteredQuery($filters)
            ->orderBy('created_at', 'desc');

        $filename = 'audit-report-' . date('Y-m-d-His') . '.csv';

        return response()->streamDownload(
            function () use ($query) {

                $handle = fopen('php://output', 'w');

                /*
                 * UTF-8 BOM for Excel compatibility.
                 */
                fwrite($handle, "\xEF\xBB\xBF");

                /*
                 * Clear column headings.
                 */
                fputcsv($handle, [
                    'Date / Time',
                    'User',
                    'Action',
                    'Module',
                    'Record ID',
                    'Description',
                ]);

                /*
                 * Stream records instead of loading
                 * the full result set into memory.
                 */
                foreach ($query->cursor() as $row) {

                    fputcsv($handle, [
                        $row->created_at
                            ? $row->created_at->format('Y-m-d H:i:s')
                            : '',

                        $row->backend_user_name
                            ?? 'System',

                        ucfirst(
                            $row->action
                                ?? 'Unknown'
                        ),

                        $row->module
                            ?? 'Unknown',

                        $row->record_id
                            ?? '',

                        $row->description
                            ?? '',
                    ]);
                }

                fclose($handle);
            },
            $filename,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]
        );
    }

    /*
     * Get current report filters.
     */
    private function getFilters(): array
    {
        return [
            'date_from' => trim(
                (string) input('date_from')
            ),

            'date_to' => trim(
                (string) input('date_to')
            ),

            'module' => trim(
                (string) input('module')
            ),

            'action' => trim(
                (string) input('action')
            ),
        ];
    }

    /*
     * Validate Date From / Date To.
     */
    private function getDateRangeError(array $filters): ?string
    {
        if (
            $filters['date_from'] !== ''
            && $filters['date_to'] !== ''
            && $filters['date_from'] > $filters['date_to']
        ) {
            return 'Invalid date range. Date From cannot be later than Date To.';
        }

        return null;
    }

    /*
     * Apply report filters directly
     * to the database query.
     */
    private function buildFilteredQuery(
        array $filters,
        bool $invalidDateRange = false
    ) {
        $query = AuditLog::query();

        /*
         * Invalid date range should return
         * no report records.
         */
        if ($invalidDateRange) {
            return $query->whereRaw('1 = 0');
        }

        if ($filters['date_from'] !== '') {
            $query->whereDate(
                'created_at',
                '>=',
                $filters['date_from']
            );
        }

        if ($filters['date_to'] !== '') {
            $query->whereDate(
                'created_at',
                '<=',
                $filters['date_to']
            );
        }

        if ($filters['module'] !== '') {
            $query->where(
                'module',
                $filters['module']
            );
        }

        if ($filters['action'] !== '') {
            $query->where(
                'action',
                $filters['action']
            );
        }

        return $query;
    }
}
