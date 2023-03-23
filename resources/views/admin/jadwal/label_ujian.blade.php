  

<form action="{{ asset('admin/jadwal/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">
  <?php
  ?>
  </div>
  
<div class="input-group mb-3 col-md-8">
<?php
//different way
echo"<select name='tahun' class='form-control form-control-sm' "; 
echo"<option value='0'>Pilih Tahun</option>"; //it should be 
foreach ($tahun as $th){
  if ($tahunplh == $th->TahunID){
	   echo "<option value='$th->TahunID' selected>$th->TahunID</option>";
  }else{
	   echo "<option value='$th->TahunID'>$th->TahunID</option>";
  }
}
echo "</select>";
?>

<select name="prodi" class="form-control form-control-sm ">
<?php 
 $prodiplhok = str_replace(".","",$prodiplh);
foreach($prodi as $prodi) { ?>
  <option value="<?php echo $prodi->ProdiID ?>" 
    <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
          elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
          elseif($prodiplhok==$prodi->ProdiID) { echo 'selected'; } ?>>
    <?php echo $prodi->Nama  ?>
  </option>
<?php } ?>
</select>


<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white;height:5px;'>
    <tr>
    <th>No</th>                        				
    <th>Nama Hari</th>
    <th>Aksi</th>     
    </tr>
</thead>
<tbody>
    <?php 				
    $hari=DB::table('hari')
    ->whereNotIn('HariID',[0])	
    ->orderBy('HariID')
    ->get();
    $no=0;
    foreach($hari as $row) {
    $no++;
    ?>

    <tr style='font-size:15px;'>
    <tr>
    <td><?php echo $no ?></td>
    <td><?php echo $row->Nama ?></td>
    <td>
    <a href="{{ asset('admin/jadwal/labelujian/cetaklbluts/'.$tahunplh.'/'.$prodiplh.'/'.$row->HariID) }}" target="_BLANK"> Cetak Label UTS</a> | 
    <a href="{{ asset('admin/jadwal/labelujian/cetaklbluas/'.$tahunplh.'/'.$prodiplh.'/'.$row->HariID) }}" target="_BLANK"> Cetak Label UAS</a>
    </td> 
    </tr>
    <?php 
     }
    ?>
</tbody>
</table>
</div>

