
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/pengajuankp/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="id" value="<?php echo $pengajuankp->JadwalID ?>">
 <input type="hidden" name="TahunID" value="<?php echo $pengajuankp->TahunID ?>">
<input type="hidden" name="ProdiID" value="<?php echo $pengajuankp->ProdiID ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Pengajuan Judul
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kelompok ID<span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="KelompokID" class="form-control form-control-sm" placeholder="Kelompok ID" value="<?php echo $pengajuankp->KelompokID ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ketua Kelompok [NIM]<span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="MhswID" class="form-control form-control-sm" placeholder="Ketua Kelompok" value="<?php echo $pengajuankp->MhswID ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Judul Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Judul" rows="2" class="form-control form-control-sm" placeholder="Judul Penelitian" value="<?php echo $pengajuankp->Judul ?>"><?php echo $pengajuankp->Judul ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tempat Penelitian <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="TempatPenelitian" class="form-control form-control-sm" placeholder="Tempat Penelitian" value="<?php echo $pengajuankp->TempatPenelitian ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">URL (Google Drive) <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="URLX" class="form-control form-control-sm" placeholder="URL" value="<?php echo $pengajuankp->URLX ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Abstrak <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <textarea name="Deskripsi" rows="10" class="form-control form-control-sm" value="<?php echo $pengajuankp->Deskripsi ?>"><?php echo $pengajuankp->Deskripsi ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing 1 <span class="text-danger">*</span></label>
  <div class="col-sm-8">
  <?php
    echo"<select class='form-control form-control-sm' name='DosenID'> 
    <option value='0' selected>- Pilih Pembimbing 1 -</option>"; 
    foreach ($dosen as $a){
      if ($pengajuankp->DosenID == $a->Login){
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
    <input type="text" name="Kota" class="form-control form-control-sm" placeholder="Tujuan Surat / Kota" value="<?php echo $pengajuankp->Kota ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kepada <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="Ke" class="form-control form-control-sm" placeholder="Kepada" value="<?php echo $pengajuankp->Ke ?>">
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

      <a href="{{ asset('admin/pengajuankp/filter/'.$pengajuankp->TahunID.'/'.$pengajuankp->ProdiID) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
