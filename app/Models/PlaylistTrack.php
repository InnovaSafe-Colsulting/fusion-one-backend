<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaylistTrack extends Model
{
    public $timestamps = false;

    protected $fillable = ['playlist_id', 'title', 'artist', 'external_id', 'position'];
}
