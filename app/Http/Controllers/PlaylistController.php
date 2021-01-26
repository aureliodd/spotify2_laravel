<?php

namespace Spotify2\Http\Controllers;

use Illuminate\Http\Request;
use Spotify2\Song;
use Spotify2\User;
use Spotify2\Playlist;


use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function show(){
        $user = Auth::user()->id;
        $user = User::find($user);

        return $user->playlist;
    }

    public function store(Request $request)
    {
        if(!Playlist::find($request->id))
        {
            $playlist = new Playlist;
            $playlist->user_id = Auth::user()->id;
            $playlist->name = $request->playlist;
            $playlist->save();
        }
    }

    public function update(Request $request)
    {
        $playlist = Playlist::find($request->playlist);
        $playlist->name = $request->new_name;
        $playlist->save();
    }

    
    public function destroy(Request $request)
    {
        $playlist = Playlist::find($request->playlist);
        $playlist->delete();
        
        $songs = Song::All();
        foreach($songs as $song)
            if(count($song->playlists) === 0)
                $song->delete();
        
        if(count(Auth::user()->playlist) === 0){
            $playlist = new Playlist;
            $playlist->user_id = Auth::user()->id;
            $playlist->name = "Nuova playlist";
            $playlist->save(); 
        }
    }

    public function removeSong(Request $request)
    {
        $playlist = Playlist::find($request->playlist);
        if(count($playlist->songs) === 1)
        {
            $playlist->songs()->detach($request->song);
            $playlist->preview_pic = "/img/blank_playlist.png";
            $playlist->save();
        }
         else 
        {
            $song = Song::find($request->song);
            if($playlist->preview_pic === $song->img)
            {
                $playlist->songs()->detach($request->song);
                $playlist->preview_pic = $playlist->songs()->first()->img;
                $playlist->save();
            } else 
                $playlist->songs()->detach($request->song);
        }

        $song = Song::find($request->song);
        if(count($song->playlists) === 0)
            $song->delete();
    }
}