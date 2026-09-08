<?php

namespace Training\Services;

use Backend;
use BackendAuth;
use System\Classes\PluginBase;
use Training\Services\Classes\AuditLogger;
use Training\Services\Models\Service;
use Training\Services\Models\Document;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Services',
            'description' => 'Manage training services and display them dynamically.',
            'author' => 'Training',
            'icon' => 'icon-briefcase',
        ];
    }

    public function registerPermissions()
    {
        return [
            'training.services.manage_services' => [
                'tab' => 'Services',
                'label' => 'Manage Services',
            ],

            'training.services.manage_categories' => [
                'tab' => 'Services',
                'label' => 'Manage Service Categories',
            ],

            'training.services.manage_contact_messages' => [
                'tab' => 'Services',
                'label' => 'Manage Contact Messages',
            ],

            'training.services.manage_pages' => [
                'tab' => 'Services',
                'label' => 'Manage Dynamic Pages',
            ],

            'training.services.manage_blog_categories' => [
                'tab' => 'Blog',
                'label' => 'Manage Blog Categories',
            ],

            'training.services.manage_blog_posts' => [
                'tab' => 'Blog',
                'label' => 'Manage Blog Posts',
            ],

            'training.services.manage_document_categories' => [
                'tab' => 'Documents',
                'label' => 'Manage Document Categories',
            ],

            'training.services.manage_documents' => [
                'tab' => 'Documents',
                'label' => 'Manage Documents',
            ],
        ];
    }

    public function registerNavigation()
    {
        $user = BackendAuth::getUser();

        if (!$user) {
            return [];
        }

        $canManageServices = $user->hasAccess(
            'training.services.manage_services'
        );

        $canManageCategories = $user->hasAccess(
            'training.services.manage_categories'
        );

        $canManageContactMessages = $user->hasAccess(
            'training.services.manage_contact_messages'
        );

        $canManagePages = $user->hasAccess(
            'training.services.manage_pages'
        );

        $canManageBlogCategories = $user->hasAccess(
            'training.services.manage_blog_categories'
        );

        $canManageBlogPosts = $user->hasAccess(
            'training.services.manage_blog_posts'
        );

        $canManageDocumentCategories = $user->hasAccess(
            'training.services.manage_document_categories'
        );

        $canManageDocuments = $user->hasAccess(
            'training.services.manage_documents'
        );

        $navigation = [];

        if (
            $canManageServices ||
            $canManageCategories ||
            $canManageContactMessages ||
            $canManagePages
        ) {
            if ($canManageServices) {
                $servicesMainUrl = Backend::url(
                    'training/services/services'
                );
            } elseif ($canManageCategories) {
                $servicesMainUrl = Backend::url(
                    'training/services/categories'
                );
            } elseif ($canManageContactMessages) {
                $servicesMainUrl = Backend::url(
                    'training/services/contactmessages'
                );
            } else {
                $servicesMainUrl = Backend::url(
                    'training/services/pages'
                );
            }

            $navigation['services'] = [
                'label' => 'Services',
                'url' => $servicesMainUrl,
                'icon' => 'icon-briefcase',
                'order' => 500,

                'sideMenu' => [
                    'services' => [
                        'label' => 'Services',
                        'url' => Backend::url(
                            'training/services/services'
                        ),
                        'icon' => 'icon-list',
                        'permissions' => [
                            'training.services.manage_services',
                        ],
                        'order' => 100,
                    ],

                    'categories' => [
                        'label' => 'Categories',
                        'url' => Backend::url(
                            'training/services/categories'
                        ),
                        'icon' => 'icon-folder',
                        'permissions' => [
                            'training.services.manage_categories',
                        ],
                        'order' => 200,
                    ],

                    'contactmessages' => [
                        'label' => 'Contact Messages',
                        'url' => Backend::url(
                            'training/services/contactmessages'
                        ),
                        'icon' => 'icon-envelope',
                        'permissions' => [
                            'training.services.manage_contact_messages',
                        ],
                        'order' => 300,
                    ],

                    'pages' => [
                        'label' => 'Dynamic Pages',
                        'url' => Backend::url(
                            'training/services/pages'
                        ),
                        'icon' => 'icon-file-text-o',
                        'permissions' => [
                            'training.services.manage_pages',
                        ],
                        'order' => 400,
                    ],
                ],
            ];
        }

        if (
            $canManageBlogCategories ||
            $canManageBlogPosts
        ) {
            if ($canManageBlogPosts) {
                $blogMainUrl = Backend::url(
                    'training/services/blogposts'
                );
            } else {
                $blogMainUrl = Backend::url(
                    'training/services/blogcategories'
                );
            }

            $navigation['blog'] = [
                'label' => 'Blog',
                'url' => $blogMainUrl,
                'icon' => 'icon-newspaper-o',
                'order' => 600,

                'sideMenu' => [
                    'blogposts' => [
                        'label' => 'Blog Posts',
                        'url' => Backend::url(
                            'training/services/blogposts'
                        ),
                        'icon' => 'icon-file-text',
                        'permissions' => [
                            'training.services.manage_blog_posts',
                        ],
                        'order' => 100,
                    ],

                    'blogcategories' => [
                        'label' => 'Blog Categories',
                        'url' => Backend::url(
                            'training/services/blogcategories'
                        ),
                        'icon' => 'icon-folder-open',
                        'permissions' => [
                            'training.services.manage_blog_categories',
                        ],
                        'order' => 200,
                    ],
                ],
            ];
        }

        if (
            $canManageDocumentCategories ||
            $canManageDocuments
        ) {
            if ($canManageDocuments) {
                $documentsMainUrl = Backend::url(
                    'training/services/documents'
                );
            } else {
                $documentsMainUrl = Backend::url(
                    'training/services/documentcategories'
                );
            }

            $navigation['documents'] = [
                'label' => 'Documents',
                'url' => $documentsMainUrl,
                'icon' => 'icon-files-o',
                'order' => 700,

                'sideMenu' => [
                    'documents' => [
                        'label' => 'Documents',
                        'url' => Backend::url(
                            'training/services/documents'
                        ),
                        'icon' => 'icon-file',
                        'permissions' => [
                            'training.services.manage_documents',
                        ],
                        'order' => 100,
                    ],

                    'documentcategories' => [
                        'label' => 'Document Categories',
                        'url' => Backend::url(
                            'training/services/documentcategories'
                        ),
                        'icon' => 'icon-folder-open',
                        'permissions' => [
                            'training.services.manage_document_categories',
                        ],
                        'order' => 200,
                    ],
                ],
            ];
        }

        return $navigation;
    }

    public function boot()
    {
        \Backend\Classes\Controller::extend(function ($controller) {
            $controller->addCss(
                '/plugins/training/services/assets/css/backend.css'
            );
        });

        Service::created(function ($service) {
            AuditLogger::log(
                'Create',
                'Service',
                $service->id,
                'Created service: ' . $service->title,
                [
                    'title' => $service->title,
                    'is_active' => $service->is_active,
                    'category_id' => $service->category_id,
                ]
            );
        });

        Service::updated(function ($service) {
            AuditLogger::log(
                'Update',
                'Service',
                $service->id,
                'Updated service: ' . $service->title,
                [
                    'title' => $service->title,
                    'is_active' => $service->is_active,
                    'category_id' => $service->category_id,
                ]
            );

            if ($service->wasChanged('is_active')) {
                AuditLogger::log(
                    'Status Change',
                    'Service',
                    $service->id,
                    'Changed service status: ' . $service->title,
                    [
                        'old_status' => (bool) $service->getOriginal('is_active'),
                        'new_status' => (bool) $service->is_active,
                    ]
                );
            }
        });

        Service::deleting(function ($service) {
            AuditLogger::log(
                'Delete',
                'Service',
                $service->id,
                'Deleted service: ' . $service->title,
                [
                    'title' => $service->title,
                    'is_active' => $service->is_active,
                    'category_id' => $service->category_id,
                ]
            );
        });

        Document::created(function ($document) {
            AuditLogger::log(
                'Create',
                'Document',
                $document->id,
                'Created document: ' . $document->title,
                [
                    'title' => $document->title,
                    'status' => $document->status,
                    'document_category_id' =>
                    $document->document_category_id,
                    'published_at' => $document->published_at
                        ? $document->published_at->toDateTimeString()
                        : null,
                ]
            );
        });

        Document::updated(function ($document) {
            AuditLogger::log(
                'Update',
                'Document',
                $document->id,
                'Updated document: ' . $document->title,
                [
                    'title' => $document->title,
                    'status' => $document->status,
                    'document_category_id' =>
                    $document->document_category_id,
                    'published_at' => $document->published_at
                        ? $document->published_at->toDateTimeString()
                        : null,
                ]
            );

            if ($document->wasChanged('status')) {
                AuditLogger::log(
                    'Status Change',
                    'Document',
                    $document->id,
                    'Changed document status: ' . $document->title,
                    [
                        'old_status' => $document->getOriginal('status'),
                        'new_status' => $document->status,
                    ]
                );
            }
        });

        Document::deleting(function ($document) {
            AuditLogger::log(
                'Delete',
                'Document',
                $document->id,
                'Deleted document: ' . $document->title,
                [
                    'title' => $document->title,
                    'status' => $document->status,
                    'document_category_id' =>
                    $document->document_category_id,
                ]
            );
        });
    }

    public function registerSettings()
    {
        return [
            'contact_settings' => [
                'label' => 'Contact Settings',
                'description' => 'Manage website contact information.',
                'category' => 'Services',
                'icon' => 'icon-envelope',
                'class' => \Training\Services\Models\ContactSettings::class,
                'order' => 500,
                'keywords' => 'contact email phone address help',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            \Training\Services\Components\ServicesList::class
            => 'servicesList',

            \Training\Services\Components\ServiceDetails::class
            => 'serviceDetails',

            \Training\Services\Components\ContactForm::class
            => 'contactForm',

            \Training\Services\Components\BlogList::class
            => 'blogList',

            \Training\Services\Components\BlogDetails::class
            => 'blogDetails',

            \Training\Services\Components\DocumentList::class
            => 'documentList',
        ];
    }
}
