<?php

/** @var array $kpis */
/** @var \Illuminate\Support\Collection $latestContactMessages */
/** @var \Illuminate\Support\Collection $recentAuditLogs */
?>

<div class="layout">
    <div class="layout-row">
        <div class="padded-container task28-dashboard">

            <div class="task28-dashboard-header">
                <div>
                    <h1>Administrative Dashboard</h1>
                    <p>
                        Monitor content, documents, messages and services
                        across the October CMS project.
                    </p>
                </div>

                <div class="task28-overview-badge">
                    <i class="icon-bar-chart"></i>
                    <span>Operational Overview</span>
                </div>
            </div>

            <!-- KPI SUMMARY CARDS -->
            <div class="task28-kpi-grid">

                <div class="task28-kpi-card task28-green">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-newspaper-o"></i>
                        </div>
                        <span class="task28-kpi-tag">Published</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['published_blog_posts']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Published Blog Posts
                    </div>

                    <p class="task28-kpi-description">
                        Blog posts currently available to website visitors.
                    </p>
                </div>

                <div class="task28-kpi-card task28-gold">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-pencil"></i>
                        </div>
                        <span class="task28-kpi-tag">Draft</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['draft_blog_posts']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Draft Blog Posts
                    </div>

                    <p class="task28-kpi-description">
                        Blog posts currently waiting for publication.
                    </p>
                </div>

                <div class="task28-kpi-card task28-blue">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-files-o"></i>
                        </div>
                        <span class="task28-kpi-tag">Total</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['total_documents']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Total Documents
                    </div>

                    <p class="task28-kpi-description">
                        All document records currently stored in the CMS.
                    </p>
                </div>

                <div class="task28-kpi-card task28-green">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-check-circle"></i>
                        </div>
                        <span class="task28-kpi-tag">Published</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['published_documents']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Published Documents
                    </div>

                    <p class="task28-kpi-description">
                        Documents currently published and available.
                    </p>
                </div>

                <div class="task28-kpi-card task28-gold">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-envelope"></i>
                        </div>
                        <span class="task28-kpi-tag">New</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['new_contact_messages']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        New Contact Messages
                    </div>

                    <p class="task28-kpi-description">
                        Messages that have not yet been marked as read.
                    </p>
                </div>

                <div class="task28-kpi-card task28-purple">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-file-text-o"></i>
                        </div>
                        <span class="task28-kpi-tag">Published</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['published_pages']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Published Dynamic Pages
                    </div>

                    <p class="task28-kpi-description">
                        Dynamic pages currently published on the website.
                    </p>
                </div>

                <div class="task28-kpi-card task28-blue">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-briefcase"></i>
                        </div>
                        <span class="task28-kpi-tag">Total</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['total_services']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Total Services
                    </div>

                    <p class="task28-kpi-description">
                        All service records currently stored in the CMS.
                    </p>
                </div>

                <div class="task28-kpi-card task28-green">
                    <div class="task28-kpi-top">
                        <div class="task28-kpi-icon">
                            <i class="icon-check"></i>
                        </div>
                        <span class="task28-kpi-tag">Active</span>
                    </div>

                    <div class="task28-kpi-value">
                        <?= e($kpis['active_services']) ?>
                    </div>

                    <div class="task28-kpi-title">
                        Active Services
                    </div>

                    <p class="task28-kpi-description">
                        Services currently enabled and active in the CMS.
                    </p>
                </div>

            </div>

            <!-- RECENT ACTIVITY -->
            <div class="task28-recent-header">
                <div>
                    <h2>Recent Activity</h2>
                    <p>
                        Quick access to the latest operational activity
                        across the CMS.
                    </p>
                </div>
            </div>

            <div class="task28-recent-grid">

                <!-- Latest Contact Messages -->
                <div class="task28-recent-card">

                    <div class="task28-recent-card-header">
                        <div>
                            <h3>
                                <i class="icon-envelope"></i>
                                Latest Contact Messages
                            </h3>

                            <p>
                                Five most recently received messages.
                            </p>
                        </div>

                        <a
                            href="<?= Backend::url(
                                        'training/services/contactmessages'
                                    ) ?>"
                            class="task28-view-all">
                            View All
                            <i class="icon-angle-right"></i>
                        </a>
                    </div>

                    <div class="task28-activity-list">

                        <?php if ($latestContactMessages->count()): ?>

                            <?php foreach ($latestContactMessages as $message): ?>

                                <div class="task28-activity-item">

                                    <div class="task28-activity-icon task28-message-icon">
                                        <i class="icon-envelope-o"></i>
                                    </div>

                                    <div class="task28-activity-content">

                                        <div class="task28-activity-main">
                                            <?= e(
                                                $message->name
                                                    ?? $message->email
                                                    ?? 'Contact Message'
                                            ) ?>
                                        </div>

                                        <div class="task28-activity-meta">

                                            <?php if (!empty($message->email)): ?>
                                                <span>
                                                    <?= e($message->email) ?>
                                                </span>
                                            <?php endif ?>

                                            <span>
                                                <?= e(
                                                    $message->created_at
                                                        ->format(
                                                            'M d, Y H:i'
                                                        )
                                                ) ?>
                                            </span>

                                        </div>

                                    </div>

                                    <span
                                        class="task28-status
                                        <?= $message->status === 'new'
                                            ? 'task28-status-new'
                                            : 'task28-status-read' ?>">
                                        <?= e(ucfirst($message->status)) ?>
                                    </span>

                                </div>

                            <?php endforeach ?>

                        <?php else: ?>

                            <div class="task28-empty-state">
                                <i class="icon-inbox"></i>
                                <span>No contact messages available.</span>
                            </div>

                        <?php endif ?>

                    </div>
                </div>

                <!-- Recent Audit Log -->
                <div class="task28-recent-card">

                    <div class="task28-recent-card-header">
                        <div>
                            <h3>
                                <i class="icon-history"></i>
                                Recent Audit Log Activities
                            </h3>

                            <p>
                                Five most recent administrative actions.
                            </p>
                        </div>

                        <a
                            href="<?= Backend::url(
                                        'training/services/auditlogs'
                                    ) ?>"
                            class="task28-view-all">
                            View All
                            <i class="icon-angle-right"></i>
                        </a>
                    </div>

                    <div class="task28-activity-list">

                        <?php if ($recentAuditLogs->count()): ?>

                            <?php foreach ($recentAuditLogs as $log): ?>

                                <div class="task28-activity-item">

                                    <div class="task28-activity-icon task28-audit-icon">
                                        <i class="icon-history"></i>
                                    </div>

                                    <div class="task28-activity-content">

                                        <div class="task28-activity-main">
                                            <?= e(
                                                ucfirst(
                                                    $log->action
                                                        ?? 'Administrative Action'
                                                )
                                            ) ?>
                                        </div>

                                        <div class="task28-activity-meta">

                                            <?php if (!empty($log->entity_type)): ?>
                                                <span>
                                                    <?= e($log->entity_type) ?>
                                                </span>
                                            <?php endif ?>

                                            <span>
                                                <?= e(
                                                    $log->created_at
                                                        ->format(
                                                            'M d, Y H:i'
                                                        )
                                                ) ?>
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            <?php endforeach ?>

                        <?php else: ?>

                            <div class="task28-empty-state">
                                <i class="icon-history"></i>
                                <span>No audit activity available.</span>
                            </div>

                        <?php endif ?>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>