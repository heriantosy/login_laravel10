<form action="{{ asset('admin/kerjapraktekpro/hasilkpfilter') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-0 col-md-7">
@include('admin/kerjapraktek/tabwaktuhsl') 
</div>

<div class="input-group mb-3 col-md-5" >
<select name="tahun" class="form-control form-control-sm" onChange='this.form.submit()'>
<?php foreach($tahun as $tahun) { ?>
  <option value="<?php echo $tahun->TahunID ?>" 
    <?php if(isset($_POST['tahunplh']) && $_POST['tahunplh']==$tahun->TahunID) { echo "selected"; }
          elseif(isset($_GET['tahunplh']) && $_GET['tahunplh']==$tahun->TahunID) { echo 'selected'; }
          elseif($tahunplh==$tahun->TahunID) { echo 'selected'; } ?>>
    <?php echo $tahun->TahunID  ?>
  </option>
<?php } ?>
</select>

<select name="prodi" class="form-control form-control-sm" onChange='this.form.submit()'>
<?php 
foreach($prodi as $prodi) { ?> 
  <option value="<?php echo $prodi->ProdiID ?>" 
    <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
          elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
          elseif($prodiplh==$prodi->ProdiID) { echo 'selected'; } ?>>
    <?php echo $prodi->Nama  ?>
  </option>
<?php } ?>
</select>

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>
</div>

<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
  <th style='width:3%'>No</th>
  <th style='width:10%'>NIM</th>  
  <th style='width:35%'>Nama</th>         
  <th style='width:15%'>Seminar Hasil</th> 
  <th style='width:15%'>Waktu</th>                                
  <th style='width:25%' style="text-align:left">Action</th>
</tr>
</thead>
<tbody>
<?php 					

$nom=0;    
foreach($hasilkp as $hasilkp) {
      $nom++;
      $Judulx = strtolower($hasilkp->Judul);
      $Judul	= ucwords($Judulx);
      //Penguji 1
      $Pji1 = DB::table('dosen')->where('Login',$hasilkp->PengujiSeminarHasil1)->first();
      if(!empty($Pji1->Nama)){
        $Pengujix   = strtolower($Pji1->Nama);
        $Penguji1	  = ucwords($Pengujix);     
      }else{
        $Penguji1   = "-";
      }

      //Penguji 2
      $Pji2 = DB::table('dosen')->where('Login',$hasilkp->PengujiSeminarHasil2)->first();
      if(!empty($Pji2->Nama)){
        $Penguji2x   = strtolower($Pji2->Nama);
        $Penguji2	  = ucwords($Penguji2x);     
      }else{
        $Penguji2   = "-";
      }

      //Penguji 3
      $Pji3 = DB::table('dosen')->where('Login',$hasilkp->PengujiSeminarHasil3)->first();
      if(!empty($Pji3->Nama)){
        $Penguji3x   = strtolower($Pji3->Nama);
        $Penguji3	  = ucwords($Penguji3x);     
      }else{
        $Penguji3   = "-";
      }

      $tanggal  = $hasilkp->TglSeminarHasil;
      $tglx     = date('d-m-Y',strtotime($hasilkp->TglSeminarHasil));
      $day      = date('D', strtotime($tanggal));
      $dayList = array(
      'Sun' => 'Minggu',
      'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu'
);

    ?>
      <tr style='font-size:15px;background:purple;color:white'>
        <td colspan='6'><?php echo $nom.'.' ?> KLP: <?php echo $hasilkp->KelompokID ?> [ <?php echo $hasilkp->NamaDosen ?> ] - <?php echo $Judul ?>
        <div style='text-align:right'>Ujian: <?php echo $dayList[$day] ?>, <?php echo date('d-m-Y',strtotime($hasilkp->TglSeminarHasil)) ?>, <?php echo substr($hasilkp->JamMulaiSeminarHasil,0,5) ?>- <?php echo substr($hasilkp->JamSelesaiSeminarHasil,0,5) ?>
        | Ruang: <?php echo $hasilkp->TempatUjian ?> | Penguji: <?php echo $Penguji1 ?>, <?php echo $Penguji2 ?>, <?php echo $Penguji3 ?></div>
        </td>
      </tr>
          <?php
          $i=0;  
          $mhs = DB::table('jadwal_kp_anggota')
          ->join('jadwal_kp', 'jadwal_kp.JadwalID', '=', 'jadwal_kp_anggota.JadwalID')
          ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp_anggota.MhswID')
          ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.Handphone','jadwal_kp.Ket2')
          ->where('jadwal_kp_anggota.JadwalID',$hasilkp->JadwalID)
          ->orderBy('jadwal_kp_anggota.MhswID','DESC')
          ->get();
          foreach($mhs as $mhs) { 
            $Namax = strtolower($mhs->NamaMhs);
            $Nama	 = ucwords($Namax);
            if ($mhs->Ket2=='1'){
              $Ketr="<b style=color:green> Lulus</b>";				
              $c="style=color:green";
              }
            else if ($mhs->Ket2=='2'){
              $Ketr="<b style=color:red> Gagal</b>";
              $c="style=color:red";
            }else{
              $Ketr="<b style=color:purple> Belum Seminar</b>";
              $c="style=color:black";
            } 
            $i++; 
            ?>
          
            <tr style='font-size:15px;'>
            <td <?php echo $c ?>><?php echo $i ?></td>
            <td <?php echo $c ?>><?php echo $mhs->MhswID ?></td>
            <td <?php echo $c ?>><?php echo $Nama ?> [ <?php echo $mhs->Handphone ?> ]</td>
            <td>
            <a href="{{ asset('admin/kerjapraktekpro/hsl/cetakbahsl_v/'.$hasilkp->JadwalID) }}" target="_BLANK">BA</a> |
            <a href="{{ asset('admin/kerjapraktekpro/hsl/cetakfrmnilaihslkp_v/'.$hasilkp->JadwalID) }}" target="_BLANK">Nilai</a> |
            <a href="{{ asset('admin/kerjapraktekpro/hsl/cetakkwitansihslkp_v/'.$hasilkp->JadwalID) }}" target="_BLANK">Kwitansi</a>
            </td>
            <td>
            <a href="{{ asset('admin/kerjapraktekpro/validasihsl/cek/'.$hasilkp->JadwalID.'/'.'N') }}">[ N ]</a> -
            <a href="{{ asset('admin/kerjapraktekpro/validasihsl/cek/'.$hasilkp->JadwalID.'/'.'R') }}">[ R ]</a> -
            <a href="{{ asset('admin/kerjapraktekpro/validasihsl/cek/'.$hasilkp->JadwalID.'/'.'X') }}">[ X ]</a>
            </td>
            <td style="text-align:left">    
              <div class="btn-group">
                <a href="{{ asset('admin/kerjapraktekpro/edithsl/'.$hasilkp->JadwalID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
                <a href="{{ asset('admin/hasilkp/delete/'.$hasilkp->JadwalID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
              </div>
              <?php echo $Ketr ?>
            </td>
      </tr>
    <?php  
    } 
  }
  ?>
</tbody>
</table>
</div>
</form>
