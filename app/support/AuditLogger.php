<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuditLogger
{
    public static function record(
        Request $request,
        object $user,
        string $action,
        string $description,
        ?string $entityType = null,
        ?int $entityId = null,
        ?string $referenceCode = null,
        array $metadata = []
    ): void {
        try {
            DB::table('audit_logs')->insert([
                'user_id' => $user->id ?? null,

                'actor_name' => mb_substr(
                    (string) ($user->name ?? 'Pengguna Sistem'),
                    0,
                    150
                ),

                'actor_role' => mb_substr(
                    (string) ($user->role ?? 'unknown'),
                    0,
                    40
                ),

                'action' => mb_substr(
                    $action,
                    0,
                    80
                ),

                'entity_type' => $entityType
                    ? mb_substr($entityType, 0, 80)
                    : null,

                'entity_id' => $entityId,

                'reference_code' => $referenceCode
                    ? mb_substr($referenceCode, 0, 80)
                    : null,

                'description' => mb_substr(
                    $description,
                    0,
                    255
                ),

                'metadata' => empty($metadata)
                    ? null
                    : json_encode(
                        $metadata,
                        JSON_UNESCAPED_UNICODE
                        | JSON_UNESCAPED_SLASHES
                    ),

                'ip_address' => $request->ip(),

                'created_at' => now(),
            ]);
        } catch (Throwable $e) {
            report($e);
        }
    }
}