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
    <?php 
    $bln	  =date('m');
    $tahun	=date('Y');
    if($bln=='1'){$BlnRomawi="I";}elseif($bln=='2'){$BlnRomawi="II";} elseif($bln=='3'){$BlnRomawi="III";} elseif($bln=='4'){$BlnRomawi="IV";} elseif($bln=='5'){$BlnRomawi="V";}
    elseif($bln=='6'){$BlnRomawi="VI";} elseif($bln=='7'){$BlnRomawi="VII";} elseif($bln=='8'){$BlnRomawi="VIII";} elseif($bln=='9'){$BlnRomawi="IX";} elseif($bln=='10'){$BlnRomawi="X";}
    elseif($bln=='11'){$BlnRomawi="XI";}else{{$BlnRomawi="XII";}}
    ?>
    <br>
    <table width="100%" border="0">

      <tr>
        <td width="90">Nomor</td>
        <td width="1">:</td>
        <td> ... /Prodi-SI/STMIK-HTP/<?php echo $BlnRomawi ?>/<?php echo $tahun ?></td>
        <td style="text-align:right">Pekanbaru, <?php echo date('d-m-Y')?></td>
      </tr>

      <tr>
        <td>Lampiran</td>
        <td width="1">:</td>
        <td >-</td>
        <td ></td>
      </tr>

      <tr>
        <td>Perihal</td>
        <td width="1">:</td>
        <td >Permohonan Pembimbingan Kerja Praktek</td>
        <td ></td>
      </tr>
      </table>

<br>
      <table width="100%" border="0">
      <tr>
      <td width="90"></td>
      <td width="1"></td>
      <td width="150" colspan="3">Kepada<br> Yth Bapak/Ibu <?php echo $pembimbing->Nama ?>, <?php echo $pembimbing->Gelar ?>
      <br> Dosen Pembimbing Kerja Praktek<br><?php echo $jdwl->Kota ?><br></td>
      </tr>
      </table>
      <br>

      <table width="100%" border="0">
      <tr>
      <td width="90"></td>
      <td width="1"></td>
      <td width="130" colspan="3" style="text-align:justify">Dengan hormat, <br>Bersama dengan ini kami mohon Bapak/Ibu untuk memberikan Bimbingan Kerja Praktek
kepada Mahasiswa di bawah ini:<br> <br></td>
      </tr>

      <tr>
      <td></td>
      <td></td>
      <td>Kelompok </td>
      <td>:</td>
      <td><?php echo $jdwl->KelompokID ?></td>
      </tr>

      <tr>
      <td width="90"></td>
      <td width="1"></td>
      <td width="130"> </td>
      <td width="1">:</td>
      <td>
      <?php 
    $agt = DB::table('jadwal_kp_anggota')
    ->join('mhsw','mhsw.MhswID','=','jadwal_kp_anggota.MhswID')
    ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone','mhsw.ProdiID')
    ->where('jadwal_kp_anggota.JadwalID',$jdwl->JadwalID)
    ->get();
    foreach($agt as $m){
        echo"$m->MhswID - $m->NamaMhs";
        echo"<br>";
      }
      ?>
      
      </td>
      </tr>
    
      <tr>
      <td></td>
      <td></td>
      <td>Program Studi </td>
      <td>:</td>
      <td><?php echo $prodi->Nama; ?></td>
      </tr>

      <tr>
      <td valign="top"></td>
      <td valign="top"></td>
      <td style="text-align:justify" valign="top">Judul Penelitian</td>
      <td valign="top">:</td>
      <td valign="top"><?php  
              $Judulx = strtolower($jdwl->Judul);
              $Judul	= ucwords($Judulx);
              echo $Judul; ?></td>
      </tr>

      <tr>
      <td colspan="4"><td>&nbsp;</td>
      </tr>

      <tr>
      <td width="90"></td>
      <td width="1"></td>
      <td width="150" colspan="3" style="text-align:justify">Demikian atas perhatian serta kesediaan Bapak/Ibu kami ucapkan terimakasih..
<br><br>
      </td>
      </tr>
    </table>
    <br> 

    <div style="float:right;">
      <center>
      Program Studi Sistem Informasi<br>
			Ketua,<br>
      <br>
      dto<br><br>
      <b><u><?php echo $prodi->Pejabat ?>, </u></b><br>
      <?php echo $prodi->NIDN ?>
      </center>
    </div>  

  </body>
</html>