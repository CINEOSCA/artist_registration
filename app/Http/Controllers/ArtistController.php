<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();
        return view("artist.index", ["artists" => $artists]);
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
        $artist = new Artist($request->all());
        if (auth()->check()){
            $artist->added_by = auth()->user()->id;
        }
        $artist->save();
        return redirect()->route("artist.index")->with("status", "Record was successfully created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $artist->update($request->all());
        if ($request->isSinger == 1){
            $artist->isSinger = 1;
        }
        else{
            $artist->isSinger = 0;
        }
        if ($request->isLyricist == 1){
            $artist->isLyricist = 1;
        }
        else{
            $artist->isLyricist = 0;
        }
        if ($request->isMusician == 1){
            $artist->isMusician = 1;
        }
        else{
            $artist->isMusician = 0;
        }
        $artist->save();


        return redirect()->route("artist.index")->with("status", "Record was successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route("artist.index")->with("status", "Record was successfully deleted!");
    }
}
