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

<?php 
  $prd = DB::table('prodi')->where('ProdiID',$datamhs->ProdiID)->first();
  ?>
<h1 style="text-align: center;">KARTU HASIL STUDI</h1>
<br>
<table style='border:none'>  
<tr style='border:none'>
  <td style='border:none;padding:1px'><b> Nama</b></td>
  <td style='border:none;padding:1px'><b> : <?php echo strtoupper($datamhs->NamaMhs) ?></b></td>
  <td style='border:none;padding:1px'><b> NIM</b></td>
  <td style='border:none;padding:1px'><b> : <?php echo strtoupper($datamhs->MhswID) ?></b></td>
</tr>
<tr style='border:none'>
  <td style='border:none;padding:1px'><b> Program/Prodi</b></td>
  <td style='border:none;padding:1px'><b> : <?php echo strtoupper($datamhs->ProgramID) ?> / <?php echo strtoupper($prd->Nama) ?></b></td>
  <td style='border:none;padding:1px' ><b> Semester</b></td>
  <td style='border:none;padding:1px'><b> : <?php echo $tahunplh ?></b></td>
</tr>
</table>

<br>
<table class="printer">  
  <thead>
    <tr class="bg-info">
      <th width="5%" style='text-align:center'>NO</th>
      <th width="10%" style='text-align:center'>KODE</th>
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
    foreach($krs as $row){
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
      <td style='text-align:left'>{{ $row->NamaMK }}</td>
      <td style='text-align:center'>{{ $row->SKS }}</td>
      <td style='text-align:center'>{{ $row->GradeNilai }}</td>
      <td style='text-align:center'><?php echo $Mutu  ?></td>
      </tr>
      <?php } ?>
    <tr>
      <td style='text-align:left' colspan='3'>IP Smt: <?php echo $ips ?> &nbsp;&nbsp;&nbsp;&nbsp;SKS YAD: <?php echo $YAD ?></td>
      <td style='text-align:center'><?php echo $totalSKS ?> </td>
      <td style='text-align:center'></td>
    </tr>
  </table>
    
<br>    
<table style='border:none;padding:1px'>
<tr  style='border:none;padding:1px'>
  <td style='border:none;padding:1px'></td>
  <td style='border:none;padding:1px' width="40%">Pekanbaru, <?php echo date('d-m-Y')?></td>
</tr>

<tr style='border:none;padding:1px'>
  <td style='border:none;padding:1px'> &nbsp;</td>

  <td style='border:none;padding:1px'>
  Ketua Program Studi
  <br>  
  <br>
  <br> 
  <br>
  <br><?php echo $prd->Pejabat ?>, <?php echo $prd->Gelar ?> 
  </td>
</tr>
</table>
</div>
</body>
</html>