a@extends('admin.layout.app')

@section('page', 'Pendaftar Turnament')

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-4 col-12">
                        <h3 class="card-title">Data Pembayaran</h3>
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
                                  <label for="status" class="mr-2">Status</label>
                                  <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $request->status == 0 ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="0" {{ $request->status == 1 ? 'selected' : '' }}>Sudah Bayar</option>
                                    <option value="0" {{ $request->status == 2 ? 'selected' : '' }}>Sudah Konfirmasi Bayar</option>
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
                            <th>Nama</th>
                            <th>HP</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Bukti Pembayaran</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item) 
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tournament->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td align="center">
                                <a href="{{ url('uploads/proof_of_payment/file/'.$item->proof_of_payment) }}" download="{{ $item->proof_of_payment }}">
                                    <img src="{{ url('uploads/proof_of_payment/file/'.$item->proof_of_payment) }}" alt="Logo" style="max-width: 100px">
                                </a>
                            </td>
                            @if ($item->status == 0)
                                <td>Belum Membayar</td>
                            @elseif ($item->status == 1)
                                <td>
                                    <button type="button" class="btn btn-success" onclick="confirm('Yakin Konfirmasi Pembayaran??') ? window.location.href = '{{ route('payment_confirm') }}' : ''">Konfirmasi Pembayaran</button>
                                </td>
                            @else 
                                <td>Sudah Di Konfirmasi</td>
                            @endif
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