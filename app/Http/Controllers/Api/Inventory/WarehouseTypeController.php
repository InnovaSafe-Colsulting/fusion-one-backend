<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreWarehouseTypeRequest;
use App\Http\Requests\Inventory\UpdateWarehouseTypeRequest;
use App\Services\Inventory\WarehouseTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarehouseTypeController extends Controller
{
    public function __construct(private WarehouseTypeService $service) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->getAll($request->all()));
    }

    public function active(): JsonResponse
    {
        return response()->json($this->service->getActive());
    }

    public function activeById(int $id): JsonResponse
    {
        return response()->json($this->service->getActiveById($id));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreWarehouseTypeRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdateWarehouseTypeRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    public function toggleStatus(int $id): JsonResponse
    {
        return response()->json($this->service->updateStatus($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
