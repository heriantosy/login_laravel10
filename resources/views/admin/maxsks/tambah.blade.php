

<form action="{{ asset('admin/maxsks/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<div class="row form-group">
  <label class="col-md-2">Dari IP</label>
  <div class="col-md-8">
    <input type="text" name="DariIP" class="form-control form-control-sm" placeholder="DariIP">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Sampai IP</label>
  <div class="col-md-8">
    <input type="text" name="SampaiIP" class="form-control form-control-sm" placeholder="SampaiIP">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Max SKS</label>
  <div class="col-md-8">
    <input type="text" name="SKS" class="form-control form-control-sm" placeholder="MaxSKS">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Tidak Aktif?</label>
  <div class="col-md-8">
  <?php   
      echo"<input type=checkbox name='NA' value='Y'>";
  ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <input type="reset" name="reset" class="btn btn-info btn-sm" value="Reset">
      <a href="{{ asset('admin/maxsks/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

