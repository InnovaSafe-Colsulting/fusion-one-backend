<?php

namespace App\Http\Controllers\Api\Products;

use App\Enums\PriceListEntityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StorePriceListItemRequest;
use App\Http\Requests\Products\UpdatePriceListItemRequest;
use App\Services\Products\PriceListItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PriceListItemController extends Controller
{
    public function __construct(private PriceListItemService $service) {}

    public function entityTypes(): JsonResponse
    {
        return response()->json(['data' => array_column(PriceListEntityType::cases(), 'value')]);
    }

    public function index(Request $request): JsonResponse
    {
        $priceListId = $request->integer('price_list_id');
        return response()->json($this->service->getAllByPriceList($priceListId));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StorePriceListItemRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdatePriceListItemRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
