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

<style >
    body {
      font: normal 15px Verdana, Arial, sans-serif; 
    }
    .garis_tepi0 {
      border:  2px dotted #FF8533;
      width:auto;
      margin:auto;
    }
    .garis_tepi {
      border:  2px dashed #FF8533;
      width:auto;
      margin:auto;
    }

    table {
        border-collapse: collapse;
    }
    thead > tr{
      background-color: #0070C0;
      color:#f1f1f1;
    }
    thead > tr > th{
      background-color: #0070C0;
      color:#fff;
      padding: 1px;
      border-color: #fff;
    }
    th, td {
      padding: 1px;
    }

    th {
        color: #222;
    }
    body{
      font-family:Calibri;
      font-size:12px;
    }
  </style>
  </head>

  <body onload="window.print();">

@include('admin/kop_laporan/kop_lap')

<div class="cetak">
<br>
<table class="printer" width="100%">
<tr>
<td align='center'><b>FORM PENILAIAN SEMINAR HASIL KERJA PRAKTEK</b></td>
</tr>
<tr>
<td align='center'></td>
</tr>
</table>
<br>

<?php
  $nob = 0;
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
	$nob++;
	$nama 		  = $data->NamaMhs;
	$namax 		  = strtolower($nama);
	$nama_kecil = ucwords($namax);	
	$prodi 		  = $data->ProdiID;

?>

<table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
<tr>
<td width='60'>Nama</td>
<td width='5'>:</td>       
<td width='580'><?php echo $nama_kecil ?></td>           
</tr>

<tr>
<td>NIM</td>
<td>:</td>            
<td ><?php echo $data->MhswID ?></td>             
</tr>
</table>
<br>

<table width='100%' border='1' cellpadding='0' cellspacing='0' align='center'>
  <tr style='background-color:#E6E6E6'>
    <td width='41' height='25' align=center>No</td>
    <td width='27'>&nbsp;</td>
    <td width='250'>Komponen Penilaian</td>
    <td width='100' align=center >Bobot (%)</td>
    <td width='100' align=center>Nilai</td>
    <td width='100' align=center>Bobot x Nilai</td>
  </tr>
  
  <tr>
    <td width='41' height='15' align=center>1.</td>
    <td colspan='2'>Format Penulisan</td>
    <td width='100'>&nbsp;</td>
    <td width='100'>&nbsp;</td>
    <td width='100'>&nbsp;</td>
  </tr>
  
  <tr>
    <td height='15'>&nbsp;</td>
    <td align=center>a.</td>
    <td >Penggunaan Bahasa Indonesia yang benar</td>
    <td align=center>10%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  
   <tr>
    <td height='15'>&nbsp;</td>
    <td align=center >b.</td>
    <td >Sesuai dengan Format Penulisan</td>
    <td align=center>10%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  
   <tr>
     <td height='15'>&nbsp;</td>
     <td align=center>c.</td>
     <td >Daftar Pustaka</td>
     <td align=center>10%</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
   </tr>
   <tr>
    <td height='15' align=center>2.</td>
    <td >&nbsp;</td>
    <td >Sikap (Attitude)</td>
    <td align=center>30%</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
   <tr>
     <td height='15' align=center>3.</td>
     <td >&nbsp;</td>
     <td >Penguasaan Materi</td>
     <td align=center>40%</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
   </tr>
   <tr>
     <td height='15' colspan='5' align=right> Total &nbsp;</td>
     <td >&nbsp;</td>
   </tr>
</table>

<br>
<?php 
} 
?>

<table border=0 width='700' align='center' cellpadding='0' cellspacing='0' >
<tr>
<td width='423' align='center'>&nbsp;</td>
<td width='367' align='left'>Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>

<tr>
  <td align='left'></td>
  <td align='left' >Penguji I / II / III</td>
</tr>

<tr>
  <td align='left'></td>
  <td align='left' >&nbsp;</td>
</tr>

<tr>
<td align='left'></td>
<td align='left'>------------------------------------------</td>
</tr>
</table>

<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y'))  ?> WIB - STMIK HTP Support System</b>

	