<?php

namespace App\Http\Controllers;

use App\Models\MasterPayment;
use Illuminate\Http\Request;

class MasterPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master_payment.index', ['master_payments' => MasterPayment::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master_payment.create');
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
            'name'      => 'required',
            'logo_bank' => 'image|max:2000'
        ], [
            'name.required'   => 'Nama Harus Di Isi',
            'logo_bank.image' => 'Yang Anda Upload Bukan Gambar',
            'logo_bank.max'   => 'Ukuran Gambar Maximum 2Mb',
        ]);

        $store = $request->all();

        if ( $request->hasFile('logo_bank') ) {
            $logo = $request->file('logo_bank');
            $logoNameGenerated = date('Ymdhis').$logo->getClientOriginalName();
            $logo->move('uploads/master_payment/logo', $logoNameGenerated);
            $store['logo_bank'] = $logoNameGenerated;
        }

        MasterPayment::create($store);

        return redirect()->route('master_payment.index')->with('success', 'Data Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPayment  $masterPayment
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPayment $masterPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPayment  $masterPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPayment $masterPayment)
    {
        return view('admin.master_payment.edit', compact('masterPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPayment  $masterPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPayment $masterPayment)
    {
        $update = [];
        $request->validate([
            'name'      => 'required',
            'logo_bank' => 'image'
        ], [
            'name.required'   => 'Nama Harus Di Isi',
            'logo_bank.image' => 'Yang Anda Upload Bukan Gambar'
        ]);

        $update = $request->all();

        if ( $request->hasFile('logo_bank') ) {
            $logo = $request->file('logo_bank');
            $logoNameGenerated = date('Ymdhis').$logo->getClientOriginalName();
            $logo->move('uploads/master_payment/logo', $logoNameGenerated);
            $update['logo_bank'] = $logoNameGenerated;
        }

        MasterPayment::where('id', $masterPayment->id)->update($update);

        return redirect()->route('master_payment.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPayment  $masterPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPayment $masterPayment)
    {
        MasterPayment::destroy($masterPayment->id);

        return redirect()->route('master_payment.index')->with('success', 'Data Berhasil Di Hapus');   
    }
}