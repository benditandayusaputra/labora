@extends('admin.layout.app')

@section('page', 'Pendaftar Turnament')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-4 col-12">
                        <h3 class="card-t0itle">Data Pendaftaran</h3>
                    </div>
                    <div class="col-md-8 col-12">
                        <form action="" method="get">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="d-flex align-items-center">
                                  <label for="tournament_id" class="mr-2">Tournament</label>
                                  <select name="tournament_id" id="tournament_id" class="form-control">
                                    @foreach ($tournaments as $key => $item)
                                        @if ($request->tournament_id)
                                            <option value="{{ $item->id }}" {{ $item->id == $request->tournament_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}" {{ $key == 0 ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                  </select>
                                </div>
                                <div class="d-flex align-items-center ml-3">
                                  <label for="club_id" class="mr-2">Club</label>
                                  <select name="club_id" id="club_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($clubs as $item)
                                        @if ($request->club_id)
                                            <option value="{{ $item->id }}" {{ $item->id == $request->club_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                  </select>
                                </div>
                                <div class="d-flex align-items-center ml-3">
                                  <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Turnamen</th>
                            <th>Club</th>
                            <th>Nama</th>
                            <th>HP</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item) 
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tournament->name }}</td>
                            <td>{{ $item->club->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->hp }}</td>
                            <td>{{ $item->status == 1 ? 'Sudah Bayar' : 'Waiting List' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
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