
<?php if($cuti) { ?>  
<div class="row">
<div class="col-md-5">
   
</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/pengajuancuti/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-4">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-8" >
<?php
echo"<select name='noreg' class='form-control form-control-sm'>";
echo "<option value=''>Pilih Pegawai</option>";
foreach ($pegawai as $w){  
    if ($noregplh == $w->Noreg){
      echo "<option value='$w->Noreg' selected>$w->Noreg - $w->Nama</option>";
    }else{
      echo "<option value='$w->Noreg'>$w->Noreg - $w->Nama</option>";
    }
}          
echo"</select>";

?>

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr style="background:black;color:white">
    <th style='2%'>No</th>                       
    <th style='35%'>Pegawai</th>
    <th style='20%'>Tgl Pengajuan</th> 			
    <th style='15%'>Jenis Cuti</th> 
    <th style='20%'>Pengganti</th> 
    <th style='15%'>Masa Cuti</th>
    <th style='15%'>Keberadaan</th>	
    <th style='10%'>Status</th>	
    <th style='20%'>Action</th>           
      </tr>
</thead>
<tbody>
<?php 					

$i=0;     
foreach($cuti as $cuti) {
  $i++;
  $Namax = strtolower($cuti->Nama);
  $Nama	= ucwords($Namax);

?>

  <tr>
   
    <td><?php echo $i ?></td>
    <td><?php echo $cuti->Nama ?><br><?php echo $cuti->Gelar ?></td>
    <td><?php echo $cuti->TanggalInput ?></td>
    <td><?php echo $cuti->JenisCuti ?></td>
    <td><?php echo $cuti->Nama ?><br><?php echo $cuti->Gelar ?></td>
    <td><?php echo $cuti->TanggalMulai ?> s/d <?php echo $cuti->TanggalSelesai ?></td>
    <td><?php echo $cuti->Keberadaan ?></td>
    <td><?php echo $cuti->Status ?></td>
    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/cuti/editfotomhs/'.$cuti->IDCuti) }}" ><i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/cuti/cetak/'.$cuti->IDCuti) }}"  target="_blank"><i class="fa fa-print"></i></a>&nbsp;
        <a href="{{ asset('admin/cuti/delete/'.$cuti->IDCuti) }} " onclick="return confirm('Yakin data akan dihapus ?')"><i class="fas fa-trash-alt"></i></a>&nbsp;
      </div>
    </td>
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>