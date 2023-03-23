 
<div class="row">
<div class="col-md-5">
</div><div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/pengajuansp/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-3 col-md-4">
    &nbsp;
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
  </button>
  &nbsp;
  <a href="{{ asset('admin/pengajuansp/tambah/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
</span>
</div>
</div>
</form>


<div class="table-responsive mailbox-messages">
<div style='align:center'>@include('admin/pengajuansp/tabta') </div>
<table class="table table-bordered table-sm" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%">No</th>
        <th width="8%">MKID</th>
        <th width="15%">Kode</th>
        <th width="45%">Nama Matakuliah</th>
        <th width="17%">SKS</th>   
    </tr>
</thead>
<tbody>
<?php 					

$i=0;     
foreach($pengajuansp as $pengajuansp) {
  $i++;
  $NamaMKx = strtolower($pengajuansp->NamaMK);
  $NamaMK	= ucwords($NamaMKx);
  $JmlMhs = DB::table('t_sp')->where('TahunID',$pengajuansp->TahunID)->where('MKID',$pengajuansp->MKID)->count();
?>
  <tr > 
    <td><?php echo $i ?></td>
    <td><?php echo $pengajuansp->MKID ?></td>
    <td><?php echo $pengajuansp->MKKode ?></td>
    <td><?php echo $NamaMK ?>  (<?php echo $JmlMhs ?> orang) - <a href="{{ asset('admin/pengajuansp/inputnilaisp/'.$pengajuansp->MKID.'/'.$tahunplh.'/'.$prodiplh) }}"> Input Nilai </a></td>
    <td><?php echo $pengajuansp->SKS ?></td>
  </tr>
<?php  
}
?>

</tbody>
</table>
</div>



