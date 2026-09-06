<?php

namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Training\Services\Models\BlogPost;
use Training\Services\Models\BlogCategory;

class BlogList extends ComponentBase
{
    public $posts;
    public $categories;
    public $search;
    public $selectedCategory;

    public function componentDetails()
    {
        return [
            'name' => 'Blog List',
            'description' => 'Displays published blog posts with category and featured image.',
        ];
    }

    public function defineProperties()
    {
        return [
            'postsPerPage' => [
                'title' => 'Posts Per Page',
                'description' => 'Number of blog posts displayed per page.',
                'default' => 3,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Posts per page must be a number.',
            ],
        ];
    }

    public function onRun()
    {
        $this->prepareVars();
    }

    protected function prepareVars()
    {
        $this->search = trim((string) get('q'));
        $this->selectedCategory = trim((string) get('category'));

        $query = BlogPost::with([
            'category',
            'featured_image',
        ])
            ->published()
            ->whereHas('category', function ($categoryQuery) {
                $categoryQuery->where('status', 'active');
            });

        if ($this->search !== '') {
            $search = $this->search;

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        if ($this->selectedCategory !== '') {
            $selectedCategory = $this->selectedCategory;

            $query->whereHas('category', function ($categoryQuery) use ($selectedCategory) {
                $categoryQuery->where('slug', $selectedCategory);
            });
        }

        $this->posts = $query
            ->orderByDesc('published_at')
            ->paginate((int) $this->property('postsPerPage', 3));

        $this->categories = BlogCategory::where('status', 'active')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        $this->page['posts'] = $this->posts;
        $this->page['blogCategories'] = $this->categories;
        $this->page['blogSearch'] = $this->search;
        $this->page['selectedBlogCategory'] = $this->selectedCategory;
    }
}
