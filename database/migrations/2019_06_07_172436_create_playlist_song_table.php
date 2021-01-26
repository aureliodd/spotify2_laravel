<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistSongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_song', function (Blueprint $table){
            $table->unsignedBigInteger('playlist_id');
            $table->string('song_id');

            $table->index('playlist_id');
            $table->index('song_id');

            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            
            $table->primary(['song_id', 'playlist_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_song', function (Blueprint $table) {
            //
        });
    }
}
