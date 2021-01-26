<?php

namespace Spotify2;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function songs()
    {
        //N-N(tabella, tabella di join, foreign key)
        return $this->belongsToMany(Song::class, "playlist_song", "playlist_id", "song_id");
    }
}
