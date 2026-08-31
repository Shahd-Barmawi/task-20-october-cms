<?php namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Training\Services\Models\Service;

class ServiceDetails extends ComponentBase
{
    public $service;

    public function componentDetails()
    {
        return [
            'name' => 'Service Details',
            'description' => 'Displays the details of a single published service.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $id = $this->param('id');

        $this->service = Service::with(['category', 'image'])
            ->where('id', $id)
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->first();

        $this->page['service'] = $this->service;

        if (!$this->service) {
            $this->setStatusCode(404);
        }
    }
}