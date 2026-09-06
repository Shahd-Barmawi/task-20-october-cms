<?php namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Training\Services\Models\BlogPost;

class BlogDetails extends ComponentBase
{
    public $post;

    public function componentDetails()
    {
        return [
            'name' => 'Blog Details',
            'description' => 'Displays a published blog post by slug.',
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Slug',
                'description' => 'Blog post slug from the page URL.',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
        ];
    }

    public function onRun()
    {
        $slug = $this->property('slug');

        $this->post = BlogPost::with([
            'category',
            'featured_image',
        ])
            ->published()
            ->whereHas('category', function ($query) {
                $query->where('status', 'active');
            })
            ->where('slug', $slug)
            ->first();

        if (!$this->post) {
            return Page::make('404');
        }

        $this->page['post'] = $this->post;

        $this->page->title = $this->post->title;
        $this->page->meta_description = $this->post->excerpt ?: $this->post->title;
    }
}