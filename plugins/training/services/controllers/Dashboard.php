<?php

namespace Training\Services\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

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
    }
}
