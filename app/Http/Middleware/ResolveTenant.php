<?php

namespace App\Http\Middleware;

use App\Context\TenantContext;
use App\Models\Tenats;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function __construct(private TenantContext $tenantContext) {}

    public function handle(Request $request, Closure $next): Response
    {
        $tenantId = $request->header('X-Tenant-ID');

        if (!$tenantId) {
            return response()->json(['message' => 'Tenant not identified.'], 400);
        }

        $tenant = Tenats::where('id', $tenantId)->where('status', 1)->first();

        if (!$tenant) {
            return response()->json(['message' => 'Tenant not found or inactive.'], 403);
        }

        $this->tenantContext->setTenantId((int) $tenant->id);

        return $next($request);
    }
}
