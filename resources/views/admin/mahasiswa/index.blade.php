@include('admin/mahasiswa/tabmahasiswa')
<?php if($mahasiswa) { ?>  
<div class="row">
<div class="col-md-12">

<form action="{{ asset('admin/mahasiswa/filtermhs') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-3">
    &nbsp;
</div>
<div class="input-group mb-3 col-md-3">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-6" >
<select name="program" class="form-control form-control-sm" onChange='this.form.submit()'>
<?php foreach($program as $program) { ?>
  <option value="<?php echo $program->ProgramID ?>" 
    <?php if(isset($_POST['programplh']) && $_POST['programplh']==$program->ProgramID) { echo "selected"; }
          elseif(isset($_GET['programplh']) && $_GET['programplh']==$program->ProgramID) { echo 'selected'; }
          elseif($programplh==$program->ProgramID) { echo 'selected'; } ?>>
    <?php echo $program->ProgramID  ?>
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

<select name="statusmhs" class="form-control form-control-sm" onChange='this.form.submit()'>
<?php 
foreach($statusmhs as $statusmhs) { ?> 
  <option value="<?php echo $statusmhs->StatusMhswID ?>" 
    <?php if(isset($_POST['statusmhsplh']) && $_POST['statusmhsplh']==$statusmhs->StatusMhswID) { echo "selected"; }
          elseif(isset($_GET['statusmhsplh']) && $_GET['statusmhsplh']==$statusmhs->StatusMhswID) { echo 'selected'; }
          elseif($statusmhsplh==$statusmhs->StatusMhswID) { echo 'selected'; } ?>>
    <?php echo $statusmhs->Nama  ?>
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
<table id="example1" class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>

        <th width="3%">No</th>
        <th width="8%">NIM</th>
        <th width="30%">Nama</th>
        <th width="30%">Tempat & Tanggal Lahir</th>
        <th width="35%">Program Studi</th>
        <th width="5%">Handphone</th>
        <th width="5%">Status</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					

       $i=0;     
      foreach($mahasiswa as $mahasiswa) {
        $i++;
        $NamaMhsx = strtolower($mahasiswa->Nama);
        $NamaMhs	= ucwords($NamaMhsx);
        $TempatLahirx = strtolower($mahasiswa->TempatLahir);
        $TempatLahir	= ucwords($TempatLahirx);
       
  ?>

  <tr>
   
    <td><?php echo $i ?></td>
    <td><a href="{{ asset('admin/mahasiswa/detailakademik/'.$mahasiswa->MhswID) }}"><?php echo $mahasiswa->MhswID ?></a></td>
    <td><?php echo $NamaMhs ?></td>
    <td><?php echo $TempatLahir ?>, <?php echo date('d-m-Y', strtotime($mahasiswa->TanggalLahir)) ?></td>
    <td><?php echo $mahasiswa->ProgramID ?> - <?php echo $mahasiswa->NamaProdi ?></a></td>
    <td><?php echo $mahasiswa->Handphone ?></td>
    <td><?php echo $mahasiswa->StatusMhswID ?></td>
    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/mahasiswa/editfotomhs/'.$mahasiswa->MhswID) }}"><i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/mahasiswa/cetak/'.$mahasiswa->MhswID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/mahasiswa/delete/'.$mahasiswa->MhswID) }}" onclick="return confirm('Yakin data akan dihapus ?')"><i class="fas fa-trash-alt"></i></a>
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