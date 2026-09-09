<?php

/** @var \October\Rain\Pagination\LengthAwarePaginator $reportRows */
/** @var array $summary */
/** @var array $filters */
/** @var \Illuminate\Support\Collection $modules */
/** @var \Illuminate\Support\Collection $actions */
/** @var string|null $dateRangeError */
?>

<div class="layout">
    <div class="layout-row">
        <div class="padded-container task28-reports">

            <!-- PAGE HEADER -->
            <div class="task28-reports-header">
                <div>
                    <h1>Administrative Reports</h1>

                    <p>
                        Review and analyze recent administrative activity
                        across the CMS.
                    </p>
                </div>
            </div>

            <!-- FILTERS -->
            <div class="task28-report-filters-card">

                <div class="task28-report-filters-header">
                    <div>
                        <h2>Report Filters</h2>

                        <p>
                            Narrow the report results using date,
                            module and action filters.
                        </p>
                    </div>
                </div>

                <form
                    method="get"
                    action="<?= Backend::url('training/services/reports') ?>"
                    class="task28-report-filters-form">

                    <!-- DATE FROM -->
                    <div class="task28-report-filter-group">
                        <label for="task28-date-from">
                            Date From
                        </label>

                        <input
                            type="date"
                            id="task28-date-from"
                            name="date_from"
                            value="<?= e($filters['date_from']) ?>"
                            class="form-control">
                    </div>

                    <!-- DATE TO -->
                    <div class="task28-report-filter-group">
                        <label for="task28-date-to">
                            Date To
                        </label>

                        <input
                            type="date"
                            id="task28-date-to"
                            name="date_to"
                            value="<?= e($filters['date_to']) ?>"
                            class="form-control">
                    </div>

                    <!-- MODULE -->
                    <div class="task28-report-filter-group">
                        <label for="task28-module">
                            Module
                        </label>

                        <select
                            id="task28-module"
                            name="module"
                            class="form-control">

                            <option value="">
                                All Modules
                            </option>

                            <?php foreach ($modules as $module): ?>

                                <option
                                    value="<?= e($module) ?>"
                                    <?= $filters['module'] === $module
                                        ? 'selected'
                                        : '' ?>>

                                    <?= e($module) ?>

                                </option>

                            <?php endforeach ?>

                        </select>
                    </div>

                    <!-- ACTION -->
                    <div class="task28-report-filter-group">
                        <label for="task28-action">
                            Action
                        </label>

                        <select
                            id="task28-action"
                            name="action"
                            class="form-control">

                            <option value="">
                                All Actions
                            </option>

                            <?php foreach ($actions as $action): ?>

                                <option
                                    value="<?= e($action) ?>"
                                    <?= $filters['action'] === $action
                                        ? 'selected'
                                        : '' ?>>

                                    <?= e(ucfirst($action)) ?>

                                </option>

                            <?php endforeach ?>

                        </select>
                    </div>

                    <!-- FILTER ACTIONS -->
                    <div class="task28-report-filter-actions">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="icon-filter"></i>
                            Apply Filters

                        </button>

                        <a
                            href="<?= Backend::url(
                                        'training/services/reports'
                                    ) ?>"
                            class="btn btn-default">

                            <i class="icon-refresh"></i>
                            Reset

                        </a>

                    </div>

                </form>

                <!-- INVALID DATE RANGE MESSAGE -->
                <?php if (!empty($dateRangeError)): ?>

                    <div
                        class="alert alert-danger"
                        style="margin: 0 22px 22px;">

                        <i class="icon-warning"></i>

                        <?= e($dateRangeError) ?>

                    </div>

                <?php endif ?>

            </div>

            <!-- SUMMARY CARDS -->
            <div class="task28-report-summary-grid">

                <!-- TOTAL -->
                <div class="task28-report-summary-card">

                    <span class="task28-report-summary-label">
                        Total Records
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['total_records']) ?>
                    </strong>

                </div>

                <!-- CREATE -->
                <div class="task28-report-summary-card">

                    <span class="task28-report-summary-label">
                        Create Actions
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['create_actions']) ?>
                    </strong>

                </div>

                <!-- UPDATE -->
                <div class="task28-report-summary-card">

                    <span class="task28-report-summary-label">
                        Update Actions
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['update_actions']) ?>
                    </strong>

                </div>

                <!-- DELETE -->
                <div class="task28-report-summary-card">

                    <span class="task28-report-summary-label">
                        Delete Actions
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['delete_actions']) ?>
                    </strong>

                </div>

            </div>

            <!-- REPORT TABLE -->
            <div class="task28-report-card">

                <!-- REPORT HEADER -->
                <div class="task28-report-card-header">

                    <div>
                        <h2>Audit Activity Report</h2>

                        <p>
                            Administrative actions ordered from newest
                            to oldest.
                        </p>
                    </div>

                    <!-- CSV EXPORT -->
                    <div>
                        <a
                            href="<?= Backend::url(
                                        'training/services/reports/export'
                                    )
                                        . '?'
                                        . http_build_query([
                                            'date_from' => $filters['date_from'],
                                            'date_to' => $filters['date_to'],
                                            'module' => $filters['module'],
                                            'action' => $filters['action'],
                                        ]) ?>"
                            class="btn btn-primary">

                            <i class="icon-download"></i>
                            Export CSV

                        </a>
                    </div>

                </div>

                <!-- REPORT RESULTS -->
                <?php if ($reportRows->count()): ?>

                    <div class="task28-report-table-wrapper">

                        <table class="task28-report-table">

                            <thead>
                                <tr>
                                    <th>Date / Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Module</th>
                                    <th>Record ID</th>
                                    <th>Description</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($reportRows as $row): ?>

                                    <tr>

                                        <!-- DATE -->
                                        <td>
                                            <?= e(
                                                $row->created_at
                                                    ->format(
                                                        'M d, Y H:i'
                                                    )
                                            ) ?>
                                        </td>

                                        <!-- USER -->
                                        <td>
                                            <?= e(
                                                $row->backend_user_name
                                                    ?? 'System'
                                            ) ?>
                                        </td>

                                        <!-- ACTION -->
                                        <td>
                                            <?= e(
                                                ucfirst(
                                                    $row->action
                                                        ?? 'Unknown'
                                                )
                                            ) ?>
                                        </td>

                                        <!-- MODULE -->
                                        <td>
                                            <?= e(
                                                $row->module
                                                    ?? 'Unknown'
                                            ) ?>
                                        </td>

                                        <!-- RECORD ID -->
                                        <td>
                                            <?= e(
                                                $row->record_id
                                                    ?? '-'
                                            ) ?>
                                        </td>

                                        <!-- DESCRIPTION -->
                                        <td>
                                            <?= e(
                                                $row->description
                                                    ?? '-'
                                            ) ?>
                                        </td>

                                    </tr>

                                <?php endforeach ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- PAGINATION -->
                    <div class="task28-report-pagination">
                        <?= $reportRows->render() ?>
                    </div>

                <?php else: ?>

                    <!-- EMPTY STATE -->
                    <div class="task28-report-empty">

                        <i class="icon-inbox"></i>

                        <span>
                            No report records match the active filters.
                        </span>

                    </div>

                <?php endif ?>

            </div>

        </div>
    </div>
</div>