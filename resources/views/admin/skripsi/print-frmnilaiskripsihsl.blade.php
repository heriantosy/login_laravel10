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
<?php
$dt = DB::table('jadwal_skripsi')
->join('mhsw','mhsw.MhswID','=','jadwal_skripsi.MhswID')
->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
->where('jadwal_skripsi.JadwalID',$jadwal->JadwalID)
->first();
$ProdiID   = $dt->ProdiID;

if ($ProdiID=='SI'){ $prod="Sistem Informasi"; $kaprodi="Herianto, M.Kom";}else{ $prod="Teknik Informatika"; $kaprodi="Yuda Irawan, S.Kom, M.TI";}
echo"<table style='border:none'>
<tr style='border:none'>
<td align='center'><b>FORMULIR PENILAIAN  SIDANG SKRIPSI DAN COMPREHENSIVE</b></td>
</tr>
<tr style='border:none'>
<td align='center'>Program Studi: $prod</td>
</tr>
</table>
<br>
<br>";

// $sql= mysqli_query($koneksi, "SELECT * FROM vw_jadwal_skripsi_ujian where JadwalID='".strfilter($_GET->JadwalID])."'");
// while($dt=mysqli_fetch_array($sql)){

echo" 
<table style='border:none'>
  <tr style='border:none'>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none' width='4'>&nbsp;</td>
  </tr >
  <tr style='border:none'>
    <td style='border:none' width='45'>&nbsp;</td>
    
    <td style='border:none' width='189'>Nama</td>
    <td style='border:none' width='13'>:</td>
    <td style='border:none' width='449'> $dt->NamaMhs</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' width='45'>&nbsp;</td>
   
    <td style='border:none' width='189'>NIM</td>
    <td style='border:none' width='13'>:</td>
    <td style='border:none' width='449'>$dt->MhswID</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' width='45'>&nbsp;</td>
   
    <td style='border:none' width='189'>Program Studi</td>
    <td style='border:none' width='13'>:</td>
    <td style='border:none' width='449'> $prod</td>
  </tr>
</table>

<br>
<table width='0' border='0.1' cellpadding='0' cellspacing='0' align='center'>
  <tr style='background-color:#E6E6E6'>
    <td width='41' height='25' align=center>No</td>
    <td width='250'>Kriteria Penilaian</td>
    <td width='100' align=center >Bobot (%)</td>
    <td width='100' align=center>Nilai</td>
    <td width='100' align=center>Bobot x Nilai</td>
  </tr>
  
  <tr>
    <td width='41' height='20' align=center>1.</td>
    <td>Konsultasi/Bimbingan Skripsi</td>
    <td width='100' align=center>10%</td>
    <td width='100'>&nbsp;</td>
    <td width='100'>&nbsp;</td>
  </tr>
  
  <tr>
    <td height='20' align=center>2.</td>
    <td >Presentasi + Demo Program</td>
    <td align=center>15%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  
   <tr>
    <td height='20' align=center>3.</td>
    <td >Penulisan</td>
    <td align=center>20%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  
   <tr>
     <td height='20' align=center>4.</td>
     <td >Penguasaan Materi</td>
     <td align=center>30%</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
   </tr>
   <tr>
    <td height='20' align=center>5.</td>
    <td >Penguasaan Program</td>
    <td align=center>15%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
   <tr>
    <td height='20' align=center>6.</td>
    <td >Attitude/Sikap Saat Sidang</td>
    <td align=center>10%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
   <tr>
     <td height='20' colspan='2' align=right> Total &nbsp;</td>
     <td align=center>100%</td>
   </tr>
</table>

<br>";
//}
echo"<br>
<br>
<table style='border:none'>
<tr>
<td style='border:none' width='423' align='center'>&nbsp;</td>
<td style='border:none' width='367' align='left'>Pekanbaru, ".date('d-m-Y')."</td>
</tr>

<tr>
  <td style='border:none' style='border:none' align='left'></td>
  <td style='border:none' style='border:none' align='left' >Penguji I / II / III</td>
</tr>

<tr>
  <td style='border:none' style='border:none' style='border:none' align='left'></td>
  <td style='border:none' style='border:none' style='border:none' align='left' >&nbsp;</td>
</tr>
<tr>
  <td style='border:none' align='left'></td>
  <td style='border:none' align='left' >&nbsp;</td>
</tr>

<tr>
  <td style='border:none' align='left'></td>
  <td style='border:none' align='left' >&nbsp;</td>
</tr>

<tr style='border:none'>
<td style='border:none' align='left'></td>
<td style='border:none' align='left'>------------------------------------------</td>
</tr>
</table>

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
<table style='border:none' border=0>
<tr>
<td style='border:none' width='300'><font style='font-size:8px'>Login by:  ".Session()->get('username')." ".(date('d-m-Y'))." ".date('H:i:s') . " WIB - STMIK HTP Support System</font></td>
</tr>
</table>";

?>	