
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
<form action="{{ asset('admin/skripsipro/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
    <?php echo $jadwal->Judul ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Pembimbing 1</label>
  <div class="col-md-8">
    <?php echo $pembimbing1->Nama ?>, <?php echo $pembimbing1->Gelar ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Pembimbing 2</label>
  <div class="col-md-8">
  <?php echo $pembimbing2->Nama ?>, <?php echo $pembimbing2->Gelar ?>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-right">Penguji 1</label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm' name='PengujiPro1'> 
    <option value='0' selected>- Pilih Penguji 1 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->PengujiPro1 == $a->Login){
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
    echo"<select class='form-control form-control-sm' name='PengujiPro2'> 
    <option value='0' selected>- Pilih Penguji 2 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->PengujiPro2 == $a->Login){
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
    echo"<select class='form-control form-control-sm' name='PengujiPro3'> 
    <option value='0' selected>- Pilih Penguji 2 -</option>"; 
    foreach ($dosen as $a){
      if ($jadwal->PengujiPro3 == $a->Login){
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
<label class="col-sm-4 control-label text-right">Sidang Proposal Skripsi</label>
  <div class="col-md-8">
    <input type="text" name="TglUjianProposal" class="form-control form-control-sm tanggal" value="<?php echo date('d-m-Y',strtotime($jadwal->TglUjianProposal)) ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Mulai</label>
  <div class="col-md-8">
    <input type="text" name="JamMulaiProSkripsi" class="form-control form-control-sm" placeholder="JamMulaiProSkripsi" required="required" value="<?php echo $jadwal->JamMulaiProSkripsi ?>">
  </div>
</div>

<div class="row form-group">
<label class="col-sm-4 control-label text-right">Jam Selesai</label>
  <div class="col-md-8">
    <input type="text" name="JamSelesaiProSkripsi" class="form-control form-control-sm" placeholder="JamSelesaiProSkripsi" required="required" value="<?php echo $jadwal->JamSelesaiProSkripsi ?>">
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
