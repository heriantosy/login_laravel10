
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php
 $pembimbing1 = DB::table('dosen')->where('Login',$jadwal->DosenID)->first();
?>
<form action="{{ asset('admin/kerjapraktekpro/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="JadwalID" value="{{ $jadwal->JadwalID }}">
<input type="hidden" name="tahun" value="{{ $tahunplh }}">
<input type="hidden" name="prodi" value="{{ $prodiplh }}">
<p class="alert alert-info">
  <i class="fa fa-user"></i> Isi data Anda dengan lengkap dan benar.
</p>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Mahasiswa</label>
  <div class="col-md-8">
    <?php echo $jadwal->MhswID ?> - <?php echo $jadwal->NamaMhs ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Judul Kerja Praktek <span class="text-danger">*</span></label>
  <div class="col-sm-8">
  <textarea name="Judul" rows="4" class="form-control form-control-sm" placeholder="Judul Kerja Praktek" value="<?php echo $jadwal->Judul?>"><?php echo $jadwal->Judul?></textarea>
  </div>
</div>



<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='DosenID'> 
    <option value='0' selected>- Pilih Pembimbing -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->DosenID == $a->Login){
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
  <label class="col-sm-4 control-label text-right">Penguji 1</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='Penguji1'> 
    <option value='0' selected>- Pilih Penguji 1 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->Penguji1 == $a->Login){
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
  <label class="col-sm-4 control-label text-right">Penguji 2</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='Penguji2'> 
    <option value='0' selected>- Pilih Penguji 2 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->Penguji2 == $a->Login){
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
  <label class="col-sm-4 control-label text-right">Penguji 3</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='Penguji3'> 
    <option value='0' selected>- Pilih Penguji 2 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->Penguji3 == $a->Login){
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
  <label class="col-sm-4 control-label text-right">Tempat Ujian</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='TempatUjian'> 
    <option value='0' selected>- Pilih Ruang -</option>"; 
    foreach ($ruang as $a){
      if ($jadwal->TempatUjian == $a->RuangID){
         echo "<option value='$a->RuangID' selected>$a->Nama</option>";
      }else{
         echo "<option value='$a->RuangID'>$a->Nama</option>";
      }
    }
    echo "</select>";
    ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Sidang Proposal KP</label>
  <div class="col-md-8">
    <input type="text" name="TglMulaiSidang" class="form-control form-control-sm tanggal" value="<?php echo date('d-m-Y',strtotime($jadwal->TglMulaiSidang)) ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Mulai</label>
  <div class="col-md-8">
    <input type="text" name="JamMulai" class="form-control form-control-sm" placeholder="JamMulai" required="required" value="<?php echo $jadwal->JamMulai ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Selesai</label>
  <div class="col-md-8">
    <input type="text" name="JamSelesai" class="form-control form-control-sm" placeholder="JamSelesai" required="required" value="<?php echo $jadwal->JamSelesai ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <a href="{{ asset('admin/kerjapraktekpro') }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
