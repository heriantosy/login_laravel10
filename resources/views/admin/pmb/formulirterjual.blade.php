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
  </button>
</span>

</div>
</div>
<div class="table-responsive mailbox-messages">
@include('admin/pmb/tabpmb')
<table class="table table-striped table-sm" cellspacing="0" width="50%">
<thead>
    <tr class="bg-dark" style='color:white'>     
        <th width="5%">No</th>
        <th width="60%">Jenis Formulir</th>
        <th width="5%" style='text-align:right'>Jumlah</th>    
    </tr>
</thead>
<tbody>
  <?php 
    $i=0;
    $formulir = DB::table('pmbformulir')->get();     
    foreach ($formulir as $formulir){   
    $i++;
    $tot =  DB::table('pmbformjual')->where(DB::raw('substr(PMBPeriodID, 1, 4)'), '=' ,$thn)->where('PMBFormulirID',$formulir->PMBFormulirID)->count();
    $ttl =  DB::table('pmbformjual')->where(DB::raw('substr(PMBPeriodID, 1, 4)'), '=' ,$thn)->count();
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $formulir->Nama ?></td>
    <td style='text-align:right'><?php echo $tot ?></td>
  </tr>

  <?php } //End looping?>
  <tr>
    <td>Total</td>
    <td></td>
    <td style='text-align:right'><?php echo $ttl ?></td>
  
  </tr>
</tbody>
</table>
</div>
</form>
