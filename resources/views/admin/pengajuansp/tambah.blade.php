<div class="row">
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
<form action="{{ asset('admin/pengajuansp/tambah_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
 <input type="hidden" name="TahunID" value="<?php echo $tahunplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<p class="alert alert-info">
  <i class="fa fa-user"></i> Semester Pendek
</p>


<div class="form-group row">
  <label class="col-sm-3 control-label text-left">Mahasiswa</label>
  <div class="col-md-8">
    <select name="MhswID" class="form-control form-control-sm select2">
      <?php foreach($mahasiswa as $mahasiswa) { ?>
        <option value="<?php echo $mahasiswa->MhswID ?>"><?php echo $mahasiswa->Nama ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 control-label text-left">Matakuliah</label>
  <div class="col-md-8">
    <select name="MKID" class="form-control form-control-sm select2">
      <?php foreach($matakuliah as $matakuliah) { ?>
        <option value="<?php echo $matakuliah->MKID ?>"><?php echo $matakuliah->Nama ?> - <?php echo $matakuliah->ProdiID ?> - <?php echo $matakuliah->Sesi ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 control-label text-left"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>&nbsp;
      <button type="reset" name="submit" class="btn btn-info btn-sm" value="reset">
        <i class="fa fa-times"></i> Reset
      </button> &nbsp;
      <?php
          $prodix = str_replace('.','',$prodiplh);
      ?>
      <a href="{{ asset('admin/pengajuansp/filter/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-backward"></i> Kembali
      </a>
    </div>
  </div>
</div>
</form>

</div>
</div>