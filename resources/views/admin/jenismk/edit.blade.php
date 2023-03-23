

<form action="{{ asset('admin/jenismk/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="JenisMKID" value="<?php echo $jenismk->JenisMKID ?>">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<div class="row form-group">
  <label class="col-md-3">Singkatan</label>
  <div class="col-md-8">
    <input type="text" name="Singkatan" class="form-control form-control-sm" placeholder="Singkatan" value="<?php echo $jenismk->Singkatan ?>">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Kurikulum" value="<?php echo $jenismk->Nama ?>">
   
  </div>
</div>



<div class="row form-group">
  <label class="col-md-3">Tidak Aktif?</label>
  <div class="col-md-8">
  <?php   
       $_na = ($jenismk->NA == 'Y')? 'checked' : '';
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
      <a href="{{ asset('admin/jenismk/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

