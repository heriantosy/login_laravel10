

<form action="{{ asset('admin/paketmk/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<div class="row form-group">
  <label class="col-md-2">Program Studi</label>
  <div class="col-md-8">
      <?php 
      $namaprodi = DB::table('prodi')->where('ProdiID',$prodiplh)->first();
      echo $namaprodi->Nama 
      ?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Nama Paket</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Paket">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Kurikulum</label>
  <div class="col-md-8">
  <select name="KurikulumID" class="form-control form-control-sm select2">
    <?php 
    foreach($kurikulum as $kurikulum) {
      echo"<option value='$kurikulum->KurikulumID'>$kurikulum->KurikulumKode - $kurikulum->Nama </option>";
    } 
    ?>
  </select>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Deskripsi</label>
  <div class="col-md-8">
    <input type="text" name="Deskripsi" class="form-control form-control-sm" placeholder="Deskripsi">
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
      <a href="{{ asset('admin/paketmk/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

