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
<table class="printer">
<tr>
<?php

   $logo  = DB::table('konfigurasi')->where('id_konfigurasi','1')->first();
   if($logo->logo!="-") { 
   $src = "$logo->logo";
   }else{
   $src = "20none90308none63048-blank.PNG";
   } 

   $no = 1;
      $prodiq = $prodiplh;
      $jadwal = DB::table('jadwal')
      ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID','LEFT')
      ->join('mk', 'mk.MKID', '=', 'jadwal.MKID','LEFT')
      ->join('hari', 'hari.HariID', '=', 'jadwal.HariID','LEFT')  
      ->join('ruang', 'ruang.RuangID', '=', 'jadwal.RuangID','LEFT') 
      ->where('jadwal.TahunID',$tahunplh)             
      ->where('jadwal.ProdiID',$prodiq)
      ->where('jadwal.HariID',$hari)  
      ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari','mk.Sesi','ruang.Nama as NamaRuang')
      ->get();
   foreach ($jadwal as $dta){  
      //$ProdiID = $dta->ProdiID;	
      if ($prodiplh=='SI'){ $prod="Sistem Informasi"; $kaprodi="Herianto, M.Kom";}else{ $prod="Teknik Informatika"; $kaprodi="Yuda Irawan, S.Kom, M.Pd";}
      
      $nama1 			= $dta->NamaMK;
      $nama_kecil1 	= strtolower($nama1);
      $mk				= ucwords($nama_kecil1);    
      $namad 			= $dta->NamaDosen;
      $nama_dos1 		= strtolower($namad);
      $dosen			= ucwords($nama_dos1);
?>		
<td class='box' width='335'>
<table class="printer" >
<tr class='header' style='background-color:#E6E6E6;padding:5px'>
   <td width='60' align='center'>
      <img src="{{ asset('public/upload/image/thumbs/'.$src) }}" width='50'>
   </td>
   <td width='130' align='center' valign='middle' style='padding: 5px 30px;'>
   <b>UJIAN AKHIR SEMESTER (UAS) <br> TA <?php echo $dta->TahunID ?> <br> <font style='font-size:8px'>Powered by: STMIK HTP Support System </font></b>
   </td>
</tr>
<tr><td height='20' width='150'>&nbsp;Kode</td><td width='300'>&nbsp; <?php echo $dta->MKKode ?></td></tr>				
<tr><td height='20'>&nbsp;Matakuliah</td><td>&nbsp; <?php echo $mk ?></td></tr>
<tr><td height='20'>&nbsp;Dosen Pengampu</td><td>&nbsp; <?php echo $dosen ?>, <?php echo $dta->Gelar ?></td></tr>
<tr><td height='20'>&nbsp;Semester</td><td>&nbsp; <?php echo $dta->Sesi ?> - <?php echo $prod ?></td></tr>
<tr><td height='20'>&nbsp;Kelas / Ruang</td><td>&nbsp; <?php echo $dta->NamaKelas ?> / <?php echo $dta->NamaRuang ?></td></tr>
<tr><td height='20'>&nbsp;Waktu</td><td>&nbsp; <?php echo $dta->NamaHari ?>, <?php echo $dta->JamMulai ?> WIB s/d <?php echo $dta->JamSelesai ?> WIB</td></tr>
</table>
</td>
<?php
  if($no%2==0) echo"</tr><tr>";
  $no++;
}
?>
</tr>
</table>
</div>
</body>