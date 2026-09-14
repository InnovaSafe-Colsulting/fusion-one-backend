<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Http\Requests\Admin\UpdateFiscalDataRequest;
use App\Http\Requests\Admin\UploadLogoRequest;
use App\Models\Tenats;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    public function show(): JsonResponse
    {
        $payload  = JWTAuth::parseToken()->getPayload();
        $tenantId = $payload->get('tenantId');
        $userId   = $payload->get('sub');

        $tenant = Tenats::findOrFail($tenantId);
        $user   = User::select('id', 'first_name', 'last_name', 'email', 'cellphone', 'is_active', 'last_login_at')
            ->findOrFail($userId);

        return response()->json([
            'tenant' => $tenant,
            'user'   => $user,
        ]);
    }

    public function update(UpdateCompanyRequest $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $tenant   = Tenats::findOrFail($tenantId);
        $tenant->update($request->validated());

        return response()->json($tenant->fresh());
    }

    public function uploadLogo(UploadLogoRequest $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $tenant   = Tenats::findOrFail($tenantId);

        if ($tenant->logo && Storage::disk('public')->exists($tenant->logo)) {
            Storage::disk('public')->delete($tenant->logo);
        }

        $path = $request->file('logo')->store('logos', 'public');
        $tenant->update(['logo' => $path]);

        return response()->json(['logo' => Storage::disk('public')->url($path)]);
    }

    public function deleteLogo(): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $tenant   = Tenats::findOrFail($tenantId);

        if ($tenant->logo && Storage::disk('public')->exists($tenant->logo)) {
            Storage::disk('public')->delete($tenant->logo);
        }

        $tenant->update(['logo' => null]);

        return response()->json(null, 204);
    }

    public function fiscalData(): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        $data = DB::table('tenant_fiscal_data')
            ->join('tenants', 'tenants.id', '=', 'tenant_fiscal_data.tenant_id')
            ->where('tenant_fiscal_data.tenant_id', $tenantId)
            ->select(
                'tenant_fiscal_data.id',
                'tenant_fiscal_data.tenant_id',
                'tenants.commercial_name',
                'tenant_fiscal_data.tax_id',
                'tenant_fiscal_data.verification_digit',
                'tenant_fiscal_data.tax_regime',
                'tenant_fiscal_data.fiscal_address'
            )
            ->first();

        return response()->json($data);
    }

    public function updateFiscalData(UpdateFiscalDataRequest $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        $fiscal = DB::table('tenant_fiscal_data')->where('tenant_id', $tenantId)->first();

        if ($fiscal) {
            DB::table('tenant_fiscal_data')
                ->where('tenant_id', $tenantId)
                ->update($request->validated());
        } else {
            DB::table('tenant_fiscal_data')->insert(
                array_merge($request->validated(), ['tenant_id' => $tenantId])
            );
        }

        return response()->json(
            DB::table('tenant_fiscal_data')->where('tenant_id', $tenantId)->first()
        );
    }

    public function deleteFiscalData(): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        DB::table('tenant_fiscal_data')
            ->where('tenant_id', $tenantId)
            ->update([
                'tax_id'             => null,
                'verification_digit' => null,
                'tax_regime'         => null,
                'fiscal_address'     => null,
            ]);

        return response()->json(null, 204);
    }
}
