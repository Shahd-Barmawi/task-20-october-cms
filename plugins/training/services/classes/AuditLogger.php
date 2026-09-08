<?php

namespace Training\Services\Classes;

use BackendAuth;
use Training\Services\Models\AuditLog;

class AuditLogger
{
    public static function log(
        string $action,
        string $module,
        $recordId,
        string $description,
        array $metadata = []
    ): void {
        $user = BackendAuth::getUser();

        AuditLog::create([
            'backend_user_id' => $user?->id,
            'backend_user_name' => $user
                ? trim($user->first_name . ' ' . $user->last_name)
                : null,
            'action' => $action,
            'module' => $module,
            'record_id' => $recordId,
            'description' => $description,
            'metadata' => self::sanitizeMetadata($metadata),
        ]);
    }

    private static function sanitizeMetadata(array $metadata): array
    {
        $sensitiveFields = [
            'password',
            'password_confirmation',
            'token',
            'access_token',
            'refresh_token',
            'api_key',
            'secret',
            'session_id',
            'authorization',
        ];

        foreach ($sensitiveFields as $field) {
            unset($metadata[$field]);
        }

        return $metadata;
    }
}
