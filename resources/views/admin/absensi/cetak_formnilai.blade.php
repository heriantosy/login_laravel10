<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title><?php echo $judul_web; ?></title>
  	<link rel="icon" type="image/png" href="asset/images/favicon1.png"/>
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

  </head>
<body onload="window.print()">
@include('admin/kop_laporan/kop_lap')

<h3 style="text-align: center;">FORM NILAI KULIAH</h3>
<?php 
echo"<table align='center'> 
<tr>
<td width='750'>$jdw->TahunID</td>           
<td width='200'>$jdw->NamaHari</td> 
</tr>

<tr>
<td>$jdw->NamaProdi</td>             
<td>".substr($jdw->JamMulai,0,5)." - ".substr($jdw->JamSelesai,0,5)." WIB</td> 
</tr>

<tr>
<td>$jdw->MKKode - $jdw->Nama ($jdw->SKS SKS) - $jdw->NamaKelas  - Semester $jdw->Sesi</td>             
<td>$jdw->NamaRuang</td> 
</tr>


<tr>
<td>$jdw->DosenID - $jdw->NamaDosen, $jdw->Gelar</td>             
<td>&nbsp;</td> 
</tr>
</table>
<br>

<table width='100%' border='1'>
<tr style='background-color:#E7EAEC' >
  <th width='30' rowspan='3' align='center'> NO.</th>
  <th width='80' rowspan='3' align='center'>NIM</th>
  <th width='200' rowspan='3' align='center'>NAMA MAHASISWA</th>
  <th height='10' colspan='11' align='center'>NILAI</th>
  </tr>
<tr style='background-color:#E7EAEC'>
  <th height='10' colspan='6' align='center'>TUGAS</th>
  <th align='center'>&nbsp;</th>
  <th width='35' rowspan='2' align='center'>UTS</th>
  <th width='35' rowspan='2' align='center'>UAS</th>
  <th width='35' align='center'>&nbsp;</th>
  <th width='35' align='center'>&nbsp;</th>
  </tr>
<tr style='background-color:#E7EAEC'>
<th width='35' height='10' align='center'>1</th>
<th width='35' align='center'>2</th>
<th width='35' align='center'>3</th>
<th width='35' align='center'>4</th>
<th width='35' align='center'>5</th>
<th width='35' align='center'>R</th>
<th width='35' align='center'>HADIR</th>
<th colspan='2' align='center'>NILAI AKHIR</th>
</tr>

<tr style='background-color:#E7EAEC'>
  <td height='10' align=center>&nbsp;</td>
  <td align=center>&nbsp;</td>
  <td>&nbsp;</td>
  <td align=center >&nbsp;</td>
  <td align=center >&nbsp;</td>
  <td align=center >&nbsp;</td>
  <td align=center >&nbsp;</td>
  <td align=center >&nbsp;</td>
  <td align=center width='35'>25%</td>
  <td align=center width='35'>15%</td>
  <td align=center >Nilai <br>(25%)</td>
  <td align=center >Nilai <br>(35%)</td>
  <td align=center >Angka</td>
  <td align=center >Huruf</td>
</tr>";    
      $no=0;                              
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
            </tr>";
          $no++;
        }

    
echo"</table>
<br>
<br>
<table border=0 width='100%' align='center'>
<tr>
  <td width='40%'>
  <table border='1' width='90%'>
        <tr>
          <td  align='center'><b>No</b></td>
          <td  align='center'><b>Range Nilai (0-100)</b></td>
          <td  align='center'><b>Nilai Huruf (Markah)</b></td>
        </tr>

        <tr>
          <td align='center'>1</td>
          <td align='center'>85 - 100</td>
          <td align='center'>A</td>
        </tr>
        <tr>
          <td align='center'>2</td>
          <td align='center'>80 - 84.99</td>
          <td align='center'>A-</td>
        </tr>
        <tr>
          <td align='center'>3</td>
          <td align='center'>75 - 79.99</td>
          <td align='center'>B+</td>
        </tr>
        <tr>
          <td align='center'>4</td>
          <td align='center'>70 - 74.99</td>
          <td align='center'>B</td>
        </tr>
        <tr>
          <td align='center'>5</td>
          <td align='center'>65 - 69.00</td>
          <td align='center'>B-</td>
        </tr>
        <tr>
          <td align='center'>6</td>
          <td align='center'>60 - 64.99</td>
          <td align='center'>C+</td>
        </tr>
        <tr>
          <td align='center'>7</td>
          <td align='center'>55 - 59.99</td>
          <td align='center'>C</td>
        </tr>
        <tr>
          <td align='center'>8</td>
          <td align='center'>50 - 54.99</td>
          <td align='center'>C-</td>
        </tr>
        <tr>
          <td align='center'>9</td>
          <td align='center'>40 - 49.99</td>
          <td align='center'>D</td>
        </tr>
        <tr>
          <td align='center'>10</td>
          <td align='center'>0 - 39.99</td>
          <td align='center'>E</td>
        </tr>
        </table>
  </td>

  <td width='30%' valign='top'>
  <table border='0' width='90%'>
      <tr>      
      <td  align='center'>&nbsp;</td>
      <td  align='left'>Penilaian</td>
      <td  align='center'>&nbsp;</td>
      </tr>

      <tr>
      <td align='left'></td>
      <td align='left'>UTS</td>
      <td align='left'>: 25%</td>

      </tr>

      <tr>
      <td align='left'></td>
      <td align='left'>Tugas</td>
      <td align='left'> : 25%</td>
      </tr>

      <tr>
      <td align='left'></td>
      <td align='left'>UAS</td>
      <td align='left'>: 35%</td>
      </tr>

      <tr>
      <td align='left'></td>
      <td align='left'>Kehadiran</td>
      <td align='left'> : 15%</td>

      </tr>
      <tr>
      <td align='left'></td>
      <td colspan='2' align='left'>---------------------------------------------</td>

      </tr>
      <tr>
      <td align='left'></td>
      <td align='left'>Nilai Akhir</td>
      <td align='left'>: 100%</td>     
      </tr>
      </table>  
</td>


<td width='30%' valign='top'>
  <table border='0' width='80%'>
      <tr>      
      <td  align='left'>Pekanbaru, ".date('d-m-Y')." 
        <br><br><br><br> $jdw->Nama, $jdw->Gelar 
        <br>$jdw->DosenID
      </td>
      </tr>
  </table>  
</td>
</table>";
?>

