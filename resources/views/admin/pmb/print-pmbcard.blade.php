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
<?php 

$logo  = DB::table('identitas')->where('Kode','SISFO')->first();
if($logo->logobro!="-") { 
  $src = "$logo->logobro";
}else{
  $src = "20none90308none63048-blank.PNG";
} 


$tgl 		= date('Y-m-d');	
$dta 		= DB::table('pmb')->where('PMBID',$pmbdata->PMBID)->first();	
$Namax 		= strtolower($dta->Nama);
$Nama		= ucwords($Namax);

$tglujian   = DB::table('pmbperiod')->where('PMBPeriodID',$dta->PMBPeriodID)->first();
$tanggal 	= $tglujian->UjianMulai;
$day 		= date("D", strtotime($tanggal));
$dayList 	= array(
	"Sun" => "Minggu",
	"Mon" => "Senin",
	"Tue" => "Selasa",
	"Wed" => "Rabu",
	"Thu" => "Kamis",
	"Fri" => "Jumat",
	"Sat" => "Sabtu"
);
$prodi 		= DB::table('prodi')->where('ProdiID',$dta->ProdiID)->first();												 
$program 	= DB::table('program')->where('ProgramID',$dta->ProgramID)->first();	
$petugas 	= DB::table('karyawan')->where('Login',Session()->get('username'))->first();	
?>

<head>
<style>
.garis_tepi0 {
     border:  2px dotted #e62899; 
	 width:700px;
}
.garis_tepi {
     border:  2px dashed #e62899;
	 width:700px;
}
</style>
</head>

<body>
<div class="garis_tepi0">
<div class="garis_tepi">
<!-- table luar untuk frame -->
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;padding:20px">


<table   >	
<tr style="border:none;">
<td style="border:none;" valign="top">
<br>
<table style="border:none;">
<tr style="border:none;padding:1px" >
<td style="border:none;padding:1px;"  rowspan="3"  ><img width="80" src="{{ asset('public/upload/image/thumbs/'.$src) }}"></td>
<td style=text-align:center;font-size:16px;font-weight:reguler;border:none;padding:1px>YAYASAN PENDIDIKAN HANG TUAH</td>
<td style="border:none;padding:1px" >&nbsp;</td>
</tr>
<tr style="border:none;padding:1px" >
<td style=text-align:center;font-size:16px;font-weight:reguler;border:none;padding:1px>SELEKSI PENERIMAAN MAHASISWA BARU TAHUN 2018/2019</td>
<td style="border:none;padding:1px"  width=60>&nbsp;</td>
</tr>
<tr style="border:none;padding:1px" >
<td height="18" style=text-align:center;font-size:25px;font-weight:bold;border:none;padding:1px>STMIK HANG TUAH PEKANBARU</td>
<td style="border:none;padding:1px" height="18" >&nbsp;</td>
</tr>
<tr style="border:none;padding:1px" >
<td style="border:none;padding:1px" >&nbsp;</td>
<td style=text-align:center;font-size:10px;font-weight:reguler;border:none;padding:1px>Jl. Mustafa Sari No. 5 Tangkerang Selatan Pekanbaru Telp. (0761) 7872494 Fax (0761) 368646 </td>
</tr>
<tr style="border:none;padding:1px" >
<td style="border:none;padding:1px" colspan="3" >
	<hr style=width:650px; ; >
</td>
</tr>
<tr style="border:none;padding:1px" >
<td style="border:none;padding:1px" colspan="3" >&nbsp;</td>
</tr>
<tr>
<td colspan="3" width=600 height=20 style=text-align:center;font-size:16px;color:#FFFFFF;font-weight:reguler;background-color:#e62899;style=text-align:center;font-size:16px;font-weight:reguler;border:none;><b>.::  TANDA PESERTA UJIAN ::.</b>  </td>
</tr>
</table>
<br>


<table class="printer" style="border:none;padding:2px">
<tr style="border:none;">
<td style="border:none;" width="120" rowspan="8" ><img class="img-thumbnail" style="width:100px" src="{{ asset('public/upload/image/thumbs/20190308163048-blank.png') }}"></td>
<td style="border:none;" width=180>&nbsp;No Ujian</td>
<td style="border:none;" width=1>:</td>
<td style="border:none;" width=320>&nbsp;<?php echo $dta->PMBRef ?></td>
</tr>
<tr style="border:none;">
<td style="border:none;">&nbsp;Nama</td>
<td style="border:none;">:</td>
<td style="border:none;">&nbsp; <?php echo $Nama ?></td>
</tr>

<tr style="border:none;">
<td style="border:none;" >&nbsp;Tempat dan Tanggal Lahir</td>
<td style="border:none;" >:</td>
<td style="border:none;" >&nbsp; <?php echo $dta->TempatLahir ?>, <?php echo $dta->TanggalLahir ?></td>
</tr>

<tr style="border:none;">
<td style="border:none;">&nbsp;Program Studi</td>
<td style="border:none;">:</td>
<td style="border:none;">&nbsp;<?php echo $prodi->Nama ?></td>
</tr>

<tr style="border:none;">
<td style="border:none;">&nbsp;Jalur</td>
<td style="border:none;">:</td>
<td style="border:none;">&nbsp;<?php echo $program->Nama ?>  </td>
</tr>


<tr style="border:none;">
<td style="border:none;" >&nbsp;Hari / Tanggal Ujian</td>
<td style="border:none;" >:</td>
<td style="border:none;" >&nbsp;<?php echo $dayList[$day] ?>, <?php echo $tglujian->UjianMulai ?></td>
</tr>
<tr style="border:none;">
<td style="border:none;" >&nbsp;Waktu</td>
<td style="border:none;" >:</td>
<td style="border:none;" >&nbsp;08:00 s/d 10:00 WIB</td>
</tr>
<tr style="border:none;">
<td style="border:none;" >&nbsp;Lokasi Ujian</td>
<td style="border:none;" >:</td>
<td style="border:none;" >&nbsp;Aula STMIK Hang Tuah Pekanbaru</td>
</tr>
</table>        
<br>



<table style="border:none">
<tr style="border:none;" >
<td style="border:none;" width=420></td>
<td style="border:none;">Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr style="border:none;" >
<td style="border:none;" >&nbsp;</td>
<td style="border:none;" >Petugas Pendaftaran</td>
</tr>

<tr style="border:none;" >
<td style="border:none;" >&nbsp;</td>
<td style="border:none;" >&nbsp;</td>
</tr>
<tr style="border:none;" >
<td style="border:none;" >&nbsp;</td>
<td style="border:none;" >&nbsp;</td>
</tr>
<tr style="border:none;" >
<td style="border:none;" >&nbsp;</td>
<td style="border:none;" ><?php echo $petugas->Nama ?></td>
</tr>

<tr style="border:none;" >
<td style="border:none;" >&nbsp;</td>
<td style="border:none;" >&nbsp;</td>
</tr>

</table>

<table style=background-color:#e62899;border:none>
<tr style=background-color:#e62899; >
<td  width=320 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;>
&nbsp; - Cetaklah kartu ujian menggunakan printer berwarna<br>
&nbsp; - Ketika ujian anda perlu membawa kartu ujian serta perlengkapan tulis
</td>
<td  width=300 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;;>
<b style="font-size:10px;font-weight:reguler;">Login: <?php echo Session()->get('username') ?> - <?php echo (date('d-m-Y'))." ".date('H:i:s') ?>  WIB - STMIKHTP Support System</b>
&nbsp;
</td>
</tr>
</table><br>
</td>
</tr>
</table>
</div>
</div>


</td>
</tr>
</table> <!-- tabel luar -->
</body>

	
	</div>
</body>
</html>
