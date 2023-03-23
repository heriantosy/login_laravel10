<p class="text-right">
  <a href="{{ asset('admin/transkrip/cetaktranskrip_v/'.$MhswIDplh) }}" target="_BLANK" class="btn btn-success btn-sm">
    <i class="fa fa-print"></i> Cetak Transkrip
  </a>
  <a href="{{ asset('admin/transkrip/cetaktranskrip_p/'.$MhswIDplh) }}" target="_BLANK" class="btn btn-success btn-sm">
    <i class="fa fa-print"></i> Cetak Transkrip PDF
  </a>
</p>
<hr>

<?php if($transkrip) { ?>  
<form action="{{ asset('admin/transkrip/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-8">
  </div>
<div class="input-group mb-3 col-md-4">


<input type="text" class="form-control form-control-sm" name="MhswID" value="<?php echo $MhswIDplh ?>" placeholder="Cari..." required>

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%" style='text-align:center'>No</th>
        <th width="8%" style='text-align:left'>Kode</th>
        <th width="60%">Matakuliah</th>
        <th width="10%" style='text-align:center'>SKS</th>
        <th width="10%%" style='text-align:center'>Huruf</th>
        <th width="10%" style='text-align:center'>Bobot</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php 
    $no =0;
    $ips =0;
    $totalSKS   = 0;
    $totalMutu  = 0; 
    foreach($transkrip as $row) {
      $no++;
      $Mutu       = $row->SKS * $row->BobotNilai; //misal Nilai A Bobot 4 * SKS 3 =12
      $totalSKS  += $row->SKS;
      $totalMutu += ($row->BobotNilai * $row->SKS);
      $ips  = number_format($totalMutu / $totalSKS,2);
      if ($ips >= 3.00) {
        $YAD=24;
        }
      if ($ips < 3.00) {
        $YAD=21;
        }
      if ($ips <= 2.49) {
        $YAD=18;
        }
      if ($ips <= 1.99) {
        $YAD=15;
        }
      if ($ips <= 1.4) {
        $YAD=12;
        }
  ?>

  <tr style='font-size:15px;'>
    <td style='text-align:center'><?php echo $no ?></td>
    <td style='text-align:center'><?php echo $row->MKKode ?></td>
    <td><?php echo $row->Nama ?></td>
    <td style='text-align:center'><?php echo $row->SKS ?></td>
    <td style='text-align:center'><?php echo $row->GradeNilai ?></td>
    <td style='text-align:center'><?php echo $row->BobotNilai ?></td>
    <td> 
      <div class="btn-group">
      <a href="{{ asset('admin/Khsadm/edit/'.$row->KRSID.'/'.$MhswIDplh) }}"><i class="fa fa-edit"></i></a>&nbsp;
      <a href="{{ asset('admin/Khsadm/cetak/'.$row->KRSID) }}" target="_blank"><i class="fa fa-print"></i></a>&nbsp;
      <a href="{{ asset('admin/Khsadm/delete/'.$row->KRSID) }}"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
  </tr>
  <?php  }//End looping?>
</tbody>
<tr><td></td></tr>
<tr><td colspan='2'><b>Total SKS</b> </td><td><b>: <?php echo $totalSKS ?> SKS </b></td><td colspan='4'></td></tr>
<tr><td colspan='2'><b>Total Mutu </b></td><td><b>: <?php echo $totalMutu ?></b></td><td colspan='4'></td></tr>
<tr><td colspan='2'><b>IPS </b></td><td><b>: <?php echo $ips ?></b></td><td colspan='4'></td></tr>
</table>

</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>