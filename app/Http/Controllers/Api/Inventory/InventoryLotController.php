<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreInventoryLotRequest;
use App\Http\Requests\Inventory\UpdateInventoryLotRequest;
use App\Services\Inventory\InventoryLotService;
use Illuminate\Http\JsonResponse;

class InventoryLotController extends Controller
{
    public function __construct(private InventoryLotService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function byProduct(int $productId): JsonResponse
    {
        return response()->json($this->service->getByProduct($productId));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreInventoryLotRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdateInventoryLotRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
