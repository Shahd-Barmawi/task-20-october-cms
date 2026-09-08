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
        $sanitized = [];

        foreach ($metadata as $key => $value) {
            if (self::isSensitiveKey((string) $key)) {
                continue;
            }

            if (is_array($value)) {
                $value = self::sanitizeMetadata($value);
            }

            $sanitized[$key] = $value;
        }

        return $sanitized;
    }

    private static function isSensitiveKey(string $key): bool
    {
        $normalizedKey = strtolower(
            str_replace(['-', ' '], '_', $key)
        );

        $sensitiveTerms = [
            'password',
            'passwd',
            'token',
            'access_token',
            'refresh_token',
            'api_key',
            'apikey',
            'secret',
            'session',
            'session_id',
            'authorization',
            'auth_header',
            'cookie',
            'private_key',
            'client_secret',
            'env',
            'environment',
            'file_content',
            'file_contents',
        ];

        foreach ($sensitiveTerms as $term) {
            if (str_contains($normalizedKey, $term)) {
                return true;
            }
        }

        return false;
    }
}
