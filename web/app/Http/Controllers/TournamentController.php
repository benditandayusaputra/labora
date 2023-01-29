<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tournament.index', ['tournaments' => Tournament::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tournament.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = [];
        $request->validate([
            'name'  => 'required',
            'price' => 'required',
            'quota' => 'required',
            'logo'  => 'image|max:2000'
        ], [
            'name.required'  => 'Nama Harus Di Isi',
            'price.required' => 'Harga Harus Di Isi',
            'quota.required' => 'Kuota Harus Di Isi',
            'logo.image'     => 'Yang Anda Upload Bukan Gambar',
            'logo.max'       => 'Ukuran Gambar Maximum 2Mb',
        ]);

        $store = array_merge($request->except('division', 'logo'), ['division' => json_encode($request->division)]);

        if ( $request->hasFile('logo') ) {
            $logo = $request->file('logo');
            $logoNameGenerated = date('Ymdhis').$logo->getClientOriginalName();
            $logo->move('uploads/tournament/logo', $logoNameGenerated);
            $store['logo'] = $logoNameGenerated;
        }

        Tournament::create($store);

        return redirect()->route('tournament.index')->with('success', 'Data Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        return view('admin.tournament.edit', compact('tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required',
            'quota' => 'required',
            'logo'  => 'image|max:2000'
        ], [
            'name.required'  => 'Nama Harus Di Isi',
            'price.required' => 'Harga Harus Di Isi',
            'quota.required' => 'Kuota Harus Di Isi',
            'logo.image'     => 'Yang Anda Upload Bukan Gambar',
            'logo.max'       => 'Ukuran Gambar Maximum 2Mb',
        ]);

        $update = array_merge($request->only('name', 'price', 'quota', 'description'), ['division' => json_encode($request->division)]);

        if ( $request->hasFile('logo') ) {
            $logo = $request->file('logo');
            $logoNameGenerated = date('Ymdhis').$logo->getClientOriginalName();
            $logo->move('uploads/tournament/logo', $logoNameGenerated);
            $update['logo'] = $logoNameGenerated;
        }

        Tournament::where('id', $tournament->id)->update($update);

        return redirect()->route('tournament.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        // Tournament::destroy($tournament->id);
        $tournament->delete();

        return redirect()->route('tournament.index')->with('success', 'Data Berhasil Di Hapus');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish($id, $publish)
    {
        Tournament::where('id', $id)->update(['published' => intval($publish)]);

        if ( intval($publish == 1) ) {
            $message = 'Data Berhasil Di Publish';
        } else {
            $message = 'Data Berhasil Di Unpublish';
        }

        return redirect()->route('tournament.index')->with('success', $message);  
    }
}