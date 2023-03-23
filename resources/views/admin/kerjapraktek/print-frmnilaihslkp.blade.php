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
<table class="printer" style="border:none">
<tr style="border:none">
<td align='center'><b>FORM PENILAIAN SEMINAR HASIL KERJA PRAKTEK</b></td>
</tr>
<tr style="border:none">
<td style="border:none" align='center'></td>
</tr>
</table>


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

<table style="border:none" width='600' border='0' cellpadding='0' cellspacing='0' align='center'>
<tr style="border:none">
<td style="border:none" width='100'>Nama</td>
<td style="border:none" width='5'>:</td>       
<td style="border:none" width='580'><?php echo $nama_kecil ?></td>           
</tr>

<tr style="border:none">
<td style="border:none">NIM</td>
<td style="border:none">:</td>            
<td style="border:none" ><?php echo $data->MhswID ?></td>             
</tr>
</table>
<br>

<table width='0' border='0.1' cellpadding='0' cellspacing='0' align='center'>
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

<table style="border:none" border=0 width='700' align='center' cellpadding='0' cellspacing='0' >
<tr>
<td style="border:none" width='423' align='center'>&nbsp;</td>
<td style="border:none" width='367' align='left'>Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>

<tr style="border:none">
  <td style="border:none" align='left'></td>
  <td style="border:none" align='left' >Penguji I / II / III</td>
</tr>

<tr style="border:none">
  <td style="border:none" align='left'></td>
  <td style="border:none" align='left' >&nbsp;</td>
</tr>

<tr style="border:none">
<td style="border:none" align='left'></td>
<td style="border:none" align='left'>------------------------------------------</td>
</tr>
</table>

<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y'))  ?> WIB - STMIK HTP Support System</b>

	