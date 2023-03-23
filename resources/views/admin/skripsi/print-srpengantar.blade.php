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
  </style>
</head>
<body>
	<div class="cetak">
@include('admin/include/headerlap')


<?php 
$dt = DB::table('jadwal_skripsi')
->join('mhsw','mhsw.MhswID','=','jadwal_skripsi.MhswID')
->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
->where('jadwal_skripsi.JadwalID',$jadwal->JadwalID)
->first();

$JudulP 	  = strtolower($dt->Judul);
$Judul		  = ucwords($JudulP);

$NamaMhsx 	= strtolower($dt->NamaMhs);
$NamaMhs		= ucwords($NamaMhsx);

//08/Prodi-TI/STMIK-HTP/III/2016/
$ProdiID   	= $dt->ProdiID;
if ($ProdiID=='SI'){ 
	$prod	  ="Sistem Informasi"; 
	$kaprodi="Herianto, S.Kom, M.Kom";	
	$KD		  ="07"; 
	$KDPROD	="Prodi-SI"; 
	$nidn	  ="1008068202";
	}
else{ 
	$prod   ="Teknik Informatika"; 
	$kaprodi="Yuda Irawan, S.Kom, M.TI"; 
	$KD		  ="08"; 
	$KDPROD	="Prodi-TI";
	$nidn	  ="1016079101";
}

$bln	=date('m');
$tahun	=date('Y');
if($bln=='1'){$BlnRomawi="I";}elseif($bln=='2'){$BlnRomawi="II";} elseif($bln=='3'){$BlnRomawi="III";} elseif($bln=='4'){$BlnRomawi="IV";} elseif($bln=='5'){$BlnRomawi="V";}
elseif($bln=='6'){$BlnRomawi="VI";} elseif($bln=='7'){$BlnRomawi="VII";} elseif($bln=='8'){$BlnRomawi="VIII";} elseif($bln=='9'){$BlnRomawi="IX";} elseif($bln=='10'){$BlnRomawi="X";}
elseif($bln=='11'){$BlnRomawi="XI";}else{{$BlnRomawi="XII";}}
//cadangan =$KD/$KDPROD/STMIK-HTP/$BlnRomawi/$tahun/


echo"<table style='border:none' class='printer'>
  <tr style='border:none'>
    <td width='84' style='border:none'>Nomor</td>
    <td width='10' style='border:none'>:</td>
    <td width='254' style='border:none'> ... /STMIK-HTP/$BlnRomawi/$tahun </td>
    <td width='105' style='border:none'>&nbsp;</td>
    <td width='329' style='border:none;text-align:right'>Pekanbaru, ".date('d-m-Y')."</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none'>Lampiran</td>
    <td style='border:none'>:</td>
    <td style='border:none'>-</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none'>Perihal</td>
    <td style='border:none'>:</td>
    <td style='border:none'>Permohonan Penelitian</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
  </tr>
</table>
<br>

<table style='border:none' class='printer'>
  <tr style='border:none'>
    <td style='border:none' width='79'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none' colspan='3'>Kepada Yth,</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none' >&nbsp;</td>
    <td style='border:none' >&nbsp;</td>
    <tdstyle='border:none'  colspan='3'>$dt->Ke</td>
  </tr>
  <tr style='border:none' >
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'  colspan='3'>di </td>
  </tr>
  <tr style='border:none' >
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none' colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dt->Kota</td>
  </tr>
  <tr style='border:none' >
  <td style='border:none'>&nbsp;</td>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none' colspan='3'>&nbsp;</td>
</tr>
<tr style='border:none'>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none' colspan='3'>&nbsp;</td>
</tr>
<tr style='border:none'>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none' colspan='3'>Dengan hormat,</td>
</tr>

<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td colspan='3' style='border:none;text-align:justify'>Ketua Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK) Hang Tuah Pekanbaru, dengan ini memberikan surat pengantar kepada Mahasiswa</td>
</tr>

<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none' colspan='3'>&nbsp;</td>
</tr>
<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none' width='140'>Nama</td>
<td style='border:none' width='13' >:</td>
<td style='border:none' width='491' >$NamaMhs</td>
</tr>
<tr style='border:none'>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>NIM</td>
    <td style='border:none'>:</td>
    <td style='border:none'>$dt->MhswID</td>
  </tr>
  <tr style='border:none'>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>Program Studi</td>
    <td style='border:none'>:</td>
    <td style='border:none'>$prod</td>
  </tr>
    <tr style='border:none'>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>&nbsp;</td>
    <td style='border:none'>No. Handphone</td>
    <td style='border:none'>:</td>
    <td style='border:none'>$dt->Handphone</td>
  </tr>
  </tr>
  <tr style='border:none'>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none'>&nbsp;</td>
  <td style='border:none'>Judul Penelitian</td>
  <td style='border:none'>:</td>
  <td style='border:none;text-align:justify'>$dt->Judul</td>
</tr>


<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
</tr>
<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td border:none colspan='3' style='text-align:justify;border:none'>Untuk melakukan Penelitian di Instansi/Perusahaan yang Bapak/Ibu pimpin. Sehubungan dengan hal tersebut, kami mohon kiranya Bapak/Ibu dapat memberikan izin dan bantuannya kepada yang bersangkutan.</td>
</tr>
<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
</tr>
<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none' colspan='3'  >Demikianlah atas perhatian dan kerjasamanya kami ucapkan terimakasih.</td>
</tr>
<tr style='border:none'>
<td style='border:none'>&nbsp;</td>
<td style='border:none'>&nbsp;</td>
<td style='border:none' colspan='3'  ></td>
</tr>



<table style='border:none'>
<tr style='border:none'>
  <td style='border:none' align='center'>&nbsp;</td>
  <td style='border:none' align='center'>&nbsp;</td>
</tr>

<tr style='border:none' >
  <td style='border:none' width='300' align='center'>&nbsp;</td>
  <td style='border:none' width='300' align='center'>STMIK Hang Tuah Pekanbaru</td>
</tr> 
<tr style='border:none' >
  <td style='border:none' width='300' align='center'>&nbsp;</td>
  <td style='border:none' width='300' align='center'>Ketua</td>
</tr>
<tr style='border:none' >
  <td style='border:none' align='center' >&nbsp;</td>
  <td style='border:none' align='center' >&nbsp;</td>
  </tr>

<tr style='border:none'>
  <td style='border:none' align='center' >&nbsp;</td>
  <td style='border:none' align='center' >&nbsp;</td>
</tr>
  
<tr style='border:none'>
  <td style='border:none' align='center' >&nbsp;</td>
  <td style='border:none' align='center' >&nbsp;</td>
  </tr>  
 
<tr style='border:none' >
  <td style='border:none' align='center' >&nbsp;</td>
  <td style='border:none' align='center' ><u>Hendry Fonda, S.Kom, M.Kom</u></td>
  </tr>



<tr style='border:none'>
  <td style='border:none' align='center'>&nbsp;</td>
  <td style='border:none' align='center'>NIDN. 1015027102</td>
</tr>
<tr style='border:none'>
  <td style='border:none' align='center'>&nbsp;</td>
  <td style='border:none' align='center'>&nbsp;</td>
</tr>
</table>
  </table>
<br>
<br>
<br>
<br>


<font style='font-size:8px'>Login by: ".Session()->get('username')." ".(date('d-m-Y'))." WIB - STMIK HTP Support System</font>";

?>	
	</div>
</body>