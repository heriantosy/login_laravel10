
<?php if($dosen) { ?>  
<div class="row">
<div class="col-md-5">
   
</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/dosen/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-4">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-8" >
<select name="prodi" class="form-control form-control-sm ">
<?php 
foreach($prodi as $prodi) { ?> 
  <option value="<?php echo $prodi->ProdiID ?>" 
    <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
          elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
          elseif($prodiplh==$prodi->ProdiID) { echo 'selected'; } ?>>
    <?php echo $prodi->Nama  ?>
  </option>
<?php } ?>
</select>&nbsp;


<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>&nbsp;
    <a href="{{ asset('admin/dosen/tambah') }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>

        <th width="3%">No</th>
        <th width="8%">Login</th>
        <th width="8%">NIDN</th>
        <th width="30%">Nama</th>
        <th width="30%">Tempat & Tanggal Lahir</th>
        <th width="35%">Homebase</th>
        <th width="5%">Handphone</th>
        <th width="5%">Status</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					

       $i=0;     
      foreach($dosen as $dosen) {
        $i++;
        $NamaDosenx = strtolower($dosen->Nama);
        $NamaDosen	= ucwords($NamaDosenx);
        $TempatLahirx = strtolower($dosen->TempatLahir);
        $TempatLahir	= ucwords($TempatLahirx);
       
  ?>

  <tr style='font-size:15px;'>
   
    <td><?php echo $i ?></td>
    <td><a href="{{ asset('admin/dosen/detailpribadi/'.$dosen->Login) }}"><?php echo $dosen->Login ?></a></td>
    <td><?php echo $dosen->NIDN ?></td>
    <td><?php echo $NamaDosen ?>, <?php echo $dosen->Gelar ?></td>
    <td><?php echo $TempatLahir ?>, <?php echo date('d-m-Y', strtotime($dosen->TanggalLahir)) ?></td>
    <td>{{ $dosen->prodi->Nama ?? 'None' }} </a></td>
    <td><?php echo $dosen->Handphone ?></td>
    <td><?php echo $dosen->NA ?></td>
    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/dosen/editfotodosen/'.$dosen->Login) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{ asset('admin/dosen/cetak/'.$dosen->Login) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/dosen/delete/'.$dosen->Login) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
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