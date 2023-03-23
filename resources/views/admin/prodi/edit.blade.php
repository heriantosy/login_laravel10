@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/prodi/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="ProdiID" value="<?php echo $prodi->ProdiID ?>">



<div class="form-group row">
	<label class="col-sm-3 control-label text-right">ProdiID</label>
	<div class="col-sm-9">
		<input type="text" name="ProdiID" class="form-control" placeholder="Prodi ID" value="<?php echo $prodi->ProdiID ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nama Program Studi</label>
	<div class="col-sm-9">
		<input type="text" name="Nama" class="form-control" placeholder="Nama Program Studi" value="<?php echo $prodi->Nama ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Pejabat</label>
	<div class="col-sm-9">
		<input type="text" name="Pejabat" class="form-control" placeholder="Nama Pejabat" value="<?php echo $prodi->Pejabat ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin/prodi') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

