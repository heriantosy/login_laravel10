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

<?php 
$mboh = DB::table('jadwal')
->join('dosen','dosen.Login','=','jadwal.DosenID')
->join('mk','mk.MKID','=','jadwal.MKID')
->select('jadwal.*','dosen.Login','dosen.Nama as NamaDosen','dosen.Gelar','mk.Nama as NamaMK','mk.SKS','mk.Sesi','mk.ProdiID')
->where('jadwal.JadwalID',$jadwal->JadwalID)
->first();

$prodix = str_replace(".","",$jadwal->ProdiID);
$prodi  = DB::table('prodi')->where('ProdiID',$prodix)->first();
$dosen  = DB::table('dosen')->where('Login',$jadwal->DosenID)->first();

$prodi    = DB::table('prodi')->where('ProdiID',$mboh->ProdiID)->first();
$hari    = DB::table('hari')->where('HariID',$mboh->HariID)->first();
$ruang    = DB::table('ruang')->where('RuangID',$mboh->RuangID)->first();

$NamaMKx 	= strtolower($mboh->NamaMK);
$NamaMK 		= ucwords($NamaMKx);

$NamaDosX 		= strtolower($mboh->NamaDosen);
$NamaDosen 		= ucwords($NamaDosX);

?>

@include('admin/include/headerlap')

<?php
echo"<table align='center' style='border: none;'> 
<tr style='border: none;'>
<td align=center><b><u>ABSENSI MENGAJAR DOSEN TA. $mboh->TahunID</u></b></td>
</tr>
<tr style='border: none;'>
<td align=center><b>Program Studi: $prodi->Nama</b></td>
</tr>
</table>     
<br>

<table style='border-collapse: collapse; border: none'>
<tr style='border: none;'>
<td width='200' style='border: none;'>Dosen</td><td style='border: none;'>:</td>             
<td width='500' style='border: none;'>$mboh->Login - $NamaDosen, $mboh->Gelar</td> 
</tr>

<tr style='border: none;'>
  <td width='200' style='border: none;'>Matakuliah</td> <td style='border: none;'>:</td>            
  <td width='500' style='border: none;'>$mboh->MKKode - $NamaMK ($mboh->SKS SKS) - Smt $mboh->Sesi</td> 
</tr>


<tr style='border: none;'>
  <td width='200' style='border: none;'>Kelas</td> <td style='border: none;'>:</td>            
  <td width='500' style='border: none;'>$mboh->NamaKelas</td> 
</tr>
</table>
<br>
<table  width='416' border='0.3' align='center' cellspacing='0'>
<tr style='background-color:#E6E6E6'>
  <th width='30' height='40' align='center'> No.</th>
  <th width='80' align='center'>Pertemuan</th>
  <th width='100' align='center'>Tanggal</th>
  <th width='100' align='center'>Tanda Tangan</th>
  <th width='100' align='center'>Staf Prodi</th>
  <th width='200' align='center'>Keterangan</th>
  </tr>

<tr>
	<td height='20' align=center>1</td>
	<td align=center>I</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
  </tr>
  
<tr>
	<td height='20' align=center>2</td>
	<td align=center>II</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
  </tr>  

<tr>
	<td height='20' align=center>3</td>
	<td align=center>III</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
  </tr>
<tr>
	<td height='20' align=center>4</td>
	<td align=center>IV</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
	<td align=right>&nbsp;</td>
  </tr>
<tr>
  <td height='20' align=center>5</td>
  <td align=center>V</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>6</td>
  <td align=center>VI</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>7</td>
  <td align=center>VII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>8</td>
  <td align=center>VIII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>9</td>
  <td align=center>IX</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>10</td>
  <td align=center>X</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>11</td>
  <td align=center>XI</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>12</td>
  <td align=center>XII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>13</td>
  <td align=center>XIII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>14</td>
  <td align=center>XIV</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>15</td>
  <td align=center>XV</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>16</td>
  <td align=center>XVI</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>17</td>
  <td align=center>XVII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
<tr>
  <td height='20' align=center>18</td>
  <td align=center>XVIII</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
  <td align=right>&nbsp;</td>
</tr>
</table>";


?>

<br>
<br>      
<table class="printer">
  <thead>
    <tr class="bg-info">
      <th>MENGETAHUI</th>
      <th width="50%">Pekanbaru, <?php echo date('d-m-Y')?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
         Ketua Program Studi
         <br>
         <br> 
         <br>{{ $prodi->Pejabat }}, {{ $prodi->Gelar }}
      </td>
      <td>
        Dosen Pengampu
         <br> 
         <br>
         <br>{{ $dosen->Nama }}, {{ $dosen->Gelar }}
      </td>
    </tr>
  </tbody>
</table>

	</div>
</body>
</html>