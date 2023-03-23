
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/jadwal/tambah_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i>Tambah Data Jadwal
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tahun Akademik</label>
  <div class="col-md-8">
    <select name="tahun" class="form-control form-control-sm select2">
      <?php foreach($tahun as $tahun) { ?>
        <option value="<?php echo $tahun->TahunID ?>"><?php echo $tahun->TahunID ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Berlaku Untuk Program</label>
  <div class="col-md-8">
   <?php
    foreach ($program as $program){
        echo "<span style='display:block;'><input type=checkbox value='$program->ProgramID' name=ProgramID[]> $program->Nama &nbsp; &nbsp; &nbsp; </span>";
    }
   ?>
  </div>
</div>



<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Hari</label>
  <div class="col-md-8">
    <select name="HariID" class="form-control form-control-sm select2">
      <?php foreach($hari as $hari) { ?>
        <option value="<?php echo $hari->HariID ?>"><?php echo $hari->Nama ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-4 control-label text-right">Jam Kuliah</label>
  <div class="col-md-1">
    <input type="text" name="JamMulai" class="form-control form-control-sm" placeholder="Jam Mulai" value="08:00">
  </div>s/d
  <div class="col-md-1">
    <input type="text" name="JamSelesai" class="form-control form-control-sm" placeholder="Jam Selesai" value="09:59">
  </div>
</div>



<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Matakuliah</label>
  <div class="col-md-8">
    <select name="MKID" class="form-control form-control-sm select2">
      <?php foreach($matakuliah as $matakuliah) { ?>
        <option value="<?php echo $matakuliah->MKID ?>"><?php echo $matakuliah->Nama ?> - <?php echo $matakuliah->ProdiID ?> - <?php echo $matakuliah->Sesi ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Nama Kelas <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="NamaKelas" class="form-control form-control-sm" placeholder="NamaKelas" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ruang Kuliah</label>
  <div class="col-md-8">
    <select name="RuangID" class="form-control form-control-sm select2">
      <?php foreach($ruang as $ruang) { ?>
        <option value="<?php echo $ruang->RuangID ?>"><?php echo $ruang->RuangID ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kapasitas/Target<span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="Kapasitas" class="form-control form-control-sm" placeholder="Kapasitas" value="55">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pengampu</label>
  <div class="col-md-8">
    <select name="DosenID" class="form-control form-control-sm select2">
      <?php foreach($dosen as $dosen) { ?>
        <option value="<?php echo $dosen->Login ?>"><?php echo $dosen->Nama ?>, <?php echo $dosen->Gelar  ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Rencana Tatap Muka <span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="RencanaKehadiran" class="form-control form-control-sm" value="16">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Minimal Kehadiran Mahasiswa<span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="KehadiranMin" class="form-control form-control-sm" value="0">
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
      <a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
