@extends('admin.layout.app')

@section('page', 'Ubah Tournament')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tournament.update', $tournament->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $tournament->name }}">
                      @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="description">Deskripsi (optional)</label>
                      <textarea type="text" class="form-control" name="description" id="description" value="{{ $tournament->description }}">{{ $tournament->description }}</textarea>
                      @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="price">Harga Daftar</label>
                      <input type="number" class="form-control" name="price" id="price" value="{{ $tournament->price }}">
                      @error('price')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="quota">Kuota Pemain</label>
                      <input type="number" class="form-control" name="quota" id="quota" value="{{ $tournament->quota }}">
                      @error('quota')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="logo">Logo Tournament (opsional)</label>
                      <input type="file" class="form-control-file" name="logo" id="logo">
                      <small class="form-text text-info">{{ 'Upload Logo Baru Untuk Mengganti' }}</small>
                      @error('logo')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <img src="{{ url('uploads/tournament/logo/'.$tournament->logo) }}" alt="Logo" style="max-width: 80px">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
