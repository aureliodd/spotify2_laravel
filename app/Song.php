<?php

namespace Spotify2;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public $incrementing = false; //altrimenti default true
    protected $keyType = 'string'; //altrimenti default int

    public function playlists()
    { //tabella pivot, forein key della tabella pivot appartenente a song, fk pivot appartenente a playlist
        return $this::belongsToMany(Playlist::class, "playlist_song", "song_id", "playlist_id");
    }
}
