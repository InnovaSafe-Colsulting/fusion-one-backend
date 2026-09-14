<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Promotion;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\PromotionRepositoryInterface;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    protected function model(): string
    {
        return Promotion::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}