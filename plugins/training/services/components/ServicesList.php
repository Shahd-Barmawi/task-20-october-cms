<?php namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Training\Services\Models\Service;
use Training\Services\Models\Category;

class ServicesList extends ComponentBase
{
    public $services;
    public $categories;
    public $selectedCategory;

    public function componentDetails()
    {
        return [
            'name' => 'Services List',
            'description' => 'Displays active services with category filtering and images.'
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
        $this->loadServices();
    }

    protected function loadServices()
    {
        $limit = (int) $this->property('limit');

        $this->selectedCategory = get('category');

        $this->categories = Category::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        $query = Service::with(['category', 'image'])
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('display_order', 'asc');

        if ($this->selectedCategory) {
            $query->whereHas('category', function ($query) {
                $query->where('slug', $this->selectedCategory)
                    ->where('is_active', true);
            });
        }

        if ($limit > 0) {
            $query->limit($limit);
        }

        $this->services = $query->get();

        $this->page['services'] = $this->services;
        $this->page['categories'] = $this->categories;
        $this->page['selectedCategory'] = $this->selectedCategory;
    }
}