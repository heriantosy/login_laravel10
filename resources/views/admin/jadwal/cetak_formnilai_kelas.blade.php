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

@include('admin/include/headerlap')
<?php
  $NamaDosenx		= strtolower($jadwal->NamaDosen); 
  $NamaDosen		= ucwords($NamaDosenx);
  $NamaMKx	    = strtolower($jadwal->NamaMK); 
  $NamaMK		    = ucwords($NamaMKx);
  
  if($jadwal->ProdiID='.SI.'){
    $NamaProdi ="Sistem Informasi";
  }else{
    $NamaProdi ="Teknik Informatika";
  }
?>

<table class="printer" style="text-align:center;border:none" >
<tr style="text-align:center;border:none">
<th colspan="14" style="text-align:center;border:none;background:#e6e4df"><b>LEMBAR PENILAIAN</b></th>
</tr>
</table>     
<br>
<table style="text-align:center;border:none">

<tr style="border:none">
<td style="border:none" colspan=2>Dosen</td>       <td style="border:none" colspan=7>: <?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?></td> <td style="border:none" colspan=2>Program Studi</td>	<td style="border:none" colspan=3>: <?php echo $NamaProdi ?></td> 
</tr>

<tr style="border:none">
<td style="border:none" colspan=2 >Matakuliah</td> <td style="border:none" colspan=7>: <?php echo $NamaMK ?>  (<?php echo $jadwal->SKS ?> SKS)</td><td style="border:none" colspan=2>Tahun Akademik</td> <td style="border:none" colspan=3>: <?php echo $jadwal->TahunID ?></td>
</tr>

<tr style="border:none">
<td style="border:none" colspan=2>Kelas </td>      <td style="border:none" colspan=7 >: <?php echo $jadwal->NamaKelas ?></td><td style="border:none" colspan=2>Semester</td>		<td style="border:none" colspan=3>: <?php echo $jadwal->Sesi ?></td> 
</tr>
</table>
<br>

<table class="printer">
<tr >
  <th width='30' rowspan='3' style="text-align:center;vertical-align:middle;"> NO.</th>
  <th width='80' rowspan='3' style="text-align:center;vertical-align:middle;">NIM</th>
  <th width='150' rowspan='3' style="text-align:center;vertical-align:middle;">NAMA MAHASISWA</th>
  <th height='15' colspan='11' style="text-align:center">NILAI</th>
  </tr>
<tr >
  <th height='15' colspan='6' style="text-align:center">TUGAS</th>
  <th width='40' rowspan='2' style="text-align:center;vertical-align:middle;">Pres</th>
  <th width='40' rowspan='2' style="text-align:center;vertical-align:middle;">UTS</th>
  <th width='40' rowspan='2' style="text-align:center;vertical-align:middle;">UAS</th>
  <th width='40' colspan="2" style="text-align:center">Nilai Akhir</th>
  </tr>
<tr >
<th width='40' height='15' style="text-align:center">1</th>
<th width='40' style="text-align:center">2</th>
<th width='40' style="text-align:center">3</th>
<th width='40' style="text-align:center">4</th>
<th width='40' style="text-align:center">5</th>
<th width='40' style="text-align:center">R</th>
<th width='40'  style="text-align:center">Nilai</th>
<th width='40'  style="text-align:center">Grade</th>
</tr>

<tr>
  <th height='15' style="text-align:center">&nbsp;</td>
  <th style="text-align:center">&nbsp;</td>
  <th>&nbsp;</td>
  <th style="text-align:center" >&nbsp;</th>
  <th style="text-align:center" >&nbsp;</th>
  <th style="text-align:center" >&nbsp;</th>
  <th style="text-align:center" >&nbsp;</th>
  <th style="text-align:center" >&nbsp;</th>
  <th style="text-align:center" >25%</th>
  <th style="text-align:center" >15%</th>
  <th style="text-align:center" >25%</th>
  <th style="text-align:center" >35%</th>
  <th style="text-align:center" ></th>
  <th style="text-align:center" ></th>
</tr>
<?php 
$no=0;
foreach($krs as $r){
  $no++;
  $NamaMhsx		= strtolower($r->NamaMhs); 
  $NamaMhs		= ucwords($NamaMhsx);
?>
<tr>
	<td height='25' style="text-align:center"> <?php echo $no ?></td>
	<td style="text-align:center" ><?php echo $r->MhswID ?></td>
	<td ><?php echo $NamaMhs ?> </td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" >&nbsp;</td>
  </tr>
<?php
}
?>
</table>
<br>

<table style="border:none">
<tr style="border:none">
<td width="30%" style="border:none">
<table style="text-align:center">
<tr>
  <td width='27' style="text-align:center"><b>No</b></td>
  <td width='96' style="text-align:center"><b>Range Nilai<br> (0-100)</b></td>
  <td width='78' style="text-align:center"><b>Nilai Huruf<br> (Markah)</b></td>
  </tr>

<tr>
  <td style="text-align:center">1</td>
  <td style="text-align:center">85 - 100</td>
  <td style="text-align:center">A</td>
  </tr>

<tr>
  <td style="text-align:center">2</td>
  <td style="text-align:center">80 - 84.99</td>
  <td style="text-align:center">A-</td>
  </tr>



<tr>
  <td style="text-align:center">3</td>
  <td style="text-align:center">75 - 79.99</td>
  <td style="text-align:center">B+</td>
  </tr>

<tr>
  <td style="text-align:center">4</td>
  <td style="text-align:center">70 - 74.99</td>
  <td style="text-align:center">B</td>
  </tr>
<tr>
  <td style="text-align:center">5</td>
  <td style="text-align:center">65 - 69.00</td>
  <td style="text-align:center">B-</td>
  </tr>
<tr>
  <td style="text-align:center">6</td>
  <td style="text-align:center">60 - 64.99</td>
  <td style="text-align:center">C+</td>
  </tr>
  <tr>
  <td style="text-align:center">7</td>
  <td style="text-align:center">55 - 59.99</td>
  <td style="text-align:center">C</td>
  </tr>
  <tr>
  <td style="text-align:center">8</td>
  <td style="text-align:center">50 - 54.99</td>
  <td style="text-align:center">C-</td>
  </tr>
  <tr>
  <td style="text-align:center">9</td>
  <td style="text-align:center">40 - 49.99</td>
  <td style="text-align:center">D</td>
  </tr>
  <tr>
  <td style="text-align:center">10</td>
  <td style="text-align:center">0 - 39.99</td>
  <td style="text-align:center">E</td>
  </tr>

</table>
</td>

<td width="30%" style="border:none">
<table style="text-align:center;border:none">
<tr style="border:none">
<td colspan="3" style="text-align:left;border:none"><b>Penilaian</b></td>
</tr>
<tr>
<td style="text-align:left;border:none">Tugas</td>
<td style="text-align:left;border:none" width="1">:</td>
<td style="text-align:left;border:none">25%</td>
</tr>

<tr>
<td style="text-align:left;border:none">UTS</td>
<td style="text-align:left;border:none">:</td>
<td style="text-align:left;border:none">25%</td>
</tr>

<tr>
<td style="text-align:left;border:none">UAS</td>
<td style="text-align:left;border:none">:</td>
<td style="text-align:left;border:none">35%</td>
</tr>

<tr>
<td style="text-align:left;border:none">Kehadiran</td>
<td style="text-align:left;border:none">:</td>
<td style="text-align:left;border:none">15%</td>
</tr>

<tr>
<td colspan="3" style="text-align:left;border:none"><b>================</b></td>
</tr>


<tr>
<td style="text-align:left;border:none">Total</td>
<td style="text-align:left;border:none">:</td>
<td style="text-align:left;border:none">100%</td>
</tr>
</table>

</td>



<td style="border:none">
<table style="text-align:left;border:none">
<tr style="text-align:left;border:none">
<td width='27' style="text-align:left;border:none">
<b>Pekanbaru, <?php echo date('d-m-Y') ?>
<br>Program Studi <?php echo $NamaProdi ?>
<br>Dosen Pengampu 
<br>
<br>
<br>
<br>

<br><?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?>
<br>NIDN: <?php echo $jadwal->NIDN ?>
</td>
 
  </tr>



</table>
</td>
</tr>
</table>



</div>
</body>
</html>