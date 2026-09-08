<?php

namespace Training\Services\Classes;

use Training\Services\Models\Service;
use Training\Services\Models\Document;

class AuditEventRegistrar
{
    public static function register(): void
    {
        self::registerServiceEvents();
        self::registerDocumentEvents();
    }

    private static function registerServiceEvents(): void
    {
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
    }

    private static function registerDocumentEvents(): void
    {
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
}
