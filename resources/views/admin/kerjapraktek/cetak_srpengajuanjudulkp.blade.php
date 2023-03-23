<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
    <title><?php echo $judul_web; ?></title>
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
  <body onload="window.print();">
  @include('admin/kop_laporan/kop_lap')
    <br>
    <h4 align="center" style="margin:0px;font-size:16px;"><u><b>PENGAJUAN JUDUL KERJA PRAKTEK</b></u></h4>
    <br>
    <br>


<br>
      <table width="100%" border="0">
      <tr>
      <td width="150" colspan="3">Kepada Yth,<br> <?php echo $jdwl->Ke ?>
      <br> di<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $jdwl->Kota ?><br>
      </td>
      </tr>
      </table>
      <br>
      <br>
      <table width="100%" border="0">
      <tr>
      <td width="130" colspan="3" style="text-align:justify">Dengan hormat, <br>Saya yang bertanda tangan di bawah ini:<br> <br></td>
      </tr>

      <tr>
      <td width="130" valign="top">Kelompok </td>
      <td width="1" valign="top">:</td>
      <td>
      <b><?php echo $jdwl->KelompokID ?></b>
      <br>
      <?php 
      $agt = DB::table('jadwal_kp_anggota')
      ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
      ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
      ->where('jadwal_kp_anggota.JadwalID',$jdwl->JadwalID)
      ->get();
      foreach($agt as $m){
        echo"$m->MhswID - $m->Nama";
        echo"<br>";
      }
      ?>
      
      </td>
      </tr>
    
      <tr>
      <td>Program Studi </td>
      <td>:</td>
      <td><?php echo $prodi->Nama; ?></td>
      </tr>

      <tr>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      </tr>

      <tr>
      <td width="150" colspan="3" style="text-align:justify">Bermaksud mengajukan judul kerja praktek sebagai berikut:
      </td>
      </tr>

      <tr>
      <td style="text-align:justify" valign="top">Judul Penelitian</td>
      <td valign="top">:</td>
      <td valign="top"><?php echo htmlentities($jdwl->Judul); ?></td>
      </tr>

      <tr>
      <td>Tempat Penelitian</td>
      <td valign="top">:</td>
      <td><?php echo $jdwl->TempatPenelitian; ?></td>
      </tr>

      <tr>
      <td>Deskripsi</td>
      <td>:</td>
      <td><?php echo $jdwl->Deskripsi; ?></td>
      </tr>

    </table>
    <br> 
    <br> 
    <br> 

    <div style="float:left;">
      <left>
      Menyetujui<br>
			Ka. Prodi,<br>
      <br>
      dto<br><br>
      <b><u><?php echo $prodi->Pejabat ?></u></b><br>
      NIDN. <?php echo $prodi->NIDN ?>
      </left>
    </div>

    <div style="float:right;">
      <center>
      Pekanbaru, <?php echo date('d-m-Y') ?>
      </center>
    </div>  
<br>
<br>
<br>
<br>
<br>
    <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      </tr>
      <tr>
      <td>Pembimbing</td>
      <td>:</td>
      <td>----------------------------------------------------------------------------------------------------
      <br>(Ditentukan dan diisi oleh Ka. Program Studi)</td>
      </tr>  
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Catatan Perbaikan</td>
      <td>:</td>
      <td>>----------------------------------------------------------------------------------------------------</td>
    </tr>
    </table>
  </body>
</html>