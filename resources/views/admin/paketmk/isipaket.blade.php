

<form action="{{ asset('admin/paketmk/isipaket_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="MKPaketID" value="<?php echo $paketmk->MKPaketID ?>">
<input type="hidden" name="KurikulumID" value="<?php echo $kurikulumplh ?>">
<input type="hidden" name="ProdiID" value="<?php echo $prodiplh ?>">

<div class="row form-group">
  <label class="col-md-2">Paket</label>
  <div class="col-md-8">
    <?php echo $paketmk->Nama?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Program Studi</label>
  <div class="col-md-8">
    <?php echo $paketmk->NamaProdi?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Kurikulum</label>
  <div class="col-md-8">
        <?php echo $paketmk->NamaKur?>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-2">Tambah MK</label>
  <div class="col-md-8">
  <select name="MKID" class="form-control form-control-sm select2">
      <?php 
      foreach($matakuliah as $matakuliah) {
        echo"<option value='$matakuliah->MKID'>$matakuliah->MKKode - $matakuliah->Nama </option>";
      } 
      ?>
  </select>
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

<div class="table-responsive mailbox-messages">
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%">No</th>
        <th width="8%">Kode</th>
        <th width="35%">Matakuliah</th>
        <th width="10%%">SKS</th>
        <th width="5%" style="text-align:center">Aksi</th>
     
    </tr>
</thead>
<tbody>
  <?php 					
      $i=0;   
      $matakuliah = DB::table('mkpaketisi')
      ->join('mkpaket', 'mkpaket.MKPaketID', '=', 'mkpaketisi.MKPaketID')
      ->join('mk', 'mk.MKID', '=', 'mkpaketisi.MKID')
      ->join('kurikulum', 'kurikulum.KurikulumID', '=', 'mkpaketisi.KurikulumID')
      ->select('mkpaketisi.*', 'kurikulum.Nama as NamaKurikulum','mk.Nama as NamaMK','mk.MKKode','mk.SKS')
      ->where('mkpaket.MKPaketID',$paketmk->MKPaketID)
      ->get();  
      foreach($matakuliah as $row) {
      $i++;
  ?>
  <tr style='font-size:15px;'>
    <td><?php echo $i ?></td>
    <td><?php echo $row->MKKode ?></td>
    <td><?php echo $row->NamaMK ?></td>
    <td><?php echo $row->SKS ?></td>
    <td width="90" style='text-align:center'>
    <a href="{{ asset('admin/paketmk/delete/'.$row->MKPaketIsiID.'/'.$paketmk->MKPaketID.'/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
        <i class="fa fa-trash"></i></a>
    </td>
  </tr>
  
  <?php  
  }
  ?>
</tbody>
</table>

