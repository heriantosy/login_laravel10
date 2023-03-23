<div class="col-md-8">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ asset('admin/nilaieditmhs/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="KRSID" value="{{ $krs->KRSID }}">
<input type='hidden' name='MhswID' value="{{ $MhswIDplh }}">
<input type='hidden' name='TahunID' value="{{ $tahunplh }}">
<input type='hidden' name='GradeLama' value="{{ $krs->GradeNilai }}">
<input type='hidden' name='GradeNilai' value="{{ $krs->GradeNilai }}">
<p class="alert alert-info">
  <i class="fa fa-user"></i> Isi data Anda dengan lengkap dan benar.
</p>

<div class="form-group row">
  <label class="col-sm-2 control-label text-left">Matakuliah </label>
  <div class="col-md-8">
    <?php
    echo"<select class='form-control form-control-sm select2' name='MKID'> 
    <option value='0' selected>- Pilih Matakuliah -</option>"; 
    foreach ($matakuliah as $a){
      if ($krs->MKID == $a->MKID){
         echo "<option value='$a->MKID' selected>$a->Nama</option>";
      }else{
         echo "<option value='$a->MKID'>$a->Nama</option>";
      }
    }
    echo "</select>";
    ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-2 control-label text-left">Nilai Angka</label>
  <div class="col-md-8">
    <input type="text" name="NilaiAkhir" class="form-control" placeholder="NilaiAkhir" value="<?php echo $krs->NilaiAkhir ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-left"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <a href="{{ asset('admin/nilaieditmhs/filter/'.$tahunplh.'/'.$MhswIDplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>

</div>