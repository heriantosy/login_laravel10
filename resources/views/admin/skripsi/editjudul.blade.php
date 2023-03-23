
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
 $pembimbing1 = DB::table('dosen')->where('Login',$jadwal->PembimbingPro1)->first();
 $pembimbing2 = DB::table('dosen')->where('Login',$jadwal->PembimbingPro2)->first();
?>
<form action="{{ asset('admin/skripsipro/editjudul_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Judul</label>
  <div class="col-md-8">
  <input type="text" name="Judul" class="form-control form-control-sm" value="<?php echo $jadwal->Judul ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Tempat Penelitian</label>
  <div class="col-md-8">
  <input type="text" name="TempatPenelitian" class="form-control form-control-sm" value="<?php echo $jadwal->TempatPenelitian ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Kab/Kota</label>
  <div class="col-md-8">
  <input type="text" name="Kota" class="form-control form-control-sm" value="<?php echo $jadwal->Kota ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">To (Untuk Surat Pengantar)</label>
  <div class="col-md-8">
  <input type="text" name="Ke" class="form-control form-control-sm" value="<?php echo $jadwal->Ke ?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-user"></i> Pembimbing Proposal / Skripsi
</p>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Pembimbing 1</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='PembimbingPro1'> 
    <option value='0' selected>- Pilih Pembimbing 1 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->PembimbingPro1 == $a->Login){
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
  <label class="col-sm-4 control-label text-right">Pembimbing 2</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='PembimbingPro2'> 
    <option value='0' selected>- Pilih Pembimbing 2 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->PembimbingPro2 == $a->Login){
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
  <label class="col-sm-4 control-label text-right"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <a href="{{ asset('admin/skripsipro') }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>
