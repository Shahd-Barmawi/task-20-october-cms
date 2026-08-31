<?php

namespace Training\Services;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Services',
            'description' => 'Manage training services and display them dynamically.',
            'author' => 'Training',
            'icon' => 'icon-briefcase'
        ];
    }

    public function registerNavigation()
    {
        return [
            'services' => [
                'label' => 'Services',
                'url' => Backend::url('training/services/services'),
                'icon' => 'icon-briefcase',
                'permissions' => [],
                'order' => 500,
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            \Training\Services\Components\ServicesList::class => 'servicesList',
        ];
    }
}
