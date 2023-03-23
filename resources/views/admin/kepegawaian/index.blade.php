@include('admin/kerjapraktek/tabkerjapraktek')
<?php if($pelatihan) { ?>  
<div class="row">
<div class="col-md-5">
</div>
<div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/pelatihan/filter') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<div class="row">
<div class="input-group mb-3 col-md-10">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-2" >
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

        <th width="3%">No</th>
        <th width="8%">Nama Pegawai</th>
        <th width="40%">Judul</th>
        <th width="18%">Pelaksana</th>
        <th width="10%">Tgl Kegiatan</th>
        <th width="25%">Narasumber</th>
        <th width="18%">Jenis Kegiatan</th>
        <th width="15%">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					

$i=0;     
foreach($pelatihan as $pelatihan) {
  $i++;
  $Namax = strtolower($pelatihan->Nama);
  $Nama	= ucwords($Namax);
  $Judulx = strtolower($pelatihan->Judul);
  $Judul	= ucwords($Judulx);

?>

  <tr style='font-size:15px;'>
   
    <td><?php echo $i ?></td>
    <td><?php echo $pelatihan->Noreg ?><br><?php echo $pelatihan->Nama ?></td>
    <td><?php echo $Judul ?></td>
    <td><?php echo $pelatihan->Pelaksana ?></td>
    <td><?php echo $pelatihan->TanggalMulai ?></td>
    <td><?php echo $pelatihan->NaraSumber ?></td>
    <td><?php echo $pelatihan->JenisKegiatan ?></td>
    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/pelatihan/editfotomhs/'.$pelatihan->IDPel) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{ asset('admin/pelatihan/cetak/'.$pelatihan->IDPel) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/pelatihan/delete/'.$pelatihan->IDPel) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>