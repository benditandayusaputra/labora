<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.club.index', ['clubs' => Club::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.club.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name'  => 'required',
        ], [
            'name.required'  => 'Nama Harus Di Isi',
        ]);

        Club::create($input);

        return redirect()->route('club.index')->with('success', 'Data Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        return view('admin.club.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $input = $request->validate([
            'name'  => 'required',
        ], [
            'name.required'  => 'Nama Harus Di Isi',
        ]);

        Club::where('id', $club->id)->update($input);

        return redirect()->route('club.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        Club::destroy($club->id);

        return redirect()->route('club.index')->with('success', 'Data Berhasil Di Hapus');  
    }
}