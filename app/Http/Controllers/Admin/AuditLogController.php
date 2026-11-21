<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $q = trim((string) $request->query('q', ''));
        $action = trim((string) $request->query('action', ''));
        $role = trim((string) $request->query('role', ''));
        $dateFrom = trim((string) $request->query('date_from', ''));
        $dateTo = trim((string) $request->query('date_to', ''));

        $actionLabels = [
            'case_viewed' => 'Membuka kasus',
            'conflict_declared' => 'Deklarasi konflik',
            'no_conflict_declared' => 'Deklarasi tanpa konflik',
            'case_claimed' => 'Mengambil penanganan',
            'case_status_updated' => 'Mengubah status kasus',
            'case_escalated' => 'Mengescalasi kasus',
            'follow_up_added' => 'Menambah tindak lanjut',
            'case_reassigned' => 'Mengalihkan penanganan',
            'student_profile_updated' => 'Memperbarui profil siswa',
            'batch_import_students' => 'Import data siswa massal',
            'batch_import_teachers' => 'Import data guru massal',
        ];

        $query = DB::table('audit_logs');

        if ($q !== '') {
            $query->where(function ($subQuery) use ($q) {
                $subQuery
                    ->where('actor_name', 'like', '%' . $q . '%')
                    ->orWhere('reference_code', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            });
        }

        if (
            $action !== ''
            && array_key_exists($action, $actionLabels)
        ) {
            $query->where('action', $action);
        }

        $allowedRoles = [
            'counselor',
            'admin',
            'homeroom_teacher',
            'student',
        ];

        if (
            $role !== ''
            && in_array($role, $allowedRoles, true)
        ) {
            $query->where('actor_role', $role);
        }

        if ($dateFrom !== '') {
            try {
                $query->where(
                    'created_at',
                    '>=',
                    Carbon::parse($dateFrom)->startOfDay()
                );
            } catch (\Throwable $e) {
                $dateFrom = '';
            }
        }

        if ($dateTo !== '') {
            try {
                $query->where(
                    'created_at',
                    '<=',
                    Carbon::parse($dateTo)->endOfDay()
                );
            } catch (\Throwable $e) {
                $dateTo = '';
            }
        }

        $logs = $query
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $logs->getCollection()->transform(
            function ($log) use ($actionLabels) {
                $metadata = [];

                if ($log->metadata) {
                    $decoded = json_decode(
                        $log->metadata,
                        true
                    );

                    if (is_array($decoded)) {
                        $metadata = $decoded;
                    }
                }

                $log->action_label =
                    $actionLabels[$log->action]
                    ?? ucwords(
                        str_replace('_', ' ', $log->action)
                    );

                $log->metadata_array = $metadata;

                return $log;
            }
        );

        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        $ringkasan = [
            'total_hari_ini' => DB::table('audit_logs')
                ->whereBetween(
                    'created_at',
                    [$todayStart, $todayEnd]
                )
                ->count(),

            'guru_bk_hari_ini' => DB::table('audit_logs')
                ->where('actor_role', 'counselor')
                ->whereBetween(
                    'created_at',
                    [$todayStart, $todayEnd]
                )
                ->count(),

            'perubahan_status_hari_ini' => DB::table('audit_logs')
                ->whereIn(
                    'action',
                    [
                        'case_status_updated',
                        'case_escalated',
                    ]
                )
                ->whereBetween(
                    'created_at',
                    [$todayStart, $todayEnd]
                )
                ->count(),

            'pengalihan_hari_ini' => DB::table('audit_logs')
                ->where('action', 'case_reassigned')
                ->whereBetween(
                    'created_at',
                    [$todayStart, $todayEnd]
                )
                ->count(),
        ];

        return view(
            'admin.audit-log.index',
            compact(
                'user',
                'logs',
                'ringkasan',
                'actionLabels',
                'q',
                'action',
                'role',
                'dateFrom',
                'dateTo'
            )
        );
    }
}
