<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StorePromotionRequest;
use App\Http\Requests\Products\UpdatePromotionRequest;
use App\Services\Products\PromotionService;
use Illuminate\Http\JsonResponse;

class PromotionController extends Controller
{
    public function __construct(private PromotionService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll(request()->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StorePromotionRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdatePromotionRequest $request, int $id): JsonResponse
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
