<p class="text-right">
  <a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
</p>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/krsadm/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="text" class="form-control" name="KRSID" value="{{ $KRSID }}">
<input type="text" class="form-control" name="MhswID" value="<?php echo $MhswIDplh ?>" >
<p class="alert alert-info">
  <i class="fa fa-user"></i> Isi data jadwal Anda dengan lengkap dan benar.
</p>




<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
        <i class="fa fa-times"></i> Reset
      </button>
    </div>
  </div>
</div>
</form>
