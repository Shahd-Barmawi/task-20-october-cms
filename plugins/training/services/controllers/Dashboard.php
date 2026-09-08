<?php

namespace Training\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Training\Services\Models\BlogPost;
use Training\Services\Models\Document;
use Training\Services\Models\ContactMessage;
use Training\Services\Models\Page;
use Training\Services\Models\Service;
use Training\Services\Models\AuditLog;

class Dashboard extends Controller
{
    public $requiredPermissions = [
        'training.services.view_dashboard',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext(
            'Training.Services',
            'dashboard'
        );
    }

    public function index()
    {
        $this->pageTitle = 'Administrative Dashboard';

        /*
         * KPI Summary Cards
         */
        $this->vars['kpis'] = [
            'published_blog_posts' => BlogPost::where(
                'status',
                'published'
            )->count(),

            'draft_blog_posts' => BlogPost::where(
                'status',
                'draft'
            )->count(),

            'total_documents' => Document::count(),

            'published_documents' => Document::where(
                'status',
                'published'
            )->count(),

            'new_contact_messages' => ContactMessage::where(
                'status',
                'new'
            )->count(),

            'published_pages' => Page::where(
                'status',
                'published'
            )->count(),

            'total_services' => Service::count(),

            'active_services' => Service::where(
                'is_active',
                true
            )->count(),
        ];

        /*
         * Part 5 - Recent Activity
         *
         * Keep the result sets small because the Dashboard
         * only needs a recent operational overview.
         */
        $this->vars['latestContactMessages'] = ContactMessage::orderBy(
            'created_at',
            'desc'
        )
            ->limit(5)
            ->get();

        $this->vars['recentAuditLogs'] = AuditLog::orderBy(
            'created_at',
            'desc'
        )
            ->limit(5)
            ->get();
    }
}
