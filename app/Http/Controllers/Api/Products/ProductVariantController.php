<?php

namespace App\Http\Controllers\Api\Products;

use App\Exports\ProductVariantsTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductVariantRequest;
use App\Http\Requests\Products\UpdateProductVariantRequest;
use App\Jobs\BulkImportVariantsJob;
use App\Services\Products\ProductVariantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductVariantController extends Controller
{
    public function __construct(private ProductVariantService $service) {}

    public function index(Request $request): JsonResponse
    {
        $productId = (int) $request->query('product_id', 0);
        if ($productId) {
            return response()->json($this->service->getAllByProduct($productId));
        }
        return response()->json($this->service->getAll($request->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreProductVariantRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateProductVariantRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(null, 204);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->updateStatus($id));
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function template(): BinaryFileResponse
    {
        $tenantId = (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
        return Excel::download(new ProductVariantsTemplateExport($tenantId), 'plantilla_variantes.xlsx');
    }

    public function bulkImport(Request $request): JsonResponse
    {
        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'El archivo es obligatorio.'], 422);
        }

        $user     = JWTAuth::parseToken()->authenticate();
        $tenantId = (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
        $filePath = $request->file('file')->store('tmp/bulk_imports');

        BulkImportVariantsJob::dispatch($filePath, $tenantId, $user->email, $user->first_name);

        return response()->json(['message' => 'Importación en proceso, recibirás un correo con el resultado.'], 202);
    }
}
