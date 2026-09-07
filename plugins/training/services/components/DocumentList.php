<?php

namespace Training\Services\Components;

use Cms\Classes\ComponentBase;
use Redirect;
use Training\Services\Models\Document;
use Training\Services\Models\DocumentCategory;

class DocumentList extends ComponentBase
{
    public $documents;
    public $categories;
    public $search;
    public $selectedCategory;
    public $downloadError;

    public function componentDetails()
    {
        return [
            'name' => 'Document List',
            'description' => 'Displays published documents with search, category filtering, pagination, and secure downloads.',
        ];
    }

    public function defineProperties()
    {
        return [
            'documentsPerPage' => [
                'title' => 'Documents Per Page',
                'description' => 'Number of documents displayed per page.',
                'default' => 6,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Documents per page must be a number.',
            ],
        ];
    }

    public function onRun()
    {
        $downloadId = (int) get('download');

        if ($downloadId > 0) {
            return $this->processDownload($downloadId);
        }

        $this->prepareVars();
    }

    protected function processDownload(int $documentId)
    {
        $document = Document::with([
            'category',
            'file',
        ])
            ->published()
            ->whereHas('category', function ($query) {
                $query->where('status', 'active');
            })
            ->where('id', $documentId)
            ->first();

        if (!$document) {
            return Redirect::to('/documents?download_error=unavailable');
        }

        if (!$document->file) {
            return Redirect::to('/documents?download_error=missing');
        }

        $document->increment('download_count');

        return Redirect::to($document->file->path);
    }

    protected function prepareVars()
    {
        $this->search = trim((string) get('q'));
        $this->selectedCategory = trim((string) get('category'));
        $this->downloadError = trim((string) get('download_error'));

        $query = Document::with([
            'category',
            'file',
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
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($this->selectedCategory !== '') {
            $selectedCategory = $this->selectedCategory;

            $query->whereHas(
                'category',
                function ($categoryQuery) use ($selectedCategory) {
                    $categoryQuery->where(
                        'slug',
                        $selectedCategory
                    );
                }
            );
        }

        $this->documents = $query
            ->orderByDesc('published_at')
            ->paginate(
                (int) $this->property('documentsPerPage', 6)
            );

        $this->categories = DocumentCategory::where(
            'status',
            'active'
        )
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        $this->page['documents'] = $this->documents;
        $this->page['documentCategories'] = $this->categories;
        $this->page['documentSearch'] = $this->search;
        $this->page['selectedDocumentCategory'] = $this->selectedCategory;
        $this->page['documentDownloadError'] = $this->downloadError;
    }
}
