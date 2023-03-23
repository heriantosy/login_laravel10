<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html charset=utf-8">
    <title><?php echo $judul_web ?></title>
  	<link rel="icon" type="image/png" href="asset/images/favicon1.png"/>
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
      padding: 1px;
    }

    th {
        color: #222;
    }
    body{
      font-family:Calibri;
      font-size:12px;
    }
    
    </style>

    <style>
    .garis_tepi0 {
        border:  4px dotted #FF8533;
      width:700px;
      margin-top:0px;
      margin-right:0px;
      margin-bottom:0px;
      margin-left:0px;
    }
    /* .garis_tepi {
        border:  2px dashed #FF8533
      width:750px
      margin:8px
    } */
    </style>
  </head>

<body onload="window.print()">
<?php 
for ($i=0; $i<=3; $i++){
  if ($i == 0) {
    $penguji  = $pembimbing->Nama;
    $gelar    = $pembimbing->Gelar;
    $honor    = $honorpembimbing->Jumlah;
    $untuk    = "Honor Pembimbing Kerja Praktek Tahun";
  }
  elseif ($i == 1) {
    $penguji  = $penguji1->Nama;
    $gelar    = $penguji1->Gelar;
    $honor    = $honorpenguji->Jumlah;
    $untuk    = "Honor Penguji Ujian Seminar Hasil Kerja Praktek Tahun";
  }
  elseif ($i == 2) {
    $penguji  = $penguji2->Nama;
    $gelar    = $penguji2->Gelar;
    $honor    = $honorpenguji->Jumlah;
    $untuk    = "Honor Penguji Ujian Seminar Hasil Kerja Praktek Tahun";
  }elseif ($i == 3) {
    $penguji  = $penguji3->Nama;
    $gelar    = $penguji3->Gelar;
    $honor    = $honorpenguji->Jumlah;
    $untuk    = "Honor Penguji Ujian Seminar Hasil Kerja Praktek Tahun";
  }
  $data3 = array(
    'penguji'		=> $penguji,
    'gelar'			=> $gelar,
    'untuk'     => $untuk,
    'honor'     => $honor
  );
  //echo"Data Penguji $penguji";
?>

<div class="garis_tepi0">
<div class="garis_tepi">
  @include('admin/kop_laporan/kop_yayasan')
    <br>
    <table border="0" width="95%" align="center">  
    <tr>
    <td colspan="3" height=20 style="text-align:center;font-size:18px;font-weight:reguler;background-color:#FF8533;">  <b style="color:#FFFFFF">:: KWITANSI ::</b>  </td>
    </tr>
    </table>
    <br>

    <table border="0" width="95%" align="center">
    <tr class="batas2" align="left">
    <td width=300>Sudah terima dari</td>
    <td>:</td>
    <td width=420>Ketua STMIK Hang Tuah Pekanbaru</td>
    </tr>
    <tr class="batas2" align="left">
    <td>Uang sejumlah</td>
    <td>:</td>
    <td>Rp. <?php echo number_format($honor) ?></td>
    </tr>

    <tr class="batas2" align="left" >
    <td style=font-style:italic>Terbilang:</td>
    <td >:</td>
    <td style=font-style:italic>
    <center>
      <div style="border:1px solid black; color:red;width:94%;padding:10px;text-align:left">
        <b style="font-size:16px;"><?php echo terbilang($honor) ?></b>
      </div>
    </center>
    </td>
    </tr>
 
    <tr class="batas2" align="left">
    <td >Untuk pembayaran</td>
    <td >:</td>
    <td ><?php echo $untuk ?> <?php echo $jdwl->TahunID ?></td>
    </tr>

 
    <tr class="batas2" align="left">
    <td valign="top">Mahasiswa</td>
    <td valign="top">:</td>
    <td valign="top">
    <?php 
    $agt = DB::table('jadwal_kp_anggota')
    ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
    ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
    ->where('jadwal_kp_anggota.JadwalID',$jdwl->JadwalID)
    ->get(); 
    foreach($agt as $m){
    ?>
    <?php echo $m->MhswID ?> - <?php echo $m->NamaMhs ?><br>
    <?php } ?>
    </td>
    </tr>
 


    <tr class="batas2" align="left">
    <td >Program Studi</td>
    <td >:</td>
    <td ><?php echo $prodi->Nama ?> </td>
    </tr>
    </table>        
    <br>
    
    <table border="0" align="center" width="95%">
    <tr>
    <td width="206"  align="center"></td>
    <td width="206" align="center"></td>
    <td width="206" align="center">Pekanbaru, <?php echo date('d-m-Y')?></td>
    </tr>
    <tr  align="center">
      <td align="center">Bendaharawan</td>
    <td align="center">Setuju Dibayar</td>
    <td align="center">Yang Menerima</td>
    </tr>
    <tr  align="center">
      <td align="center"></td>
    <td align="center">STMIK Hang Tuah Pekanbaru<br>Ketua</td>
    <td align="center"></td>
    </tr>
    <tr  align="center">
      <td align="center">&nbsp</td>
      <td align="center"></td>
      <td align="left"></td>
    </tr>

    <tr  align="center">
      <td align="center">Zupri Henra Hartomi, S.Kom</td>
    <td align="center">Hendry Fonda, M.Kom</td>
    <td align="center"><?php echo $penguji ?>, <?php echo $gelar ?></td>
    </tr>
    <tr  align="center">
      <td align="center"></td>
    <td align="center"></td>
    <td align="center"></td>
    </tr>
    </table>

    <table border="0" align="center" width="95%">
    <tr style="background-color:#FFB482" >
    <td  width="300" style="text-align:left;color:#FFFFFF;font-size:8px;font-style:italic;height:20">
    - Mohon hitung kembali nominal uang yang diterima <br>
    - Komplain tidak diterima setelah meninggalkan program studi 
    </td>
    <td width="320" style="text-align:right;color:#FFFFFF;font-size:8px;font-style:italic;height:20">
    <font style="font-size:8px">Login by: <?php echo date('d-m-Y H:i:s')?> WIB - STMIK HTP Support System</font>
    </td>
    </tr>
    </table>
    <br>
    

</div>
</div>
<?php  
}
?>
</body>
</html>