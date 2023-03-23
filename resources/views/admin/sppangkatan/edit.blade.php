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
<form action="{{ asset('admin/jadwal/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="JadwalID" value="{{ $jadwal->JadwalID }}">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Isi data jadwal Anda dengan lengkap dan benar.
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Program Studi</label>
  <div class="col-md-8">
    <select name="ProdiID" class="form-control select2">
      <?php foreach($prodi as $prodi) { ?>
        <option value="<?php echo $prodi->ProdiID ?>" 
          <?php if(isset($_POST['ProdiID']) && $_POST['ProdiID']==$prodi->ProdiID) { echo "selected"; }
                elseif(isset($_GET['ProdiID']) && $_GET['ProdiID']==$prodi->ProdiID) { echo 'selected'; }
                elseif($prodi->ProdiID==$jadwal->ProdiID) { echo 'selected'; } ?>>
          <?php echo $prodi->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pilih Tahun Akademik</label>
  <div class="col-md-8">
    <select name="TahunID" class="form-control select2">
      <?php foreach($tahun as $tahun) { ?>
        <option value="<?php echo $tahun->TahunID ?>" 
          <?php if(isset($_POST['TahunID']) && $_POST['TahunID']==$tahun->TahunID) { echo "selected"; }
                elseif(isset($_GET['TahunID']) && $_GET['TahunID']==$tahun->TahunID) { echo 'selected'; }
                elseif($tahun->TahunID==$jadwal->TahunID) { echo 'selected'; } ?>>
          <?php echo $tahun->TahunID  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Nama Kelas</label>
  <div class="col-md-8">
    <input type="text" name="NamaKelas" class="form-control" placeholder="Nama Kelas" required="required" value="<?php echo $jadwal->NamaKelas ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pilih Hari</label>
  <div class="col-md-8">
    <select name="HariID" class="form-control select2">
      <?php foreach($hari as $hari) { ?>
        <option value="<?php echo $hari->HariID ?>" 
          <?php if(isset($_POST['HariID']) && $_POST['HariID']==$hari->HariID) { echo "selected"; }
                elseif(isset($_GET['HariID']) && $_GET['HariID']==$hari->HariID) { echo 'selected'; }
                elseif($hari->HariID==$jadwal->HariID) { echo 'selected'; } ?>>
          <?php echo $hari->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ruang Kelas</label>
  <div class="col-md-8">
    <select name="RuangID" class="form-control select2">
      <?php foreach($ruang as $ruang) { ?>
        <option value="<?php echo $ruang->RuangID ?>" 
          <?php if(isset($_POST['RuangID']) && $_POST['RuangID']==$ruang->RuangID) { echo "selected"; }
                elseif(isset($_GET['RuangID']) && $_GET['RuangID']==$ruang->RuangID) { echo 'selected'; }
                elseif($ruang->RuangID==$jadwal->RuangID) { echo 'selected'; } ?>>
          <?php echo $ruang->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Matakuliah</label>
  <div class="col-md-8">
    <select name="MKID" class="form-control select2">
      <?php foreach($matakuliah as $matakuliah) { ?>
        <option value="<?php echo $matakuliah->MKID ?>" 
          <?php if(isset($_POST['MKID']) && $_POST['MKID']==$matakuliah->MKID) { echo "selected"; }
                elseif(isset($_GET['MKID']) && $_GET['MKID']==$matakuliah->MKID) { echo 'selected'; }
                elseif($matakuliah->MKID==$jadwal->MKID) { echo 'selected'; } ?>>
          <?php echo $matakuliah->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pengampu</label>
  <div class="col-md-8">
    <select name="DosenID" class="form-control select2">
      <?php foreach($dosen as $dosen) { ?>
        <option value="<?php echo $dosen->Login ?>" 
          <?php if(isset($_POST['DosenID']) && $_POST['DosenID']==$dosen->Login) { echo "selected"; }
                elseif(isset($_GET['DosenID']) && $_GET['DosenID']==$dosen->Login) { echo 'selected'; }
                elseif($dosen->Login==$jadwal->DosenID) { echo 'selected'; } ?>>
          <?php echo $dosen->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Rencana Tatap Muka</label>
  <div class="col-md-8">
    <input type="text" name="RencanaKehadiran" class="form-control" placeholder="Nama Kelas" required="required" value="<?php echo $jadwal->NamaKelas ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Minimal Kehadiran Mahasiswa</label>
  <div class="col-md-8">
    <input type="text" name="KehadiranMin" class="form-control" placeholder="Nama Kelas" required="required" value="<?php echo $jadwal->KehadiranMin ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Mulai</label>
  <div class="col-md-8">
    <input type="text" name="JamMulai" class="form-control" placeholder="Nama Kelas" required="required" value="<?php echo $jadwal->JamMulai ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Selesai</label>
  <div class="col-md-8">
    <input type="text" name="JamSelesai" class="form-control" placeholder="Nama Kelas" required="required" value="<?php echo $jadwal->JamSelesai ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <button type="reset" name="submit" class="btn btn-info btn-lg" value="reset">
        <i class="fa fa-times"></i> Reset
      </button>
    </div>
  </div>
</div>
</form>
