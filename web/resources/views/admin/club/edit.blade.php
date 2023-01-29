@extends('admin.layout.app')

@section('page', 'Ubah Club')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('club.update', $club->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $club->name }}">
                      @error('name')
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
