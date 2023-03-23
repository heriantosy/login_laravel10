

<form action="{{ asset('admin/predikat/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="PredikatID" value="<?php echo $predikat->PredikatID ?>">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<div class="row form-group">
  <label class="col-md-2">Predikat</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Predikat" value="<?php echo $predikat->Nama ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Mulai IPK</label>
  <div class="col-md-8">
    <input type="text" name="IPKMin" class="form-control form-control-sm" placeholder="IPKMin" value="<?php echo $predikat->IPKMin ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Sampai IPK</label>
  <div class="col-md-8">
    <input type="text" name="IPKMax" class="form-control form-control-sm" placeholder="IPKMax" value="<?php echo $predikat->IPKMax ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Keterangan<span class="text-danger"> *</span></label>
  <div class="col-sm-4">
    <textarea name="Keterangan" rows="3" class="form-control form-control-sm"><?php echo $predikat->Keterangan ?></textarea>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Tidak Aktif?</label>
  <div class="col-md-8">
  <?php   
       $_na = ($predikat->NA == 'Y')? 'checked' : '';
      echo"<input type=checkbox name='NA' value='Y' $_na>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/predikat/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

