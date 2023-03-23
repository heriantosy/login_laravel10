<?php 
$tgl 		  = date('Y-m-d');	
$tanggal 	= $pmbperiod->UjianMulai;
$day 		  = date('D', strtotime($tanggal));
$dayList 	= array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);
?>
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
<head>
<style>
.garis_tepi0 {
     border:  6px dotted #e62899; 
	 width:700px;
}
/* .garis_tepi {
     border:  2px dashed #e62899;
	 width:750px;
} */
</style>
</head>
<center>
<body onload="window.print();">
<div class='garis_tepi0'>
<div class='garis_tepi'>
<table border=0  align='center'>
    
	
<tr class='brs_isi'>
<td valign='top'>
<br>
@include('admin/kop_laporan/kop_yayasan')
<br>
<table width='100%' border='0''>
<tr class='batas2' align='left'>
<td width='120' rowspan='8' align='center'><img class='img-thumbnail' style='width:150px' src="{{ asset('assets/logo/20190308163048-blank.png') }}"></td>
<td width=180>&nbsp;No Ujian</td>
<td>:</td>
<td width=320>&nbsp;<?php echo $pmb->PMBRef ?></td>
</tr>
<tr class='batas2' align='left'>
<td>&nbsp;Nama</td>
<td>:</td>
<td>&nbsp;<?php echo $pmb->Nama?></td>
</tr>

<tr class='batas2' align='left'>
<td >&nbsp;Tempat dan Tanggal Lahir</td>
<td >:</td>
<td >&nbsp;<?php echo $pmb->TempatLahir ?>, <?php echo $pmb->TanggalLahir ?></td>
</tr>

<tr class='batas2' align='left'>
<td>&nbsp;Program Studi</td>
<td>:</td>
<td>&nbsp;<?php echo $prodix->Nama ?></td>
</tr>

<tr class='batas2' align='left'>
<td>&nbsp;Jalur</td>
<td>:</td>
<td>&nbsp;<?php echo $prodix->Nama ?></td>
</tr>


<tr class='batas2' align='left'>
<td >&nbsp;Hari / Tanggal Ujian</td>
<td >:</td>
<td >&nbsp;<?php echo $dayList[$day] ?>, <?php echo $pmbperiod->UjianMulai ?></td>
</tr>
<tr class='batas2' align='left'>
<td >&nbsp;Waktu</td>
<td >:</td>
<td >&nbsp;08:00 s/d 10:00 WIB</td>
</tr>
<tr class='batas2' align='left'>
<td >&nbsp;Lokasi Ujian</td>
<td >:</td>
<td >&nbsp;Aula STMIK Hang Tuah Pekanbaru</td>
</tr>
</table>        
<br>



<table  border='0' width="100%">
<tr  align='center'>
<td width='350' center='left'></td>
<td width='300' align='left'>Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr  align='center'>
<td align='left'>&nbsp;</td>
<td align='left'>Petugas Pendaftaran</td>
</tr>

<tr  align='center'>
<td align='left'>&nbsp;</td>
<td align='left'>&nbsp;</td>
</tr>
<tr  align='center'>
<td align='left'>&nbsp;</td>
<td align='left'>&nbsp;</td>
</tr>
<tr  align='center'>
<td align='center'>&nbsp;</td>
<td align='left'><?php echo $pmb->LoginBuat ?></td>
</tr>

<tr  align='center'>
<td align='left'>&nbsp;</td>
<td align='left'>&nbsp;</td>
</tr>

</table>

<table  border='0'  width="100%">
<tr style=background-color:#e62899; >
<td  width=320 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;>
&nbsp; - Cetaklah kartu ujian menggunakan printer berwarna<br>
&nbsp; - Ketika ujian anda perlu membawa kartu ujian serta perlengkapan tulis
</td>
<td width=300 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;>
<font style='font-size:8px'>Login by: <?php echo $pmb->LoginBuat ?> <?php echo date('d-m-Y H:i:s') ?>WIB - STMIK HTP Support System</font>
&nbsp;
</td>
</tr>
</table><br>
</td>
</tr>
</table>
</div>
</div>
</body>
</center>

