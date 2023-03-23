 
<div class="row">
<div class="col-md-5">
</div><div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/pengajuanta/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-2 col-md-4">
@include('admin/pengajuanta/tabta') 
</div>

<div class="input-group mb-4 col-md-7" >
<select name="tahun" class="form-control form-control-sm">
<?php foreach($tahun as $tahun) { ?>
  <option value="<?php echo $tahun->TahunID ?>" 
    <?php if(isset($_POST['tahunplh']) && $_POST['tahunplh']==$tahun->TahunID) { echo "selected"; }
          elseif(isset($_GET['tahunplh']) && $_GET['tahunplh']==$tahun->TahunID) { echo 'selected'; }
          elseif($tahunplh==$tahun->TahunID) { echo 'selected'; } ?>>
    <?php echo $tahun->TahunID  ?>
  </option>
<?php } ?>
</select>

<select name="prodi" class="form-control form-control-sm">
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
  &nbsp;
  <a href="{{ asset('admin/pengajuanta/tambah/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
</span>
</div>
</div>
</form>


<div class="table-responsive mailbox-messages">

<table class="table table-bordered table-sm" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>

        <th width="3%">No</th>
        <th width="8%">NIM</th>
        <th width="20%">Nama / Pembimbing</th>
        <th width="45%">Judul Penelitian</th>
        <th width="17%">Tempat</th>
        <th width="7%">Status</th>
        <th width="10%">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					

$i=0;     
foreach($pengajuanta as $pengajuanta) {
  $i++;
  $NamaMhsx           = strtolower($pengajuanta->NamaMhs);
  $NamaMhs	          = ucwords($NamaMhsx);
  $Judulx             = strtolower($pengajuanta->Judul);
  $Judul	            = ucwords($Judulx);
  $TempatPenelitianx  = strtolower($pengajuanta->TempatPenelitian);
  $TempatPenelitian	  = ucwords($TempatPenelitianx);
  if ($pengajuanta->Status=='DITERIMA'){
    $c="style=color:green";
  } 
  else  if ($pengajuanta->Status=='DITOLAK'){
    $c="style=color:red";
  }
  else{
      $c="style=color:black";
  }

  $p1 = DB::table('dosen')->where('Login',$pengajuanta->Pembimbing1)->first();
  if(!empty($p1->Nama)){
    $Pembimbing1x   = strtolower($p1->Nama);
    $Pembimbing1	  = ucwords($Pembimbing1x); 
    $GelarPm1       = $p1->Gelar;    
  }else{
    $Pembimbing1    = "-";
    $GelarPm1       = "-";
  }
  
  $p2 = DB::table('dosen')->where('Login',$pengajuanta->Pembimbing2)->first();
  if(!empty($p2->Nama)){
    $Pembimbing2x   = strtolower($p2->Nama);
    $Pembimbing2	  = ucwords($Pembimbing2x);
    $GelarPm2       = $p2->Gelar;  
  }else{
    $Pembimbing2    = "-";
    $GelarPm2       = "-";
  }

  // $Pji1 = DB::table('dosen')->where('Login',$pengajuanta->PengujiPro1)->first();
  // $Penguji1x 	 = strtolower($Pji1->Nama);
  // $Penguji1	 = ucwords($Penguji1x); 

  // $Pji2 = DB::table('dosen')->where('Login',$pengajuanta->PengujiPro2)->first();
  // $Penguji2x 	 = strtolower($Pji2->Nama);
  // $Penguji2	 = ucwords($Penguji2x); 

  // $Pji3 = DB::table('dosen')->where('Login',$pengajuanta->PengujiPro3)->first();
  // $Penguji3x 	 = strtolower($Pji3->Nama);
  // $Penguji3	 = ucwords($Penguji3x);

  // $ruang = DB::table('ruang')->where('RuangID',$pengajuanta->TempatUjian)->first();

  // $tanggal  = $pengajuanta->TglUjianProposal;
  // $tglx     = date('d-m-Y',strtotime($pengajuanta->TglUjianProposal));
  // $day      = date('D', strtotime($tanggal));
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

  <tr >
   
    <td><?php echo $i ?></td>
    <td><?php echo $pengajuanta->MhswID ?></td>
    <td><?php echo $NamaMhs ?>
        <br>1. <?php echo $Pembimbing1 ?>, <?php echo $GelarPm1 ?>
        <br>2. <?php echo $Pembimbing2 ?>, <?php echo $GelarPm2 ?>      
        </td>
    <td><?php echo $Judul ?> (<b style='color:red;font-size:12px;'><?php echo $pengajuanta->Komentar ?>)</b><br>
    <a href="{{ asset('admin/pengajuanta/terimax/'.$pengajuanta->IDPenelitian.'/'.$pengajuanta->TahunID.'/'.$pengajuanta->ProdiID) }}">[ TERIMA ]</a>
    <a href="{{ asset('admin/pengajuanta/tolakx/'.$pengajuanta->IDPenelitian.'/'.$pengajuanta->TahunID.'/'.$pengajuanta->ProdiID) }}">[ TOLAK ]</a> - 
    <a href="" data-toggle="modal" data-target="#Edit<?php echo $pengajuanta->IDPenelitian ?>">Komentar dan Pembimbing</a>
    </td>

    <td>
    <?php echo $TempatPenelitian ?>
    <br>
    <br>
    </td>
    <td <?php echo $c ?>><?php echo $pengajuanta->Status ?></td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/pengajuanta/edit/'.$pengajuanta->IDPenelitian) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{ asset('admin/pengajuanta/delete/'.$pengajuanta->IDPenelitian.'/'.$pengajuanta->TahunID.'/'.$pengajuanta->ProdiID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
    @include('admin/pengajuanta/komentar_popup')
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>



