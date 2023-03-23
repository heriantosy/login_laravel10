
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('mahasiswa/pengajuanta/tambah_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="TahunID" value="<?php echo $tahunplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Pengajuan Judul
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ketua Kelompok [NIM]<span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="MhswID" class="form-control form-control-sm" placeholder="Ketua Kelompok" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Judul Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Judul" rows="2" class="form-control form-control-sm" placeholder="Judul Penelitian" ></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tempat Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="TempatPenelitian" class="form-control form-control-sm" placeholder="Tempat Penelitian" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pembimbing</label>
  <div class="col-md-8">
    <select name="DosenID" class="form-control form-control-sm select2">
      <?php foreach($dosen as $dosen) { ?>
        <option value="<?php echo $dosen->Login ?>"><?php echo $dosen->Nama ?>, <?php echo $dosen->Gelar  ?></option>
      <?php } ?>
    </select>
  </div>
</div>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right">URL (Google Drive) <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="URLX" class="form-control form-control-sm" placeholder="URL">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Abstrak <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Abstrak" rows="10" class="form-control form-control-sm" ></textarea>
  </div>
</div>


<p class="alert alert-info">
  <i class="fa fa-user"></i> Setting Penerbitan Surat Pengantar Ke Perusahaan
</p>
<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tujuan Surat / Kota <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="Kota" class="form-control form-control-sm" placeholder="Tujuan Surat / Kota" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kepada <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="Ke" class="form-control form-control-sm" placeholder="Kepada" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>
<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
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
      <a href="{{ asset('admin/pengajuanta/filter/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
