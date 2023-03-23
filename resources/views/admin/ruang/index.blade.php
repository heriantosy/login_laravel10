
<div class="row">
<div class="col-md-5">

</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/ruang/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">
  <a href="{{ asset('admin/ruang/tambah') }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
  </div>
<div class="input-group mb-3 col-md-8">

<select name="kampus" class="form-control form-control-sm select2">
<?php foreach($kampus as $kampus) { ?>
  <option value="<?php echo $kampus->KampusID ?>" 
    <?php if(isset($_POST['kampusplh']) && $_POST['kampusplh']==$kampus->KampusID) { echo "selected"; }
          elseif(isset($_GET['kampusplh']) && $_GET['kampusplh']==$kampus->KampusID) { echo 'selected'; }
          elseif($kampusplh==$kampus->KampusID) { echo 'selected'; } ?>>
    <?php echo $kampus->Nama  ?>
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
<table class="table table-bordered table-sm" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>      
        <th width="4%">No</th>
        <th style='width:8%;text-align:center'>Kode</th>
        <th width="10%">Nama</th>
        <th width="30%" >Program Studi</th>
        <th width="10%" style='text-align:center'>Ruang Kelas?</th>
        <th width="8%" style='text-align:center'>Kapasitas</th>
        <th width="10%" style='text-align:center'>Untuk USM?</th>
        <th width="30%">Keterangan</th>
        <th width="5%">NA</th>
        <th width="3%"></th>
    </tr>
</thead>
<tbody>
  <?php 
      $i=0;     
      foreach($ruang as $ruang) {
      $i++;
  ?>
    <tr>
    <td><?php echo $i ?></td>
    <td style='text-align:center'><?php echo $ruang->RuangID ?></td>
    <td><?php echo $ruang->Nama ?></td>
    <td><?php echo $ruang->ProdiID ?></td>
    <td style='text-align:center'><?php echo $ruang->RuangKuliah ?></td>
    <td style='text-align:center'><?php echo $ruang->Kapasitas ?></td>
    <td style='text-align:center'><?php echo $ruang->UntukUSM ?></td>
    <td><?php echo $ruang->Keterangan ?></td>
    <td><?php echo $ruang->NA ?></td>
    <td><a href="{{ asset('admin/ruang/edit/'.$ruang->RuangID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a></td>
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>


</form>
