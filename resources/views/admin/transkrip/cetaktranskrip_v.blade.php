<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cetak Transkrip Nilai</title>
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
@include('admin/kop_laporan/kop_lap')

<h3 style="text-align: center;">TRANSKRIP NILAI SEMENTARA</h3>
<br>
<br>
<table width="100%" border="0">  
<tr>
  <td><b>Nama</b></td>
  <td> <strong>: <?php echo strtoupper($datamhs->Nama) ?></strong></td>
  <td><b>NPM</b></td>
  <td><strong>: <?php echo strtoupper($datamhs->MhswID) ?></strong></td>
</tr>
<tr>
  <td><b>Program/Prodi</b></td>
  <td><strong>: <?php echo strtoupper($datamhs->ProgramID) ?> / <?php echo $prd->Nama ?></strong></td>
  <td><b>Semester</b></td>
  <td><strong>: </strong></td>
</tr>
</table>

<br>
<table width="100%" border="1">  
  <thead>
    <tr>
      <th width="5%" style='text-align:center'>NO</th>
      <th width="15%" style='text-align:center'>KODE</th>
      <th width="50%">MATAKULIAH </th>
      <th width="10%" style='text-align:center'>SKS </th>
      <th width="10%" style='text-align:center'>HURUF </th>
      <th width="10%" style='text-align:center'>BOBOT </th>
    </tr>
  </thead>
   
    <?php
    //Laravel menggunakan nilai awal native no
    $no =0;
    $totalSKS   = 0;
    $totalMutu  = 0;
    foreach($transkrip as $row){
      $no++;
      $Mutu       = $row->SKS * $row->BobotNilai; //misal Nilai A Bobot 4 * SKS 3 =12
      $totalSKS  += $row->SKS;
      $totalMutu += ($row->BobotNilai * $row->SKS);
      $ips  = number_format($totalMutu / $totalSKS,2);
      if ($ips >= 3.00) {
        $YAD=24;
        }
      if ($ips < 3.00) {
        $YAD=21;
        }
      if ($ips <= 2.49) {
        $YAD=18;
        }
      if ($ips <= 1.99) {
        $YAD=15;
        }
      if ($ips <= 1.4) {
        $YAD=12;
        }
      ?>
      <tr>
      <td style='text-align:center'><?php echo $no ?></td>
      <td style='text-align:center'>{{ $row->MKKode }}</td>
      <td style='text-align:left'>{{ $row->Nama }}</td>
      <td style='text-align:center'>{{ $row->SKS }}</td>
      <td style='text-align:center'>{{ $row->GradeNilai }}</td>
      <td style='text-align:center'><?php echo $Mutu  ?></td>
      </tr>
      <?php 
        } 
        ?>
    <tr>
      <td style='text-align:left' colspan='3'>IP Smt: <?php echo $ips ?> &nbsp;&nbsp;&nbsp;&nbsp;SKS YAD: <?php echo $YAD ?></td>
      <td style='text-align:center'><?php echo $totalSKS ?> </td>
      <td style='text-align:center'></td>
      <td style='text-align:center'></td>
    </tr>
  </table>
    
<br>    
<table width="100%">
    <tr >
      <th>MENGETAHUI</th>
      <th width="50%">Pekanbaru, <?php echo date('d-m-Y')?></th>
    </tr>
    <tr>
      <td align="center">
        Fakultas <?php echo $fakultas->Nama ?><br>Dekan
         <br>
         <br> 
         <br><?php echo $fakultas->Pejabat ?>
      </td>
      <td align="center">
        Program Studi <?php echo $prd->Nama ?> <br>Ketua
         <br> 
         <br>
         <br><?php echo $prd->Pejabat ?>, <?php echo $prd->Gelar ?> 
      </td>
    </tr>
</table>

</body>
</html>