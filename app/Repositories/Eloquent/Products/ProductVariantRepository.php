<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\ProductVariant;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ProductVariantRepositoryInterface;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    protected function model(): string
    {
        return ProductVariant::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }

    public function allVariants(array $filters = []): mixed
    {
        $query = $this->model->newQuery()
            ->select('id', 'product_id', 'name', 'sku', 'barcode', 'price', 'cost', 'is_active')
            ->orderBy('name');

        if (!empty($filters['name'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['name'] . '%')
                  ->orWhere('sku', 'like', '%' . $filters['name'] . '%');
            });
        }

        return $query->get()->toArray();
    }

    public function allByProduct(int $productId): mixed
    {
        return $this->model->newQuery()
            ->where('product_id', $productId)
            ->select('id', 'product_id', 'name', 'sku', 'barcode', 'price', 'cost', 'is_active')
            ->orderBy('name')
            ->paginate(20);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
