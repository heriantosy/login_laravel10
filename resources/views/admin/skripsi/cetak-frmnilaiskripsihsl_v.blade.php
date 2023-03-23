<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul_web; ?></title>
</head>

<style>
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
      padding: 10px;
      border-color: #fff;
    }
    th, td {
      padding: 2px;
    }

    th {
        color: #222;
    }
    body{
      font-family:Calibri;
    }
    </style>
  </head>
  <body onload="window.print();">

@include('admin/kop_laporan/kop_lap')
<?php
$dt = DB::table('jadwal_skripsi')
->join('mhsw','mhsw.MhswID','=','jadwal_skripsi.MhswID')
->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
->where('jadwal_skripsi.JadwalID',$jdwl->JadwalID)
->first();
$ProdiID   = $dt->ProdiID;

if ($ProdiID=='SI'){ $prod="Sistem Informasi"; $kaprodi="Herianto, M.Kom";}else{ $prod="Teknik Informatika"; $kaprodi="Yuda Irawan, S.Kom, M.TI";}
echo"<table width='100%'>
<tr >
<td align='center'><b>FORMULIR PENILAIAN  SIDANG SKRIPSI DAN COMPREHENSIVE</b></td>
</tr>
<tr >
<td align='center'>Program Studi: $prod</td>
</tr>
</table>
<br>
<br>";
echo" 
<table width='95%' align='center'>
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td  width='4'>&nbsp;</td>
  </tr >
  <tr >    
    <td  width='189'>Nama</td>
    <td  width='13'>:</td>
    <td  width='449'> $dt->NamaMhs</td>
  </tr>
  <tr >
    <td  width='189'>NIM</td>
    <td  width='13'>:</td>
    <td  width='449'>$dt->MhswID</td>
  </tr>
  <tr >
    <td  width='189'>Program Studi</td>
    <td  width='13'>:</td>
    <td  width='449'> $prod</td>
  </tr>
</table>

<br>
<table width='100%' border='1' align='center>
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
     <td >&nbsp;</td>
     <td >&nbsp;</td>
   </tr>
</table>

<br>";
//}
echo"<br>
<br>
<table >
<tr>
<td  width='423' align='center'>&nbsp;</td>
<td  width='367' align='left'>Pekanbaru, ".date('d-m-Y')."</td>
</tr>

<tr>
  <td   align='left'></td>
  <td   align='left' >Penguji I / II / III</td>
</tr>

<tr>
  <td    align='left'></td>
  <td    align='left' >&nbsp;</td>
</tr>
<tr>
  <td  align='left'></td>
  <td  align='left' >&nbsp;</td>
</tr>

<tr>
  <td  align='left'></td>
  <td  align='left' >&nbsp;</td>
</tr>

<tr >
<td  align='left'></td>
<td  align='left'>------------------------------------------</td>
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
<table  border=0>
<tr>
<td  width='300'><font style='font-size:8px'>Login by:  ".Session()->get('username')." ".(date('d-m-Y'))." ".date('H:i:s') . " WIB - STMIK HTP Support System</font></td>
</tr>
</table>";

?>	