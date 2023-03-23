
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/kurikulum/tambah_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
 <input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i>Tambah Data
</p>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Kurikulum Kode<span class="text-danger"> *</span></label>
  <div class="col-sm-4">
    <input type="text" name="KurikulumKode" class="form-control form-control-sm" placeholder="KurikulumKode" value="55">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Nama<span class="text-danger"> *</span></label>
  <div class="col-sm-4">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama" value="55">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Nama Sesi<span class="text-danger"> *</span></label>
  <div class="col-sm-4">
    <input type="text" name="Sesi" class="form-control form-control-sm" placeholder="Sesi" value="55">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Jml Sesi / Tahun<span class="text-danger"> *</span></label>
  <div class="col-sm-4">
    <input type="text" name="JmlSesi" class="form-control form-control-sm" placeholder="JmlSesi" value="55">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Tidak Aktif?</label>
  <div class="col-md-4">
  <?php   
      echo"<input type=checkbox name='NA' value='Y'>";
  ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-2 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>&nbsp;
      <button type="reset" name="submit" class="btn btn-info btn-sm" value="reset">
        <i class="fa fa-times"></i> Reset
      </button> &nbsp;
      <?php
          $prodix = str_replace('.','',$prodiplh);
      ?>
      <a href="{{ asset('admin/kurikulum/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
