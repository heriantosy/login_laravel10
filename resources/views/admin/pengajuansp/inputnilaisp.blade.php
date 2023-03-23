 
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

<form action="{{ asset('admin/pengajuansp/simpannilaisp') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="table-responsive mailbox-messages">
<div style='align:center'>@include('admin/pengajuansp/tabta') </div>
<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			
			<th><b style='color:white'>MATAKULIAH</b></th>
			<th width="50%"><b style='color:white'>DOSEN PENGAMPU</b></th>
		</tr>
	</thead>
	<tbody>
    <tr>
      <td>Matakuliah: <?php echo $mk->Nama ?> (<?php echo $mk->SKS ?>)
      <br>ProdiID: <?php echo $mk->ProdiID ?>
      </td>
      <td>Dosen Pengampu: <?php echo '-' ?>
      <br>Waktu: <?php echo '-' ?>
      </td>
    </tr>
	</tbody>
</table>
<table class="table table-bordered table-sm" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%">No</th>
        <th width="8%">NIM</th>
        <th width="45%">Nama Mahasiswa</th>
        <th width="17%">Nilai Angka</th> 
        <th width="17%">Nilai Huruf</th>   
    </tr>
</thead>
<tbody>
<?php 					

$no=0;     
foreach($pengajuansp as $row) {
  $no++;
  $NamaMhsx = strtolower($row->NamaMhs);
  $NamaMhs	= ucwords($NamaMhsx);
?>
  <tr > 
  <input type="hidden" name="TahunID" value="{{ $tahunplh }}"> 
  <input type="hidden" name="ProdiID" value="{{ $prodiplh }}"> 
  <input type="hidden" name="MKID" value="{{ $row->MKID }}"> 
  <input type="hidden" name="MhswID[]" value="{{ $row->MhswID }}">        
    <td><?php echo $no ?></td>
    <td><?php echo $row->MhswID ?></td>
    <td><?php echo $NamaMhs ?></td></td>
    <td><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="NilaiAkhir[]" size="1" value="{{ $row->NilaiAkhir }}"></td>
    <td><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="Tugas3[]" size="1" value="{{ $row->GradeNilai }}"></td>
  </tr>
<?php  
}
?>
<tr>
	<td colspan="4">
		<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
			Simpan Data</button>
			<a href="{{ asset('admin/pengajuansp/nilaisp/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
	</td>
	</tr>
</tbody>
</table>
</form>
</div>



