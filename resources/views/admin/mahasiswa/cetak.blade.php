<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="assets/img/logo/logo.png" rel="icon">
  <title>{{ $title }}</title>
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
  
  <!-- Select2 -->
<link href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
<style>
  th{
    padding: 12px 24px 12px 12px !important;
  }
  td{
    padding: 12px 12px 12px 12px !important;
  }
</style>

</head>
<body>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        
    </div>

    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    
                </div>
                <div class="">
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>NO. HP</th>
                                <th>Alamat</th>
                                <th>HAK AKSES</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>NO. HP</th>
                                <th>Alamat</th>
                                <th>HAK AKSES</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($pegawai as $pegawai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pegawai->nama_pegawai }}</td>
                            <td>{{ $pegawai->email }}</td>
                            <td>{{ $pegawai->no_hp }}</td>
                            <td>{{ $pegawai->alamat }}</td>
                            <td>
                                @foreach($user as $u)
                                    @if ($pegawai->email == $u->email)
                                        @if ($u->level == 1)
                                            Pimpinan
                                        @elseif ($u->level == 2)
                                            Kader
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/app.js"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>  
  
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  
    <!-- Page level custom scripts -->
    <script>
      $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
      });
      $(document).ready(function () {
        $('#dataTable2').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
      });
  
  
  
    </script>
  
  <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
  
  <!-- Select2 -->
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script>
      $(document).ready(function () {
  
  
        $('.select2-single').select2();
  
  
      });
  
      $(document).ready(function() {
          $('.select2').select2();
      });
  
  
  
    </script>
  
    
  <script>
      window.print();
  </script>
  </body>
  
  </html>