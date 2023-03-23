<div class="row">
<div class="col-md-5">
</div>
<div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/pmb/prosesjual') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-7">
  </div>
<div class="input-group mb-3 col-md-5">
<?php
echo"<select class='form-control form-control-sm' name='pmbperiod'> 
<option value='0' selected>- Pilih Periode -</option>"; 
foreach ($pmbperiod as $w){
  if ($pmbperiodplh == $w->PMBPeriodID){
	echo "<option value='$w->PMBPeriodID' selected>$w->PMBPeriodID</option>";
  }else{
	echo "<option value='$w->PMBPeriodID'>$w->PMBPeriodID</option>";
  }
}
echo "</select>";

echo"<select class='form-control form-control-sm' name='formulir'> 
<option value='0' selected>- Pilih Formulir -</option>"; 
foreach ($formulir as $a){
  if ($formulirplh == $a->PMBFormulirID){
	echo "<option value='$a->PMBFormulirID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->PMBFormulirID'>$a->Nama</option>";
  }
}
echo "</select>";
?>

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>&nbsp;
</span>
<a href="{{ asset('admin/pmb/tambah') }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
</div>

</div>
</form>


<div class="table-responsive mailbox-messages">
@include('admin/pmb/tabpmb')
<table id="dataTablexxx" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
      
    <th  width="10">No</th>					  					 
    <th width="2">Periode</th>
    <th width="30">Tanggal</th> 
    <th width="80">No Kwitansi</th>
    <th width="100">No Bukti Setoran</th>
    <th width="200">Pembeli</th>
    <th width="100">Formulir</th>
    <th width="30">Pil</th>
    <th width="30">Harga</th>
    </tr>
</thead>
<tbody>
  <?php 
      $i=0;   

      foreach($pmbjualform as $pmb) {
        $i++;
        $Namax = strtolower($pmb->Nama);
        $Nama	= ucwords($Namax);
  ?>
  <tr>

    <td><?php echo $i ?></td>
    <td><?php echo $pmb->PMBPeriodID ?></td>
    <td><?php echo date('d-m-Y', strtotime($pmb->TanggalBuat)) ?></td>
    <td><?php echo $pmb->PMBFormJualID ?><a href="" data-toggle="modal" data-target="#Edit<?php echo $pmb->PMBFormJualID ?>"> [ Edit ]</a></td>
    <td><?php echo $pmb->BuktiSetoran ?></td>
    <td><a href="{{ asset('admin/pmb/pmbformdaftar/'.$pmb->PMBFormJualID) }}"><?php echo $Nama ?></a></td>
    <td><?php echo $pmb->NamaFormulir ?></td>
    <td><?php echo $pmb->JumlahPilihan ?></td>
    <td><?php echo number_format($pmb->Harga) ?></td>

    @include('admin/pmb/editpopup_kwitansi')
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>



