<?php

namespace App\Repositories\Eloquent\Reservations;

use App\Models\Reservation;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Reservations\ReservationRepositoryInterface;

class ReservationRepository extends BaseRepository implements ReservationRepositoryInterface
{
    protected function model(): string
    {
        return Reservation::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}