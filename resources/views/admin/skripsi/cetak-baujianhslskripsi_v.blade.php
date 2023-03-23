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

$JudulP 	= strtolower($dt->Judul);
$Judul		= ucwords($JudulP);

$ProdiID  = $dt->ProdiID;
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


  $Pji1 = DB::table('dosen')->where('Login',$dt->PengujiPro1)->first();
  if(!empty($Pji1->Nama)){
    $Penguji1x  = strtolower($Pji1->Nama);
    $Penguji1	  = ucwords($Penguji1x); 
    $GelarPj1   = $Pji1->Gelar;
  }else{
    $Penguji1   = "-";
    $GelarPj1   = "-";
  }

  //Penguji 2 ---------------------------------------------
  $Pji2 = DB::table('dosen')->where('Login',$dt->PengujiPro2)->first();
  if(!empty($Pji2->Nama)){
    $Penguji2x  = strtolower($Pji2->Nama);
    $Penguji2	  = ucwords($Penguji2x); 
    $GelarPj2   = $Pji2->Gelar;
  }else{
    $Penguji2   = "-";
    $GelarPj2   = "-";
  }

  //Penguji 3 ---------------------------------------------
  $Pji3 = DB::table('dosen')->where('Login',$dt->PengujiPro3)->first();
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

if ($dt->ProdiID=='SI'){$progst ="Sistem Informasi";}else{$progst ="Teknik Informatika"; }
?>

<div class="cetak">
<table align="center" width="100%">
<tr >
<td align="center"><b>BERITA ACARA UJIAN SIDANG SKRIPSI DAN COMPREHENSIVE</b></td>
</tr>
<tr >
<td align="center">Program Studi: <?php echo $prod ?></td>
</tr>
</table>     
<br>


<table >
<tr >
  <td style='border:none;text-align:justify;'>Pada hari ini,  <?php echo$dayList[$day] ?>, Tanggal <?php echo date('d',strtotime($dt->TglUjianProposal)) ?> Bulan <?php echo $bulList[$bul] ?> Tahun <?php echo date('Y',strtotime($dt->TglUjianProposal)) ?> Ujian Sidang Skripsi dan
Comprehensive Program Strata-1 ( S1 ),  
  Program Studi <?php echo $progst ?> STMIK Hang Tuah Pekanbaru terhadap:
  </td>
</tr>
</table>

<table  width="98%" border="0" align="center">
  <tr >
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
  </tr>
  <tr >
    <td  width="5%">1.</td>
    <td  width="170px">Nama</td>
    <td  width="3%">:</td>
    <td  > <?php echo $dt->NamaMhs ?></td>
  </tr>
  <tr >
    <td  >&nbsp;</td>
    <td >NIM</td>
    <td  >:</td>
    <td  ><?php echo $dt->MhswID ?></td>
  </tr>
  <tr >
    <td  >&nbsp;</td>
    <td  >Program Studi</td>
    <td  >:</td>
    <td  > <?php echo $prod ?></td>
  </tr>


  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>

<tr >
<td valign="top">2.</td>
<td valign="top">Judul Skripsi</td> 
<td valign="top">:</td>
<td valign="top"> <?php echo $Judul ?></td>           
</tr>

<tr >
<td  ></td>
<td  ></td> <td >&nbsp;</td>
<td  ></td>           
</tr>

<tr >
  <td  >3.</td>
  <td >Dosen Pembimbing 1</td>
  <td  >:</td>
  <td ><?php echo$Pembimbing1 ?>, <?php echo$GelarPm1 ?></td>
</tr>
<tr >
  <td  >&nbsp;</td>
<td >Dosen Pembimbing 2</td> 
<td >:</td><td > <?php echo $Pembimbing2 ?>, <?php echo $GelarPm2 ?></td>           
</tr>

<tr >
  <td >4.</td>
<td  >Waktu Ujian</td> 
<td  >:</td><td ><?php echo substr($dt->JamMulaiUjianSkripsi,0,5) ?> s/d <?php echo substr($dt->JamSelesaiUjianSkripsi,0,5)?> WIB</td>           
</tr>

<tr >
  <td >5.</td>
<td  >Tempat Ujian</td> 
<td >:</td>
<td > Kampus STMIK Hang Tuah Pekanbaru</td>           
</tr>

<tr  >
  <td >6.</td>
  <td >Nilai</td>
  <td >:</td>
  <td >Angka = ..... &nbsp; Huruf =&nbsp; A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E</td>
</tr>
<tr  >
  <td  >7.</td>
<td  >Keterangan</td> 
<td  >:</td>
<td  >1. Lulus &nbsp;&nbsp;&nbsp;&nbsp;2. Tidak Lulus</td>           
</tr>
</table>


<table  width='100%'>
  <tr >
    <td  >&nbsp;</td>   
  </tr>
  <tr >
    <td  align="center"><u>PANITIA UJIAN</u></td>   
  </tr>
  <tr >
    <td >&nbsp;</td>   
  </tr>
</table>


<table width="70%" align="center" border="1">
  <tr >
    <td width='20%' height=30 >&nbsp;Ketua</td>
    <td width='40%' >&nbsp;<?php echo $Penguji3 ?>, <?php echo $GelarPj3 ?></td>
    <td width='20%' >&nbsp;1. </td>
  
  </tr>
   <tr  >
    <td height=30 >&nbsp;Anggota</td>
    <td >&nbsp;<?php echo $Penguji1 ?>, <?php echo $GelarPj1 ?></td>
    <td >&nbsp;2. </td>
	
  </tr>
   <tr >
    <td height=30 >&nbsp;Anggota</td>
    <td >&nbsp;<?php echo $Penguji2 ?>, <?php echo $GelarPm2 ?></td>
    <td >&nbsp;3.  </td>
  </tr>
</table>
<br>
<br>


<table width="100%" align="center" border="0">
<tr >
<td align="center">Diketahui / disetujui oleh</td>
</tr>

<tr >
  <td align="center">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>


<tr >
  <td >&nbsp;</td>
</tr>
<tr >
  <td >&nbsp;</td>
</tr>

<tr >
<td align="center">Hendry Fonda, M.Kom</td>
</tr>
<tr >
<td align="center">NIDN. 1015027102</td>
</tr>
</table>

<br>

<table >
<tr >
<td  width='300'><b style='font-size:10px;font-weight:reguler;'>Login by: <?php echo Session()->get('username') ?> - <?php echo (date('d-m-Y'))." ".date('H:i:s') ?>  WIB - STMIK HTP Support System</b></td>
</tr>
</table>	

</div>
</body>
</html>