<?php

namespace Training\Services;

use Backend;
use BackendAuth;
use System\Classes\PluginBase;

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

        if (
            !$canManageServices &&
            !$canManageCategories &&
            !$canManageContactMessages
        ) {
            return [];
        }

        if ($canManageServices) {
            $mainUrl = Backend::url('training/services/services');
        } elseif ($canManageCategories) {
            $mainUrl = Backend::url('training/services/categories');
        } else {
            $mainUrl = Backend::url('training/services/contactmessages');
        }

        return [
            'services' => [
                'label' => 'Services',
                'url' => $mainUrl,
                'icon' => 'icon-briefcase',
                'order' => 500,

                'sideMenu' => [
                    'services' => [
                        'label' => 'Services',
                        'url' => Backend::url('training/services/services'),
                        'icon' => 'icon-list',
                        'permissions' => [
                            'training.services.manage_services',
                        ],
                    ],

                    'categories' => [
                        'label' => 'Categories',
                        'url' => Backend::url('training/services/categories'),
                        'icon' => 'icon-folder',
                        'permissions' => [
                            'training.services.manage_categories',
                        ],
                    ],
                ],
            ],
        ];
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
            \Training\Services\Components\ServicesList::class => 'servicesList',
            \Training\Services\Components\ServiceDetails::class => 'serviceDetails',
        ];
    }
}