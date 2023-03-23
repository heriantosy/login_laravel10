<?php
function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,0,',',',');
  return $hasil_rupiah;
}
?>


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

<body id="page-top">
<div class="container-fluid"> 
    <div class="mb-3">
            
            
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
    <br>
<!-- Row -->
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Berat Badan Anak berdasarkan Usia</h6>
            </div>
            <!-- Area Chart -->
            
            <div class="card-body">
                <canvas id="speedChart1" width="500" height="200"></canvas>
                @foreach($balita as $b)
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ date('d-m -Y',strtotime($b->tanggal)) }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Berat Badan Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $b->berat_badan }} kg</label>
                    </div>
                    <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kondisi Berat Badan</label>
                    <label for="inputEmail3" class="col-form-label">:</label>
                    <label for="inputEmail3" class="col-sm-5 col-form-label">
                    @php
                    $balita2 = DB::table('balita')->where('id_balita',$b->balita_id)->first();
                        
                    @endphp
                        @if($balita2->jenis_kelamin === "L")
                            @if ($b->umur == 0)
                                @if ($b->berat_badan < 2.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 2.1 && $b->berat_badan < 2.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 2.5 && $b->berat_badan <= 4.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 4.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 1 )
                                @if ($b->berat_badan < 2.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 2.9 && $b->berat_badan < 3.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 3.4 && $b->berat_badan <= 5.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 5.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 2 )
                                @if ($b->berat_badan < 3.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 3.8 && $b->berat_badan < 4.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 4.3 && $b->berat_badan <= 7.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 7.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 3 )
                                @if ($b->berat_badan < 4.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 4.4 && $b->berat_badan < 5.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 5.0 && $b->berat_badan <= 8.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 8.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 4 )
                                @if ($b->berat_badan < 4.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 4.9 && $b->berat_badan < 5.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 5.6 && $b->berat_badan <= 8.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 8.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 5 )
                                @if ($b->berat_badan < 5.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.3 && $b->berat_badan < 6.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.0 && $b->berat_badan <= 9.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 9.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 6 )
                                @if ($b->berat_badan < 5.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.3 && $b->berat_badan < 6.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.0 && $b->berat_badan <= 9.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 9.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 7 )
                                @if ($b->berat_badan < 5.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.9 && $b->berat_badan < 6.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.7 && $b->berat_badan <= 10.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 10.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 8 )
                                @if ($b->berat_badan < 6.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.2 && $b->berat_badan < 6.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.9 && $b->berat_badan <= 10.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 10.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 9 )
                                @if ($b->berat_badan < 6.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.4 && $b->berat_badan < 7.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.1 && $b->berat_badan <= 11.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 10 )
                                @if ($b->berat_badan < 6.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.6 && $b->berat_badan < 7.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.4 && $b->berat_badan <= 11.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 11 )
                                @if ($b->berat_badan < 6.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.8 && $b->berat_badan < 7.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.6 && $b->berat_badan <= 11.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 12 )                                
                                @if ($b->berat_badan < 6.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.9 && $b->berat_badan < 7.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.7 && $b->berat_badan <= 12.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 13 )
                                @if ($b->berat_badan < 7.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.1 && $b->berat_badan < 7.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.9 && $b->berat_badan <= 12.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 14 )
                                @if ($b->berat_badan < 7.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.2 && $b->berat_badan < 8.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.1 && $b->berat_badan <= 12.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 15 )
                                @if ($b->berat_badan < 7.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.4 && $b->berat_badan < 8.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.3 && $b->berat_badan <= 12.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 16 )
                                @if ($b->berat_badan < 7.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.5 && $b->berat_badan < 8.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.4 && $b->berat_badan <= 13.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 17 )
                                @if ($b->berat_badan < 7.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.7 && $b->berat_badan < 8.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.6 && $b->berat_badan <= 13.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 18 )
                                @if ($b->berat_badan < 7.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.8 && $b->berat_badan < 8.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.8 && $b->berat_badan <= 13.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 19 )
                                @if ($b->berat_badan < 8.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.0 && $b->berat_badan < 8.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.9 && $b->berat_badan <= 13.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 20 )
                                @if ($b->berat_badan < 8.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.1 && $b->berat_badan < 9.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.1 && $b->berat_badan <= 14.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 21 )
                                @if ($b->berat_badan < 8.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.2 && $b->berat_badan < 9.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.2 && $b->berat_badan <= 14.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 22 )
                                @if ($b->berat_badan < 8.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.4 && $b->berat_badan < 9.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.4 && $b->berat_badan <= 14.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 23 )
                                @if ($b->berat_badan < 8.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.5 && $b->berat_badan < 9.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.5 && $b->berat_badan <= 15.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 24 )
                                @if ($b->berat_badan < 8.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.6 && $b->berat_badan < 9.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.7 && $b->berat_badan <= 15.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 25 )
                                @if ($b->berat_badan < 8.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.8 && $b->berat_badan < 9.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.8 && $b->berat_badan <= 15.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 26 )
                                @if ($b->berat_badan < 8.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.9 && $b->berat_badan < 10.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.0 && $b->berat_badan <= 15.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 27 )
                                @if ($b->berat_badan < 9.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.0 && $b->berat_badan < 10.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.1 && $b->berat_badan <= 16.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 28 )
                                @if ($b->berat_badan < 9.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.1 && $b->berat_badan < 10.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.2 && $b->berat_badan <= 16.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 29 )
                                @if ($b->berat_badan < 9.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.2 && $b->berat_badan < 10.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.4 && $b->berat_badan <= 16.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 30 )
                                @if ($b->berat_badan < 9.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.4 && $b->berat_badan < 10.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.5 && $b->berat_badan <= 16.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 31 )
                                @if ($b->berat_badan < 9.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.5 && $b->berat_badan < 10.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.7 && $b->berat_badan <= 17.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 32 )
                                @if ($b->berat_badan < 9.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.6 && $b->berat_badan < 10.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.8 && $b->berat_badan <= 17.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 33 )
                                @if ($b->berat_badan < 9.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.7 && $b->berat_badan < 10.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.9 && $b->berat_badan <= 17.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 34 )
                                @if ($b->berat_badan < 9.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.8 && $b->berat_badan < 11.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.0 && $b->berat_badan <= 17.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 35 )
                                @if ($b->berat_badan < 9.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.9 && $b->berat_badan < 11.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.2 && $b->berat_badan <= 18.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 36 )
                                @if ($b->berat_badan < 10.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.0 && $b->berat_badan < 11.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.3 && $b->berat_badan <= 18.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 37 )
                                @if ($b->berat_badan < 10.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.1 && $b->berat_badan < 11.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.4 && $b->berat_badan <= 18.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 38 )
                                @if ($b->berat_badan < 10.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.2 && $b->berat_badan < 11.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.5 && $b->berat_badan <= 18.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 39 )
                                @if ($b->berat_badan < 10.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.3 && $b->berat_badan < 11.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.6 && $b->berat_badan <= 19.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 40 )
                                @if ($b->berat_badan < 10.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.4 && $b->berat_badan < 11.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.8 && $b->berat_badan <= 19.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 41 )
                                @if ($b->berat_badan < 10.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.5 && $b->berat_badan < 11.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.9 && $b->berat_badan <= 19.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 42 )
                                @if ($b->berat_badan < 10.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.6 && $b->berat_badan < 12.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.0 && $b->berat_badan <= 19.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 43 )
                                @if ($b->berat_badan < 10.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.7 && $b->berat_badan < 12.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.1 && $b->berat_badan <= 20.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 44 )
                                @if ($b->berat_badan < 10.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.8 && $b->berat_badan < 12.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.2 && $b->berat_badan <= 20.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 45 )
                                @if ($b->berat_badan < 10.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.9 && $b->berat_badan < 12.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.4 && $b->berat_badan <= 20.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 46 )
                                @if ($b->berat_badan < 11.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.0 && $b->berat_badan < 12.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.5 && $b->berat_badan <= 20.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 47 )
                                @if ($b->berat_badan < 11.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.1 && $b->berat_badan < 12.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.6 && $b->berat_badan <= 20.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 48 )
                                @if ($b->berat_badan < 11.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.2 && $b->berat_badan < 12.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.7 && $b->berat_badan <= 21.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 49 )
                                @if ($b->berat_badan < 11.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.3 && $b->berat_badan < 12.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.8 && $b->berat_badan <= 21.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 50 )
                                @if ($b->berat_badan < 11.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.4 && $b->berat_badan < 12.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.9 && $b->berat_badan <= 21.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 51 )
                                @if ($b->berat_badan < 11.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.5 && $b->berat_badan < 13.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.1 && $b->berat_badan <= 21.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 52 )
                                @if ($b->berat_badan < 11.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.6 && $b->berat_badan < 13.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.2 && $b->berat_badan <= 22.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 53 )
                                @if ($b->berat_badan < 11.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.7 && $b->berat_badan < 13.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.3 && $b->berat_badan <= 22.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 54 )
                                @if ($b->berat_badan < 11.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.8 && $b->berat_badan < 13.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.4 && $b->berat_badan <= 22.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 55 )
                                @if ($b->berat_badan < 11.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.9 && $b->berat_badan < 13.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.5 && $b->berat_badan <= 22.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 56 )
                                @if ($b->berat_badan < 12.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.0 && $b->berat_badan < 13.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.6 && $b->berat_badan <= 23.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 57 )
                                @if ($b->berat_badan < 12.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.1 && $b->berat_badan < 13.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.7 && $b->berat_badan <= 23.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 58 )
                                @if ($b->berat_badan < 12.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.2 && $b->berat_badan < 13.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.8 && $b->berat_badan <= 23.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 59 )
                                @if ($b->berat_badan < 12.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.3 && $b->berat_badan < 14.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 14.0 && $b->berat_badan <= 23.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 60 )
                                @if ($b->berat_badan < 12.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.4 && $b->berat_badan < 14.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 14.1 && $b->berat_badan <= 24.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 24.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @else
                            Bukan Balita Lagi
                            @endif
                        @elseif($balita2->jenis_kelamin === "P")
                            @if ($b->umur == 0)
                                @if ($b->berat_badan < 2.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 2.0 && $b->berat_badan < 2.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 2.4 && $b->berat_badan <= 4.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 4.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 1 )
                                @if ($b->berat_badan < 2.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 2.7 && $b->berat_badan < 3.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 3.2 && $b->berat_badan <= 5.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 5.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 2 )
                                @if ($b->berat_badan < 3.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 3.4 && $b->berat_badan < 3.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 3.9 && $b->berat_badan <= 6.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 6.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 3 )
                                @if ($b->berat_badan < 4.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 4.0 && $b->berat_badan < 4.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 4.5 && $b->berat_badan <= 7.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 7.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 4 )
                                @if ($b->berat_badan < 4.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 4.4 && $b->berat_badan < 5.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 5.0 && $b->berat_badan <= 8.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 8.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 5 )
                                @if ($b->berat_badan < 4.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 4.8 && $b->berat_badan < 5.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 5.4 && $b->berat_badan <= 8.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 8.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 6 )
                                @if ($b->berat_badan < 5.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.1 && $b->berat_badan < 5.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 5.7 && $b->berat_badan <= 9.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 9.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 7 )
                                @if ($b->berat_badan < 5.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.3 && $b->berat_badan < 6.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.0 && $b->berat_badan <= 9.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 9.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 8 )
                                @if ($b->berat_badan < 5.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.6 && $b->berat_badan < 6.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.3 && $b->berat_badan <= 10.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 10.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 9 )
                                @if ($b->berat_badan < 5.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.8 && $b->berat_badan < 6.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.5 && $b->berat_badan <= 10.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 10.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 10 )
                                @if ($b->berat_badan < 5.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 5.9 && $b->berat_badan < 6.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.7 && $b->berat_badan <= 10.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 10.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 11 )
                                @if ($b->berat_badan < 6.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.1 && $b->berat_badan < 6.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 6.9 && $b->berat_badan <= 11.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 12 )                                
                                @if ($b->berat_badan < 6.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.3 && $b->berat_badan < 7.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.0 && $b->berat_badan <= 11.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 13 )
                                @if ($b->berat_badan < 6.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.4 && $b->berat_badan < 7.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.2 && $b->berat_badan <= 11.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 11.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 14 )
                                @if ($b->berat_badan < 6.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.6 && $b->berat_badan < 7.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.4 && $b->berat_badan <= 12.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 15 )
                                @if ($b->berat_badan < 6.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.7 && $b->berat_badan < 7.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.6 && $b->berat_badan <= 12.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 16 )
                                @if ($b->berat_badan < 6.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 6.9 && $b->berat_badan < 7.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.7 && $b->berat_badan <= 12.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 17 )
                                @if ($b->berat_badan < 7.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.0 && $b->berat_badan < 7.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 7.9 && $b->berat_badan <= 12.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 12.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 18 )
                                @if ($b->berat_badan < 7.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.2 && $b->berat_badan < 8.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.1 && $b->berat_badan <= 13.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 19 )
                                @if ($b->berat_badan < 7.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.3 && $b->berat_badan < 8.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.2 && $b->berat_badan <= 13.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 20 )
                                @if ($b->berat_badan < 7.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.5 && $b->berat_badan < 8.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.4 && $b->berat_badan <= 13.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 13.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 21 )
                                @if ($b->berat_badan < 7.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.6 && $b->berat_badan < 8.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.6 && $b->berat_badan <= 14.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 22 )
                                @if ($b->berat_badan < 7.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.8 && $b->berat_badan < 8.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.7 && $b->berat_badan <= 14.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 23 )
                                @if ($b->berat_badan < 7.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 7.9 && $b->berat_badan < 8.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 8.9 && $b->berat_badan <= 14.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 24 )
                                @if ($b->berat_badan < 8.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.1 && $b->berat_badan < 9.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.0 && $b->berat_badan <= 14.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 14.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 25 )
                                @if ($b->berat_badan < 8.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.2 && $b->berat_badan < 9.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.2 && $b->berat_badan <= 15.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 26 )
                                @if ($b->berat_badan < 8.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.4 && $b->berat_badan < 9.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.4 && $b->berat_badan <= 15.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 27 )
                                @if ($b->berat_badan < 8.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.5 && $b->berat_badan < 9.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.5 && $b->berat_badan <= 15.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 15.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 28 )
                                @if ($b->berat_badan < 8.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.6 && $b->berat_badan < 9.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.7 && $b->berat_badan <= 16.0 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.0 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 29 )
                                @if ($b->berat_badan < 8.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.8 && $b->berat_badan < 9.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 9.8 && $b->berat_badan <= 16.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 30 )
                                @if ($b->berat_badan < 8.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 8.9 && $b->berat_badan < 10.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.0 && $b->berat_badan <= 16.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 31 )
                                @if ($b->berat_badan < 9.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.0 && $b->berat_badan < 10.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.1 && $b->berat_badan <= 16.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 16.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 32 )
                                @if ($b->berat_badan < 9.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.1 && $b->berat_badan < 10.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.3 && $b->berat_badan <= 17.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 33 )
                                @if ($b->berat_badan < 9.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.3 && $b->berat_badan < 10.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.4 && $b->berat_badan <= 17.3 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.3 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 34 )
                                @if ($b->berat_badan < 9.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.4 && $b->berat_badan < 10.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.5 && $b->berat_badan <= 17.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 35 )
                                @if ($b->berat_badan < 9.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.5 && $b->berat_badan < 10.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.7 && $b->berat_badan <= 17.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 17.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 36 )
                                @if ($b->berat_badan < 9.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.6 && $b->berat_badan < 10.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.8 && $b->berat_badan <= 18.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 37 )
                                @if ($b->berat_badan < 9.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.7 && $b->berat_badan < 10.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 10.9 && $b->berat_badan <= 18.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 38 )
                                @if ($b->berat_badan < 9.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.8 && $b->berat_badan < 11.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.1 && $b->berat_badan <= 18.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 18.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 39 )
                                @if ($b->berat_badan < 9.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 9.9 && $b->berat_badan < 11.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.2 && $b->berat_badan <= 19.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 40 )
                                @if ($b->berat_badan < 10.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.1 && $b->berat_badan < 11.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.3 && $b->berat_badan <= 19.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 41 )
                                @if ($b->berat_badan < 10.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.2 && $b->berat_badan < 11.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.5 && $b->berat_badan <= 19.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 42 )
                                @if ($b->berat_badan < 10.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.3 && $b->berat_badan < 11.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.6 && $b->berat_badan <= 19.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 19.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 43 )
                                @if ($b->berat_badan < 10.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.4 && $b->berat_badan < 11.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.7 && $b->berat_badan <= 20.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 44 )
                                @if ($b->berat_badan < 10.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.5 && $b->berat_badan < 11.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 11.8 && $b->berat_badan <= 20.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 45 )
                                @if ($b->berat_badan < 10.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.6 && $b->berat_badan < 12.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.0 && $b->berat_badan <= 20.7 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.7 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 46 )
                                @if ($b->berat_badan < 10.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.7 && $b->berat_badan < 12.1 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.1 && $b->berat_badan <= 20.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 20.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 47 )
                                @if ($b->berat_badan < 10.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.8 && $b->berat_badan < 12.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.2 && $b->berat_badan <= 21.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 48 )
                                @if ($b->berat_badan < 10.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 10.9 && $b->berat_badan < 12.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.3 && $b->berat_badan <= 21.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 49 )
                                @if ($b->berat_badan < 11.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.0 && $b->berat_badan < 12.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.4 && $b->berat_badan <= 21.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 21.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 50 )
                                @if ($b->berat_badan < 11.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.1 && $b->berat_badan < 12.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.6 && $b->berat_badan <= 22.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 51 )
                                @if ($b->berat_badan < 11.2 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.2 && $b->berat_badan < 12.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.7 && $b->berat_badan <= 22.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 52 )
                                @if ($b->berat_badan < 11.3 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.3 && $b->berat_badan < 12.8 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.8 && $b->berat_badan <= 22.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 53 )
                                @if ($b->berat_badan < 11.4 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.4 && $b->berat_badan < 12.9 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 12.9 && $b->berat_badan <= 22.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 22.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 54 )
                                @if ($b->berat_badan < 11.5 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.5 && $b->berat_badan < 13.0 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.0 && $b->berat_badan <= 23.2 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.2 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 55 )
                                @if ($b->berat_badan < 11.6 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.6 && $b->berat_badan < 13.2 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.2 && $b->berat_badan <= 23.5 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.5 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 56 )
                                @if ($b->berat_badan < 11.7 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.7 && $b->berat_badan < 13.3 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.3 && $b->berat_badan <= 23.8 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 23.8 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 57 )
                                @if ($b->berat_badan < 11.8 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.8 && $b->berat_badan < 13.4 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.4 && $b->berat_badan <= 24.1 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 24.1 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 58 )
                                @if ($b->berat_badan < 11.9 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 11.9 && $b->berat_badan < 13.5 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.5 && $b->berat_badan <= 24.4 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 24.4 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 59 )
                                @if ($b->berat_badan < 12.0 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.0 && $b->berat_badan < 13.6 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.6 && $b->berat_badan <= 24.6 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 24.6 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @elseif ($b->umur == 60 )
                                @if ($b->berat_badan < 12.1 )
                                    <span class="badge badge-danger">
                                        Gizi Buruk
                                    </span>
                                @elseif ($b->berat_badan >= 12.1 && $b->berat_badan < 13.7 )
                                    <span class="badge badge-warning">
                                        Gizi Kurang
                                    </span>
                                @elseif ($b->berat_badan >= 13.7 && $b->berat_badan <= 24.9 )
                                    <span class="badge badge-success">
                                        Gizi Baik
                                    </span>
                                @elseif ($b->berat_badan > 24.9 )
                                    <span class="badge badge-danger">
                                        Gizi Lebih
                                    </span>
                                @endif
                            @else
                                Bukan Balita Lagi
                            @endif
                        @endif

                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Tinggi Badan Anak berdasarkan Usia</h6>
            </div>
            <!-- Area Chart -->
            <div class="card-body">
                <canvas id="speedChart2" width="500" height="200"></canvas>
                @foreach($balita as $b)
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ date('d-m -Y',strtotime($b->tanggal)) }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tinggi Badan Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $b->tinggi_badan }} kg</label>
                    </div>
                    <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kondisi Tinggi Badan</label>
                    <label for="inputEmail3" class="col-form-label">:</label>
                    <label for="inputEmail3" class="col-sm-5 col-form-label">
                    @php
                    $balita2 = DB::table('balita')->where('id_balita',$b->balita_id)->first();
                        
                    @endphp
                        @if($balita2->jenis_kelamin === "L")
                            @if ($b->umur == 0)
                                @if ($b->tinggi_badan < 44.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 44.2 && $b->tinggi_badan < 46.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 46.1 && $b->tinggi_badan <= 53.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 53.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                                
                            @elseif ($b->umur == 1 )
                                @if ($b->tinggi_badan < 48.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 48.9 && $b->tinggi_badan < 50.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 50.8 && $b->tinggi_badan <= 58.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 58.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 2 )
                                @if ($b->tinggi_badan < 52.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 52.4 && $b->tinggi_badan < 54.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 54.4 && $b->tinggi_badan <= 62.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 62.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 3 )
                                @if ($b->tinggi_badan < 55.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 55.3 && $b->tinggi_badan < 57.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 57.3 && $b->tinggi_badan <= 65.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 65.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 4 )
                                @if ($b->tinggi_badan < 57.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 57.6 && $b->tinggi_badan < 59.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 59.7 && $b->tinggi_badan <= 68.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 68.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 5 )
                                @if ($b->tinggi_badan < 59.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 59.6 && $b->tinggi_badan < 61.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 61.7 && $b->tinggi_badan <= 70.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 70.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 6 )
                                @if ($b->tinggi_badan < 61.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 61.2 && $b->tinggi_badan < 63.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 63.3 && $b->tinggi_badan <= 71.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 71.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 7 )
                                @if ($b->tinggi_badan < 62.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 62.7 && $b->tinggi_badan < 64.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 64.8 && $b->tinggi_badan <= 73.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 73.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 8 )
                                @if ($b->tinggi_badan < 64.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 64.0 && $b->tinggi_badan < 66.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 66.2 && $b->tinggi_badan <= 75.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 75.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 9 )
                                @if ($b->tinggi_badan < 65.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 65.2 && $b->tinggi_badan < 67.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 67.5 && $b->tinggi_badan <= 76.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 76.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 10 )
                                @if ($b->tinggi_badan < 66.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 66.4 && $b->tinggi_badan < 68.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 68.7 && $b->tinggi_badan <= 77.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 77.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 11 )
                                @if ($b->tinggi_badan < 67.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 67.6 && $b->tinggi_badan < 69.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 69.9 && $b->tinggi_badan <= 79.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 79.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 12 )
                                @if ($b->tinggi_badan < 68.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 68.6 && $b->tinggi_badan < 71.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 71.0 && $b->tinggi_badan <= 80.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 80.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 13 )
                                @if ($b->tinggi_badan < 69.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 69.6 && $b->tinggi_badan < 72.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 72.1 && $b->tinggi_badan <= 81.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 81.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 14 )
                                @if ($b->tinggi_badan < 70.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 70.6 && $b->tinggi_badan < 73.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 73.1 && $b->tinggi_badan <= 83.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 83.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 15 )
                                @if ($b->tinggi_badan < 71.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 71.6 && $b->tinggi_badan < 74.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 74.1 && $b->tinggi_badan <= 84.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 84.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 16 )
                                @if ($b->tinggi_badan < 72.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 72.5 && $b->tinggi_badan < 75.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 75.0 && $b->tinggi_badan <= 85.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 85.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 17 )
                                @if ($b->tinggi_badan < 73.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 73.3 && $b->tinggi_badan < 76.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.0 && $b->tinggi_badan <= 86.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 86.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 18 )
                                @if ($b->tinggi_badan < 74.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 74.2 && $b->tinggi_badan < 76.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.9 && $b->tinggi_badan <= 87.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 87.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 19 )
                                @if ($b->tinggi_badan < 75.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 75.0 && $b->tinggi_badan < 77.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 77.7 && $b->tinggi_badan <= 88.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 88.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 20 )
                                @if ($b->tinggi_badan < 75.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 75.8 && $b->tinggi_badan < 78.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.6 && $b->tinggi_badan <= 89.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 89.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 21 )
                                @if ($b->tinggi_badan < 76.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.5 && $b->tinggi_badan < 79.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 79.4 && $b->tinggi_badan <= 90.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 90.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 22 )
                                @if ($b->tinggi_badan < 77.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 77.2 && $b->tinggi_badan < 80.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.2 && $b->tinggi_badan <= 91.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 91.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 23 )
                                @if ($b->tinggi_badan < 78.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.0 && $b->tinggi_badan < 81.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.0 && $b->tinggi_badan <= 92.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 92.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 24 )
                                @if ($b->tinggi_badan < 78.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.0 && $b->tinggi_badan < 81.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.0 && $b->tinggi_badan <= 93.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 93.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 25 )
                                @if ($b->tinggi_badan < 78.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.6 && $b->tinggi_badan < 81.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.7 && $b->tinggi_badan <= 94.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 94.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 26 )
                                @if ($b->tinggi_badan < 79.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 79.3 && $b->tinggi_badan < 82.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.5 && $b->tinggi_badan <= 95.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 95.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 27 )
                                @if ($b->tinggi_badan < 79.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 79.9 && $b->tinggi_badan < 83.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.1 && $b->tinggi_badan <= 96.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 96.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 28 )
                                @if ($b->tinggi_badan < 80.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.5 && $b->tinggi_badan < 83.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.8 && $b->tinggi_badan <= 97.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 97.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 29 )
                                @if ($b->tinggi_badan < 81.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.1 && $b->tinggi_badan < 84.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.5 && $b->tinggi_badan <= 97.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 97.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 30 )
                                @if ($b->tinggi_badan < 81.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.7 && $b->tinggi_badan < 85.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.1 && $b->tinggi_badan <= 98.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 98.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 31 )
                                @if ($b->tinggi_badan < 82.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.3 && $b->tinggi_badan < 85.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.7 && $b->tinggi_badan <= 99.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 99.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 32 )
                                @if ($b->tinggi_badan < 82.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.8 && $b->tinggi_badan < 86.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.4 && $b->tinggi_badan <= 100.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 100.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 33 )
                                @if ($b->tinggi_badan < 83.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.4 && $b->tinggi_badan < 86.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.9 && $b->tinggi_badan <= 101.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 101.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 34 )
                                @if ($b->tinggi_badan < 83.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.9 && $b->tinggi_badan < 87.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.5 && $b->tinggi_badan <= 102.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 102.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 35 )
                                @if ($b->tinggi_badan < 84.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.4 && $b->tinggi_badan < 88.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.1 && $b->tinggi_badan <= 102.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 102.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 36 )
                                @if ($b->tinggi_badan < 85.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.0 && $b->tinggi_badan < 88.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.7 && $b->tinggi_badan <= 103.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 103.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 37 )
                                @if ($b->tinggi_badan < 85.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.5 && $b->tinggi_badan < 89.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.2 && $b->tinggi_badan <= 104.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 104.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 38 )
                                @if ($b->tinggi_badan < 86.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.0 && $b->tinggi_badan < 89.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.8 && $b->tinggi_badan <= 105.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 105.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 39 )
                                @if ($b->tinggi_badan < 86.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.5 && $b->tinggi_badan < 90.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.3 && $b->tinggi_badan <= 105.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 105.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 40 )
                                @if ($b->tinggi_badan < 87.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.0 && $b->tinggi_badan < 90.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.9 && $b->tinggi_badan <= 106.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 106.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 41 )
                                @if ($b->tinggi_badan < 87.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.5 && $b->tinggi_badan < 91.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.4 && $b->tinggi_badan <= 107.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 107.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 42 )
                                @if ($b->tinggi_badan < 88.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.0 && $b->tinggi_badan < 91.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.9 && $b->tinggi_badan <= 107.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 107.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 43 )
                                @if ($b->tinggi_badan < 88.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.4 && $b->tinggi_badan < 92.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.4 && $b->tinggi_badan <= 108.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 108.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 44 )
                                @if ($b->tinggi_badan < 88.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.9 && $b->tinggi_badan < 93.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.0 && $b->tinggi_badan <= 109.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 109.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 45 )
                                @if ($b->tinggi_badan < 89.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.4 && $b->tinggi_badan < 93.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.5 && $b->tinggi_badan <= 109.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 109.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 46 )
                                @if ($b->tinggi_badan < 89.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.8 && $b->tinggi_badan < 94.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.0 && $b->tinggi_badan <= 110.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 110.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 47 )
                                @if ($b->tinggi_badan < 90.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.3 && $b->tinggi_badan < 94.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.4 && $b->tinggi_badan <= 111.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 111.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 48 )
                                @if ($b->tinggi_badan < 90.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.7 && $b->tinggi_badan < 94.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.9 && $b->tinggi_badan <= 111.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 111.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 49 )
                                @if ($b->tinggi_badan < 91.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.2 && $b->tinggi_badan < 95.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.4 && $b->tinggi_badan <= 112.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 112.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 50 )
                                @if ($b->tinggi_badan < 91.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.6 && $b->tinggi_badan < 95.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.9 && $b->tinggi_badan <= 113.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 113.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 51 )
                                @if ($b->tinggi_badan < 92.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.1 && $b->tinggi_badan < 96.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 96.4 && $b->tinggi_badan <= 113.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 113.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 52 )
                                @if ($b->tinggi_badan < 92.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.5 && $b->tinggi_badan < 96.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 96.9 && $b->tinggi_badan <= 114.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 114.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 53 )
                                @if ($b->tinggi_badan < 93.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.0 && $b->tinggi_badan < 97.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 97.4 && $b->tinggi_badan <= 114.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 114.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 54 )
                                @if ($b->tinggi_badan < 93.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.4 && $b->tinggi_badan < 97.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 97.8 && $b->tinggi_badan <= 115.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 115.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 55 )
                                @if ($b->tinggi_badan < 93.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.9 && $b->tinggi_badan < 98.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 98.3 && $b->tinggi_badan <= 116.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 116.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 56 )
                                @if ($b->tinggi_badan < 94.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.3 && $b->tinggi_badan < 98.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 98.8 && $b->tinggi_badan <= 116.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 116.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 57 )
                                @if ($b->tinggi_badan < 94.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.7 && $b->tinggi_badan < 99.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 99.3 && $b->tinggi_badan <= 117.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 117.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 58 )
                                @if ($b->tinggi_badan < 95.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.2 && $b->tinggi_badan < 99.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 99.7 && $b->tinggi_badan <= 118.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 118.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 59 )
                                @if ($b->tinggi_badan < 95.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.6 && $b->tinggi_badan < 100.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 100.2 && $b->tinggi_badan <= 118.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 118.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 60 )
                                @if ($b->tinggi_badan < 96.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 96.1 && $b->tinggi_badan < 100.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 100.7 && $b->tinggi_badan <= 119.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 119.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @else
                            Bukan Balita Lagi
                            @endif
                        @elseif($balita2->jenis_kelamin === "P")
                            @if ($b->umur == 0)
                                @if ($b->tinggi_badan < 43.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 43.6 && $b->tinggi_badan < 45.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 45.4 && $b->tinggi_badan <= 52.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 52.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                                
                            @elseif ($b->umur == 1 )
                                @if ($b->tinggi_badan < 47.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 47.8 && $b->tinggi_badan < 49.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 49.8 && $b->tinggi_badan <= 57.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 57.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 2 )
                                @if ($b->tinggi_badan < 51.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 51.0 && $b->tinggi_badan < 53.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 53.0 && $b->tinggi_badan <= 61.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 61.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 3 )
                                @if ($b->tinggi_badan < 53.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 53.5 && $b->tinggi_badan < 55.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 55.6 && $b->tinggi_badan <= 64.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 64.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 4 )
                                @if ($b->tinggi_badan < 55.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 55.6 && $b->tinggi_badan < 57.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 57.8 && $b->tinggi_badan <= 66.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 66.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 5 )
                                @if ($b->tinggi_badan < 57.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 57.4 && $b->tinggi_badan < 59.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 59.6 && $b->tinggi_badan <= 68.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 68.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 6 )
                                @if ($b->tinggi_badan < 58.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 58.9 && $b->tinggi_badan < 61.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 61.2 && $b->tinggi_badan <= 70.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 70.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 7 )
                                @if ($b->tinggi_badan < 60.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 60.3 && $b->tinggi_badan < 62.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 62.7 && $b->tinggi_badan <= 71.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 71.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 8 )
                                @if ($b->tinggi_badan < 61.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 61.7 && $b->tinggi_badan < 64.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 64.0 && $b->tinggi_badan <= 73.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 73.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 9 )
                                @if ($b->tinggi_badan < 62.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 62.9 && $b->tinggi_badan < 65.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 65.3 && $b->tinggi_badan <= 75.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 75.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 10 )
                                @if ($b->tinggi_badan < 64.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 64.1 && $b->tinggi_badan < 66.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 66.5 && $b->tinggi_badan <= 76.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 76.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 11 )
                                @if ($b->tinggi_badan < 65.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 65.2 && $b->tinggi_badan < 67.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 67.7 && $b->tinggi_badan <= 77.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 77.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 12 )
                                @if ($b->tinggi_badan < 66.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 66.3 && $b->tinggi_badan < 68.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 68.9 && $b->tinggi_badan <= 79.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 79.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 13 )
                                @if ($b->tinggi_badan < 67.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 67.3 && $b->tinggi_badan < 70.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 70.0 && $b->tinggi_badan <= 80.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 80.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 14 )
                                @if ($b->tinggi_badan < 68.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 68.3 && $b->tinggi_badan < 71.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 71.0 && $b->tinggi_badan <= 81.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 81.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 15 )
                                @if ($b->tinggi_badan < 69.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 69.3 && $b->tinggi_badan < 72.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 72.0 && $b->tinggi_badan <= 83.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 83.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 16 )
                                @if ($b->tinggi_badan < 70.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 70.2 && $b->tinggi_badan < 73.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 73.0 && $b->tinggi_badan <= 84.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 84.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 17 )
                                @if ($b->tinggi_badan < 71.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 71.1 && $b->tinggi_badan < 74.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 74.0 && $b->tinggi_badan <= 85.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 85.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 18 )
                                @if ($b->tinggi_badan < 72.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 72.0 && $b->tinggi_badan < 74.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 74.9 && $b->tinggi_badan <= 86.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 86.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 19 )
                                @if ($b->tinggi_badan < 72.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 72.8 && $b->tinggi_badan < 75.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 75.8 && $b->tinggi_badan <= 87.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 87.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 20 )
                                @if ($b->tinggi_badan < 73.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 73.7 && $b->tinggi_badan < 76.7 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.7 && $b->tinggi_badan <= 88.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 88.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 21 )
                                @if ($b->tinggi_badan < 74.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 74.5 && $b->tinggi_badan < 77.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 77.5 && $b->tinggi_badan <= 89.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 89.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 22 )
                                @if ($b->tinggi_badan < 75.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 75.2 && $b->tinggi_badan < 78.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.4 && $b->tinggi_badan <= 90.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 90.8 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 23 )
                                @if ($b->tinggi_badan < 76.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.0 && $b->tinggi_badan < 79.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 79.2 && $b->tinggi_badan <= 91.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 91.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 24 )
                                @if ($b->tinggi_badan < 76.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.7 && $b->tinggi_badan < 80.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.0 && $b->tinggi_badan <= 92.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 92.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 25 )
                                @if ($b->tinggi_badan < 76.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 76.8 && $b->tinggi_badan < 80.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.0 && $b->tinggi_badan <= 93.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 93.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 26 )
                                @if ($b->tinggi_badan < 77.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 77.5 && $b->tinggi_badan < 80.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.8 && $b->tinggi_badan <= 94.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 94.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 27 )
                                @if ($b->tinggi_badan < 78.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.1 && $b->tinggi_badan < 81.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.5 && $b->tinggi_badan <= 95.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 95.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 28 )
                                @if ($b->tinggi_badan < 78.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 78.8 && $b->tinggi_badan < 82.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.2 && $b->tinggi_badan <= 96.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 96.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 29 )
                                @if ($b->tinggi_badan < 79.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 79.5 && $b->tinggi_badan < 82.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.9 && $b->tinggi_badan <= 96.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 96.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 30 )
                                @if ($b->tinggi_badan < 80.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.1 && $b->tinggi_badan < 83.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.6 && $b->tinggi_badan <= 97.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 97.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 31 )
                                @if ($b->tinggi_badan < 80.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 80.7 && $b->tinggi_badan < 84.3 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.3 && $b->tinggi_badan <= 98.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 98.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 32 )
                                @if ($b->tinggi_badan < 81.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.3 && $b->tinggi_badan < 84.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.9 && $b->tinggi_badan <= 99.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 99.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 33 )
                                @if ($b->tinggi_badan < 81.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 81.9 && $b->tinggi_badan < 85.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.6 && $b->tinggi_badan <= 100.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 100.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 34 )
                                @if ($b->tinggi_badan < 82.5 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 82.5 && $b->tinggi_badan < 86.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.2 && $b->tinggi_badan <= 101.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 101.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 35 )
                                @if ($b->tinggi_badan < 83.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.1 && $b->tinggi_badan < 86.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.8 && $b->tinggi_badan <= 101.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 101.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 36 )
                                @if ($b->tinggi_badan < 83.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 83.6 && $b->tinggi_badan < 87.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.4 && $b->tinggi_badan <= 102.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 102.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 37 )
                                @if ($b->tinggi_badan < 84.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.2 && $b->tinggi_badan < 88.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.0 && $b->tinggi_badan <= 103.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 103.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 38 )
                                @if ($b->tinggi_badan < 84.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 84.7 && $b->tinggi_badan < 88.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.6 && $b->tinggi_badan <= 104.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 104.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 39 )
                                @if ($b->tinggi_badan < 85.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.3 && $b->tinggi_badan < 89.2 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.2 && $b->tinggi_badan <= 105.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 105.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 40 )
                                @if ($b->tinggi_badan < 85.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 85.8 && $b->tinggi_badan < 89.8 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.8 && $b->tinggi_badan <= 105.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 105.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 41 )
                                @if ($b->tinggi_badan < 86.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.3 && $b->tinggi_badan < 90.4 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.4 && $b->tinggi_badan <= 106.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 106.4 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 42 )
                                @if ($b->tinggi_badan < 86.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 86.8 && $b->tinggi_badan < 90.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.9 && $b->tinggi_badan <= 107.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 107.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 43 )
                                @if ($b->tinggi_badan < 87.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.4 && $b->tinggi_badan < 91.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.5 && $b->tinggi_badan <= 107.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 107.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 44 )
                                @if ($b->tinggi_badan < 87.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 87.9 && $b->tinggi_badan < 92.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.0 && $b->tinggi_badan <= 108.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 108.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 45 )
                                @if ($b->tinggi_badan < 88.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.4 && $b->tinggi_badan < 92.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.5 && $b->tinggi_badan <= 109.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 109.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 46 )
                                @if ($b->tinggi_badan < 88.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 88.9 && $b->tinggi_badan < 93.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.1 && $b->tinggi_badan <= 110.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 110.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 47 )
                                @if ($b->tinggi_badan < 89.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.3 && $b->tinggi_badan < 93.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.6 && $b->tinggi_badan <= 110.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 110.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 48 )
                                @if ($b->tinggi_badan < 89.8 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 89.8 && $b->tinggi_badan < 94.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.1 && $b->tinggi_badan <= 111.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 111.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 49 )
                                @if ($b->tinggi_badan < 90.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.3 && $b->tinggi_badan < 94.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.6 && $b->tinggi_badan <= 112.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 112.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 50 )
                                @if ($b->tinggi_badan < 90.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 90.7 && $b->tinggi_badan < 95.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.1 && $b->tinggi_badan <= 112.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 112.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 51 )
                                @if ($b->tinggi_badan < 91.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.2 && $b->tinggi_badan < 95.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.6 && $b->tinggi_badan <= 113.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 113.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 52 )
                                @if ($b->tinggi_badan < 91.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 91.7 && $b->tinggi_badan < 96.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 96.1 && $b->tinggi_badan <= 114.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 114.0 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 53 )
                                @if ($b->tinggi_badan < 92.1 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.1 && $b->tinggi_badan < 96.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 96.6 && $b->tinggi_badan <= 114.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 114.6 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 54 )
                                @if ($b->tinggi_badan < 92.6 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 92.6 && $b->tinggi_badan < 97.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 97.1 && $b->tinggi_badan <= 115.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 115.2 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 55 )
                                @if ($b->tinggi_badan < 93.0 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.0 && $b->tinggi_badan < 97.6 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 97.6 && $b->tinggi_badan <= 115.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 115.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 56 )
                                @if ($b->tinggi_badan < 93.4 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.4 && $b->tinggi_badan < 98.1 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 98.1 && $b->tinggi_badan <= 116.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 116.5 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 57 )
                                @if ($b->tinggi_badan < 93.9 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 93.9 && $b->tinggi_badan < 98.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 98.5 && $b->tinggi_badan <= 117.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 117.1 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 58 )
                                @if ($b->tinggi_badan < 94.3 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.3 && $b->tinggi_badan < 99.0 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 99.0 && $b->tinggi_badan <= 117.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 117.7 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 59 )
                                @if ($b->tinggi_badan < 94.7 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 94.7 && $b->tinggi_badan < 99.5 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 99.5 && $b->tinggi_badan <= 118.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 118.3 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @elseif ($b->umur == 60 )
                                @if ($b->tinggi_badan < 95.2 )
                                    <span class="badge badge-danger">
                                        Sangat Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 95.2 && $b->tinggi_badan < 99.9 )
                                    <span class="badge badge-warning">
                                        Pendek
                                    </span>
                                @elseif ($b->tinggi_badan >= 99.9 && $b->tinggi_badan <= 118.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->tinggi_badan > 118.9 )
                                    <span class="badge badge-danger">
                                        Tinggi
                                    </span>
                                @endif
                            @else
                            Bukan Balita Lagi
                            @endif
                        @endif

                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Lingkar kepala Anak berdasarkan Usia</h6>
            </div>
            <!-- Area Chart -->
            <div class="card-body">
                <canvas id="speedChart3" width="500" height="200"></canvas>
                @foreach($balita as $b)
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ date('d-m -Y',strtotime($b->tanggal)) }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Lingkar Kepala Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $b->berat_badan }} kg</label>
                    </div>
                    <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kondisi Tinggi Badan</label>
                    <label for="inputEmail3" class="col-form-label">:</label>
                    <label for="inputEmail3" class="col-sm-5 col-form-label">
                    @php
                    $balita2 = DB::table('balita')->where('id_balita',$b->balita_id)->first();
                        
                    @endphp
                        @if($balita2->jenis_kelamin === "L")
                            @if ($b->umur == 0)
                                @if ($b->lingkar_kepala < 31.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 31.9 && $b->lingkar_kepala <= 37.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 37.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 1)
                                @if ($b->lingkar_kepala < 34.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 34.9 && $b->lingkar_kepala <= 39.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 39.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 2)
                                @if ($b->lingkar_kepala < 36.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 36.8 && $b->lingkar_kepala <= 41.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 41.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 3)
                                @if ($b->lingkar_kepala < 38.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 38.1 && $b->lingkar_kepala <= 42.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 42.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 4)
                                @if ($b->lingkar_kepala < 39.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 39.2 && $b->lingkar_kepala <= 44.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 44.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 5)
                                @if ($b->lingkar_kepala < 40.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 40.1 && $b->lingkar_kepala <= 45.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 45.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 6)
                                @if ($b->lingkar_kepala < 40.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 40.9 && $b->lingkar_kepala <= 45.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 45.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 7)
                                @if ($b->lingkar_kepala < 41.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 41.5 && $b->lingkar_kepala <= 46.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 46.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 8)
                                @if ($b->lingkar_kepala < 42.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.0 && $b->lingkar_kepala <= 47.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 9)
                                @if ($b->lingkar_kepala < 42.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.5 && $b->lingkar_kepala <= 47.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 10)
                                @if ($b->lingkar_kepala < 42.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.9 && $b->lingkar_kepala <= 47.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 11)
                                @if ($b->lingkar_kepala < 43.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.2 && $b->lingkar_kepala <= 48.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 12)
                                @if ($b->lingkar_kepala < 43.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.5 && $b->lingkar_kepala <= 48.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 13)
                                @if ($b->lingkar_kepala < 43.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.8 && $b->lingkar_kepala <= 48.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 14)
                                @if ($b->lingkar_kepala < 44.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.0 && $b->lingkar_kepala <= 49.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 15)
                                @if ($b->lingkar_kepala < 44.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.2 && $b->lingkar_kepala <= 49.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 16)
                                @if ($b->lingkar_kepala < 44.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.4 && $b->lingkar_kepala <= 49.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 17)
                                @if ($b->lingkar_kepala < 44.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.6 && $b->lingkar_kepala <= 49.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 18)
                                @if ($b->lingkar_kepala < 44.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.7 && $b->lingkar_kepala <= 50.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 19)
                                @if ($b->lingkar_kepala < 44.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.9 && $b->lingkar_kepala <= 50.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 20)
                                @if ($b->lingkar_kepala < 45.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.0 && $b->lingkar_kepala <= 50.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 21)
                                @if ($b->lingkar_kepala < 45.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.2 && $b->lingkar_kepala <= 50.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 22)
                                @if ($b->lingkar_kepala < 45.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.3 && $b->lingkar_kepala <= 50.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 23)
                                @if ($b->lingkar_kepala < 45.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.4 && $b->lingkar_kepala <= 50.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 24)
                                @if ($b->lingkar_kepala < 45.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.5 && $b->lingkar_kepala <= 51.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 25)
                                @if ($b->lingkar_kepala < 45.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.6 && $b->lingkar_kepala <= 51.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 26)
                                @if ($b->lingkar_kepala < 45.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.8 && $b->lingkar_kepala <= 51.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 27)
                                @if ($b->lingkar_kepala < 45.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.9 && $b->lingkar_kepala <= 51.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 28)
                                @if ($b->lingkar_kepala < 46.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.0 && $b->lingkar_kepala <= 51.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 29)
                                @if ($b->lingkar_kepala < 46.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.1 && $b->lingkar_kepala <= 51.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 30)
                                @if ($b->lingkar_kepala < 46.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.1 && $b->lingkar_kepala <= 51.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 31)
                                @if ($b->lingkar_kepala < 46.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.2 && $b->lingkar_kepala <= 51.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 32)
                                @if ($b->lingkar_kepala < 46.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.3 && $b->lingkar_kepala <= 51.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 33)
                                @if ($b->lingkar_kepala < 46.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.4 && $b->lingkar_kepala <= 52.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 34)
                                @if ($b->lingkar_kepala < 46.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.5 && $b->lingkar_kepala <= 52.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 35)
                                @if ($b->lingkar_kepala < 46.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.6 && $b->lingkar_kepala <= 52.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 36)
                                @if ($b->lingkar_kepala < 46.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.6 && $b->lingkar_kepala <= 52.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 37)
                                @if ($b->lingkar_kepala < 46.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.7 && $b->lingkar_kepala <= 52.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 38)
                                @if ($b->lingkar_kepala < 46.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.8 && $b->lingkar_kepala <= 52.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 39)
                                @if ($b->lingkar_kepala < 46.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.8 && $b->lingkar_kepala <= 52.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 40)
                                @if ($b->lingkar_kepala < 46.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.9 && $b->lingkar_kepala <= 52.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 41)
                                @if ($b->lingkar_kepala < 46.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.9 && $b->lingkar_kepala <= 52.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 42)
                                @if ($b->lingkar_kepala < 47.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.0 && $b->lingkar_kepala <= 52.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 43)
                                @if ($b->lingkar_kepala < 47.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.0 && $b->lingkar_kepala <= 52.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 44)
                                @if ($b->lingkar_kepala < 47.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.1 && $b->lingkar_kepala <= 52.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 45)
                                @if ($b->lingkar_kepala < 47.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.1 && $b->lingkar_kepala <= 53.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 46)
                                @if ($b->lingkar_kepala < 47.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.2 && $b->lingkar_kepala <= 53.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 47)
                                @if ($b->lingkar_kepala < 47.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.2 && $b->lingkar_kepala <= 53.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 48)
                                @if ($b->lingkar_kepala < 47.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.3 && $b->lingkar_kepala <= 53.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 49)
                                @if ($b->lingkar_kepala < 47.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.3 && $b->lingkar_kepala <= 53.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 50)
                                @if ($b->lingkar_kepala < 47.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.4 && $b->lingkar_kepala <= 53.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 51)
                                @if ($b->lingkar_kepala < 47.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.4 && $b->lingkar_kepala <= 53.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 52)
                                @if ($b->lingkar_kepala < 47.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.5 && $b->lingkar_kepala <= 53.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 53)
                                @if ($b->lingkar_kepala < 47.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.5 && $b->lingkar_kepala <= 53.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 54)
                                @if ($b->lingkar_kepala < 47.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.5 && $b->lingkar_kepala <= 53.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 55)
                                @if ($b->lingkar_kepala < 47.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.6 && $b->lingkar_kepala <= 53.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 56)
                                @if ($b->lingkar_kepala < 47.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.6 && $b->lingkar_kepala <= 53.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 57)
                                @if ($b->lingkar_kepala < 47.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.6 && $b->lingkar_kepala <= 53.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 58)
                                @if ($b->lingkar_kepala < 47.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.7 && $b->lingkar_kepala <= 53.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 59)
                                @if ($b->lingkar_kepala < 47.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.7 && $b->lingkar_kepala <= 53.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 60)
                                @if ($b->lingkar_kepala < 47.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.7 && $b->lingkar_kepala <= 53.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 53.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                                
                            @else
                            Bukan Balita Lagi
                            @endif
                        @elseif($balita2->jenis_kelamin === "P")
                            @if ($b->umur == 0)
                                @if ($b->lingkar_kepala < 31.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 31.5 && $b->lingkar_kepala <= 36.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 36.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 1)
                                @if ($b->lingkar_kepala < 34.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 34.2 && $b->lingkar_kepala <= 28.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 28.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 2)
                                @if ($b->lingkar_kepala < 35.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 35.8 && $b->lingkar_kepala <= 40.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 40.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 3)
                                @if ($b->lingkar_kepala < 37.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 37.1 && $b->lingkar_kepala <= 42.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 42.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 4)
                                @if ($b->lingkar_kepala < 38.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 38.1 && $b->lingkar_kepala <= 43.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 43.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 5)
                                @if ($b->lingkar_kepala < 38.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 38.9 && $b->lingkar_kepala <= 44.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 44.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 6)
                                @if ($b->lingkar_kepala < 39.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 39.6 && $b->lingkar_kepala <= 44.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 44.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 7)
                                @if ($b->lingkar_kepala < 40.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 40.2 && $b->lingkar_kepala <= 45.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 45.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 8)
                                @if ($b->lingkar_kepala < 40.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 40.7 && $b->lingkar_kepala <= 46.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 46.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 9)
                                @if ($b->lingkar_kepala < 41.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 41.2 && $b->lingkar_kepala <= 46.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 46.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 10)
                                @if ($b->lingkar_kepala < 41.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 41.5 && $b->lingkar_kepala <= 46.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 46.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 11)
                                @if ($b->lingkar_kepala < 41.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 41.9 && $b->lingkar_kepala <= 47.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 12)
                                @if ($b->lingkar_kepala < 42.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.2 && $b->lingkar_kepala <= 47.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 13)
                                @if ($b->lingkar_kepala < 42.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.4 && $b->lingkar_kepala <= 47.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 47.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 14)
                                @if ($b->lingkar_kepala < 42.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.7 && $b->lingkar_kepala <= 48.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 15)
                                @if ($b->lingkar_kepala < 42.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 42.9 && $b->lingkar_kepala <= 48.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 16)
                                @if ($b->lingkar_kepala < 43.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.1 && $b->lingkar_kepala <= 48.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 17)
                                @if ($b->lingkar_kepala < 43.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.3 && $b->lingkar_kepala <= 48.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 48.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 18)
                                @if ($b->lingkar_kepala < 43.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.5 && $b->lingkar_kepala <= 49.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 19)
                                @if ($b->lingkar_kepala < 43.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.6 && $b->lingkar_kepala <= 49.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 20)
                                @if ($b->lingkar_kepala < 43.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 43.8 && $b->lingkar_kepala <= 49.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 21)
                                @if ($b->lingkar_kepala < 44.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.0 && $b->lingkar_kepala <= 49.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 22)
                                @if ($b->lingkar_kepala < 44.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.1 && $b->lingkar_kepala <= 49.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 23)
                                @if ($b->lingkar_kepala < 44.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.3 && $b->lingkar_kepala <= 49.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 49.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 24)
                                @if ($b->lingkar_kepala < 44.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.4 && $b->lingkar_kepala <= 50.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 25)
                                @if ($b->lingkar_kepala < 44.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.5 && $b->lingkar_kepala <= 50.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 26)
                                @if ($b->lingkar_kepala < 44.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.7 && $b->lingkar_kepala <= 50.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 27)
                                @if ($b->lingkar_kepala < 44.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.8 && $b->lingkar_kepala <= 50.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 28)
                                @if ($b->lingkar_kepala < 44.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 44.9 && $b->lingkar_kepala <= 50.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 29)
                                @if ($b->lingkar_kepala < 45.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.0 && $b->lingkar_kepala <= 50.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 30)
                                @if ($b->lingkar_kepala < 45.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.1 && $b->lingkar_kepala <= 50.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 31)
                                @if ($b->lingkar_kepala < 45.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.2 && $b->lingkar_kepala <= 50.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 50.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 32)
                                @if ($b->lingkar_kepala < 45.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.3 && $b->lingkar_kepala <= 51.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 33)
                                @if ($b->lingkar_kepala < 45.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.4 && $b->lingkar_kepala <= 51.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 34)
                                @if ($b->lingkar_kepala < 45.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.5 && $b->lingkar_kepala <= 51.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 35)
                                @if ($b->lingkar_kepala < 45.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.6 && $b->lingkar_kepala <= 51.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 36)
                                @if ($b->lingkar_kepala < 45.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.7 && $b->lingkar_kepala <= 51.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 37)
                                @if ($b->lingkar_kepala < 45.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.8 && $b->lingkar_kepala <= 51.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 38)
                                @if ($b->lingkar_kepala < 45.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.8 && $b->lingkar_kepala <= 51.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 39)
                                @if ($b->lingkar_kepala < 45.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 45.9 && $b->lingkar_kepala <= 51.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 40)
                                @if ($b->lingkar_kepala < 46.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.0 && $b->lingkar_kepala <= 51.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 41)
                                @if ($b->lingkar_kepala < 46.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.1 && $b->lingkar_kepala <= 51.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 42)
                                @if ($b->lingkar_kepala < 46.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.1 && $b->lingkar_kepala <= 51.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 43)
                                @if ($b->lingkar_kepala < 46.2 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.2 && $b->lingkar_kepala <= 51.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 44)
                                @if ($b->lingkar_kepala < 46.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.3 && $b->lingkar_kepala <= 51.9 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 51.9 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 45)
                                @if ($b->lingkar_kepala < 46.3 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.3 && $b->lingkar_kepala <= 52.0 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.0 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 46)
                                @if ($b->lingkar_kepala < 46.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.4 && $b->lingkar_kepala <= 52.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 47)
                                @if ($b->lingkar_kepala < 46.4 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.4 && $b->lingkar_kepala <= 52.1 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.1 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 48)
                                @if ($b->lingkar_kepala < 46.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.5 && $b->lingkar_kepala <= 52.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 49)
                                @if ($b->lingkar_kepala < 46.5 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.5 && $b->lingkar_kepala <= 52.2 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.2 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 50)
                                @if ($b->lingkar_kepala < 46.6 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.6 && $b->lingkar_kepala <= 52.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 51)
                                @if ($b->lingkar_kepala < 46.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.7 && $b->lingkar_kepala <= 52.3 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.3 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 52)
                                @if ($b->lingkar_kepala < 46.7 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.7 && $b->lingkar_kepala <= 52.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 53)
                                @if ($b->lingkar_kepala < 46.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.8 && $b->lingkar_kepala <= 52.4 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.4 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 54)
                                @if ($b->lingkar_kepala < 46.8 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.8 && $b->lingkar_kepala <= 52.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 55)
                                @if ($b->lingkar_kepala < 46.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.9 && $b->lingkar_kepala <= 52.5 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.5 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 56)
                                @if ($b->lingkar_kepala < 46.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.9 && $b->lingkar_kepala <= 52.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 57)
                                @if ($b->lingkar_kepala < 46.9 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 46.9 && $b->lingkar_kepala <= 52.6 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.6 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 58)
                                @if ($b->lingkar_kepala < 47.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.0 && $b->lingkar_kepala <= 52.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 59)
                                @if ($b->lingkar_kepala < 47.0 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.0 && $b->lingkar_kepala <= 52.7 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.7 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                            @elseif ($b->umur == 60)
                                @if ($b->lingkar_kepala < 47.1 )
                                    <span class="badge badge-danger">
                                        Mikrosefali
                                    </span>
                                @elseif ($b->lingkar_kepala >= 47.1 && $b->lingkar_kepala <= 52.8 )
                                    <span class="badge badge-success">
                                        Normal
                                    </span>
                                @elseif ($b->lingkar_kepala > 52.8 )
                                    <span class="badge badge-danger">
                                        Makrosefali
                                    </span>
                                @endif
                                
                            @else
                            Bukan Balita Lagi
                            @endif
                        @endif

                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>


    <table  style="float:right;">
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


    


    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        var speedCanvas = document.getElementById("speedChart1");
        
        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;
        
        var speedData = {
          labels: ["0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15",
           "16", "17", "18", "19", "20", "21", "22", "23", "24","25","26","27","28","29","30","31",
           "32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49",
           "50","51","52","53","54","55","56","57","58","59","60"],
          datasets: [{
            label: "Grafik Berat Badan",
            data: [
                @foreach($p as $b)
                {{ $b->berat_badan }},
                @endforeach
            ],
            fill: false
          }]
        };
        
        var chartOptions = {
          legend: {
            display: true,
            position: 'top',
            labels: {
              boxWidth: 80,
              fontColor: 'black'
            }
          }
        };
        
        var lineChart = new Chart(speedCanvas, {
          type: 'line',
          data: speedData,
          options: chartOptions
        });
        
          </script>

<script>
    var speedCanvas = document.getElementById("speedChart2");
    
    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;
    
    var speedData = {
      labels: ["0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15",
           "16", "17", "18", "19", "20", "21", "22", "23", "24","25","26","27","28","29","30","31",
           "32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49",
           "50","51","52","53","54","55","56","57","58","59","60"],
      datasets: [{
        label: "Grafik Tinggi Badan",
        data: [
            @foreach($p as $b)
            {{ $b->tinggi_badan }} ,
            @endforeach
        ],
        fill: false
      }]
    };
    
    var chartOptions = {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 80,
          fontColor: 'black'
        }
      }
    };
    
    var lineChart = new Chart(speedCanvas, {
      type: 'line',
      data: speedData,
      options: chartOptions
    });
    
      </script>


<script>
    var speedCanvas = document.getElementById("speedChart3");
    
    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;
    
    var speedData = {
      labels: ["0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15",
           "16", "17", "18", "19", "20", "21", "22", "23", "24","25","26","27","28","29","30","31",
           "32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49",
           "50","51","52","53","54","55","56","57","58","59","60"],
      datasets: [{
        label: "Grafik Lingkar Kepala",
        data: [
            @foreach($p as $b)
            {{ $b->lingkar_kepala }},
            @endforeach
        ],
        fill: false
      }]
    };
    
    var chartOptions = {
      legend: {
        display: true,
        position: 'top',
        labels: {
          boxWidth: 80,
          fontColor: 'black'
        }
      }
    };
    
    var lineChart = new Chart(speedCanvas, {
      type: 'line',
      data: speedData,
      options: chartOptions
    });
    
      </script>


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
