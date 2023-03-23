<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
<title><?php echo $judul_web; ?></title>

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
    }
    </style>
  
  <!-- <style type="text/css" media="print">
  @page { size: landscape; }
  </style> -->

<link rel="stylesheet" type="text/css" href="asset/printer.css">
</head>

<body onload="window.print();">
<?php echo view('admin/kop_laporan/kop_lap'); ?>
<br>
<?php
  $NamaMhsx		= strtolower($datamhs->NamaMhs); 
  $NamaMhs		= ucwords($NamaMhsx);

  $sesi = (empty($khsid->Sesi))? '-' : "$khsid->Sesi";
?>

<table border='1' class='center' width='100%'>
<tr style="text-align:center;border:none">
<th colspan="14" style="text-align:center;border:none;background:#e6e4df"><b>KARTU HASIL STUDI</b></th>
</tr>
</table>     
<br>

<table border='0' class='center' width='100%'>

<tr style="border:none">
<td style="border:none" colspan=2>Nama</td>       
<td style="border:none" colspan=7>: <?php echo $datamhs->Nama ?></td> 
<td style="border:none" colspan=2>NPM</td>	
<td style="border:none" colspan=3>: <?php echo $datamhs->MhswID ?></td> 
</tr>

<tr style="border:none">
<td style="border:none" colspan=2 >Program/Prodi</td> 
<td style="border:none" colspan=7>: <?php echo $datamhs->ProgramID ?> - <?php echo $prd->Nama ?></td>
<td style="border:none" colspan=2>Semester</td> <td style="border:none" colspan=3>: <?php echo $sesi ?></td>
</tr>

</table>
<br>

<table border='1' class='center' width='100%'>
<tr >
  <th width='30' style="text-align:center;vertical-align:middle;"> NO.</th>
  <th width='80' style="text-align:center;vertical-align:middle;">KODE</th>
  <th style="text-align:left;vertical-align:middle;;width:250px">MATAKULIAH</th>
  <th height='30'  style="text-align:center;width:30px">SKS</th>
  <th height='30'  style="text-align:center;width:30px">HURUF</th>
  <th height='30'  style="text-align:center;width:30px">BOBOT</th>
  </tr>
<?php 
$no =0;
$total_sks =0;
$total_bobot=0;
$ips =0;
$tbobottotal = 0;
$tsks =0;

foreach($khs as $r){
  $no++;
  $NamaMKx	= strtolower($r->NamaMK); 
  $NamaMK		= strtoupper($NamaMKx);
  $nilai = $r->NilaiAkhir;
            if ($nilai >= 85 AND $nilai <= 100){
                $huruf = "A";
                $bobot = "4";
            }
            elseif ($nilai >= 80 AND $nilai <= 84.99){
                $huruf = "A-";
                $bobot = "3.70";
            }
            elseif ($nilai >= 75 AND $nilai <= 79.99){
                $huruf = "B+";
                $bobot = "3.30";
            }
            elseif ($nilai >= 70 AND $nilai <= 74.99){
                $huruf = "B";
                $bobot = "3";
            }
            elseif ($nilai >= 65 AND $nilai <= 69.99){
                $huruf = "B-";
                $bobot = "2.70";
            }
            elseif ($nilai >= 60 AND $nilai <= 64.99){
                $huruf = "C+";
                $bobot = "2.30";
            }
            elseif ($nilai >= 55 AND $nilai <= 59.99){
                $huruf = "C";
                $bobot = "2";
            }
            elseif ($nilai >= 50 AND $nilai <= 54.99){
                $huruf = "C-";
                $bobot = "1.70";
            }
            elseif ($nilai >= 40 AND $nilai <= 49.99){
                $huruf = "D";
                $bobot = "1";
            }
            elseif ($nilai < 40){
                $huruf = "E";
                $bobot = "0";
            }
            
            $total_sks 	  	= $r->SKS;
            $total_bobot  	= $r->SKS * $bobot;
            
            $tsks 			+= $total_sks;
            $tbobottotal 	+= $total_bobot;
            $ips = number_format($tbobottotal / $tsks,2);
            
            if ($ips >= 3.00) {
                $YAD=24;
                }
            if ($ips < 3.00) {
                $YAD=21;
                }
            if ($ips <= 2.49) {
                $YAD=18;
                }
            if ($ips <= 1.99) {
                $YAD=15;
                }
            if ($ips <= 1.4) {
                $YAD=12;
                }
?>
<tr>
	<td height='25' style="text-align:center"> <?php echo $no ?></td>
	<td style="text-align:center" ><?php echo $r->MKKode ?></td>
	<td style="text-align:left"><?php echo $NamaMK ?> </td>

	<td style="text-align:center" ><?php echo $r->SKS ?></td>
	<td style="text-align:center" ><?php echo $r->GradeNilai ?></td>
	<td style="text-align:center" ><?php echo $r->BobotNilai ?></td>
  </tr>
<?php
}
?>
<tr>
	<td height='25' style="text-align:left" colspan="3">&nbsp;&nbsp; IP Smt: <?php echo $ips ?> &nbsp; SKS YAD: <?php echo $YAD ?></td>
	<td style="text-align:center"><?php echo $tsks ?></td>
  <td style="text-align:center" colspan="2"></td>
  </tr>
</table>
<br>

<table border='0' class='center' width='100%'>
<tr>
<td width='60%'>
&nbsp;
</td> 

<td width='40%'>
<b>Bandar Lampung, <?php echo date('d-m-Y') ?>
<br>Ketua Program Studi 
<br>
<br>
<br>
<br>
<?php echo $kaprod->Pejabat ?>
</td> 
</tr>

</table>


</div>
</body>
</html>