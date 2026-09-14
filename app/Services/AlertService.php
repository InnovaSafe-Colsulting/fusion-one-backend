<?php

namespace App\Services;

use App\Models\Alert;

class AlertService
{
    public function getActiveAlerts(int $tenantId, int $branchId, ?int $limit = null): array
    {
        $alerts = Alert::where('tenant_id', $tenantId)
            ->where('branch_id', $branchId)
            ->whereNull('resolved_at')
            ->orderBy('created_at', 'desc')
            ->when($limit, fn($q) => $q->limit($limit))
            ->get();

        return [
            'total' => $alerts->count(),
            'data'  => $alerts->map(fn($a) => [
                'id'         => $a->id,
                'type'       => $a->type->value,
                'label'      => $a->type->label(),
                'severity'   => $a->severity,
                'message'    => $a->message,
                'created_at' => $a->created_at,
            ])->values()->toArray(),
        ];
    }
}
