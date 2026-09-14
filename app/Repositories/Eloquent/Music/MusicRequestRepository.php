<?php

namespace App\Repositories\Eloquent\Music;

use App\Models\MusicRequest;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Music\MusicRequestRepositoryInterface;

class MusicRequestRepository extends BaseRepository implements MusicRequestRepositoryInterface
{
    protected function model(): string
    {
        return MusicRequest::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}