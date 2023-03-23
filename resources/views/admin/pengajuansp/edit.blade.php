
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/pengajuanta/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="id" value="<?php echo $pengajuanta->IDPenelitian ?>">
 <input type="hidden" name="TahunID" value="<?php echo $pengajuanta->TahunID ?>">
<input type="hidden" name="ProdiID" value="<?php echo $pengajuanta->ProdiID ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Pengajuan Judul
</p>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ketua Kelompok [NIM]<span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="MhswID" class="form-control form-control-sm" placeholder="Ketua Kelompok" value="<?php echo $pengajuanta->MhswID ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Judul Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Judul" rows="2" class="form-control form-control-sm" placeholder="Judul Penelitian" value="<?php echo $pengajuanta->Judul ?>"><?php echo $pengajuanta->Judul ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tempat Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="TempatPenelitian" class="form-control form-control-sm" placeholder="Tempat Penelitian" value="<?php echo $pengajuanta->TempatPenelitian ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">URL (Google Drive) <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="URLX" class="form-control form-control-sm" placeholder="URL" value="<?php echo $pengajuanta->URLX ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Abstrak <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Abstrak" rows="10" class="form-control form-control-sm" value="<?php echo $pengajuanta->Abstrak ?>"><?php echo $pengajuanta->Abstrak ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing 1 <span class="text-danger">*</span></label>
  <div class="col-sm-8">
  <?php
    echo"<select class='form-control form-control-sm' name='Pembimbing1'> 
    <option value='0' selected>- Pilih Pembimbing 1 -</option>"; 
    foreach ($dosen as $a){
      if ($pengajuanta->Pembimbing1 == $a->Login){
         echo "<option value='$a->Login' selected>$a->Nama</option>";
      }else{
         echo "<option value='$a->Login'>$a->Nama</option>";
      }
    }
    echo "</select>";
  ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing 2 <span class="text-danger">*</span></label>
  <div class="col-sm-8">
  <?php
    echo"<select class='form-control form-control-sm' name='Pembimbing2'> 
    <option value='0' selected>- Pilih Pembimbing 2 -</option>"; 
    foreach ($dosen as $a){
      if ($pengajuanta->Pembimbing2 == $a->Login){
         echo "<option value='$a->Login' selected>$a->Nama</option>";
      }else{
         echo "<option value='$a->Login'>$a->Nama</option>";
      }
    }
    echo "</select>";
  ?>
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-user"></i> Setting Penerbitan Surat Pengantar Ke Perusahaan
</p>
<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tujuan Surat / Kota <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="Kota" class="form-control form-control-sm" placeholder="Tujuan Surat / Kota" value="<?php echo $pengajuanta->Kota ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kepada <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="Ke" class="form-control form-control-sm" placeholder="Kepada" value="<?php echo $pengajuanta->Ke ?>">
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

      <a href="{{ asset('admin/pengajuanta/filter/'.$pengajuanta->TahunID.'/'.$pengajuanta->ProdiID) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
