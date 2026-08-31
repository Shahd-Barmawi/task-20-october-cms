<?php

namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Training\Services\Models\Service;

class ServicesList extends ComponentBase
{
    public $services;

    public function componentDetails()
    {
        return [
            'name' => 'Services List',
            'description' => 'Displays active services from the database.'
        ];
    }

    public function defineProperties()
    {
        return [
            'limit' => [
                'title' => 'Maximum Services',
                'description' => 'Maximum number of services to display.',
                'default' => 6,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Please enter a valid number.'
            ]
        ];
    }

    public function onRun()
    {
        $limit = (int) $this->property('limit');

        $query = Service::where('is_active', true)
            ->orderBy('display_order', 'asc');

        if ($limit > 0) {
            $query->limit($limit);
        }

        $this->services = $query->get();

        $this->page['services'] = $this->services;
    }
}
