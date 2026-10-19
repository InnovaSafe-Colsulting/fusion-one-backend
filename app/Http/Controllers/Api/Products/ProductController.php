<?php

namespace App\Http\Controllers\Api\Products;

use App\Jobs\BulkImportProductsJob;
use App\Exports\ProductsTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Services\CacheService;
use App\Services\Products\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function activeProducts(): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        $products = DB::table('products')
            ->where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->select('id', 'name', 'price')
            ->orderBy('name')
            ->get();

        return response()->json($products);
    }

    public function count(): JsonResponse
    {
        return response()->json(['count' => $this->service->getCount()]);
    }

    public function activeTypes(): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');

        $types = DB::table('product_types')
            ->where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->select('id', 'name', 'slug')
            ->orderBy('name')
            ->get();

        return response()->json($types);
    }

    public function template(): BinaryFileResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        return Excel::download(new ProductsTemplateExport($tenantId), 'plantilla_productos.xlsx');
    }

    public function bulkImport(Request $request): JsonResponse
    {
        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'El archivo es obligatorio.'], 422);
        }

        $user     = JWTAuth::parseToken()->authenticate();
        $tenantId = (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
        $filePath = $request->file('file')->store('tmp/bulk_imports');

        BulkImportProductsJob::dispatch($filePath, $tenantId, $user->email, $user->first_name);

        return response()->json(['message' => 'Importación en proceso, recibirás un correo con el resultado.'], 202);
    }

    public function import(Request $request): JsonResponse
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json(['message' => 'El archivo es obligatorio.'], 422);
            }

            $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
            $import   = new ProductsImport($tenantId);

            Excel::import($import, $request->file('file'));

            return response()->json([
                'created' => $import->created,
                'errors'  => $import->errors,
            ]);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al importar productos', 'error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->getAll($request->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->service->create($request->all()), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}