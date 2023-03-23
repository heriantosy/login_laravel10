
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/pengajuankp/tambahagt_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="JadwalID" value="<?php echo $pengajuankp->JadwalID ?>">
 <input type="hidden" name="TahunID" value="<?php echo $tahunplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Tambah Anggota Kelompok
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Judul<span class="text-danger"> *</span></label>
  <div class="col-sm-8">
  <?php echo $pengajuankp->Judul ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing <span class="text-danger">*</span></label>
  <div class="col-sm-8">
      <?php echo $pengajuankp->DosenID ?>
  </div>
</div>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Nama Kelompok <span class="text-danger">*</span></label>
  <div class="col-sm-2">
    <input type="text" name="KelompokID" class="form-control form-control-sm" placeholder="Tempat Penelitian" value=" <?php echo $pengajuankp->KelompokID ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">NIM <span class="text-danger">*</span></label>
  <div class="col-sm-2">
    <input type="text" name="MhswID" class="form-control form-control-sm" placeholder="NIM">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>&nbsp;
 
      <a href="{{ asset('admin/pengajuankp/filter/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
