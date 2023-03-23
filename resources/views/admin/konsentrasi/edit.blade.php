

<form action="{{ asset('admin/konsentrasi/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="KonsentrasiID" value="<?php echo $konsentrasi->KonsentrasiID ?>">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">
<div class="row form-group">
  <label class="col-md-3">Konsentrasi Kode</label>
  <div class="col-md-8">
    <input type="text" name="KonsentrasiKode" class="form-control form-control-sm" placeholder="KonsentrasiKode" required="required" value="<?php echo $konsentrasi->KonsentrasiKode ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Kurikulum" value="<?php echo $konsentrasi->Nama ?>">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-8">
  <textarea name="Keterangan" rows="3" class="form-control form-control-sm"><?php echo $konsentrasi->Keterangan ?></textarea>
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tidak Aktif?</label>
  <div class="col-md-8">
  <?php   
       $_na = ($konsentrasi->NA == 'Y')? 'checked' : '';
      echo"<input type=checkbox name='NA' value='Y' $_na>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/konsentrasi/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

