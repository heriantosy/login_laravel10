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

$JudulP 	= strtolower($dt->Judul);
$Judul		= ucwords($JudulP);

$ProdiID   	= $dt->ProdiID;
if ($ProdiID=='SI'){ $prod="Sistem Informasi"; $kaprodi="Herianto, S.Kom, M.Kom";}else{ $prod="Teknik Informatika"; $kaprodi="Yuda Irawan, S.Kom, M.TI";}

$p1 = DB::table('dosen')->where('Login',$dt->PembimbingPro1)->first();
  
  if(!empty($p1->Nama)){
    $Pembimbing1x   = strtolower($p1->Nama);
    $Pembimbing1	  = ucwords($Pembimbing1x); 
    $GelarPm1       = $p1->Gelar;    
  }else{
    $Pembimbing1    = "-";
    $GelarPm1       = "-";
  }
  
  $p2 = DB::table('dosen')->where('Login',$dt->PembimbingPro2)->first();
  if(!empty($p2->Nama)){
    $Pembimbing2x   = strtolower($p2->Nama);
    $Pembimbing2	  = ucwords($Pembimbing2x);
    $GelarPm2       = $p2->Gelar;  
  }else{
    $Pembimbing2    = "-";
    $GelarPm2       = "-";
  }


  $Pji1 = DB::table('dosen')->where('Login',$dt->PengujiSkripsi1)->first();
  if(!empty($Pji1->Nama)){
    $Penguji1x  = strtolower($Pji1->Nama);
    $Penguji1	  = ucwords($Penguji1x); 
    $GelarPj1   = $Pji1->Gelar;
  }else{
    $Penguji1   = "-";
    $GelarPj1   = "-";
  }

  //Penguji 2 ---------------------------------------------
  $Pji2 = DB::table('dosen')->where('Login',$dt->PengujiSkripsi2)->first();
  if(!empty($Pji2->Nama)){
    $Penguji2x  = strtolower($Pji2->Nama);
    $Penguji2	  = ucwords($Penguji2x); 
    $GelarPj2   = $Pji2->Gelar;
  }else{
    $Penguji2   = "-";
    $GelarPj2   = "-";
  }

  //Penguji 3 ---------------------------------------------
  $Pji3 = DB::table('dosen')
  ->where('Login',$dt->PengujiSkripsi3)->first();
  if(!empty($Pji3->Nama)){
    $Penguji3x 	  = strtolower($Pji3->Nama);
    $Penguji3	    = ucwords($Penguji3x);
    $GelarPj3     = $Pji3->Gelar;
  }else{
    $Penguji3     = "-";
    $GelarPj3     = "-";
  }

   $ruang = DB::table('ruang')->where('RuangID',$dt->TempatUjian)->first();
   if(!empty($ruang->Nama)){
     $NamaRuang = $ruang->Nama;
   }else{
    $NamaRuang  = "-";
   }

$tgl = substr($dt->TglUjianSkripsi,8,2); //2017-01-01
$bln = substr($dt->TglUjianSkripsi,5,2);
$thn = substr($dt->TglUjianSkripsi,0,4);

$tanggal = $dt->TglUjianSkripsi;
//$day = date('D', strtotime($tanggal));
$day = date('D', strtotime($tanggal));
$dayList = array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);


$bul = date('m', strtotime($tanggal));
$bulList = array(
	'01' => 'Januari',
	'02' => 'Februari',
	'03' => 'Maret',
	'04' => 'April',
	'05' => 'Mei',
	'06' => 'Juni',
	'07' => 'Juli',
	'08' => 'Agustus',
	'09' => 'September',
	'10' => 'Oktober',
	'11' => 'Nopember',
	'12' => 'Desember'
);

//echo "Tanggal {$tanggal} adalah hari : " . $dayList[$day];

/*
if ($bln=='01'){$bul ="Januari";}elseif ($bln=='02'){$bul ="Februari"; }elseif ($bln=='03'){$bul ="Maret"; }
elseif ($bln=='04'){$bul ="April";}elseif ($bln=='05'){$bul ="Mei"; }elseif ($bln=='06'){$bul ="Juni"; }
elseif ($bln=='07'){$bul ="Juli";}elseif ($bln=='08'){$bul ="Agustus"; }elseif ($bln=='09'){$bul ="September"; }
elseif ($bln=='10'){$bul ="Oktober";}elseif ($bln=='11'){$bul ="Nopember"; }else{$bul ="Desember"; }
*/


if ($dt->ProdiID=='SI'){$progst ="Sistem Informasi";}else{$progst ="Teknik Informatika"; }


echo"<table style='border:none'>
<tr style='border:none;padding:0px'>
<td style='border:none;padding:0px' align='center'><b>BERITA ACARA UJIAN  SIDANG SKRIPSI DAN COMPREHENSIVE</b></td>
</tr>
<tr style='border:none;padding:0px'>
<td style='border:none;padding:0px' align='center'>Program Studi: $prod</td>
</tr>
</table>     
<br>
<br>

<table style='border:none'>
<tr style='border:none'>
  <td style='border:none;text-align:justify;'>Pada hari ini,  $dayList[$day],  Tanggal ".date('d',strtotime($dt->TglUjianSkripsi))." Bulan $bulList[$bul] Tahun ".date('Y',strtotime($dt->TglUjianSkripsi))." Telah dilaksanakan Ujian  Sidang Skripsi dan Comprehensive Program Strata-1 ( S1 ),  
  Program Studi $progst STMIK Hang Tuah Pekanbaru terhadap:
  </td>
</tr>
</table>

<table style='border:none' >
  <tr style='border:none'>
    <td style='border:none' ></td>
    <td style='border:none' ></td>
    <td style='border:none' ></td>
    <td style='border:none' ></td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' >1.</td>
    <td style='border:none;width:150px;' >Nama</td>
    <td style='border:none' >:</td>
    <td style='border:none' > $dt->NamaMhs</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' >&nbsp;</td>
    <td style='border:none' >NIM</td>
    <td style='border:none' >:</td>
    <td style='border:none' >$dt->MhswID</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' >&nbsp;</td>
    <td style='border:none' >Program Studi</td>
    <td style='border:none' >:</td>
    <td style='border:none' > $prod</td>
  </tr>


  <tr style='border:none'>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
  </tr>

<tr style='border:none'>
<td style='border:none' >2.</td>
<td style='border:none' >Judul Skripsi</td> 
<td style='border:none' >:</td>
<td style='border:none;text-align:justify;' > $Judul</td>           
</tr>

<tr style='border:none'>
<td style='border:none' ></td>
<td style='border:none' ></td> <td style='border:none'>&nbsp;</td>
<td style='border:none' ></td>           
</tr>

<tr style='border:none'>
  <td style='border:none' >3.</td>
  <td style='border:none'>Dosen Pembimbing 1</td>
  <td style='border:none' >:</td>
  <td style='border:none'>$Pembimbing1, $GelarPm1</td>
</tr>
<tr style='border:none'>
  <td style='border:none' >&nbsp;</td>
<td style='border:none'>Dosen Pembimbing 2</td> 
<td style='border:none'>:</td><td style='border:none'> $Pembimbing2, $GelarPm2</td>           
</tr>

<tr style='border:none'>
  <td style='border:none'>4.</td>
<td style='border:none' >Waktu Ujian</td> 
<td style='border:none' >:</td><td style='border:none'>".substr($dt->JamMulaiUjianSkripsi,0,5)." s/d ".substr($dt->JamSelesaiUjianSkripsi,0,5)." WIB</td>           
</tr>

<tr style='border:none'>
  <td style='border:none'>5.</td>
<td style='border:none' >Tempat Ujian</td> 
<td style='border:none'>:</td>
<td style='border:none'> Kampus STMIK Hang Tuah Pekanbaru</td>           
</tr>

<tr style='border:none' >
  <td style='border:none'>6.</td>
  <td style='border:none'>Nilai</td>
  <td style='border:none'>:</td>
  <td style='border:none'>Angka = ..... &nbsp; Huruf =&nbsp; A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E</td>
</tr>
<tr style='border:none' >
  <td style='border:none' >7.</td>
<td style='border:none' >Keterangan</td> 
<td style='border:none' >:</td>
<td style='border:none' >1. Lulus &nbsp;&nbsp;&nbsp;&nbsp;2. Tidak Lulus</td>           
</tr>
</table>


<table style='border:none' width='50%' border='0' cellpadding='0' cellspacing='0' align='center'>
  <tr style='border:none'>
    <td style='border:none' >&nbsp;</td>   
  </tr>
  <tr style='border:none'>
    <td  style='border:none' align=center><u>PANITIA UJIAN</u></td>   
  </tr>
  <tr style='border:none'>
    <td >&nbsp;</td>   
  </tr>
</table>


<table style='width:500px;' align='center'>
  <tr >
    <td width='20%' height=30 style='vertical-align:middle;text-align:left;'>&nbsp;Ketua</td>
    <td width='40%' style='vertical-align:middle;text-align:left;'>&nbsp;$Penguji3, $GelarPj3</td>
    <td width='20%' style='vertical-align:middle;text-align:left;'>&nbsp;1. </td>
  
  </tr>
   <tr  >
    <td height=30 style='vertical-align:middle;text-align:left;'>&nbsp;Anggota</td>
    <td style='vertical-align:middle;text-align:left;'>&nbsp;$Penguji1, $GelarPj1</td>
    <td style='vertical-align:middle;text-align:left;'>&nbsp;2. </td>
	
  </tr>
   <tr >
    <td height=30 style='vertical-align:middle;text-align:left;'>&nbsp;Anggota</td>
    <td style='vertical-align:middle;text-align:left;'>&nbsp;$Penguji2, $GelarPm2</td>
    <td style='vertical-align:middle;text-align:left;'>&nbsp;3.  </td>
  </tr>
</table>
<br>
<br>


<table style='border:none' border=0 width='700' align='center' cellpadding='0' cellspacing='0' >
<tr style='border:none'>
<td style='border:none' width='367' align='center'>Diketahui / disetujui oleh</td>
</tr>

<tr style='border:none'>
  <td style='border:none' align='center' >Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>

<tr style='border:none'>
  <td align='center' >&nbsp;</td>
</tr>

<tr style='border:none'>
  <td style='border:none' align='center' >&nbsp;</td>
</tr>
<tr style='border:none'>
  <td style='border:none' align='center' >&nbsp;</td>
</tr>

<tr style='border:none'>
<td style='border:none' align='center'>Hendry Fonda, M.Kom</td>
</tr>
<tr style='border:none'>
<td style='border:none' align='center'>NIDN. 1015027102</td>
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
<table style='border:none' border=0 >
<tr style='border:none'>

<td style='border:none' width='300'><font style='font-size:10px'>Login by: ".Session()->get('username')." ".(date('d-m-Y'))." ".date('H:i:s') . " WIB - STMIK HTP Support System</font></td>
</tr>
</table>";



?>	