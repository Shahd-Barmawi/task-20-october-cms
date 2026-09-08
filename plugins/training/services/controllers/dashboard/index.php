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
        </div>
    </div>
</div>