<?php

namespace Spotify2\Http\Controllers;

use Spotify2\Song;
use Spotify2\Playlist;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!($search = Song::find($request->id)))
        {
            $song = new Song;
            $song->id = $request->id;
            $song->album = $request->album;
            $song->img = $request->img;
            $song->title = $request->titolo;
            $song->artists = $request->artisti;
            $song->length = $request->durata;
            $song->save();

            $playlist = Playlist::find($request->playlist);
            $playlist->preview_pic = $request->img;
            $playlist->save();

            
            $song->playlists()->attach($playlist);
        } else {
            $playlist = Playlist::find($request->playlist);
           
            if(!$playlist->songs->contains($request->id)){
                $playlist->preview_pic = $request->img;
                $playlist->save();
    
                $search->playlists()->attach($playlist);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spotify2\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spotify2\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spotify2\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spotify2\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
