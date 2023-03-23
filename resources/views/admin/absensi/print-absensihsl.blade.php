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
@include('admin/include/headerlap')

<div class="cetak">
<h1 style="text-align: center;">ABSENSI KULIAH</h1>
<table style="border:none" width='1408'  cellpadding='0' cellspacing='0' >
<tr>
<td style="border:none" width='400'><?php echo $jadwal->TahunID ?></td>           
<td style="border:none" width='100'><?php echo $jadwal->Nama ?></td> 
</tr>

<tr style="border:none">
<td style="border:none"><?php echo $jadwal->Nama ?></td>             
<td style="border:none"><?php echo substr($jadwal->JamMulai,0,5) ?> - <?php echo substr($jadwal->JamSelesai,0,5) ?></td> 
</tr>

<tr style="border:none">
<td style="border:none"><?php echo $jadwal->MKKode ?> - <?php echo $jadwal->NamaMK ?>  <?php echo $jadwal->SKS ?> SKS) - <?php echo $jadwal->NamaKelas ?>  - Semester <?php echo $jadwal->Sesi  ?></td>             
<td style="border:none"><?php echo $jadwal->Nama ?></td> 
</tr>


<tr style="border:none">
<td style="border:none"><?php echo $jadwal->DosenID ?> - <?php echo $jadwal->NamaDosen ?>, <?php echo $jadwal->Gelar ?></td>             
<td style="border:none">&nbsp;</td> 
</tr>

</table>
<br>

<table class="printer">
  <tr><th rowspan="2" style='vertical-align:middle;text-align:center;width:20px;font-weight:bold'>No.</th>
  <th rowspan="2" style='vertical-align:middle;text-align:center;width:100px;font-weight:bold'>NIM</th>
  <th rowspan="2" style='vertical-align:middle;text-align:center;width:230px;font-weight:bold'>NAMA MAHASISWA</th>
  <th colspan='16' style='vertical-align:middle;text-align:center;font-weight:bold'>PERTEMUAN KE</th></tr>
  <tr>

  <th style="text-align:center">1</th>
  <th style="text-align:center">2</th>
  <th style="text-align:center">3</th>
  <th style="text-align:center">4</th>
  <th style="text-align:center">5</th>
  <th style="text-align:center">6</th>
  <th style="text-align:center">7</th>
  <th style="text-align:center">8</th>
  <th style="text-align:center">9</th>
  <th style="text-align:center">10</th>
  <th style="text-align:center">11</th>
  <th style="text-align:center">12</th>
  <th style="text-align:center">13</th>
  <th style="text-align:center">14</th>
  <th style="text-align:center">15</th>
  <th style="text-align:center">16</th>
  </tr>
 <?php   
  $krs = DB::table('krs')
	->join('mhsw','mhsw.MhswID','=','krs.MhswID','LEFT OUTER')
  ->join('jadwal','jadwal.JadwalID','=','krs.JadwalID','LEFT OUTER')
  ->join('presensi','presensi.JadwalID','=','jadwal.JadwalID','LEFT OUTER')
  ->join('presensimhsw','presensimhsw.PresensiID','=','presensi.PresensiID','LEFT OUTER')
	->join('jenispresensi','jenispresensi.JenisPresensiID','=','presensimhsw.JenisPresensiID','LEFT OUTER')
  ->select('krs.*','jadwal.Kehadiran','jadwal.MKKode','jadwal.Nama as NamaMK','jadwal.NamaKelas','jadwal.JenisJadwalID',
  'jadwal.TahunID','mhsw.Nama as NamaMhs','presensi.Pertemuan','presensi.PresensiID','presensimhsw.JenisPresensiID','jenispresensi.Nilai')
	->where('krs.JadwalID',$jadwal->JadwalID)
	->groupBy('krs.JadwalID')
	->groupBy('krs.MhswID')
  ->orderBy('krs.MhswID','ASC')
	->get();

	// $sq = mysqli_query($koneksi, "SELECT krs.*, jadwal.Kehadiran,
	// jadwal.MKKode, jadwal.Nama AS NamaMK, jadwal.NamaKelas, jadwal.JenisJadwalID,jadwal.TahunID,
	// mhsw.Nama as NamaMhs,
	// presensi.Pertemuan,presensi.PresensiID,
	// presensimhsw.JenisPresensiID,
	// jenispresensi.Nilai
	// FROM krs
	// LEFT OUTER JOIN jadwal ON krs.JadwalID=jadwal.JadwalID	
	// LEFT OUTER JOIN presensi ON jadwal.JadwalID=presensi.JadwalID
	// LEFT OUTER JOIN presensimhsw ON presensi.PresensiID=presensimhsw.PresensiID	
	// LEFT OUTER JOIN jenispresensi ON jenispresensi.JenisPresensiID=presensimhsw.JenisPresensiID			
	// LEFT OUTER JOIN mhsw ON mhsw.MhswID=krs.MhswID
	// WHERE krs.JadwalID='".strfilter($_GET[JadwalID])."'
	// AND jadwal.TahunID='".strfilter($_GET[tahun])."'
	// GROUP BY krs.JadwalID,krs.MhswID order by krs.MhswID asc");  
  $no=0;  
  foreach ($krs as $row){
    $no++;
    $NamaMhsx	= strtolower($row->NamaMhs);
    $NamaMhs	= ucwords($NamaMhsx);
    ?>
      <tr>
      <td style="text-align:center"><?php echo $no ?></td>
      <td style="text-align:center"><?php echo $row->MhswID ?></td>
      <td><?php echo $NamaMhs ?></td>
      <?php
      $p1 = DB::table('presensimhsw')->where('MhswID',$row->MhswID)->where('JadwalID',$jadwal->JadwalID)->get();
      foreach($p1 as $w){ 
        $nm = DB::table('jenispresensi')->where('JenisPresensiID',$w->JenisPresensiID)->first();
        echo"<td style='text-align:center'>$w->JenisPresensiID - $nm->Nilai</td>";
      }
      ?>
	    </tr>
     <?php   
      }
    ?>
<tr>
	<td height='20'></td>
	<td></td>
	<td>Tanggal&nbsp;</td>
  <?php
    //$p1 = mysqli_query($koneksi, "SELECT * from presensi where  JadwalID='".strfilter($_GET[JadwalID])."'");
    $p1 = DB::table('presensi')->where('JadwalID',$jadwal->JadwalID)->get();
    foreach($p1 as $w){  
		//$nm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from jenispresensi where JenisPresensiID='$w[JenisPresensiID]'"));
		echo"<td style='text-align:center'><b style='font-size:9px'>".date('d-m-y',strtotime($w->Tanggal))."</b></td>";
  }
  ?>
</tr>

<tr>
	<td height='20' ></td>
	<td ></td>
	<td>Paraf Dosen&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>
	<td  >&nbsp;</td>              
</tr>
</table>
<br>

<table style="border:none">
<tr style="border:none">
	<td style="border:none">Keterangan</td>           
</tr>
<tr style="border:none">
	<td style="border:none" width="20">H</td><td style="border:none"> : Hadir (1)</td>           
</tr>
<tr>
	<td style="border:none">S</td><td style="border:none"> : Sakit (1)</td>           
</tr>
<tr style="border:none">
	<td style="border:none">I</td><td style="border:none"> : Ijin (1)</td>           
</tr>
<tr style="border:none">
	<td style="border:none">M</td><td style="border:none"> : Mangkir (0)</td>           
</tr>
</table>


<br>
<table style="border:none">
<tr style="border:none">
<td style="border:none" width="800">&nbsp;</td>
<td style="border:none">Pekanbaru, <?php echo date('d-m-Y') ?>  <br>Dosen Pengampu</td>
</tr>

<tr style="border:none">
  <td style="border:none"></td>
  <td style="border:none" >&nbsp;</td>
</tr>

<tr style="border:none">
  <td style="border:none"></td>
  <td style="border:none" >&nbsp;</td>
</tr>



<tr style="border:none">
<td style="border:none"></td>
<td style="border:none"><?php echo $jadwal->NamaDosen ?>, <?php echo $jadwal->Gelar ?></td>
</tr>
</table>
<br>
<br>
<br>
<br>
<table style="border:none">
<tr style='border:none'>

<td style='border:none' width='800'><b style='font-size:10px;font-weight:reguler;'>Login by: <?php echo Session()->get('username') ?> - <?php echo (date('d-m-Y'))." ".date('H:i:s') ?>  WIB - STMIK HTP Support System</b></td>
</tr>
</table>

	</div>
</body>
</html>