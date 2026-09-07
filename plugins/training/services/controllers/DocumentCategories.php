<?php

namespace Training\Services\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class DocumentCategories extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'training.services.manage_document_categories',
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext(
            'Training.Services',
            'documents',
            'documentcategories'
        );
    }
}
