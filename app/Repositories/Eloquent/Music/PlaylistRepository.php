<?php

namespace App\Repositories\Eloquent\Music;

use App\Models\Playlist;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Music\PlaylistRepositoryInterface;

class PlaylistRepository extends BaseRepository implements PlaylistRepositoryInterface
{
    protected function model(): string
    {
        return Playlist::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}