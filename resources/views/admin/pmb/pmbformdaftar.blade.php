
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pmb/pmbformdaftarsimpan') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}"> 
<input type='hidden' name='ProgramID' value="<?php echo $formulirx->ProgramID ?>">
<input type='hidden' name='ProdiID' value="<?php echo $formulirx->Keterangan ?>">
<input type='hidden' name='PMBPeriodID' value="<?php echo $pmbformjual->PMBPeriodID ?>">
<input type='hidden' name='PMBFormulirID' value="<?php echo $pmbformjual->PMBFormulirID ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Tambah Formulir PMB
</p>
<div class="row form-group">
  <label class="col-md-3">No PMB</label>
  <div class="col-md-9">
    <input type="text" name="PMBID" class="form-control form-control-sm" placeholder="No PMB" required="required" value="<?php echo $NewID ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Program Studi (Program)</label>
  <div class="col-md-9">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="prodist" value="<?php echo $prodist->Nama ?> ( <?php echo $formulirx->Nama ?> ) " readonly="">
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">No Ujian</label>
  <div class="col-md-9">
    <input type="text" name="PMBRef" class="form-control form-control-sm" placeholder="No Ujian" value="<?php echo $NewID ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kwitansi</label>
  <div class="col-md-9">
    <input type="text" name="PMBFormJualID" class="form-control form-control-sm" placeholder="Kwitansi" value="<?php echo $pmbformjual->PMBFormJualID ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama</label>
  <div class="col-md-9">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama" value="<?php echo $pmbformjual->Nama ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Status Awal</label>
 <div class="col-md-3">
 <?php
 echo"<select class='form-control form-control-sm' name='StatusAwalID'> "; 
 foreach ($statusawal as $a){
  // if ($a->ProgramID == $a->ProgramID){
      echo "<option value='$a->StatusAwalID'>$a->Nama</option>";
  //  }else{
  //     echo "<option value='$a->ProgramID'>$a->Nama</option>";
  //  }
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Jenis Kelamin</label>
 <div class="col-md-3">
 <?php
 echo"<select class='form-control form-control-sm' name='Kelamin'> "; 
 foreach ($kelamin as $a){
  // if ($a->ProgramID == $a->ProgramID){
      echo "<option value='$a->Kelamin'>$a->Nama</option>";
  //  }else{
  //     echo "<option value='$a->ProgramID'>$a->Nama</option>";
  //  }
 }
 echo "</select>";
 ?>
</div>
</div>



<div class="row form-group">
  <label class="col-md-3">NIK</label>
  <div class="col-md-9">
    <input type="text" name="NIK" class="form-control form-control-sm" placeholder="NIK">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tempat Lahir</label>
  <div class="col-md-9">
    <input type="text" name="TempatLahir" class="form-control form-control-sm" placeholder="Tempat Lahir">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tanggal Lahir</label>
  <div class="col-md-9">
    <input type="text" name="TanggalLahir" class="form-control tanggal form-control-sm" placeholder="Tanggal Lahir">
  </div>
</div>



<p class="alert alert-info">
  <i class="fa fa-book"></i> Pilihan Program Studi
</p>

<div class="row form-group">
  <label class="col-md-3">Program</label>
  <div class="col-md-9">
    <input type="text" name="ProgramID" class="form-control form-control-sm" placeholder="Program" value="<?php echo $formulirx->ProgramID ?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pililhan 1</label>
  <div class="col-md-9">
    <input type="text" name="Pilihan1" class="form-control form-control-sm" placeholder="Pilihan 1" value="<?php echo $formulirx->Keterangan ?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Pilihan 2</label>
  <div class="col-md-9">
    <input type="text" name="Pilihan2" class="form-control form-control-sm" placeholder="Pilihan 2">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-edit"></i> Data Pribadi (Sesuai KTP)
</p>
<div class="row form-group">
  <label class="col-md-3">Warga Negara</label>
  <div class="col-md-9">
    <input type="text" name="WargaNegara" class="form-control form-control-sm" placeholder="Warga Negara">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kebangsaan</label>
  <div class="col-md-9">
    <input type="text" name="Kebangsaan" class="form-control form-control-sm" placeholder="Kebangsaan">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Agama</label>
 <div class="col-md-3">
 <?php
 echo"<select class='form-control form-control-sm' name='Agama'> "; 
 foreach ($agama as $a){
    echo "<option value='$a->Agama'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Status Sipil</label>
 <div class="col-md-3">
 <?php
 echo"<select class='form-control form-control-sm' name='StatusSipil'> "; 
 foreach ($statussipil as $a){
    echo "<option value='$a->StatusSipil'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Alamat Tinggal</label>
  <div class="col-md-9">
    <input type="text" name="Alamat" class="form-control form-control-sm" placeholder="Alamat">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kota / Kabupaten</label>
  <div class="col-md-9">
    <input type="text" name="Kota" class="form-control form-control-sm" placeholder="Kota">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">RT</label>
  <div class="col-md-9">
    <input type="text" name="RT" class="form-control form-control-sm" placeholder="RT">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">RW</label>
  <div class="col-md-9">
    <input type="text" name="RW" class="form-control form-control-sm" placeholder="RW">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kelurahan</label>
  <div class="col-md-9">
    <input type="text" name="Kelurahan" class="form-control form-control-sm" placeholder="Kelurahan">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kecamatan</label>
  <div class="col-md-9">
    <input type="text" name="Kecamatan" class="form-control form-control-sm" placeholder="Kecamatan">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kode POS</label>
  <div class="col-md-9">
    <input type="text" name="KodePOS" class="form-control form-control-sm" placeholder="KodePOS">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Propinsi</label>
  <div class="col-md-9">
    <input type="text" name="Propinsi" class="form-control form-control-sm" placeholder="Propinsi">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Negara</label>
  <div class="col-md-9">
    <input type="text" name="Negara" class="form-control form-control-sm" placeholder="Negara">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Telepon</label>
  <div class="col-md-9">
    <input type="text" name="Telepon" class="form-control form-control-sm" placeholder="Telepon">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Handphone</label>
  <div class="col-md-9">
    <input type="text" name="Handphone" class="form-control form-control-sm" placeholder="Handphone">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Email</label>
  <div class="col-md-9">
    <input type="text" name="Email" class="form-control form-control-sm" placeholder="Email">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book"></i> Asal Sekolah
</p>

<div class="row form-group">
  <label class="col-md-3">Asal Sekolah</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='AsalSekolah'> "; 
 foreach ($asalsekolah as $a){
    echo "<option value='$a->SekolahID'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Jurusan</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='JurusanSekolah'> "; 
 foreach ($jurusansekolah as $a){
    echo "<option value='$a->JurusanSekolahID'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tahun Lulus</label>
  <div class="col-md-9">
    <input type="text" name="TahunLulus" class="form-control form-control-sm" placeholder="Tahun Lulus">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nilai Kelulusan</label>
  <div class="col-md-9">
    <input type="text" name="NilaiSekolah" class="form-control form-control-sm" placeholder="Nilai Sekolah">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book"></i> Asal Perguruan Tinggi
</p>


<div class="row form-group">
  <label class="col-md-3">Asal Perguruan Tinggi</label>
  <div class="col-md-9">
    <input type="text" name="AsalPT" class="form-control form-control-sm" placeholder="Asal Perguruan Tinggi">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Dari Program Studi</label>
  <div class="col-md-9">
    <input type="text" name="ProdiAsalPT" class="form-control form-control-sm" placeholder="Dari Program Studi">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Telah Lulus dr PT ini?</label>
  <div class="col-md-9">
    <input type="text" name="TglLulusAsalPT" class="form-control form-control-sm" placeholder="Jika ya, maka lulus tanggal ?">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book"></i> Alamat Tinggal Pekanbaru
</p>
<div class="row form-group">
  <label class="col-md-3">Alamat</label>
  <div class="col-md-9">
    <input type="text" name="Alamatx" class="form-control form-control-sm" placeholder="Alamat">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">Kota</label>
  <div class="col-md-9">
    <input type="text" name="Kotax" class="form-control form-control-sm" placeholder="Kotax">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">RT/RW</label>
  <div class="col-md-9">
    <input type="text" name="RTx" class="form-control form-control-sm" placeholder="RT">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">Telepon</label>
  <div class="col-md-9">
    <input type="text" name="Teleponx" class="form-control form-control-sm" placeholder="Telepon">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">Kode POS</label>
  <div class="col-md-9">
    <input type="text" name="KodePOSx" class="form-control form-control-sm" placeholder="Kode POS">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">Propinsi</label>
  <div class="col-md-9">
    <input type="text" name="Propinsix" class="form-control form-control-sm" placeholder="Propinsix">
  </div>
</div>
<div class="row form-group">
  <label class="col-md-3">Negara</label>
  <div class="col-md-9">
    <input type="text" name="Negarax" class="form-control form-control-sm" placeholder="Negara">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book"></i> Data Orang Tua
</p>
<div class="row form-group">
  <label class="col-md-3">Nama Ayah</label>
  <div class="col-md-9">
    <input type="text" name="NamaAyah" class="form-control form-control-sm" placeholder="Nama Ayah">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Agama Ayah</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='AgamaAyah'> "; 
 foreach ($agama as $a){
    echo "<option value='$a->Agama'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pendidikan Ayah</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='PendidikanAyah'> "; 
 foreach ($pendidikanortu as $a){
    echo "<option value='$a->Pendidikan'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pekerjaan Ayah</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='PekerjaanAyah'> "; 
 foreach ($pekerjaanortu as $a){
    echo "<option value='$a->Pekerjaan'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Status Ayah</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='HidupAyah'> "; 
 foreach ($hidup as $a){
    echo "<option value='$a->Hidup'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama Ibu</label>
  <div class="col-md-9">
    <input type="text" name="NamaIbu" class="form-control form-control-sm" placeholder="Nama Ibu">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Agama Ibu</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='AgamaIbu'> "; 
 foreach ($agama as $a){
    echo "<option value='$a->Agama'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pendidikan Ibu</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='PendidikanIbu'> "; 
 foreach ($pendidikanortu as $a){
    echo "<option value='$a->Pendidikan'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pekerjaan Ibu</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='PekerjaanIbu'> "; 
 foreach ($pekerjaanortu as $a){
    echo "<option value='$a->Pekerjaan'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<div class="row form-group">
  <label class="col-md-3">Status Ibu</label>
 <div class="col-md-9">
 <?php
 echo"<select class='form-control form-control-sm' name='HidupAyah'> "; 
 foreach ($hidup as $a){
    echo "<option value='$a->Hidup'>$a->Nama</option>";
 }
 echo "</select>";
 ?>
</div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book"></i> Alamat Orang Tua
</p>

<div class="row form-group">
  <label class="col-md-3">Alamat Orang Tua</label>
  <div class="col-md-9">
    <input type="text" name="AlamatOrtu" class="form-control form-control-sm" placeholder="Alamat Orang Tua">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kota</label>
  <div class="col-md-9">
    <input type="text" name="KotaOrtu" class="form-control form-control-sm" placeholder="Kota">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">RT</label>
  <div class="col-md-9">
    <input type="text" name="RTOrtu" class="form-control form-control-sm" placeholder="RT">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">RW</label>
  <div class="col-md-9">
    <input type="text" name="RWOrtu" class="form-control form-control-sm" placeholder="RW">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Kode POS</label>
  <div class="col-md-9">
    <input type="text" name="KodePOSOrtu" class="form-control form-control-sm" placeholder="Kode POS">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Propinsi</label>
  <div class="col-md-9">
    <input type="text" name="PropinsiOrtu" class="form-control form-control-sm" placeholder="Propinsi">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Negara</label>
  <div class="col-md-9">
    <input type="text" name="NegaraOrtu" class="form-control form-control-sm" placeholder="Negara">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Telepon</label>
  <div class="col-md-9">
    <input type="text" name="TeleponOrtu" class="form-control form-control-sm" placeholder="Telepon">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Telepon Bergerak</label>
  <div class="col-md-9">
    <input type="text" name="TeleponOrtu" class="form-control form-control-sm" placeholder="Telepon Bergerak">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Email</label>
  <div class="col-md-9">
    <input type="text" name="EmailOrtu" class="form-control form-control-sm" placeholder="Email">
  </div>
</div>



<div class="row form-group">
  <label class="col-md-3"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/pmb/pmbjualform') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

