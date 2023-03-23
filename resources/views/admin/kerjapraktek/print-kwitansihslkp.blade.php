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
  <style >
    body {
      font: normal 15px Verdana, Arial, sans-serif; 
    }
    .garis_tepi0 {
      border:  2px dotted #FF8533;
      width:auto;
      margin:auto;
    }
    .garis_tepi {
      border:  2px dashed #FF8533;
      width:auto;
      margin:auto;
    }
  </style>
  </head>

<body>

<?php 
$dt = DB::table('jadwal_kp')
->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
->where('jadwal_kp.JadwalID',$jadwal->JadwalID)
->first();

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
  
  $Pji1 = DB::table('dosen')->where('Login',$dt->PengujiSeminarHasil1)->first();
  if(!empty($Pji1->Nama)){
    $Penguji1x  = strtolower($Pji1->Nama);
    $Penguji1	  = ucwords($Penguji1x); 
    $GelarPj1   = $Pji1->Gelar;
  }else{
    $Penguji1   = "-";
    $GelarPj1   = "-";
  }

  //Penguji 2 ---------------------------------------------
  $Pji2 = DB::table('dosen')->where('Login',$dt->PengujiSeminarHasil2)->first();
  if(!empty($Pji2->Nama)){
    $Penguji2x  = strtolower($Pji2->Nama);
    $Penguji2	  = ucwords($Penguji2x); 
    $GelarPj2   = $Pji2->Gelar;
  }else{
    $Penguji2   = "-";
    $GelarPj2   = "-";
  }

  //Penguji 3 ---------------------------------------------
  $Pji3 = DB::table('dosen')->where('Login',$dt->PengujiSeminarHasil3)->first();
  if(!empty($Pji3->Nama)){
    $Penguji3x 	  = strtolower($Pji3->Nama);
    $Penguji3	    = ucwords($Penguji3x);
    $GelarPj3     = $Pji3->Gelar;
  }else{
    $Penguji3     = "-";
    $GelarPj3     = "-";
  }

$dth    = DB::table('t_biaya')->where('BiayaID','2')->first();									 
$n1 		=$dth->Jumlah;
$Nominal=terbilang($n1);
$o1 		=$dth->Jumlah;
$NominalPenguji =terbilang($o1);
?>

<!-- PEMBIMBING  ============================================================================================================================================= -->
<div class='garis_tepi0'>
<div class='garis_tepi'>

<!-- table luar untuk frame -->
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;padding:20px">

@include('admin/include/headerlap2')

<table  class="printer" style="border:none;padding:2px">
<tr>
<td colspan='3' height=20 style=text-align:center;font-size:18px;font-weight:reguler;background-color:#FF8533;>  <b style=color:#FFFFFF>:: KWITANSI ::</b>  </td>
</tr>
</table>
<br>

<table  class="printer" style="border:none;padding:2px">
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px" width="25%">Sudah terima dari</td>
<td style="border:none;padding:2px" width="2%">: </td>
<td  style="border:none;padding:2px">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Uang sejumlah</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Rp. <?php echo  number_format($n1) ?></td>
</tr>

<tr   style="border:none;padding:2px">
<td style="border:none;padding:2px;font-style:italic;">Terbilang</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px;font-style:italic;"><textarea rows="2" cols="70"><?php echo $Nominal ?> rupiah </textarea></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Untuk pembayaran</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Honor Pembimbing Kerja Praktek Tahun <?php echo $dt->TahunID ?></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Mahasiswa</td>
<td style="border:none;padding:2px">:</td><td style="border:none;padding:2px"></td>
</tr>";
<?php
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
  $NamaMhsx   = strtolower($data->NamaMhs);
	$NamaMhs    = ucwords($NamaMhsx);
?>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px"></td>
  <td style="border:none;padding:2px">: </td><td style="border:none;padding:2px"><?php echo $data->MhswID ?> - <?php echo $NamaMhs ?></td>
  </tr>";
<?php
  }
?>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Program Studi</td>
<td style="border:none;padding:2px">: </td>
<td style="border:none;padding:2px"> <?php echo $prod ?> </td>
</tr>
</table>

<br>
<table style="border:none;padding:2px">
<tr style="border:none;padding:2px">
<td style="border:none;padding:2px" widtstyle="border:none;padding:2px" width="120"  ></td>
<td style="border:none;padding:2px" width="120" ></td>
<td style="border:none;padding:2px;text-align:center" width="120" >Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px;text-align:center" >Bendaharawan</td>
<td style="border:none;padding:2px;text-align:center" >Setuju Dibayar</td>
<td style="border:none;padding:2px;text-align:center" >Yang Menerima</td>
</tr>
<tr style="border:none;padding:2px;text-align:center"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
<td style="border:none;padding:2px;text-align:center" >STMIK Hang Tuah Pekanbaru</td>
<td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>


<tr style="border:none;padding:2px" >
  <td style="border:none;padding:2px;text-align:center">Zupri Henra Hartomi, M.Kom</td>
<td style="border:none;padding:2px;text-align:center">Hendry Fonda, M.Kom</td>
<td style="border:none;padding:2px;text-align:center"><?php echo $Pembimbing1 ?>, <?php echo $GelarPm1 ?></td>
</tr>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px">&nbsp;</td>
</tr>
</table>

<table style="border:none;padding:2px">
<tr style=background-color:#FFB482;border:none;padding:2px >
<td  width=300 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
- Mohon hitung kembali nominal uang yang diterima <br>
- Komplain tidak diterima setelah meninggalkan program studi 
</td>
<td width=320 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y H:i:s'))  ?> WIB - STMIK HTP Support System</b>
&nbsp;
</td>
</tr>


</td>
</tr>
</table>
</table> <!-- tabel luar -->

</div>
</div>

<p></p>


<!-- PENGUJI 1 ============================================================================================================================================= -->
<div class='garis_tepi0'>
<div class='garis_tepi'>

<!-- table luar untuk frame -->
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;padding:20px">

@include('admin/include/headerlap2')

<table  class="printer" style="border:none;padding:2px">
<tr>
<td colspan='3' height=20 style=text-align:center;font-size:18px;font-weight:reguler;background-color:#FF8533;>  <b style=color:#FFFFFF>:: KWITANSI ::</b>  </td>
</tr>
</table>
<br>

<table  class="printer" style="border:none;padding:2px">
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px" width="25%">Sudah terima dari</td>
<td style="border:none;padding:2px" width="2%">: </td>
<td  style="border:none;padding:2px">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Uang sejumlah</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Rp. <?php echo  number_format($n1) ?></td>
</tr>

<tr   style="border:none;padding:2px">
<td style="border:none;padding:2px;font-style:italic;">Terbilang</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px;font-style:italic;"><textarea rows="2" cols="70"><?php echo $Nominal ?> rupiah </textarea></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Untuk pembayaran</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Honor Penguji Ujian Hasil Kerja Praktek Tahun <?php echo $dt->TahunID ?></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Mahasiswa</td>
<td style="border:none;padding:2px">:</td><td style="border:none;padding:2px"></td>
</tr>";
<?php
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
  $NamaMhsx   = strtolower($data->NamaMhs);
	$NamaMhs    = ucwords($NamaMhsx);
?>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px"></td>
  <td style="border:none;padding:2px">: </td><td style="border:none;padding:2px"><?php echo $data->MhswID ?> - <?php echo $NamaMhs ?></td>
  </tr>";
<?php
  }
?>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Program Studi</td>
<td style="border:none;padding:2px">: </td>
<td style="border:none;padding:2px"> <?php echo $prod ?> </td>
</tr>
</table>

<br>
<table style="border:none;padding:2px">
<tr style="border:none;padding:2px">
<td style="border:none;padding:2px" widtstyle="border:none;padding:2px" width="120"  ></td>
<td style="border:none;padding:2px" width="120" ></td>
<td style="border:none;padding:2px;text-align:center" width="120" >Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px;text-align:center" >Bendaharawan</td>
<td style="border:none;padding:2px;text-align:center" >Setuju Dibayar</td>
<td style="border:none;padding:2px;text-align:center" >Yang Menerima</td>
</tr>
<tr style="border:none;padding:2px;text-align:center"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
<td style="border:none;padding:2px;text-align:center" >STMIK Hang Tuah Pekanbaru</td>
<td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>


<tr style="border:none;padding:2px" >
  <td style="border:none;padding:2px;text-align:center">Zupri Henra Hartomi, M.Kom</td>
<td style="border:none;padding:2px;text-align:center">Hendry Fonda, M.Kom</td>
<td style="border:none;padding:2px;text-align:center"><?php echo $Penguji1 ?>, <?php echo $GelarPj1 ?></td>
</tr>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px">&nbsp;</td>
</tr>
</table>

<table style="border:none;padding:2px">
<tr style=background-color:#FFB482;border:none;padding:2px >
<td  width=300 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
- Mohon hitung kembali nominal uang yang diterima <br>
- Komplain tidak diterima setelah meninggalkan program studi 
</td>
<td width=320 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y H:i:s'))  ?> WIB - STMIK HTP Support System</b>
&nbsp;
</td>
</tr>


</td>
</tr>
</table>
</table> <!-- tabel luar -->

</div>
</div>

<p></p>

<!-- PENGUJI 2 ========================================================================================================================= -->
<div class='garis_tepi0'>
<div class='garis_tepi'>

<!-- table luar untuk frame -->
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;padding:20px">

@include('admin/include/headerlap2')

<table  class="printer" style="border:none;padding:2px">
<tr>
<td colspan='3' height=20 style=text-align:center;font-size:18px;font-weight:reguler;background-color:#FF8533;>  <b style=color:#FFFFFF>:: KWITANSI ::</b>  </td>
</tr>
</table>
<br>

<table  class="printer" style="border:none;padding:2px">
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px" width="25%">Sudah terima dari</td>
<td style="border:none;padding:2px" width="2%">: </td>
<td  style="border:none;padding:2px">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Uang sejumlah</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Rp. <?php echo  number_format($n1) ?></td>
</tr>

<tr   style="border:none;padding:2px">
<td style="border:none;padding:2px;font-style:italic;">Terbilang</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px;font-style:italic;"><textarea rows="2" cols="70"><?php echo $Nominal ?> rupiah </textarea></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Untuk pembayaran</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Honor Penguji Ujian Hasil Kerja Praktek Tahun <?php echo $dt->TahunID ?></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Mahasiswa</td>
<td style="border:none;padding:2px">:</td><td style="border:none;padding:2px"></td>
</tr>";
<?php
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
  $NamaMhsx   = strtolower($data->NamaMhs);
	$NamaMhs    = ucwords($NamaMhsx);
?>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px"></td>
  <td style="border:none;padding:2px">: </td><td style="border:none;padding:2px"><?php echo $data->MhswID ?> - <?php echo $NamaMhs ?></td>
  </tr>";
<?php
  }
?>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Program Studi</td>
<td style="border:none;padding:2px">: </td>
<td style="border:none;padding:2px"> <?php echo $prod ?> </td>
</tr>
</table>

<br>
<table style="border:none;padding:2px">
<tr style="border:none;padding:2px">
<td style="border:none;padding:2px" widtstyle="border:none;padding:2px" width="120"  ></td>
<td style="border:none;padding:2px" width="120" ></td>
<td style="border:none;padding:2px;text-align:center" width="120" >Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px;text-align:center" >Bendaharawan</td>
<td style="border:none;padding:2px;text-align:center" >Setuju Dibayar</td>
<td style="border:none;padding:2px;text-align:center" >Yang Menerima</td>
</tr>
<tr style="border:none;padding:2px;text-align:center"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
<td style="border:none;padding:2px;text-align:center" >STMIK Hang Tuah Pekanbaru</td>
<td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>


<tr style="border:none;padding:2px" >
  <td style="border:none;padding:2px;text-align:center">Zupri Henra Hartomi, M.Kom</td>
<td style="border:none;padding:2px;text-align:center">Hendry Fonda, M.Kom</td>
<td style="border:none;padding:2px;text-align:center"><?php echo $Penguji2 ?>, <?php echo $GelarPj2 ?></td>
</tr>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px">&nbsp;</td>
</tr>
</table>

<table style="border:none;padding:2px">
<tr style=background-color:#FFB482;border:none;padding:2px >
<td  width=300 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
- Mohon hitung kembali nominal uang yang diterima <br>
- Komplain tidak diterima setelah meninggalkan program studi 
</td>
<td width=320 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y H:i:s'))  ?> WIB - STMIK HTP Support System</b>
&nbsp;
</td>
</tr>


</td>
</tr>
</table>
</table> <!-- tabel luar -->

</div>
</div>

<p></p>
<!-- PENGUJI 3 ========================================================================================================================= -->
<div class='garis_tepi0'>
<div class='garis_tepi'>

<!-- table luar untuk frame -->
<table style="border:none;">
<tr style="border:none;">
<td style="border:none;padding:20px">

@include('admin/include/headerlap2')

<table  class="printer" style="border:none;padding:2px">
<tr>
<td colspan='3' height=20 style=text-align:center;font-size:18px;font-weight:reguler;background-color:#FF8533;>  <b style=color:#FFFFFF>:: KWITANSI ::</b>  </td>
</tr>
</table>
<br>

<table  class="printer" style="border:none;padding:2px">
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px" width="25%">Sudah terima dari</td>
<td style="border:none;padding:2px" width="2%">: </td>
<td  style="border:none;padding:2px">Ketua STMIK Hang Tuah Pekanbaru</td>
</tr>
<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Uang sejumlah</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Rp. <?php echo  number_format($n1) ?></td>
</tr>

<tr   style="border:none;padding:2px">
<td style="border:none;padding:2px;font-style:italic;">Terbilang</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px;font-style:italic;"><textarea rows="2" cols="70"><?php echo $Nominal ?> rupiah </textarea></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Untuk pembayaran</td>
<td style="border:none;padding:2px">:</td>
<td style="border:none;padding:2px">Honor Penguji Ujian Hasil Kerja Praktek Tahun <?php echo $dt->TahunID ?></td>
</tr>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Mahasiswa</td>
<td style="border:none;padding:2px">:</td><td style="border:none;padding:2px"></td>
</tr>";
<?php
  $data = DB::table('jadwal_kp_anggota')
  ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
  ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
  ->where('jadwal_kp_anggota.JadwalID',$jadwal->JadwalID)
  ->get(); 
  foreach($data as $data){
  $NamaMhsx   = strtolower($data->NamaMhs);
	$NamaMhs    = ucwords($NamaMhsx);
?>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px"></td>
  <td style="border:none;padding:2px">: </td><td style="border:none;padding:2px"><?php echo $data->MhswID ?> - <?php echo $NamaMhs ?></td>
  </tr>";
<?php
  }
?>

<tr  style="border:none;padding:2px">
<td style="border:none;padding:2px">Program Studi</td>
<td style="border:none;padding:2px">: </td>
<td style="border:none;padding:2px"> <?php echo $prod ?> </td>
</tr>
</table>

<br>
<table style="border:none;padding:2px">
<tr style="border:none;padding:2px">
<td style="border:none;padding:2px" widtstyle="border:none;padding:2px" width="120"  ></td>
<td style="border:none;padding:2px" width="120" ></td>
<td style="border:none;padding:2px;text-align:center" width="120" >Pekanbaru, <?php echo date('d-m-Y') ?></td>
</tr>
<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px;text-align:center" >Bendaharawan</td>
<td style="border:none;padding:2px;text-align:center" >Setuju Dibayar</td>
<td style="border:none;padding:2px;text-align:center" >Yang Menerima</td>
</tr>
<tr style="border:none;padding:2px;text-align:center"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
<td style="border:none;padding:2px;text-align:center" >STMIK Hang Tuah Pekanbaru</td>
<td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>

<tr style="border:none;padding:2px"  >
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
</tr>


<tr style="border:none;padding:2px" >
  <td style="border:none;padding:2px;text-align:center">Zupri Henra Hartomi, M.Kom</td>
<td style="border:none;padding:2px;text-align:center">Hendry Fonda, M.Kom</td>
<td style="border:none;padding:2px;text-align:center"><?php echo $Penguji3 ?>, <?php echo $GelarPj3 ?></td>
</tr>
<tr  style="border:none;padding:2px">
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px" >&nbsp;</td>
  <td style="border:none;padding:2px">&nbsp;</td>
</tr>
</table>

<table style="border:none;padding:2px">
<tr style=background-color:#FFB482;border:none;padding:2px >
<td  width=300 style=text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
- Mohon hitung kembali nominal uang yang diterima <br>
- Komplain tidak diterima setelah meninggalkan program studi 
</td>
<td width=320 style=text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20;border:none;padding:2px>
<b style='font-size:8px;font-weight:reguler;'>Login by: <?php echo Session()->get('username')." ". (date('d-m-Y H:i:s'))  ?> WIB - STMIK HTP Support System</b>
&nbsp;
</td>
</tr>


</td>
</tr>
</table>
</table> <!-- tabel luar -->

</div>
</div>

</body>








