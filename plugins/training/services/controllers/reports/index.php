<?php

/** @var \October\Rain\Pagination\LengthAwarePaginator $reportRows */
/** @var array $summary */
?>

<div class="layout">
    <div class="layout-row">
        <div class="padded-container task28-reports">

            <div class="task28-reports-header">
                <div>
                    <h1>Administrative Reports</h1>

                    <p>
                        Review and analyze recent administrative activity
                        across the CMS.
                    </p>
                </div>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="task28-report-summary-grid">

                <div class="task28-report-summary-card">
                    <span class="task28-report-summary-label">
                        Total Records
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['total_records']) ?>
                    </strong>
                </div>

                <div class="task28-report-summary-card">
                    <span class="task28-report-summary-label">
                        Create Actions
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['create_actions']) ?>
                    </strong>
                </div>

                <div class="task28-report-summary-card">
                    <span class="task28-report-summary-label">
                        Update Actions
                    </span>

                    <strong class="task28-report-summary-value">
                        <?= e($summary['update_actions']) ?>
                    </strong>
                </div>

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

                <div class="task28-report-card-header">
                    <div>
                        <h2>Audit Activity Report</h2>

                        <p>
                            Administrative actions ordered from newest
                            to oldest.
                        </p>
                    </div>
                </div>

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

                                        <td>
                                            <?= e(
                                                $row->created_at
                                                    ->format('M d, Y H:i')
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= e(
                                                $row->backend_user_name
                                                    ?? 'System'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= e(
                                                ucfirst(
                                                    $row->action
                                                        ?? 'Unknown'
                                                )
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= e(
                                                $row->module
                                                    ?? 'Unknown'
                                            ) ?>
                                        </td>

                                        <td>
                                            <?= e(
                                                $row->record_id
                                                    ?? '-'
                                            ) ?>
                                        </td>

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
                            No report records available.
                        </span>
                    </div>

                <?php endif ?>

            </div>

        </div>
    </div>
</div>