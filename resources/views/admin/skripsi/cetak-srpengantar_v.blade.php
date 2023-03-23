<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	
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
      padding: 1px;
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
      /* font-size:14px; */
    }
    </style>
  
  <!-- <style type="text/css" media="print">
  @page { size: landscape; }
  </style> -->

</head>
<body onload="window.print();">
	<div class="cetak">
@include('admin/kop_laporan/kop_lap')
<br>

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


echo"<table border='0' width='90%' align='center'>
  <tr >
    <td width='100' >Nomor</td>
    <td width='10' >:</td>
    <td width='254' > ... /STMIK-HTP/$BlnRomawi/$tahun </td>
    <td width='105' >&nbsp;</td>
    <td width='329' style='border:none;text-align:right'>Pekanbaru, ".date('d-m-Y')."</td>
  </tr>
  <tr >
    <td >Lampiran</td>
    <td >:</td>
    <td >-</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td >Perihal</td>
    <td >:</td>
    <td >Permohonan Penelitian</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
</table>
<br>

<table width='90%' border='0' align='center'>
  <tr >
    <td  width='122'>&nbsp;</td>
    <td >&nbsp;</td>
    <td  colspan='3'>Kepada Yth,</td>
  </tr>
  <tr >
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td  colspan='3'>$dt->Ke</td>
  </tr>
  <tr  >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td   colspan='3'>di </td>
  </tr>
  <tr  >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td  colspan='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dt->Kota</td>
  </tr>
  <tr  >
  <td >&nbsp;</td>
  <td >&nbsp;</td>
  <td  colspan='3'>&nbsp;</td>
</tr>

<tr >
  <td >&nbsp;</td>
  <td >&nbsp;</td>
  <td  colspan='3'>Dengan hormat,</td>
</tr>

<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td colspan='3' style='border:none;text-align:justify'>Ketua Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK) Hang Tuah Pekanbaru, dengan ini memberikan surat pengantar kepada Mahasiswa</td>
</tr>

<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td  colspan='3'>&nbsp;</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td  width='140'>Nama</td>
<td  width='13' >:</td>
<td  width='491' >$NamaMhs</td>
</tr>
<tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >NIM</td>
    <td >:</td>
    <td >$dt->MhswID</td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >Program Studi</td>
    <td >:</td>
    <td >$prod</td>
  </tr>
    <tr >
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >No. Handphone</td>
    <td >:</td>
    <td >$dt->Handphone</td>
  </tr>
  </tr>
  <tr >
  <td valign='top'>&nbsp;</td>
  <td valign='top'>&nbsp;</td>
  <td valign='top'>Judul Penelitian</td>
  <td valign='top'>:</td>
  <td valign='top' style='border:none;text-align:justify'>$dt->Judul</td>
</tr>


<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td border:none colspan='3' style='text-align:justify;border:none'>Untuk melakukan Penelitian di Instansi/Perusahaan yang Bapak/Ibu pimpin. Sehubungan dengan hal tersebut, kami mohon kiranya Bapak/Ibu dapat memberikan izin dan bantuannya kepada yang bersangkutan.</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td >&nbsp;</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td  colspan='3'  >Demikianlah atas perhatian dan kerjasamanya kami ucapkan terimakasih.</td>
</tr>
<tr >
<td >&nbsp;</td>
<td >&nbsp;</td>
<td  colspan='3'  ></td>
</tr>



<table >
<tr >
  <td  align='center'>&nbsp;</td>
  <td  align='center'>&nbsp;</td>
</tr>

<tr  >
  <td  width='60%' align='center'>&nbsp;</td>
  <td  width='30%' align='center'>STMIK Hang Tuah Pekanbaru</td>
</tr> 
<tr  >
  <td align='center'>&nbsp;</td>
  <td align='center'>Ketua</td>
</tr>
<tr  >
  <td  align='center' >&nbsp;</td>
  <td  align='center' >&nbsp;</td>
  </tr>

<tr >
  <td  align='center' >&nbsp;</td>
  <td  align='center' >&nbsp;</td>
</tr>
  
<tr  >
  <td  align='center' >&nbsp;</td>
  <td  align='center' ><u>Hendry Fonda, S.Kom, M.Kom</u></td>
  </tr>



<tr >
  <td  align='center'>&nbsp;</td>
  <td  align='center'>NIDN. 1015027102</td>
</tr>
<tr >
  <td  align='center'>&nbsp;</td>
  <td  align='center'>&nbsp;</td>
</tr>
</table>
<br>



<font style='font-size:8px'>Login by: ".Session()->get('username')." ".(date('d-m-Y'))." WIB - STMIK HTP Support System</font>";

?>	
	</div>
</body>