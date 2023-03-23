<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
<title>Cetak KRS</title>

<link rel="icon" type="image/png" href="assets/images/favicon.png"/>
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
      padding: 3px;
    }

    th {
        color: #222;
    }
    body{
      font-family:Calibri;
      font-size:15px;
    }
    </style>
  
  <!-- <style type="text/css" media="print">
  @page { size: landscape; }
  </style> -->

<link rel="stylesheet" type="text/css" href="asset/printer.css">
</head>

<body onload="window.print();">
@include('admin/kop_laporan/kop_lap')
<br>
<?php
  $NamaMhsx		= strtolower($mheader->NamaMhs); 
  $NamaMhs		= ucwords($NamaMhsx);

?>

<table border='1' class='center' width='100%'>
<tr style="text-align:center;border:none">
<th colspan="14" style="text-align:center;border:none;background:#e6e4df"><b>KARTU RENCANA STUDI</b></th>
</tr>
</table>     
<br>

<table border='0' class='center' width='100%'>

<tr style="text-align:left">
<th style="text-align:left" colspan=2>Nama</th>       
<th style="text-align:left" colspan=7>: <?php echo $mheader->Nama ?></th> 
<th style="text-align:left" colspan=2>NIM</th>	
<th style="text-align:left" colspan=3>: <?php echo $mheader->MhswID ?></th> 
</tr>

<tr style="text-align:left">
<th style="text-align:left" colspan=2 >Program/Prodi</th> 
<th style="text-align:left" colspan=7>: <?php echo $mheader->ProgramID ?> - <?php echo $prodi->Nama ?></th>
<th style="text-align:left" colspan=2>Semester</th> <th style="text-align:left" colspan=3>: <?php echo $khsidx->Sesi ?> - <?php echo $khsidx->TahunID ?></th>
</tr>

</table>
<br>

<table border='1' class='center' width='100%'>
<tr >
  <th width='30' style="text-align:center;vertical-align:middle;"> NO.</th>
  <th width='90' style="text-align:center;vertical-align:middle;">KODE</th>
  <th style="text-align:left;vertical-align:middle;;width:260px">MATAKULIAH</th>
  <th height='30'  style="text-align:center;width:30px">T</th>
  <th height='30'  style="text-align:center;width:30px">P</th>
  <th height='30'  style="text-align:center;width:40px">KLS</th>
  <th height='30'  style="text-align:center;width:30px">NL</th>
  <th height='30'  style="text-align:center;width:150px">DOSEN</th>
  </tr>

<?php 
$no=0;
$tsks=0;
foreach($krs as $r){
  $no++;
  $NamaMKx		= strtolower($r->NamaMK); 
  $NamaMK		  = strtoupper($NamaMKx);
  $total_sks 	= $r->SKS;
  $tsks 		 += $total_sks;
 
?>
<tr>
	<td  style="text-align:center"> <?php echo $no ?></td>
	<td style="text-align:center" ><?php echo $r->MKKode ?></td>
	<td style="text-align:left"><?php echo $NamaMK ?> </td>

	<td style="text-align:center" ><?php echo $r->SKS ?></td>
    <td style="text-align:center" >&nbsp;</td>
	<td style="text-align:center" ><?php echo $r->NamaKelasx ?></td>
	<td style="text-align:center" >&nbsp;</td>
    <td style="text-align:left" ><?php echo $r->NamaDosen ?></td>
  </tr>
<?php
}
?>
<tr>
	<td height='25' style="text-align:left" colspan="3">&nbsp;&nbsp; Total SKS</td>
	<td style="text-align:center"> <?php echo $tsks ?></td>
  <td style="text-align:center" colspan="4"></td>
  </tr>
</table>
<br>
<br>  
<table border="0" width="100%">
    <tr>
      <th width="33%">&nbsp;</th>
      <th width="33%">&nbsp;</th>
      <th width="33%">PEKANBARU, <?php echo date('d-m-Y')?></th>
    </tr>
</table>

<table border="0" width="100%">
    <tr>
      <th width="33%">MAHASISWA</th>
      <th width="33%">PEMBIMBING AKADEMIK</th>
      <th width="33%">KETUA PRODI</th>
    </tr>
    <tr>
      <th align="center">
         
         <br>
         <br> 
         <br>{{ $mheader->NamaMhs }}
      </th>
      <th align="center">
         <br> 
         <br>
         <br>( --------------------------------- )
      </th>
      <th align="center">
         <br> 
         <br>
         <br>{{ $prodi->Pejabat }}
      </th>
    </tr>
  </tbody>
</table>
<br>
<br>
<table border="0" width="100%" >
    <tr valign="top">
      <th width="1%" align="left">1. <br>2. <br>3. <br></th>
      <th width="99%" align="left">
      KRS diprint tiga rangkap dan diserahkan ke Prodi, BAAK, dan Pembimbing Akademik<br>
      KRS dianggap sah setelah ditanda tangani oleh Mahasiswa, Pembimbing Akademik, dan Ketua Prodi<br>
      Bagi mahasiswa yang tidak menyerahkan KRS ke Prodi, BAAK, dan Pembimbing Akademik dianggap PASIF/ALFA STUDI pada semester berjalan
</th>
    </tr>
</table>


</body>
</html>