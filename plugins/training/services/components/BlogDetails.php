<?php

namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Training\Services\Models\BlogPost;

class BlogDetails extends ComponentBase
{
    public $post;
    public $relatedPosts;

    public function componentDetails()
    {
        return [
            'name' => 'Blog Details',
            'description' => 'Displays a published blog post with related posts.',
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

        $this->relatedPosts = BlogPost::with([
            'category',
            'featured_image',
        ])
            ->published()
            ->where('blog_category_id', $this->post->blog_category_id)
            ->where('id', '!=', $this->post->id)
            ->whereHas('category', function ($query) {
                $query->where('status', 'active');
            })
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $this->page['post'] = $this->post;
        $this->page['relatedPosts'] = $this->relatedPosts;

        $this->page->title = $this->post->title;
        $this->page->meta_description =
            $this->post->excerpt ?: $this->post->title;
    }
}
