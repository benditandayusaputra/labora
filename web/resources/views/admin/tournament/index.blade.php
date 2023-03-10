@extends('admin.layout.app')

@section('page', 'Tournament')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    @if (session('success'))
                        <div class="col-12 mb-2">
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="col-6">
                        <h3 class="card-title">Data Tournament</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('tournament.create') }}'">Tambah Tournament</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tournament</th>
                            <th>Harga</th>
                            <th>Sisa Slot</th>
                            <th>Logo</th>
                            <th>Publikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tournaments as $item) 
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quota }}</td>
                            <td align="center">
                                <img src="{{ url('uploads/tournament/logo/'.$item->logo) }}" alt="Logo" style="max-width: 80px">
                            </td>
                            <td align="center">
                                @if ($item->published == 0)
                                    <button type="button" class="btn btn-success mr-2 d-inline" onclick="window.location.href = '{{ url('publish_tournament/'.$item->id.'/1') }}'"><i class="fa fa-eye"></i> Publish</button>
                                @else
                                    <button type="button" class="btn btn-success mr-2 d-inline" onclick="window.location.href = '{{ url('publish_tournament/'.$item->id.'/0') }}'"><i class="fa fa-eye-slash"></i> Unpublish</button>
                                @endif
                            </td>
                            <td class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-success mr-2" onclick="window.location.href = '{{ route('tournament.edit', $item->id) }}'"><i class="fa fa-edit"></i></button>
                                <form action="{{ route('tournament.destroy', $item->id) }}" method="post" id="formHapus">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="if(confirm('Yakin Hapus Data?')) document.getElementById('formHapus').submit()"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection


@section('script')
    <script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('template') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
@endsection