@extends('admin.layout.app')

@section('page', 'Tambah Metode Pembayaran')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('master_payment.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="bank">Nama Bank/E-Wallet</label>
                      <input type="text" class="form-control" name="bank" id="bank" value="{{ old('bank') }}">
                      @error('bank')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="no_rek">No Rekening/E-Wallet</label>
                      <input type="text" class="form-control" name="no_rek" id="no_rek" value="{{ old('no_rek') }}">
                      @error('no_rek')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="name">Atas Nama</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                      @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="logo_bank">Logo Bank/E-Wallet (opsional)</label>
                      <input type="file" class="form-control-file" name="logo_bank" id="logo_bank">
                      @error('logo_bank')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
