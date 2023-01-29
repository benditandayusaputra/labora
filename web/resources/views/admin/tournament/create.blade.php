@extends('admin.layout.app')

@section('page', 'Tambah Tournament')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tournament.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                      @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="division">Divisi</label>
                      <div class="select2-blue">
                        <select class="select2" multiple="multiple" name="division[]" data-placeholder="Select a State" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                        </select>
                      </div>
                      @error('division')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="description">Deskripsi (optional)</label>
                      <textarea type="text" class="form-control" name="description" id="description" value="{{ old('description') }}"></textarea>
                      @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="price">Harga Daftar</label>
                      <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}">
                      @error('price')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="quota">Kuota Pemain</label>
                      <input type="number" class="form-control" name="quota" id="quota" value="{{ old('quota') }}">
                      @error('quota')
                        <small class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="logo">Logo Tournament (opsional)</label>
                      <input type="file" class="form-control-file" name="logo" id="logo">
                      @error('logo')
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

@section('style')
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('script')
  <script src="{{ asset('template') }}/plugins/select2/js/select2.full.min.js"></script>
  <script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  </script>
@endsection
