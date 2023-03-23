<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Print Data</title>
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
  
<style type="text/css" media="print">
@page { size: landscape; }
</style>
<link rel="stylesheet" type="text/css" href="asset/printer.css">
</head>

<body onload="window.print()">
@include('admin/kop_laporan/kop_lap')

<?php
echo"<table width='100%' border='0'> 
<tr>
<td style='text-align:center'><b>ABSENSI KULIAH</b></td>
</tr>
</table>     
<br>

<table width='100%'>
<tr>
<td width='60%'>$jadwalx->TahunID</td>           
<td width='40%'>$jadwalx->NamaHari</td> 
</tr>

<tr>
<td>$jadwalx->NamaProdi</td>             
<td>".substr($jadwalx->JamMulai,0,5)." - ".substr($jadwalx->JamSelesai,0,5)." WIB</td> 
</tr>

<tr>
<td>$jadwalx->MKKode - $jadwalx->NamaMK ($jadwalx->SKS SKS) - $jadwalx->NamaKelasx  - Semester $jadwalx->Sesi</td>             
<td>$jadwalx->RuangID</td> 
</tr>

<tr>
<td>$jadwalx->DosenID - $jadwalx->NamaDosen, $jadwalx->Gelar</td>             
<td>&nbsp;</td> 
</tr>

</table>
<br>";
echo "<table border='1' class='center' width='100%'>
  <tr >
    <th  rowspan='2' style='text-align:center;width:50px'> NO.</th>
    <th  rowspan='2' style='text-align:center;width:90px'>NIM</th>
    <th  rowspan='2' style='text-align:center;width:250px'>NAMA MAHASISWA</th>
    <th  colspan='16' style='text-align:center'>PERTEMUAN KE</th>
  </tr>
  <tr >
  <th  style='text-align:center;width:50px''>1</th>
  <th  style='text-align:center;width:50px''>2</th>
  <th  height='20' style='text-align:center;width:50px''>3</th>
  <th  style='text-align:center;width:50px''>4</th>
  <th  style='text-align:center;width:50px''>5</th>
  <th  style='text-align:center;width:50px''>6</th>
  <th  style='text-align:center;width:50px''>7</th>
  <th  style='text-align:center;width:50px''>8</th>
  <th  style='text-align:center;width:50px''>9</th>
  <th  style='text-align:center;width:50px''>10</th>
  <th  style='text-align:center;width:50px''>11</th>
  <th  style='text-align:center;width:50px''>12</th>
  <th  style='text-align:center;width:50px'>13</th>
  <th  style='text-align:center;width:50px'>14</th>
  <th  style='text-align:center;width:50px'>15</th>
  <th  style='text-align:center;width:50px'>16</th>
  </tr>";
      $no = 1;
     
      foreach ($krs as $r){
        $NamaMhs 		= $r->NamaMhs;
        $NamaMhsx 	= strtolower($NamaMhs);
        $NamaMhs	  = ucwords($NamaMhsx);
          echo "<tr>
          <td height='20' align=center> $no</td>
          <td align=center>$r->MhswID</td>
          <td >&nbsp;$NamaMhs </td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
          <td align=center >&nbsp;</td>
            </tr>";
          $no++;
        }

    
echo"</table>
<br>
<br>
<table border=0 width='100%' style='text-align:center'>
<tr>
<td style=width:1000px;text-align:center'>&nbsp;</td>
<td style=width:1000px;text-align:left'>Pekanbaru, ".(date('Y-m-d'))."  <br>Ketua Program Studi</td>
</tr>
<tr>
  <td ></td>
  <td  >&nbsp;</td>
</tr>
<tr>
  <td ></td>
  <td >&nbsp;</td>
</tr>

<tr>
<td ></td>
<td >$prodi->Pejabat</td>
</tr>
</table>";
?>

