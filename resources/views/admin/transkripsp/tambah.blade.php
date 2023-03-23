<p class="text-right">
  <a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
</p>
<hr>
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


<p class="alert alert-info">
  <i class="fa fa-user"></i> Isi data jadwal Anda dengan lengkap dan benar.
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tahun Akademik</label>
  <div class="col-md-8">
    <select name="tahun" class="form-control select2">
      <?php foreach($tahun as $tahun) { ?>
        <option value="<?php echo $tahun->TahunID ?>"><?php echo $tahun->TahunID ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Program Studi</label>
  <div class="col-md-8">
    <select name="prodi" class="form-control select2">
   <?php foreach($prodi as $prodi) { ?>
     <option value="<?php echo $prodi->ProdiID ?>"><?php echo $prodi->Nama ?></option>
   <?php } ?>
 </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Hari</label>
  <div class="col-md-8">
    <select name="HariID" class="form-control select2">
      <?php foreach($hari as $hari) { ?>
        <option value="<?php echo $hari->HariID ?>"><?php echo $hari->Nama ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ruang Kuliah</label>
  <div class="col-md-8">
    <select name="RuangID" class="form-control select2">
      <?php foreach($ruang as $ruang) { ?>
        <option value="<?php echo $ruang->RuangID ?>"><?php echo $ruang->RuangID ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pengampu</label>
  <div class="col-md-8">
    <select name="DosenID" class="form-control select2">
      <?php foreach($dosen as $dosen) { ?>
        <option value="<?php echo $dosen->Login ?>"><?php echo $dosen->Nama ?></option>
      <?php } ?>
    </select>
  </div>
</div>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Matakuliah</label>
  <div class="col-md-8">
    <select name="MKID" class="form-control select2">
      <?php foreach($matakuliah as $matakuliah) { ?>
        <option value="<?php echo $matakuliah->MKID ?>"><?php echo $matakuliah->Nama ?></option>
      <?php } ?>
    </select>
  </div>
</div>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Nama Kelas <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="NamaKelas" class="form-control" placeholder="NamaKelas" value="<?php if(isset($_POST['NamaKelas'])) { echo old('NamaKelas'); } ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Tanggal Order <span class="text-danger">*</span></label>
  <div class="col-sm-8">
    <input type="text" name="TglBuat" class="form-control tanggal" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['tanggal_order'])) { echo old('tanggal_order'); }else{ echo date('d-m-Y'); } ?>">
  </div>
</div>


<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
        <i class="fa fa-save"></i> Simpan pesanan
      </button>
      <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
        <i class="fa fa-times"></i> Reset
      </button>
    </div>
  </div>
</div>
</form>
