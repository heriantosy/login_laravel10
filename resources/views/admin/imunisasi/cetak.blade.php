

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="assets/img/logo/logo.png" rel="icon">
  <title>{{ $judul }}</title>
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

<body class="sb-nav-fixed">
    <div class="container-fluid">
        <div>
            
            
            <center>
                <h1>POSYANDU KASIH IBU</h1>
                <p>
                
                Jalan Sultan Abdul Jalil, Desa Kapau Jaya<br>
                Kec. Siak Hulu, Kab. Kampar, Prov. Riau
                Telp/WA: 0853-7670-2835
                </p>
            </center>
        </div>
        <hr >
          <div class="table-responsive">
            <center>
              <h5>{{$judul}} <br> Periode {{date('d-m-Y',strtotime($mulai))}} Sd {{date('d-m-Y',strtotime($selesai))}}</h5>
            </center>
            <hr>

            <table class="table table-bordered" width="100%">
              <thead>
                <tr>
                    <th>NO</th>
                    <th>Tanggal</th>
                    <th>Nama Balita</th>
                    <th>Jenis Vaksin</th>
                    <th>Umur (Bulan)</th>
                    <th>Pemeriksa</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($imunisasi as $imun)
                    @php
                    $balita = DB::table('balita')->where('id_balita',$imun->balita_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $imun->tanggal }}</td>
                        <td>{{ $balita->nama_anak }}</td>
                        <td>
                            @if ($imun->jenis_vaksin == 1)
                                HB 0 (0-24 jam)
                            @elseif ($imun->jenis_vaksin == 2)
                                BCG
                            @elseif ($imun->jenis_vaksin == 3)
                                *Polio
                            @elseif ($imun->jenis_vaksin == 4)
                                *DPT-HB-Hib 1
                            @elseif ($imun->jenis_vaksin == 5)
                                *Polio 2
                            @elseif ($imun->jenis_vaksin == 6)
                                *DPT-HB-Hib 2
                            @elseif ($imun->jenis_vaksin == 7)
                                *Polio 3
                            @elseif ($imun->jenis_vaksin == 8)
                                *DPT-HB-Hib 3
                            @elseif ($imun->jenis_vaksin == 9)
                                *Polio 4
                            @elseif ($imun->jenis_vaksin == 10)
                                *IPV
                            @elseif ($imun->jenis_vaksin == 11)
                                Campak
                            @endif

                        </td>
                        <td>{{ $imun->umur }}</td>
                        <td>{{ $imun->user->nama }}</td>
                    </tr>
                    @endforeach
              </tbody>
            </table>

            

            <table width="100%">
                <tr>
                    <td style="width: 700px;"></td>
                    <td>Pekanbaru, {{date('d-m-Y')}} <br> Dicetak Oleh,</td>
                </tr>
                <tr>
                    <td style="height: 100px;"></td>
                </tr>
                <tr>
                    <td style="width: 700px;"></td>
                    @if(auth()->user()->akses == 1)
                    <td>{{auth()->user()->nama}} <br> Pimpinan</td>
                    @else
                    <td>{{auth()->user()->nama}} <br> Kader</td>
                    @endif
                </tr>
          </table>
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