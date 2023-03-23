<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="{{ asset('public/css/print.css') }}" media="print">
	<link rel="stylesheet" href="{{ asset('public/css/print.css') }}" media="screen">
  <link href="{{ asset('public/admin/vendor/fontawesome-free/css/all.min.css') }}" media="print" rel="stylesheet" type="text/css">
  <link href="{{ asset('public/admin/vendor/fontawesome-free/css/all.min.css') }}" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="cetak">
		<h1 style="text-align: center;">ABSENSI KULIAH</h1>
    <table class="printer">
  <thead>
    <tr class="bg-info">
      <th>INSTITUSI</th>
      <th width="50%">KULIAH</th>
    </tr>
  </thead>

  <?php
  $prodix = str_replace(".","",$jadwal->ProdiID);
  $prd = DB::table('prodi')->where('ProdiID',$prodix)->first();
  $dosen = DB::table('dosen')->where('Login',$jadwal->DosenID)->first();

  ?>

  <tbody>
    <tr>
      <td>
        <strong><?php echo strtoupper($site->Nama) ?></strong>
              <br><?php echo nl2br($site->Alamat1) ?>
                <br>Telepon: <?php echo $site->Telepon ?>
                <br>Email: <?php echo $site->Email ?>
                <br>Website: <?php echo $site->Website ?>
                <br>NoAkta: <?php echo $site->NoAkta ?>
      </td>
      <td>
        <strong><?php echo strtoupper($jadwal->NamaDosen) ?>, <?php echo $jadwal->Gelar ?></strong>
          <br><?php echo nl2br($prd->Nama) ?>
          <br>Thn Akademik: <?php echo $jadwal->TahunID ?> 
          <br>Matakuliah: <?php echo $jadwal->NamaMK ?> ( <?php echo $jadwal->SKS ?> SKS)
          <br>Nama Kelas: <?php echo $jadwal->NamaKelas ?>
          <br>Waktu: <?php echo substr($jadwal->JamMulai,0,5) ?> - <?php echo substr($jadwal->JamSelesai,0,5) ?> WIB
      </td>
    </tr>
  </tbody>
</table>
<br>
    <?php 
    echo"<table border='1'>
    <tr><td rowspan='2' style='vertical-align:middle;text-align:center;width:20px;font-weight:bold'>No.</td>
    <td rowspan='2' style='vertical-align:middle;text-align:center;width:100px;font-weight:bold'>NIM</td>
    <td rowspan='2' style='vertical-align:middle;text-align:center;width:230px;font-weight:bold'>NAMA MAHASISWA</td>
    <td colspan='16' style='vertical-align:middle;text-align:center;font-weight:bold'>PERTEMUAN KE</td></tr>
    <tr>
  
    <th align='center'>1</th>
    <th align='center'>2</th>
    <th align='center'>3</th>
    <th align='center'>4</th>
    <th align='center'>5</th>
    <th align='center'>6</th>
    <th align='center'>7</th>
    <th align='center'>8</th>
    <th align='center'>9</th>
    <th align='center'>10</th>
    <th align='center'>11</th>
    <th align='center'>12</th>
    <th align='center'>13</th>
    <th align='center'>14</th>
    <th align='center'>15</th>
    <th align='center'>16</th>
    </tr>";
    
    $krs = DB::table('krs')
    ->join('mhsw','mhsw.MhswID','=','krs.MhswID')
    ->select('krs.JadwalID','krs.MhswID','mhsw.Nama as NamaMhs')
    ->where('krs.JadwalID',$jadwal->JadwalID)
    ->orderBy('krs.MhswID','ASC')
    ->get();
    ?>
    @foreach ($krs as $row){
    <?php
     	$NamaMhsx	= strtolower($row->NamaMhs);
      $NamaMhs	= ucwords($NamaMhsx);
    ?>
      <tr>
      <td style='text-align:center'>{{ $loop->index+1 }}</td>
    <?php  
      echo"<td style='text-align:center'>$row->MhswID</td>
      <td>$NamaMhs</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      </tr>";
      ?>

      @endforeach
<?php
    echo"</table>";
    ?>
<br>
<br>      
<table class="printer">
  <thead>
    <tr class="bg-info">
      <th>MENGETAHUI</th>
      <th width="50%">Pekanbaru, <?php echo date('d-m-Y')?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
         Ketua Program Studi
         <br>
         <br> 
         <br>{{ $prd->Pejabat }}, {{ $prd->Gelar }}
      </td>
      <td>
        Dosen Pengampu
         <br> 
         <br>
         <br>{{ $dosen->Nama }}, {{ $dosen->Gelar }}
      </td>
    </tr>
  </tbody>
</table>

	</div>
</body>
</html>