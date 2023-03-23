@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/absensi/simpatedittglabsensi/'.$dtpresensi->JadwalID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $dtpresensi->PresensiID ?>">

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Pertemuan</label>
	<div class="col-sm-6">
		<input type="text" name="Pertemuan" class="form-control form-control-sm" placeholder="Pertemuan" value="<?php echo $dtpresensi->Pertemuan ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Tanggal</label>
	<div class="col-sm-6">
		<input type="text" name="Tanggal" class="form-control form-control-sm tanggal" placeholder="yyyy-mm-dd" value="<?php echo date('d-m-Y', strtotime($dtpresensi->Tanggal))?>">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Jam Mulai</label>
	<div class="col-sm-2">
		<input type="text" name="JamMulai" class="form-control form-control-sm" placeholder="Jam Mulai" value="<?php echo $dtpresensi->JamMulai ?>" required>
	</div>
	<div class="col-sm-2">
		<input type="text" name="JamSelesai" class="form-control form-control-sm" placeholder="Jam Selesai" value="<?php echo $dtpresensi->JamSelesai ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Catatan</label>
	<div class="col-sm-6">
		<textarea name="Catatan" class="form-control form-control-sm" value="<?php echo $dtpresensi->Catatan ?>"> <?php echo $dtpresensi->Catatan ?></textarea>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Simpan Data">
			<a href="{{ asset('admin/absensi/createabsensi/'.$dtpresensi->JadwalID) }}" class="btn btn-danger btn-sm">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

