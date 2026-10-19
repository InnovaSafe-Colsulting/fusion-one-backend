<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Http\Requests\Inventory\UpdateInventoryRequest;
use App\Services\Inventory\InventoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(private InventoryService $service) {}

    public function index(Request $request): JsonResponse
    {
        if ($request->filled('product_id') && $request->filled('warehouse_id')) {
            return response()->json($this->service->getByProductAndWarehouse(
                $request->integer('product_id'),
                $request->integer('warehouse_id')
            ));
        }
        return response()->json($this->service->getAll($request->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreInventoryRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdateInventoryRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    public function updateQuantities(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'quantity'          => 'sometimes|required|numeric|min:0',
            'reserved_quantity' => 'sometimes|required|numeric|min:0',
        ]);
        return response()->json($this->service->updateQuantities($id, $data));
    }

    public function totalAverageCost(): JsonResponse
    {
        return response()->json(['total_average_cost' => $this->service->getTotalAverageCost()]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
