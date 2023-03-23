<p class="text-right">
  <a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
</p>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('admin/pmb/setawal_nim_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 {{ csrf_field() }}
<input type="hidden" name="PMBID" value="{{ $pmb->PMBID }}">
<input type="hidden" name="PMBFormJualID" value="{{ $pmb->PMBFormJualID }}">
<input type="hidden" name="PMBFormulirID" value="{{ $pmb->PMBFormulirID }}">
<input type="hidden" name="PMBPeriodID" value="{{ $pmb->PMBPeriodID }}">
<input type="hidden" name="ProdiID" value="{{ $pmb->ProdiID }}">
<p class="alert alert-info">
  <i class="fa fa-user"></i> SET NIM
</p>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">PMBID</label>
  <div class="col-md-6">
   : <?php echo $pmb->PMBID ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">Nama</label>
  <div class="col-md-6">
    : <?php echo $pmb->Nama ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">Tempat dan Tanggal Lahir</label>
  <div class="col-md-6">
  : <?php echo $pmb->TempatLahir ?>, <?php echo date('d-m-Y', strtotime($pmb->TanggalLahir)) ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">Alamat</label>
  <div class="col-md-6">
  : <?php echo $pmb->Alamat ?>
  </div>
</div>


<div class="row form-group">
<label class="col-sm-3 control-label text-left">ProgramID</label>
  <div class="col-md-6">
  : <?php echo $pmb->ProgramID ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">ProdiID</label>
  <div class="col-md-6">
  : <?php echo $pmb->ProdiID ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">Handphone</label>
  <div class="col-md-6">
  : <?php echo $pmb->Handphone ?>
  </div>
</div>


<div class="row form-group">
<label class="col-sm-3 control-label text-left">NIM Terakhir</label>
  <div class="col-md-6">
  : <?php echo $nimterakhir ?>
  </div>
</div>

<div class="row form-group">
<label class="col-sm-3 control-label text-left">NIM</label>
  <div class="col-md-2">
    <input type="text" name="NIM" class="form-control form-control-sm" placeholder="NIM" value="<?php echo $nimgen ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-4 control-label text-left"></label>
  <div class="col-sm-8">
    <div class="btn-group">
      <button type="submit" name="submit" class="btn btn-primary btn-lg btn-sm" value="login">
        <i class="fa fa-save"></i> Simpan
      </button>
      <button type="reset" name="submit" class="btn btn-info btn-lg btn-sm" value="reset">
        <i class="fa fa-times"></i> Reset
      </button>
      <a href="{{ asset('admin/pmb/filter/'.$pmb->PMBPeriodID.'/'.$pmb->ProdiID) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
    </a>
    </div>
  </div>
</div>
</form>
