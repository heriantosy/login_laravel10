<?php if($pmb) { ?>  
<div class="row">
<div class="col-md-5">
    <form action="{{ asset('admin/pmb/cari') }}" method="get" accept-charset="utf-8">

    </form>
</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/pmb/prosestahun') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">

  </div>
<div class="input-group mb-3 col-md-8">
<div class="input-group mb-3 col-md-6">&nbsp;</div>
<select name="tahun" class="form-control  form-control-sm select2">
<?php foreach($tahun as $tahun) { ?>
  <option value="<?php echo $tahun->Tahun ?>" 
    <?php if(isset($_POST['tahunplh']) && $_POST['tahunplh']==$tahun->Tahun) { echo "selected"; }
          elseif(isset($_GET['tahunplh']) && $_GET['tahunplh']==$tahun->Tahun) { echo 'selected'; }
          elseif($tahunplh==$tahun->Tahun) { echo 'selected'; } ?>>
    <?php echo $tahun->Tahun  ?>
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
        
        <th width="5%">No</th>
        <th style='width:8%;text-align:center'>PMBID</th>
        <th width="10%%">PMBPeriodID</th>
        <th width="35%">Nama</th>
        <th width="35%">Tempat dan Tanggal Lahir</th>
        <th width="10%%">Program</th>
        <th width="8%">Prodi</th>
        <th width="5%">Status</th>
        <th width="5%">Lulus</th>
        <th width="5%">Registered?</th>
        <th width="5%" style='text-align:center'>NIM</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>
  <?php 
      $i=0;     
      foreach($pmb as $pmb) {
        $i++;
        $NamaMhsx 		  = strtolower($pmb->Nama);
        $NamaMhs	      = ucwords($NamaMhsx);
        $TempatLahirx 	= strtolower($pmb->TempatLahir);
        $TempatLahir	= ucwords($TempatLahirx);
        if ($pmb->RegUlang=='Y'){
          $c="style=color:green";
        } else{
            $c="style=color:black";
        }
  ?>
  <tr <?php echo $c ?>>
    <td><?php echo $i ?></td>
    <td><?php echo $pmb->PMBID ?></td>
    <td><?php echo $pmb->PMBPeriodID ?></td>
    <td><?php echo $NamaMhs ?></td>
    <td><?php echo $TempatLahir ?>, <?php echo date('d-m-Y', strtotime($pmb->TanggalLahir)) ?></td>
    <td><?php echo $pmb->ProgramID ?></td>
    <td><?php echo $pmb->ProdiID ?></td>
    <td><?php echo $pmb->StatusAwalID ?></td>
    <td><?php echo $pmb->LulusUjian ?></td>
    <td><?php echo $pmb->RegUlang ?></td>
    <td><?php echo $pmb->NIM ?></td>

    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/pmb/edit/'.$pmb->PMBID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{ asset('admin/pmb/cetak/'.$pmb->PMBID) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/pmb/delete/'.$pmb->PMBID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
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