@include('admin/mahasiswa/tabmahasiswa')


<?php 
echo "<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA AKADEMIK</b></h3>
</div>";
?>

<form action="{{ asset('admin/mahasiswa/simpaneditakademik/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end
echo"<table class='table table-sm table-borderless'>
<tbody>
<tr><td>&nbsp;</td></tr>
<input type='hidden' name='id' value='$detailmhs->MhswID'>

<tr><th scope='row' width='220px'>Program Studi</th>          
<td><select class='form-control form-control-sm' name='program' readonly=''> 
<option value='0' selected>- Pilih Program -</option>"; 
foreach ($program as $a){
  if ($detailmhs->ProgramID == $a->ProgramID){
	   echo "<option value='$a->ProgramID' selected>$a->Nama</option>";
  }else{
	   echo "<option value='$a->ProgramID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Program Studi</th>          
<td><select class='form-control form-control-sm' name='prodi' readonly=''> 
<option value='0' selected>- Pilih Prodi -</option>"; 
foreach ($prodi as $a){
  if ($detailmhs->ProdiID == $a->ProdiID){
	echo "<option value='$a->ProdiID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->ProdiID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Status Awal</th>          
<td><select class='form-control form-control-sm' name='StatusAwalID'> 
<option value='0' selected>- Pilih Status Awal -</option>"; 
foreach ($statusawal as $a){
  if ($detailmhs->StatusAwalID == $a->StatusAwalID){
	echo "<option value='$a->StatusAwalID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->StatusAwalID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Status Mahasiswa</th>          
<td><select class='form-control form-control-sm' name='StatusMhswID'> 
<option value='0' selected>- Pilih Status Mahasiswa -</option>"; 
foreach ($statusmhs as $a){
  if ($detailmhs->StatusMhswID == $a->StatusMhswID){
	echo "<option value='$a->StatusMhswID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->StatusMhswID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Penasehat Akademik</th>          
<td><select class='form-control form-control-sm' name='PenasehatAkademik'> 
<option value='0' selected>- Pilih Penasehat Akademik -</option>"; 
//PenasehatAkadeik(mhsw) dan Login(dosen)
foreach ($dosen as $a){
  if ($detailmhs->PenasehatAkademik == $a->Login){
	echo "<option value='$a->Login' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->Login'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th  scope='row'>Batas Studi</th>    <td><input type='text' class='form-control form-control-sm' name='BatasStudi' value='$detailmhs->BatasStudi'></td></tr>

</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<br>
<table class='table table-sm table-borderless'>
<tr><th scope='row'>Foto</th>    <td><input type='text' name='Foto' class='form-control form-control-sm' placeholder='Upload gambar' value='$detailmhs->Nama'></td></tr>
<tr><th scope='row'></th>
<td>"; ?>
    <?php if($detailmhs->Foto!="") { ?>
      <img src="{{ asset('assets/upload/mahasiswa/thumbs/'.$detailmhs->Foto) }}" class="img img-thumbnail img-responsive" >
      <?php }else{ ?>
      <img src="{{ asset('assets/upload/mahasiswa/20190308163048-blank.png') }}" class="img img-thumbnail img-responsive" >
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
<a href="{{ asset('admin/mahasiswa') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";
?>