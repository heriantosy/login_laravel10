
<div class="modal fade" id="Edit<?php echo $pengajuanta->IDPenelitian ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Komentar</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    
<form action="{{ asset('admin/pengajuanta/simpankomentar') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ $pengajuanta->IDPenelitian }}">
<input type="hidden" name="tahun" value="{{ $pengajuanta->TahunID }}">
<input type="hidden" name="prodi" value="{{ $pengajuanta->ProdiID }}">
<div class="form-group row">
	<label class="col-md-4">Komentar</label>
	<div class="col-md-7">
		<input type="text" name="Komentar" class="form-control form-control-sm" placeholder="Komentar" value="<?php echo $pengajuanta->Komentar ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4">Judul</label>
	<div class="col-md-7">
		<textarea name="Judul" cols="90" rows="6" class="form-control form-control-sm" placeholder="Judul"><?php echo $pengajuanta->Judul ?>  </textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4">Tempat Penelitian</label>
	<div class="col-md-7">
		<input type="text" name="TempatPenelitian" class="form-control form-control-sm" placeholder="Tempat Penelitian" value="<?php echo $TempatPenelitian ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4">Pembimbing 1</label>
	<div class="col-md-7">
		<?php
		echo"<select class='form-control form-control-sm' name='Pembimbing1'> 
		<option value='0' selected>- Pilih Pembimbing 1 -</option>"; 
		$dosen = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();
		foreach ($dosen as $a){
		  //if ($dosenplh == $a->Login){
		  //echo "<option value='$a->Login' selected>$a->Nama</option>";
		  //}else{
			echo "<option value='$a->Login'>$a->Nama</option>";
		  }
		//}
		echo "</select>";
		?>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4">Pembimbing 2</label>
	<div class="col-md-7">
		<?php
		echo"<select class='form-control form-control-sm' name='Pembimbing2'> 
		<option value='0' selected>- Pilih Pembimbing 2 -</option>"; 
		$dosen = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();
		foreach ($dosen as $a){
		  //if ($dosenplh == $a->Login){
		  //echo "<option value='$a->Login' selected>$a->Nama</option>";
		  //}else{
			echo "<option value='$a->Login'>$a->Nama</option>";
		  }
		//}
		echo "</select>";
		?>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4"></label>
	<div class="col-md-7">
<div class="btn-group">
<input type="submit" name="submit" class="btn btn-success " value="Tambahkan Komentar">&nbsp;
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
