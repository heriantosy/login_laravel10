
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/ruang/proses_edit') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="id" value="<?php echo $ruang->RuangID ?>">
<div class="row form-group">
  <label class="col-md-3">Kode Ruang</label>
  <div class="col-md-8">
    <input type="text" name="RuangID" class="form-control form-control-sm" placeholder="RuangID" required="required" value="<?php echo $ruang->RuangID ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama Ruang</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Ruang" value="<?php echo $ruang->Nama ?>">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kampus</label>
 <div class="col-md-3">
  <select name="KampusID" class="form-control form-control-sm select2">
   <?php foreach($kampus as $kampus) { ?>
    <option value="<?php echo $kampus->KampusID ?>"  <?php if($ruang->KampusID==$kampus->KampusID) { echo "selected"; } ?>>
    <?php echo $kampus->Nama ?></option>
   <?php } ?>
 </select>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Lantai</label>
  <div class="col-md-8">
    <input type="text" name="Lantai" class="form-control form-control-sm" placeholder="Lantai" value="<?php echo $ruang->Lantai ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Untuk Kuliah</label>
  <div class="col-md-8">
  <?php
      $ruangkuliah = ($ruang->RuangKuliah == 'Y')? 'checked' : '';
      echo"<input type=checkbox name='RuangKuliah' value='Y' $ruangkuliah>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kapasitas</label>
  <div class="col-md-8">
    <input type="text" name="Kapasitas" class="form-control form-control-sm" placeholder="Kapasitas" value="<?php echo $ruang->Kapasitas ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kapasitas Ujian</label>
  <div class="col-md-8">
    <input type="text" name="KapasitasUjian" class="form-control form-control-sm" placeholder="KapasitasUjian" value="<?php echo $ruang->KapasitasUjian ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Jumlah Kolom Ujian</label>
  <div class="col-md-8">
    <input type="text" name="KolomUjian" class="form-control form-control-sm" placeholder="Kolom Ujian" value="<?php echo $ruang->KolomUjian ?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Untuk Ujian Saringan Masuk (USM)?</label>
  <div class="col-md-8">
  <?php
      $_usm = ($ruang->UntukUSM == 'Y')? 'checked' : '';
      echo"<input type=checkbox name='UntukUSM' value='Y' $_usm>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-8">
    <textarea name="Keterangan" class="form-control form-control-sm" value="<?php echo $ruang->Keterangan ?>"><?php echo $ruang->Keterangan ?></textarea>
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">NA (Tidak Aktif) ?</label>
  <div class="col-md-8">
  <?php
      $NA = ($ruang->NA == 'Y')? 'checked' : '';
      echo"<input type=checkbox name='NA' value='Y' $NA>";
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

