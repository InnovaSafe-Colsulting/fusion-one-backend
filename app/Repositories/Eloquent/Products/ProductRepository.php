<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Product;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allWithCategory(array $filters = []): mixed
    {
        $query = $this->model->newQuery()
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('product_types', 'product_types.id', '=', 'products.type_product_id')
            ->where('products.tenant_id', $this->getTenantId())
            ->select(
                'products.id', 'products.name', 'products.sku', 'products.barcode',
                'products.description', 'products.category_id', 'categories.name as category_name',
                'products.type_product_id', 'product_types.name as product_type_name',
                'products.cost', 'products.price', 'products.is_active'
            );

        if (!empty($filters['name'])) {
            $query->where('products.name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['category_id'])) {
            $query->where('products.category_id', $filters['category_id']);
        }

        if (!empty($filters['barcode'])) {
            $query->where('products.barcode', $filters['barcode']);
        }

        if (!empty($filters['type_product_id'])) {
            $query->where('products.type_product_id', $filters['type_product_id']);
        }

        return $query->paginate(20);
    }

    public function count(): int
    {
        return $this->model->newQuery()
            ->where('tenant_id', $this->getTenantId())
            ->count();
    }
}