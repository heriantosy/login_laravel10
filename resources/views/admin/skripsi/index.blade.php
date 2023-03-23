
<?php if($skripsipro) { ?>  
<div class="row">
<div class="col-md-12">
<form action="{{ asset('admin/skripsipro/filter') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-0 col-md-7">
@include('admin/skripsi/tabwaktupro') 
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
    <tr class="bg-dark" style='color:white'>
        <th width="3%" style="text-align:center">No</th>
        <th width="11%">NIM</th>
        <th width="18%">Nama / Pembimbing</th>
        <th width="30%">Judul Proposal</th>
        <th width="18%">Penguji</th>
        <th width="12%">Waktu/Tempat</th>
        <th width="15%" style="text-align:center">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					

$i=0;     
foreach($skripsipro as $skripsipro) {
  $i++;
  $NamaMhsx = strtolower($skripsipro->NamaMhs);
  $NamaMhs	= ucwords($NamaMhsx);
  $Judulx = strtolower($skripsipro->Judul);
  $Judul	= ucwords($Judulx);
  if ($skripsipro->Ket=='1'){
    $Ketr="<b style=color:green> Lulus</b>";				
    $c="style=color:green";
    }
  else if ($skripsipro->Ket=='2'){
    $Ketr="<b style=color:red> Gagal</b>";
    $c="style=color:red";
  }else{
    $Ketr="<b style=color:purple> Belum Seminar</b>";
    $c="style=color:black";
  } 
  $p1 = DB::table('dosen')->where('Login',$skripsipro->PembimbingPro1)->first();
  
  if(!empty($p1->Nama)){
    $Pembimbing1x   = strtolower($p1->Nama);
    $Pembimbing1	  = ucwords($Pembimbing1x); 
    $GelarPm1       = $p1->Gelar;    
  }else{
    $Pembimbing1    = "-";
    $GelarPm1       = "-";
  }
  
  $p2 = DB::table('dosen')->where('Login',$skripsipro->PembimbingPro2)->first();
  if(!empty($p2->Nama)){
    $Pembimbing2x   = strtolower($p2->Nama);
    $Pembimbing2	  = ucwords($Pembimbing2x);
    $GelarPm2       = $p2->Gelar;  
  }else{
    $Pembimbing2    = "-";
    $GelarPm2       = "-";
  }

   //Penguji 1 ---------------------------------------------
  $Pji1 = DB::table('dosen')->where('Login',$skripsipro->PengujiPro1)->first();
  if(!empty($Pji1->Nama)){
    $Penguji1x  = strtolower($Pji1->Nama);
    $Penguji1	  = ucwords($Penguji1x); 
    $GelarPj1   = $Pji1->Gelar;
  }else{
    $Penguji1   = "-";
    $GelarPj1   = "-";
  }

  //Penguji 2 ---------------------------------------------
  $Pji2 = DB::table('dosen')->where('Login',$skripsipro->PengujiPro2)->first();
  if(!empty($Pji2->Nama)){
    $Penguji2x  = strtolower($Pji2->Nama);
    $Penguji2	  = ucwords($Penguji2x); 
    $GelarPj2   = $Pji2->Gelar;
  }else{
    $Penguji2   = "-";
    $GelarPj2   = "-";
  }

  //Penguji 3 ---------------------------------------------
  $Pji3 = DB::table('dosen')->where('Login',$skripsipro->PengujiPro3)->first();
  if(!empty($Pji3->Nama)){
    $Penguji3x 	  = strtolower($Pji3->Nama);
    $Penguji3	    = ucwords($Penguji3x);
    $GelarPj3     = $Pji3->Gelar;
  }else{
    $Penguji3     = "-";
    $GelarPj3     = "-";
  }

   $ruang = DB::table('ruang')->where('RuangID',$skripsipro->TempatUjian)->first();
   if(!empty($ruang->Nama)){
     $NamaRuang = $ruang->Nama;
   }else{
    $NamaRuang  = "-";
   }

  $tanggal  = $skripsipro->TglUjianProposal;
  $tglx     = date('d-m-Y',strtotime($skripsipro->TglUjianProposal));
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

  <tr style='font-size:15px;'>   
    <td style="text-align:center" <?php echo $c ?>><?php echo $i ?></td>
    <td>
    <a href="{{ asset('admin/skripsipro/editjudul/'.$skripsipro->JadwalID) }}"><?php echo $skripsipro->MhswID ?></a>
    <br>[ <?php echo $skripsipro->Handphone ?> ] <br>
    <a href="{{ asset('admin/skripsipro/validasipro/cek/'.$skripsipro->JadwalID.'/'.'N') }}">[ N ]</a> -
    <a href="{{ asset('admin/skripsipro/validasipro/cek/'.$skripsipro->JadwalID.'/'.'R') }}">[ R ]</a> -
    <a href="{{ asset('admin/skripsipro/validasipro/cek/'.$skripsipro->JadwalID.'/'.'X') }}">[ X ]</a>
    </td>
    <td <?php echo $c ?>><?php echo $NamaMhs ?>
        <br><a href="{{ asset('admin/skripsipro/pro/cetakpembimbing_v/'.$skripsipro->JadwalID) }}" target="_BLANK">1. <?php echo $Pembimbing1 ?>, <?php echo $GelarPm1 ?></a>
        <br><a href="{{ asset('admin/skripsipro/pro/cetakpembimbing2_v/'.$skripsipro->JadwalID) }}" target="_BLANK">2. <?php echo $Pembimbing2 ?>, <?php echo $GelarPm2 ?></a>      
        </td>
    <td <?php echo $c ?>><?php echo $Judul ?><br>
    <a href="{{ asset('admin/skripsihsl/hsl/cetaksrpengantar_v/'.$skripsipro->JadwalID) }}" target=_BLANK>[ Surat Pengantar ]</a> - 
    <a href="{{ asset('admin/skripsipro/pro/cetakkwitansiproskripsi_v/'.$skripsipro->JadwalID) }}" target=_BLANK>[ Print Kwitansi ]</a>
    </td>
    <td <?php echo $c ?>>1. <?php echo $Penguji1 ?>, <?php echo $GelarPj1 ?>
    <br>2. <?php echo $Penguji2 ?>, <?php echo $GelarPj2 ?>
    <br>3. <?php echo $Penguji3 ?>, <?php echo $GelarPj3 ?>
    </td>
    <td <?php echo $c ?>>
    <?php echo $dayList[$day] ?>, 
    <?php echo $tglx ?>
    
    <br><?php echo substr($skripsipro->JamMulaiProSkripsi,0,5) ?>-<?php echo substr($skripsipro->JamSelesaiProSkripsi,0,5) ?>
    <br><?php echo $NamaRuang ?>
    </td>
    <td style="text-align:center">   
      <div class="btn-group">
        <a href="{{ asset('admin/skripsipro/edit/'.$skripsipro->JadwalID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{ asset('admin/skripsipro/pro/cetakbapro_v/'.$skripsipro->JadwalID) }}" title="Cetak Berita Acara" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/skripsipro/pro/cetakfrmnilaipro_v/'.$skripsipro->JadwalID) }}" title="Cetak Form Nilai" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/skripsipro/delete/'.$skripsipro->JadwalID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
      <?php echo $Ketr ?>
    </td>
  </tr>

  <?php  
  }
  ?>
</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>