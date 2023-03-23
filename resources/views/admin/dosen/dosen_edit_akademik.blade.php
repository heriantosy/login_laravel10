@include('admin/dosen/tabdosen')


<?php 
echo "<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA AKADEMIK</b></h3>
</div>";
?>

<form action="{{ asset('admin/dosen/simpaneditakademik/'.$detaildosen->Login) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end
echo"<table class='table table-sm table-borderless'>
<tbody>
<tr><td>&nbsp;</td></tr>
<input type='hidden' name='Login' value='$detaildosen->Login'>";
?>
<tr>
<th scope='row' width='220px'>Mulai Bekerja</th> 
<th scope='row'>
<input type="text" class="form-control form-control-sm tanggal" style='width:140px; text-align:center; padding:0px' maxlength='10'  class="form-control form-control-sm" name="TglBekerja" value="<?php echo date('d-m-Y');  ?>">
</th>
</tr>
<?php
echo"<tr><th scope='row' width='220px'>Status Kerja</th>          
<td><select class='form-control form-control-sm' name='StatusKerjaID'> 
<option value='0' selected>- Pilih Status Kerja -</option>"; 
foreach ($statuskerja as $a){
  if ($detaildosen->StatusKerjaID == $a->StatusKerjaID){
	echo "<option value='$a->StatusKerjaID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->StatusKerjaID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Status Dosen</th>          
<td><select class='form-control form-control-sm' name='StatusDosenID'> 
<option value='0' selected>- Pilih Status Dosen -</option>"; 
foreach ($statusdosen as $a){
  if ($detaildosen->StatusDosenID == $a->StatusDosenID){
	echo "<option value='$a->StatusDosenID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->StatusDosenID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Prodi Homabase</th>          
<td><select class='form-control form-control-sm' name='Homebase'> 
<option value='0' selected>- Pilih Prodi -</option>"; 
foreach ($prodi as $a){
  if ($detaildosen->Homebase == $a->ProdiID){
	echo "<option value='$a->ProdiID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->ProdiID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>



<tr><th  scope='row'>Kode Instansi Induk</th>    <td><input type='text' class='form-control form-control-sm' name='InstitusiInduk' value='$detaildosen->InstitusiInduk'></td></tr>
<tr><th  scope='row'>Lulus Perguruan Tinggi</th>    <td><input type='text' class='form-control form-control-sm' name='InstitusiInduk' value='$detaildosen->InstitusiInduk'></td></tr>
<tr><th  scope='row'>Jenjang Pendidikan Tinggi</th>    <td><select class='form-control form-control-sm' name='Homebase'> 
<option value='0' selected>- Jenjang Pendidikan -</option>"; 
foreach ($jenjang as $a){
  if ($detaildosen->JenjangID == $a->JenjangID){
	echo "<option value='$a->JenjangID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->JenjangID'>$a->Nama</option>";
  }
}
echo "</select></td></tr>
<tr><th  scope='row'>Keilmuan</th>    <td><input type='text' class='form-control form-control-sm' name='Keilmuan' value='$detaildosen->Keilmuan'></td></tr>
</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<br>
<table class='table table-sm table-borderless'>
<tr><th scope='row'>Foto</th>    <td><input type='text' name='Foto' class='form-control form-control-sm' placeholder='Upload gambar' value='$detaildosen->Nama'></td></tr>
<tr><th scope='row'></th>
<td>"; ?>
    <?php if($detaildosen->FotoBro!="") { ?>
      <img src="{{ asset('assets/upload/dosen/thumbs/'.$detaildosen->FotoBro) }}" class="img img-thumbnail img-responsive" >
      <?php }else{ ?>
      <img src="{{ asset('assets/upload/dosen/20190308163048-blank.png') }}" class="img img-thumbnail img-responsive" >
      <?php } ?>
    </td>
<tr>    
<?php

echo"</tbody>
</table>";

//tutup kolom 2
echo"</div>";

?>
<?php
echo"
<div class='card-footer'>
<button type='submit' name='submit' class='btn btn-info btn-sm'>Update</button>&nbsp;";?>
<a href="{{ asset('admin/dosen') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";
?>