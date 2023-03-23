@include('admin/pengajuankp/tabkerjapraktek')
<?php if($pengajuankp) { ?>  
<div class="row">
<div class="col-md-5">
   
</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/pengajuankp/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-4">

</div>

<div class="input-group mb-3 col-md-8" >
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
  </button> &nbsp;
  <a href="{{ asset('admin/pengajuankp/tambah/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
    <th style='width:3%'>No</th>
    <th style='width:10%'>NIM</th>  
    <th style='width:45%'>Nama</th>         
    <th style='width:15%'>Program Studi</th> 
    <th style='width:15%'>Tanggal Pengajuan</th>                                
    <th style='width:5%'>Action</th>
    </tr>
</thead>
<tbody>
<?php 					

$nom=0;    
$pengajuankp = DB::table('jadwal_kp')
->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
->select('jadwal_kp.*','dosen.Nama as NamaDosen')
->where('jadwal_kp.TahunID',$tahunplh)
->where('jadwal_kp.ProdiID',$prodiplh)
->orderBy('jadwal_kp.MhswID','DESC')
->get();
foreach($pengajuankp as $pengajuankp) {
  $nom++;
  $Judulx = strtolower($pengajuankp->Judul);
  $Judul	= ucwords($Judulx);
  if ($pengajuankp->Status=='DITERIMA'){
    $c="style=color:yellow";
  } else{
      $c="style=color:red";
  }
?>
  <tr style='font-size:15px;background:purple;color:white'>
    <td colspan='6'>
    <a href="{{ asset('admin/pengajuankp/edit/'.$pengajuankp->JadwalID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
    <?php echo $nom.'.' ?> KLP: <?php echo $pengajuankp->KelompokID ?> [ <?php echo $pengajuankp->NamaDosen ?> ] - <?php echo $Judul ?>  
    <b style='color:yellow;font-size:16px'> ( <?php echo $pengajuankp->Status ?> ) </b>

    <a href="{{ asset('admin/pengajuankp/tambahagt/'.$pengajuankp->JadwalID) }}">[ Add Member ] </a>
    <div style='text-align:right'>Ujian: <?php echo date('d-m-Y',strtotime($pengajuankp->TglMulaiSidang)) ?>, <?php echo substr($pengajuankp->JamMulai,0,5) ?>- <?php echo substr($pengajuankp->JamSelesai,0,5) ?>
    | Ruang: <?php echo $pengajuankp->TempatUjian ?> | Penguji: <?php echo $pengajuankp->Penguji1 ?>
    <a href="{{ asset('admin/pengajuankp/deletekp/'.$pengajuankp->JadwalID.'/'.$tahunplh.'/'.$prodiplh) }}">[ Del ] </a>
    </div>
    </td>
  </tr>
      <?php
      $i=0;  
      $mhs = DB::table('jadwal_kp_anggota')
      ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp_anggota.MhswID')
      ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.Handphone','mhsw.ProdiID')
      ->where('jadwal_kp_anggota.JadwalID',$pengajuankp->JadwalID)
      ->orderBy('jadwal_kp_anggota.MhswID','DESC')
      ->get();
      foreach($mhs as $mhs) { 
        $Namax = strtolower($mhs->NamaMhs);
        $Nama	 = ucwords($Namax);
        $i++; 
        ?>
       
        <tr style='font-size:15px;'>
        <td><?php echo $i ?></td>
        <td><?php echo $mhs->MhswID ?></td>
        <td><?php echo $Nama ?> [ <?php echo $mhs->Handphone ?> ]</td>
        <td><?php echo $mhs->ProdiID ?></td>
        <td><?php echo $mhs->TglBuat ?></td>
        <td>   
          <div class="btn-group">
            <a href="{{ asset('admin/pengajuankp/deleteagt/'.$mhs->MID.'/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
          </div>
        </td>
    </tr>

<?php  } }//End looping?>

</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>