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

<body onload="window.print()">
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


@include('admin/kop_laporan/kop_lap')
<?php
echo"<table width='100%' border='0'> 
<tr >
<td align=center><b><u>ABSENSI MENGAJAR DOSEN TA. $mboh->TahunID</u></b></td>
</tr>
<tr >
<td align=center><b>Program Studi: $prodi->Nama</b></td>
</tr>
</table>     
<br>

<table width='100%'>
<tr >
<td width='200' >Dosen</td><td >:</td>             
<td width='500' >$mboh->Login - $NamaDosen, $mboh->Gelar</td> 
</tr>

<tr >
  <td width='200' >Matakuliah</td> <td >:</td>            
  <td width='500' >$mboh->MKKode - $NamaMK ($mboh->SKS SKS) - Smt $mboh->Sesi</td> 
</tr>


<tr >
  <td width='200' >Kelas</td> <td >:</td>            
  <td width='500' >$mboh->NamaKelas</td> 
</tr>
<tr >
  <td width='200' >Waktu</td> <td >:</td>            
  <td width='500' >$jadwal->NamaHari, ".substr($jadwal->JamMulai,0,5)." s/d ".substr($jadwal->JamSelesai,0,5)." WIB</td> 
</tr>
</table>
<br>
<table width='100%' border='1'>
<tr style='background-color:#E6E6E6'>
  <th width='30' height='40' > No.</th>
  <th width='80' >Pertemuan</th>
  <th width='100' >Tanggal</th>
  <th width='100' >Tanda Tangan</th>
  <th width='100' >Staf Prodi</th>
  <th width='200' >Keterangan</th>
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
<table border="1" width="100%">
    <tr>
      <th>MENGETAHUI</th>
      <th width="50%">Pekanbaru, <?php echo date('d-m-Y')?></th>
    </tr>
  <tbody>
    <tr>
      <td align="center">
         Ketua Program Studi
         <br>
         <br> 
         <br>{{ $prodi->Pejabat }}, {{ $prodi->Gelar }}
      </td>
      <td align="center">
        Dosen Pengampu
         <br> 
         <br>
         <br>{{ $dosen->Nama }}, {{ $dosen->Gelar }}
      </td>
    </tr>
  </tbody>
</table>

</body>
</html>