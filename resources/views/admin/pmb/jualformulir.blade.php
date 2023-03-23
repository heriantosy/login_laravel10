
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pmb/prosesjual') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">
  </div>
<div class="input-group mb-3 col-md-8">

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
</form>


@include('admin/pmb/tabpmb')

<form action="{{ asset('admin/pmb/jualformulirsimpan') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<table width='100%'>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type=hidden name='PMBPeriodID' value="<?php echo $pmbperiodplh ?>">
<input type=hidden name='PMBFormulirID' value="<?php echo $formulirplh ?>">
<tr><td  height='30px' scope='row' colspan='2' style=text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;>&nbsp;PENJUALAN FORMULIR</td></tr>
<tr><td height="5px"></td></tr>
<tr><td width='290px' scope='row'>PMBFormJualIDx</td> <td><input type='text' class='form-control form-control-sm' name='PMBFormJualID' value="<?php echo $NewID ?>" readonly> </td></tr>
<tr><td  scope='row'>Jenis Formulir</td> <td><input type='text' class='form-control form-control-sm' required name='x' value="<?php echo  $frm->Nama ?>" readonly> </td></tr>
<tr><td  scope='row'>Tanggal</td> <td><input type='text' class='form-control form-control-sm' name='Tanggal' value="<?php echo date('Y-m-d') ?>" readonly> </td></tr>
			
<tr><td scope='row'>Jumlah Pilihan</td><td><input type='text' class='form-control form-control-sm' name='JumlahPilihan' value="<?php echo $frm->JumlahPilihan ?>" readonly></td></tr>
<tr><td scope='row'>Harga</td><td><input type='text' class='form-control form-control-sm' name='Harga' value="<?php echo $frm->Harga ?>" readonly></td></tr>
<tr><td scope='row'>No Bukti Setoran</td><td><input type='text' class='form-control form-control-sm' name='BuktiSetoran' ></td></tr>
<tr><td scope='row'>Pembeli</td><td><input type='text' class='form-control form-control-sm' name='Pembeli' ></td></tr>
<tr><td scope='row'>Keterangan</td><td><input type='text' class='form-control form-control-sm' name='Keterangan' ></td></tr>
<tr><td height="15px"></td></tr>
<tr>
<td colspan='2'>
    <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
    <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
    <a href="{{ asset('admin/pmb/pmbjualform') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
    </a>
<td>
</tr>
</table>      
</form>



