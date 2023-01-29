<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Labora</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tournament {{ $tournament->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-12">
                                            <h3 class="card-title">Data Sudah Bayar</h3>
                                        </div>
                                        <div class="col-md-8 col-12">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataBayar as $item) 
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tournament->name }}</td>
                                                <td>{{ $item->club->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->hp }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-12">
                                            <h3 class="card-title">Data Waiting List</h3>
                                        </div>
                                        <div class="col-md-8 col-12">
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
                                            @foreach ($dataWaiting as $item) 
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tournament->name }}</td>
                                                <td>{{ $item->club->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->hp }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
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
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "buttons": ["print", "colvis"]
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
</body>

</html>