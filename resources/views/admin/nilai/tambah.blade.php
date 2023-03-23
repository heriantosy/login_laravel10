
<form action="{{ asset('admin/nilai/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">


<div class="row form-group">
  <label class="col-md-2">Nama</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Kurikulum">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Bobot</label>
  <div class="col-md-8">
    <input type="text" name="Bobot" class="form-control form-control-sm" placeholder="Bobot">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Lulus?</label>
  <div class="col-md-8">
  <?php   
      echo"<input type=checkbox name='Lulus' value='N'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Batas Bawah</label>
  <div class="col-md-8">
    <input type="text" name="NilaiMin" class="form-control form-control-sm" placeholder="BatasBawah">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Batas Atas</label>
  <div class="col-md-8">
    <input type="text" name="NilaiMax" class="form-control form-control-sm" placeholder="BatasAtas">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Max Pengampilan SKS</label>
  <div class="col-md-8">
    <input type="text" name="MaxSKS" class="form-control form-control-sm" placeholder="MaxSKS">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Tidak Aktif?</label>
  <div class="col-md-8">
  <?php   
      echo"<input type=checkbox name='NA' value='Y'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Deskripsi</label>
  <div class="col-md-8">
    <input type="text" name="Deskripsi" class="form-control form-control-sm" placeholder="Deskripsi">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/nilai/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

