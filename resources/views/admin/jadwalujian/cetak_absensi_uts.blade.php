<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $judul_web ?></title>
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
  
<link rel="stylesheet" type="text/css" href="asset/printer.css">
</head>

<body onload="window.print()">
@include('admin/kop_laporan/kop_lap')

<?php
echo"<table width='100%' border='0'> 
<tr>
<td style='text-align:center'><b>DAFTAR HADIR UJIAN TENGAH SEMESTER </b></td>
</tr>
</table>     
<br>

<table width='100%'>
<tr>
<td width='65%'>$jdw->TahunID</td>           
<td width='35%'>$hari->Nama</td> 
</tr>

<tr>
<td>$prodi->Nama</td>             
<td>".substr($jdw->JamMulai,0,5)." - ".substr($jdw->JamSelesai,0,5)." WIB</td> 
</tr>

<tr>
<td>$jdw->MKKode - $Matakul ($jdw->SKS SKS) - $jdw->NamaKelas  - Semester $mk->Sesi</td>             
<td>$jdw->RuangID</td> 
</tr>

<tr>
<td>$ds->Login - $NamaDos, $ds->Gelar</td>             
<td>&nbsp;</td> 
</tr>

</table>
<br>";
echo "<table border='1' class='center' width='100%'>
  <tr >
    <th style='text-align:center;width:50px'> NO.</th>
    <th style='text-align:center;width:90px'>NIM</th>
    <th style='text-align:center;width:250px'>NAMA MAHASISWA</th>
    <th style='text-align:center'>PRES</th>
    <th style='text-align:center'>TANDA TANGAN</th>
    <th style='text-align:center'>KETERANGAN</th>
  
  </tr>";
      //   $jadwal = $this->db->query("SELECT presensimhsw.*, jadwal.Kehadiran,
      //   jadwal.MKKode, jadwal.Nama AS NamaMK, jadwal.NamaKelas, jadwal.JenisJadwalID,jadwal.TahunID,
      //   SUM(presensimhsw.Nilai) AS JML,
      //   mhsw.Nama as NamaMhs
      //   FROM presensimhsw
      //   LEFT OUTER JOIN jadwal ON presensimhsw.JadwalID=jadwal.JadwalID			
      //   LEFT OUTER JOIN mhsw ON mhsw.MhswID=presensimhsw.MhswID
      //   WHERE presensimhsw.JadwalID='$id'
      //   GROUP BY presensimhsw.JadwalID,presensimhsw.MhswID order by presensimhsw.MhswID asc")->result();
      //   foreach ($jadwal as $row){
      //   $persentase= number_format(($row->JML/$row->Kehadiran)* 100,0);
      //   $persen			= ($row->JML/$row->Kehadiran)* 100;

      $no = 1;
      $pres = DB::table('presensimhsw')
      ->join('jadwal', 'jadwal.JadwalID', '=', 'presensimhsw.JadwalID', 'LEFT OUTER')
      ->join('mhsw', 'mhsw.MhswID', '=', 'presensimhsw.MhswID', 'LEFT OUTER')
      ->select('presensimhsw.*', 'jadwal.Kehadiran','jadwal.MKKode', 'jadwal.Nama AS NamaMK','mhsw.Nama as NamaMhs',
       DB::raw('SUM(presensimhsw.Nilai) as JML'),
      'jadwal.NamaKelas','jadwal.JenisJadwalID','jadwal.TahunID')
      ->where('presensimhsw.JadwalID',$jdw->JadwalID)
      ->groupBy('presensimhsw.JadwalID')
      ->groupBy('presensimhsw.MhswID')
      ->orderBy('presensimhsw.MhswID','ASC')
      ->get();    
    foreach($pres as $row) {
    $persen			= ($row->JML / $row->Kehadiran)* 100;
    $persentase		= number_format(($row->JML / $row->Kehadiran)* 100,0);
        $NamaMhs 		= $row->NamaMhs;
        $NamaMhsx 	= strtolower($NamaMhs);
        $NamaMhs	  = ucwords($NamaMhsx);
          echo "<tr>
          <td height='20' align=center> $no</td>
          <td align=center>$row->MhswID</td>
          <td >&nbsp;$NamaMhs </td>
          <td align=center>$persentase %</td>
          <td >&nbsp; </td>
          <td >&nbsp; </td>
            </tr>";
          $no++;
        }

    
echo"</table>
<br>
<br>
<table border=0 width='100%' style='text-align:center'>
<tr>
<td style=width:1000px;text-align:center'>&nbsp;</td>
<td style=width:1000px;text-align:left'>Pekanbaru, ".(date('Y-m-d'))."  <br>Ketua Program Studi</td>
</tr>
<tr>
  <td ></td>
  <td  >&nbsp;</td>
</tr>
<tr>
  <td ></td>
  <td >&nbsp;</td>
</tr>

<tr>
<td ></td>
<td >$prodi->Pejabat</td>
</tr>
</table>";
?>

