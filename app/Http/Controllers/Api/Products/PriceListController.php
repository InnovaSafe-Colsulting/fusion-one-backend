<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StorePriceListRequest;
use App\Http\Requests\Products\UpdatePriceListRequest;
use App\Services\Products\PriceListService;
use Illuminate\Http\JsonResponse;

class PriceListController extends Controller
{
    public function __construct(private PriceListService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StorePriceListRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdatePriceListRequest $request, int $id): JsonResponse
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
