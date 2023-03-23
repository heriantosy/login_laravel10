
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/jadwalujian/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="JadwalID" value="{{ $jadwal->JadwalID }}">
<input type="hidden" name="TahunID" value="{{ $jadwal->TahunID }}">
<input type="hidden" name="ProdiID" value="{{ $jadwal->ProdiID }}">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Edit Data Jadwal Ujian
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">No Jadwal</label>
  <div class="col-md-8">
  <?php echo $jadwal->JadwalID ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Matakuliah</label>
  <div class="col-md-8">
  <?php echo $jadwal->NamaMK ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Jadwal Kuliah</label>
  <div class="col-md-8">
  <?php echo $jadwal->NamaHari ?>, <?php echo substr($jadwal->JamMulai,0,5) ?> - <?php echo substr($jadwal->JamSelesai,0,5) ?> WIB
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Nama Kelas</label>
  <div class="col-md-8">
  <?php echo $jadwal->NamaKelas ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Dosen Pengampu</label>
  <div class="col-md-8">
  <?php echo $jadwal->NamaDosen ?>, <?php echo $jadwal->Gelar ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-4 control-label text-right">Tanggal UTS</label>
  <div class="col-md-3">
  <input type="text" class="form-control tanggal form-control-sm" name="UTSTanggal" value="<?php echo date('d-m-Y', strtotime($jadwal->UTSTanggal));  ?>"> 
  </div>
</div>

<div class="row form-group">
  <label class="col-md-4 control-label text-right">UTS Jam Mulai</label>
  <div class="col-md-1">
    <input type="text" name="UTSJamMulai" class="form-control form-control-sm" placeholder="Jam Mulai" value="<?php echo $jadwal->UTSJamMulai ?>">
  </div>s/d
  <div class="col-md-1">
    <input type="text" name="UTSJamSelesai" class="form-control form-control-sm" placeholder="Jam Selesai" value="<?php echo $jadwal->UTSJamSelesai ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-4 control-label text-right">Tanggal UAS</label>
  <div class="col-md-3">
  <input type="text" class="form-control tanggal form-control-sm" name="UASTanggal" value="<?php echo date('d-m-Y', strtotime($jadwal->UASTanggal));  ?>"> 
  </div>
</div>

<div class="row form-group">
  <label class="col-md-4 control-label text-right">UAS Jam Mulai</label>
  <div class="col-md-1">
    <input type="text" name="UASJamMulai" class="form-control form-control-sm" placeholder="Jam Mulai" value="<?php echo $jadwal->UASJamMulai ?>">
  </div>s/d
  <div class="col-md-1">
    <input type="text" name="UASJamSelesai" class="form-control form-control-sm" placeholder="Jam Selesai" value="<?php echo $jadwal->UASJamSelesai ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Kehadiran Minimal <span class="text-danger">*</span></label>
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
      <?php
          $prodix = str_replace('.','',$prodiplh);
      ?>
      <a href="{{ asset('admin/jadwalujian/filter/'.$tahunplh.'/'.$prodix) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
