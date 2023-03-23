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
$dt = DB::table('jadwal_kp')
->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
->where('jadwal_kp.JadwalID',$jadwal->JadwalID)
->first();

$JudulP 	= strtolower($dt->Judul);
$Judul		= ucwords($JudulP);

$ProdiID   	= $dt->ProdiID;
if ($ProdiID=='SI'){ $prod="Sistem Informasi"; $kaprodi="Herianto, S.Kom, M.Kom";}else{ $prod="Teknik Informatika"; $kaprodi="Yuda Irawan, S.Kom, M.TI";}

$p1 = DB::table('dosen')->where('Login',$dt->DosenID)->first();
  if(!empty($p1->Nama)){
    $Pembimbing1x   = strtolower($p1->Nama);
    $Pembimbing1	  = ucwords($Pembimbing1x); 
    $GelarPm1       = $p1->Gelar;    
  }else{
    $Pembimbing1    = "-";
    $GelarPm1       = "-";
  }
  
  $Pji1 = DB::table('dosen')->where('Login',$dt->Penguji1)->first();
  if(!empty($Pji1->Nama)){
    $Penguji1x  = strtolower($Pji1->Nama);
    $Penguji1	  = ucwords($Penguji1x); 
    $GelarPj1   = $Pji1->Gelar;
  }else{
    $Penguji1   = "-";
    $GelarPj1   = "-";
  }

  //Penguji 2 ---------------------------------------------
  $Pji2 = DB::table('dosen')->where('Login',$dt->Penguji2)->first();
  if(!empty($Pji2->Nama)){
    $Penguji2x  = strtolower($Pji2->Nama);
    $Penguji2	  = ucwords($Penguji2x); 
    $GelarPj2   = $Pji2->Gelar;
  }else{
    $Penguji2   = "-";
    $GelarPj2   = "-";
  }

  //Penguji 3 ---------------------------------------------
  $Pji3 = DB::table('dosen')->where('Login',$dt->Penguji3)->first();
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



$tgl = substr($dt->TglMulaiSidang,8,2); //2017-01-01
$bln = substr($dt->TglMulaiSidang,5,2);
$thn = substr($dt->TglMulaiSidang,0,4);

$tanggal = $dt->TglMulaiSidang;
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

?>

<body>
<div class="cetak">
<table class="printer" style="border:none">
<tr style="border:none">
<td style="text-align:center;border:none"><b>BERITA ACARA SEMINAR PROPOSAL KERJA PRAKTEK </b></td>
</tr>
</table>     
<br>
<br>

<table class="printer" style="border:none">
<tr style="text-align:center;border:none">
  <td style="text-align:justify;border:none" height=25>Pada hari ini,  <?php echo $dayList[$day]?>,  Tanggal <?php echo $tgl ?> Bulan <?php echo $bulList[$bul]?> Tahun <?php echo $thn ?> Telah dilaksanakan Ujian Proposal Kerja Praktek Program Strata-1 (S1),  
  Program Studi <?php echo $prod ?> STMIK Hang Tuah Pekanbaru terhadap:
  </td>
</tr>
</table>
<br>
<table class="printer" style="border:none">
  <tr style='background-color:#E6E6E6'>
    <td width='25' style="text-align:center" height=25>No</td>
    <td width='230' style="text-align:left;">Nama</td>
    <td width='100' style="text-align:center">NIM </td>
    <td width='140' style="text-align:center">Program Studi</td>
    <td width='100' style="text-align:center">Jenjang</td>
  </tr>
	
  <?php
  $nom =0;
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
	$nom++;
	$nama 		  = $data->NamaMhs;
	$namax 		  = strtolower($nama);
	$nama_kecil = ucwords($namax);	
	$prodi 		  = $data->ProdiID;
?>

   <tr>
    <td width='0' style="text-align:center" height=20><?php echo $nom ?></td>
    <td width='0'><?php echo $nama_kecil ?></td>
    <td width='0' style="text-align:center"> <?php echo $data->MhswID ?></td>
    <td width='0' style="text-align:center"><?php echo $prod ?></td>
    <td width='0' style="text-align:center">S1 (Strata 1)</td>	
  </tr>";
<?php 
}
?>
</table>
<br>
<table style="border:none">
<tr style="border:none">
<td  style="border:none;text-align:justify;" width='152'>1. Judul</td> <td style="border:none" width='5'>:</td><td style="border:none" width='505'> <?php echo $dt->Judul ?> </td>           
</tr>

<tr style="border:none">
<td style="border:none" width='152'></td> <td style="border:none" width='5'>&nbsp;</td><td style="border:none" width='450'></td>           
</tr>

<tr style="border:none">
<td style="border:none" width='152'>2. Dosen Pembimbing</td> <td style="border:none" width='5'>:</td><td style="border:none" width='450'> <?php echo $Pembimbing1 ?>, <?php echo $GelarPm1 ?></td>           
</tr>

<tr style="border:none">
<td style="border:none" width='152'>3. Waktu Ujian</td> <td style="border:none" width='5'>:</td><td style="border:none" width='450'> <?php echo substr($dt->JamMulai,0,5) ?> s/d <?php echo substr($dt->JamSelesai,0,5) ?> WIB</td>           
</tr>

<tr style="border:none">
<td style="border:none" width='152'>4. Tempat Ujian</td> <td style="border:none" width='5'>:</td><td style="border:none" width='450'> <?php echo $dt->TempatUjian ?></td>           
</tr>

<tr>
<td style="border:none" width='152'>5. Nilai</td> <td style="border:none" width='5'>:</td><td style="border:none" width='450'></td>           
</tr style="border:none">
</table>


<br>
<table width='427' style="text-align:center" cellspacing='0'>
  <tr style='background-color:#E6E6E6'>
    <td width='25' style="text-align:center;vertical-align:middle" height=25>No</td>
    <td width='230' style="text-align:left;border:none;vertical-align:middle">Nama</td>
    <td width='100' style="text-align:center;vertical-align:middle">NIM </td>
    <td width='60' style="text-align:center">Penguji I<br>(1)</td>
    <td width='60' style="text-align:center">Penguji II<br>(2)</td>
	 <td width='60' style="text-align:center">Penguji III<br>(3)</td>
	 <td width='60' style="text-align:center">Nilai<br>(1+2+3)/3</td>
  </tr>
	
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

   <tr>
    <td width='0' style="text-align:center" height=20> <?php echo $nob ?></td>
    <td width='0'><?php echo $nama_kecil ?> </td>
    <td width='0' style="text-align:center"><?php echo $data->MhswID ?> </td>
    <td width='0' style="text-align:center">...</td>
    <td width='0' style="text-align:center">...</td>
	<td width='0' style="text-align:center">...</td>
	<td width='0' style="text-align:center">...</td>	
  </tr>
<?php  
}
?>
</table>
<br>
<table style="border:none" >  
  <tr style="border:none">
    <td style="border:none" width=152>6. Keterangan</td>
    <td style="border:none">: 1. Lulus &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Tidak Lulus</td>
    <td style="border:none"> </td>
  </tr>
</table>
<br>
<table style="border:none" width='700'  cellpadding='0' cellspacing='0' >
  <tr style="border:none">
    <td style="border:none" width='152'>&nbsp;</td>   
  </tr>
  <tr style="border:none">
    <td style="border:none" width='400' style="text-align:center"><u>PANITIA UJIAN</u></td>   
  </tr>
</table>
<br>
<table style="border:none" width='0' cellpadding='0' cellspacing='0'>
  <tr style="border:none">
    <td style="border:none" width='152' height=25>Ketua</td>
    <td style="border:none" width='10'>:</td>
    <td style="border:none" width='200'><?php echo $Penguji1 ?>, <?php echo $GelarPj1 ?></td>
    <td style="border:none" width='0'>1. --------------------------------------</td>	
  </tr>

   <tr style="border:none">
    <td style="border:none" width='100' height=25>Anggota</td>
    <td style="border:none" width='10'>:</td>
    <td style="border:none" width='200'><?php echo $Penguji2 ?>, <?php echo $GelarPj2 ?></td>
    <td style="border:none" width='0'>2. --------------------------------------</td>
  </tr>

   <tr style="border:none">
    <td style="border:none" width='100 height=25'>Anggota</td>
    <td style="border:none" width='10'>:</td>
    <td style="border:none" width='200'><?php echo $Penguji3 ?>, <?php echo $GelarPj3 ?></td>
    <td style="border:none" width='0'>3. -------------------------------------- </td>
	
  </tr>
</table>
<br>
<br>


<table style="border:none"  cellpadding='0' cellspacing='0' >
<tr style="border:none">
<td width='367' style="text-align:center;border:none">Diketahui / disetujui oleh</td>
</tr>

<tr style="border:none">
  <td style="text-align:center;border:none">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>

<tr style="border:none">
  <td style="" style="text-align:center;border:none" >&nbsp;</td>
</tr>

<tr style="border:none">
  <td style="text-align:center;border:none" >&nbsp;</td>
</tr>

<tr style="border:none">
<td style="text-align:center;border:none">Hendry Fonda, M.Kom</td>
</tr>
<tr style="border:none">
<td style="text-align:center;border:none">NIDN. 1015027102</td>
</tr>
</table>
<br>
<br>
<br>
<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y'))  ?> WIB - STMIK HTP Support System</b>
