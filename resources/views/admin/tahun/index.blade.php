
<div class="row">

<div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/tahun/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">
  <a href="{{ asset('admin/tahun/tambah/'.$prodiplh.'/'.$programplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
  </div>
<div class="input-group mb-3 col-md-8">
<?php
echo"<select class='form-control form-control-sm' name='prodi'> 
<option value='0' selected>- Pilih Prodi -</option>"; 
foreach ($prodi as $a){
  if ($prodiplh == $a->ProdiID){
	echo "<option value='$a->ProdiID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->ProdiID'>$a->Nama</option>";
  }
}
echo "</select>";


echo"<select class='form-control form-control-sm' name='program'> 
<option value='0' selected>- Pilih Prodi -</option>"; 
foreach ($program as $a){
  if ($programplh == $a->ProgramID){
	echo "<option value='$a->ProgramID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->ProgramID'>$a->Nama</option>";
  }
}
echo "</select>";
?>


<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table  class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="2%">No</th>
        <th width="5%">Tahun</th>
       
        <th width="10%">KRS</th>
        <th width="10%">KRS Online</th>
        <th width="10%">Ubah KRS</th>
        <th width="10%">Masa Bayar</th>
        <th width="10%">Masa Kuliah</th>
        <th width="10%">Masa UTS	</th>
        <th width="10%" style='text-align:center'>Masa UAS</th>
        <th width="10%">Penilaian</th>
        <th width="10%">Akhir KSS</th>
        <th width="5%">Buka</th>
        <th width="10%">NA</th>
    </tr>
</thead>
<tbody>
<?php 
    $i=0;     
    foreach($tahun as $tahun) {
    $i++;
    if ($tahun->NA=='N'){
      $c="style=color:green";
    } else{
        $c="style=color:black";
    }
?>
  <tr <?php echo $c ?>>   
    <td><?php echo $i ?></td>
    <td><a href="{{ asset('admin/tahun/edit/'.$tahun->TahunID.'/'.$prodiplh.'/'.$programplh) }}"><?php echo $tahun->TahunID ?></a></td>
    
    <td><?php echo date('d-m-Y', strtotime($tahun->TglKRSMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglKRSSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglKRSOnlineMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglKRSOnlineSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglUbahKRSMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglUbahKRSSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglBayarMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglBayarSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglKuliahMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglKuliahSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglUTSMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglUTSSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglUASMulai)) ?><br><?php echo date('d-m-Y', strtotime($tahun->TglUASSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglNilai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($tahun->TglAkhirKSS)) ?></td>
    <td><a href="{{ asset('admin/tahun/buka/'.$tahun->TahunID.'/'.$tahun->ProdiID.'/'.$tahun->ProgramID) }}">Buka</a></td>
    <td><?php echo $tahun->NA ?></td>
  </tr>
  <?php  
  }
  ?>
</tbody>
</table>
</div>


</form>
