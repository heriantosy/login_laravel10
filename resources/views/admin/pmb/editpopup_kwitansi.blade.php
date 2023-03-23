
<div class="modal fade" id="Edit<?php echo $pmb->PMBFormJualID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Edit Kwitansi</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    
<form action="{{ asset('admin/pmb/edit_kwitansi') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="PMBFormJualID" value="{{ $pmb->PMBFormJualID }}">
<input type="hidden" name="PMBFormulirID" value="{{ $pmb->PMBFormulirID }}">
<input type="hidden" name="PMBPeriodID" value="{{ $pmb->PMBPeriodID }}">
<div class="form-group row">
	<label class="col-md-5">No Kwitansi</label>
	<div class="col-md-7">
		<b><?php echo $pmb->PMBFormJualID ?></b>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Periode Gelombang</label>
	<div class="col-md-7">
		<input type="text" name="PMBPeriodID" class="form-control" placeholder="Periode" value="<?php echo $pmb->PMBPeriodID ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Bukti Setoran Bank</label>
	<div class="col-md-7">
		<input type="text" name="BuktiSetoran" class="form-control" placeholder="Bukti Setoran" value="<?php echo $pmb->BuktiSetoran ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Nama Pembeli</label>
	<div class="col-md-7">
		<input type="text" name="Nama" class="form-control" placeholder="Nama Pembeli" value="<?php echo $pmb->Nama ?>" required>
	</div>
</div>



<div class="form-group row">
	<label class="col-md-5">Jenis Formulir</label>
	<div class="col-md-7">
		<b><?php echo $frm->Nama ?></b>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Harga</label>
	<div class="col-md-7">
		<b><?php echo $frm->Harga ?></b>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Jumlah Pilihan</label>
	<div class="col-md-7">
		<b><?php echo $frm->JumlahPilihan ?></b>
	</div>
</div>


<div class="form-group row">
	<label class="col-md-5">Ganti Formulir</label>
	<div class="col-md-7">
		<?php
		echo"<select class='form-control form-control-sm' name='PMBFormulirID'> 
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
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5">Keterangan</label>
	<div class="col-md-7">
		<input type="text" name="Keterangan" class="form-control" placeholder="Keterangan" value="<?php echo $pmb->Keterangan ?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-md-5"></label>
	<div class="col-md-7">
<div class="btn-group">
<input type="submit" name="submit" class="btn btn-success " value="Edit">&nbsp;
<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>

<div class="clearfix"></div>

</form>

</div>
</div>
</div>
</div>
