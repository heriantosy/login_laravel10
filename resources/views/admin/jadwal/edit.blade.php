
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
<input type="hidden" name="TahunID" value="{{ $jadwal->TahunID }}">
<input type="hidden" name="ProdiID" value="{{ $jadwal->ProdiID }}">
<input type="hidden" name="ProgramID" value="{{ $jadwal->ProgramID }}">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Edit Data Jadwal Kuliah
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pilih Tahun Akademik</label>
  <div class="col-md-8">
    <select name="TahunID" class="form-control form-control select2">
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

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Program</label>
  <div class="col-md-8">
    <select name="ProgramID" class="form-control form-control-sm">
      <?php foreach($program as $program) { ?>
        <option value="<?php echo $program->ProgramID ?>" 
          <?php if(isset($_POST['ProgramID']) && $_POST['ProgramID']==$program->ProgramID) { echo "selected"; }
                elseif(isset($_GET['ProgramID']) && $_GET['ProgramID']==$program->ProgramID) { echo 'selected'; }
                elseif($program->ProgramID==$jadwal->ProgramID) { echo 'selected'; } ?>>
          <?php echo $program->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Program Studi</label>
  <div class="col-md-8">
    <select name="ProdiID" class="form-control form-control-sm">
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
  <label class="col-sm-4 control-label text-right">Pilih Hari</label>
  <div class="col-md-8">
    <select name="HariID" class="form-control form-control-sm select2">
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


<div class="row form-group">
  <label class="col-md-4 control-label text-right">Jam Kuliah</label>
  <div class="col-md-1">
    <input type="text" name="JamMulai" class="form-control form-control-sm" placeholder="Jam Mulai" value="<?php echo $jadwal->JamMulai ?>">
  </div>s/d
  <div class="col-md-1">
    <input type="text" name="JamSelesai" class="form-control form-control-sm" placeholder="Jam Selesai" value="<?php echo $jadwal->JamSelesai ?>">
  </div>
</div>



<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Matakuliah</label>
  <div class="col-md-8">
    <select name="MKID" class="form-control form-control-sm select2">
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
  <label class="col-sm-4 control-label text-right">SKS<span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="RencanaKehadiran" class="form-control" value="<?php echo $jadwal->SKS ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Ruang Kuliah</label>
  <div class="col-md-8">
    <select name="RuangID" class="form-control form-control-sm select2">
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

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Kapasitas</label>
  <div class="col-md-1">
    <input type="text" name="Kapasitas" class="form-control form-control-sm" placeholder="Kapasitas" required="required" value="<?php echo $jadwal->Kapasitas ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Nama Kelas</label>
  <div class="col-md-8">
    <select name="NamaKelas" class="form-control form-control-sm">
      <?php foreach($kelas as $kelas) { ?>
        <option value="<?php echo $kelas->KelasID ?>" 
          <?php if(isset($_POST['KelasID']) && $_POST['KelasID']==$kelas->KelasID) { echo "selected"; }
                elseif(isset($_GET['KelasID']) && $_GET['KelasID']==$kelas->KelasID) { echo 'selected'; }
                elseif($kelas->KelasID==$jadwal->NamaKelas) { echo 'selected'; } ?>>
          <?php echo $kelas->Nama  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pengampu</label>
  <div class="col-md-8">
    <select name="DosenID" class="form-control form-control-sm select2">
      <?php foreach($dosen as $dosen) { ?>
        <option value="<?php echo $dosen->Login ?>" 
          <?php if(isset($_POST['DosenID']) && $_POST['DosenID']==$dosen->Login) { echo "selected"; }
                elseif(isset($_GET['DosenID']) && $_GET['DosenID']==$dosen->Login) { echo 'selected'; }
                elseif($dosen->Login==$jadwal->DosenID) { echo 'selected'; } ?>>
                <?php echo $dosen->Nama  ?>, <?php echo $dosen->Gelar  ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>



<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Rencana Tatap Muka <span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="RencanaKehadiran" class="form-control form-control-sm" value="<?php echo $jadwal->RencanaKehadiran ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Minimal Kehadiran Mahasiswa<span class="text-danger">*</span></label>
  <div class="col-sm-1">
    <input type="text" name="KehadiranMin" class="form-control form-control-sm" value="<?php echo $jadwal->KehadiranMin ?>">
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
      </button>&nbsp;
     <button class="btn btn-success btn-sm" onclick="goBack()"><i class="fa fa-backward"></i>x Kembali</button>	
	
    </div>
  </div>
</div>
</form>

<script>
function goBack() {
  window.history.back();
}
</script>
