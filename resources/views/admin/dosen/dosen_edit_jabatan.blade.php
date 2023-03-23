@include('admin/dosen/tabdosen')


<?php 
echo "<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA JABATAN</b></h3>
</div>";
?>

<form action="{{ asset('admin/dosen/simpaneditjabatan/'.$detaildosen->Login) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>
<table class='table table-sm table-borderless'>
<tbody>

<tr><td>&nbsp;</td></tr>
<input type='hidden' name='Login' value='$detaildosen->Login'>

<tr><th scope='row' width='220px'>Tunjangan Ikatan</th>          
<td><select class='form-control form-control-sm' name='IkatanID'> 
<option value='0' selected>- Pilih Tunjangan Ikatan -</option>"; 
foreach ($ikatan as $a){
  if ($detaildosen->IkatanID == $a->IkatanID){
	echo "<option value='$a->IkatanID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->IkatanID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Jabatan Dikti</th>          
<td><select class='form-control form-control-sm' name='JabatanID'> 
<option value='0' selected>- Pilih Jabatan -</option>"; 
foreach ($jabatandikti as $a){
  if ($detaildosen->JabatanDiktiID == $a->JabatanDiktiID){
	echo "<option value='$a->JabatanDiktiID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->JabatanDiktiID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th scope='row' width='220px'>Golongan</th>          
<td><select class='form-control form-control-sm' name='GolonganID'> 
<option value='0' selected>- Pilih Golongan -</option>"; 
foreach ($golongan as $a){
  if ($detaildosen->GolonganID == $a->GolonganID){
	echo "<option value='$a->GolonganID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->GolonganID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>

<tr><th  scope='row'>Tunjangan Ikatan</th>    <td><select class='form-control form-control-sm' name='IkatanID'> 
<option value='0' selected>- Tunjangan Ikatan -</option>"; 
foreach ($ikatan as $a){
  if ($detaildosen->IkatanID == $a->IkatanID){
	echo "<option value='$a->IkatanID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->IkatanID'>$a->Nama</option>";
  }
}
echo "</select></td></tr>
<tr><th  scope='row'>Nama Bank</th>    <td><input type='text' class='form-control form-control-sm' name='NamaBank' value='$detaildosen->NamaBank'></td></tr>
<tr><th  scope='row'>Nama Akun</th>    <td><input type='text' class='form-control form-control-sm' name='NamaAkun' value='$detaildosen->NamaAkun'></td></tr>
<tr><th  scope='row'>Nomer Akun</th>    <td><input type='text' class='form-control form-control-sm' name='NomerAkun' value='$detaildosen->NomerAkun'></td></tr>
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