
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/ruang/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="row form-group">
  <label class="col-md-3">Kode Ruang</label>
  <div class="col-md-8">
    <input type="text" name="RuangID" class="form-control form-control-sm" placeholder="RuangID" required="required" value="{{ old('RuangID') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama Ruang</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Ruang" value="{{ old('Nama') }}">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kampus</label>
 <div class="col-md-3">
  <select name="KampusID" class="form-control form-control-sm select2">
   <?php foreach($kampus as $kampus) { ?>
     <option value="<?php echo $kampus->KampusID ?>"><?php echo $kampus->Nama ?></option>
   <?php } ?>
 </select>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Lantai</label>
  <div class="col-md-8">
    <input type="text" name="Lantai" class="form-control form-control-sm" placeholder="Lantai" value="{{ old('Lantai') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Untuk Kuliah</label>
  <div class="col-md-8">
  <?php
      echo"<input type=checkbox name='RuangKuliah' value='Y'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kapasitas</label>
  <div class="col-md-8">
    <input type="text" name="Kapasitas" class="form-control form-control-sm" placeholder="Kapasitas" value="{{ old('Kapasitas') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kapasitas Ujian</label>
  <div class="col-md-8">
    <input type="text" name="KapasitasUjian" class="form-control form-control-sm" placeholder="KapasitasUjian" value="{{ old('KapasitasUjian') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Jumlah Kolom Ujian</label>
  <div class="col-md-8">
    <input type="text" name="KolomUjian" class="form-control form-control-sm" placeholder="Kolom Ujian" value="{{ old('KolomUjian') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Untuk Ujian Saringan Masuk (USM)?</label>
  <div class="col-md-8">
  <?php   
      echo"<input type=checkbox name='UntukUSM' value='Y'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-8">
    <textarea name="Keterangan" class="form-control form-control-sm" ></textarea>
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">NA (Tidak Aktif) ?</label>
  <div class="col-md-8">
  <?php
      echo"<input type=checkbox name='NA' value='N'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/ruang') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

