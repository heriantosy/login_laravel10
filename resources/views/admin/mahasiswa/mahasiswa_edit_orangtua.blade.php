@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA ORANG TUA</b></h3>
</div>";
?>

<form action="{{ asset('admin/mahasiswa/detailortusimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end

echo "<br>
<table class='table table-sm table-borderless'>
<tbody>
<tr><th  scope='row' colspan='2' style=text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;>DATA AYAH</th></tr>
<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th  scope='row'>Nama Ayah</th> <td><input type='text' class='form-control form-control-sm' name='NamaAyah' value='$detailmhs->NamaAyah'></td></tr>
<tr><th scope='row'>Agama Ayah</th>          
<td><select class='form-control form-control-sm' name='AgamaAyah'> 
<option value='0' selected>- Pilih agama -</option>"; 
foreach ($agama as $a){
  //Agama pada tabel agama
  if ($detailmhs->AgamaAyah == $a->Agama){
	echo "<option value='$a->Agama' selected>$a->Agama - $a->Nama</option>";
  }else{
	echo "<option value='$a->Agama'>$a->Agama - $a->Nama</option>";
  }
}
echo "</select></td></tr>  
 
<tr><th scope='row'>Pendidikan Ayah</th>          
<td><select class='form-control form-control-sm' name='PendidikanAyah'> 
<option value='0' selected>- Pilih Pendidikan Ayah -</option>"; 
foreach ($pendidikanortu as $a){
  //Pendidikan pada tabel pendidikanortu
  if ($detailmhs->PendidikanAyah == $a->Pendidikan){
	echo "<option value='$a->Pendidikan' selected>$a->Pendidikan - $a->Nama</option>";
  }else{
	echo "<option value='$a->Pendidikan'>$a->Pendidikan - $a->Nama</option>";
  }
}
echo "</select></td></tr> 
<tr><th scope='row'>Pekerjaan Ayah</th>          
<td><select class='form-control form-control-sm' name='PekerjaanAyah'> 
<option value='0' selected>- Pilih Pekerjaan Ayah -</option>"; 
foreach ($pekerjaanortu as $a){
  if ($detailmhs->PekerjaanAyah == $a->Pekerjaan){
	echo "<option value='$a->Pekerjaan' selected>$a->Pekerjaan - $a->Nama</option>";
  }else{
	echo "<option value='$a->Pekerjaan'>$a->Pekerjaan - $a->Nama</option>";
  }
}
echo "</select></td></tr>  
<tr><th scope='row'>Hidup</th>          
<td><select class='form-control form-control-sm' name='HidupAyah'>";
//Hidup pada tabel master hidup dan Hidup Ayah pada tabel mhsw 
foreach ($hidup as $a){
  if ($detailmhs->HidupAyah == $a->Hidup){
	echo "<option value='$a->Hidup' selected>$a->Hidup - $a->Nama</option>";
  }else{
	echo "<option value='$a->Hidup'>$a->Hidup - $a->Nama</option>";
  }
}
echo "</select></td></tr> 
</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<br><table class='table table-sm table-borderless'>
<tbody>
<tr><th  scope='row' colspan='2' style=text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;>DATA IBU</th></tr>
<tr><th  scope='row'>Nama Ibu</th> <td><input type='text' class='form-control form-control-sm' name='NamaIbu' value='$detailmhs->NamaIbu'></td></tr>
<tr><th scope='row'>Agama Ibu</th>          
<td><select class='form-control form-control-sm' name='AgamaIbu'> 
<option value='0' selected>- Pilih agama -</option>"; 
foreach ($agama as $a){
  if ($detailmhs->AgamaIbu == $a->Agama){
	echo "<option value='$a->Agama' selected>$a->Agama - $a->Nama</option>";
  }else{
	echo "<option value='$a->Agama'>$a->Agama - $a->Nama</option>";
  }
}
echo "</select></td></tr> 
<tr><th scope='row'>Pendidikan Ibu</th>          
<td><select class='form-control form-control-sm' name='PendidikanIbu'> 
<option value='0' selected>- Pilih Pendidikan Ibu -</option>"; 
foreach ($pendidikanortu as $a){
  if ($detailmhs->PendidikanIbu == $a->Pendidikan){
	echo "<option value='$a->Pendidikan' selected>$a->Pendidikan - $a->Nama</option>";
  }else{
	echo "<option value='$a->Pendidikan'>$a->Pendidikan - $a->Nama</option>";
  }
}
echo "</select></td></tr> 
<tr><th scope='row'>Pekerjaan Ibu</th>          
<td><select class='form-control form-control-sm' name='PekerjaanIbu'> 
<option value='0' selected>- Pilih Pekerjaan Ibu -</option>"; 
//Pekerjaan pada tabel pekerjaanortu
foreach ($pekerjaanortu as $a){
  if ($detailmhs->PekerjaanIbu == $a->Pekerjaan){
	echo "<option value='$a->Pekerjaan' selected>$a->Pekerjaan - $a->Nama</option>";
  }else{
	echo "<option value='$a->Pekerjaan'>$a->Pekerjaan - $a->Nama</option>";
  }
}
echo "</select></td></tr>  
<tr><th scope='row'>Hidup</th>          
<td><select class='form-control form-control-sm' name='HidupIbu'> 
"; 
foreach ($hidup as $a){
  if ($detailmhs->HidupIbu == $a->Hidup){
	echo "<option value='$a->Hidup' selected>$a->Hidup - $a->Nama</option>";
  }else{
	echo "<option value='$a->Hidup'>$a->Hidup - $a->Nama</option>";
  }
}
echo "</select></td></tr> 
</tbody>
</table>";
//close kolom 
echo"</div>";

//tutup kolom 2

//mulai table dengan kolom 12
echo "<div class='col-12'> ";
echo"<table class='table table-sm table-borderless'>
<tbody>
<tr><th  scope='row' colspan='2' style=text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;>ALAMAT ORANG TUA</th></tr>
<tr><th  scope='row' width='220px'>Alamat Orang Tua</th> <td><input type='text' class='form-control form-control-sm' name='AlamatOrtu' value='$detailmhs->AlamatOrtu'></td></tr>
<tr><th  scope='row'>RT</th> <td><input type='text' class='form-control form-control-sm' name='RTOrtu' value='$detailmhs->RTOrtu'></td></tr>
<tr><th  scope='row'>RW</th> <td><input type='text' class='form-control form-control-sm' name='RWOrtu' value='$detailmhs->RWOrtu'></td></tr>
<tr><th  scope='row'>Kota</th> <td><input type='text' class='form-control form-control-sm' name='KotaOrtu' value='$detailmhs->KotaOrtu'></td></tr>
<tr><th  scope='row'>Propinsi</th> <td><input type='text' class='form-control form-control-sm' name='PropinsiOrtu' value='$detailmhs->PropinsiOrtu'></td></tr>
<tr><th  scope='row'>Negara</th> <td><input type='text' class='form-control form-control-sm' name='NegaraOrtu' value='$detailmhs->NegaraOrtu'></td></tr>
<tr><th  scope='row'>Telepon</th> <td><input type='text' class='form-control form-control-sm' name='TeleponOrtu' value='$detailmhs->TeleponOrtu'></td></tr>
<tr><th  scope='row'>Handphone</th> <td><input type='text' class='form-control form-control-sm' name='HandphoneOrtu' value='$detailmhs->HandphoneOrtu'></td></tr>
<tr><th  scope='row'>Email</th> <td><input type='text' class='form-control form-control-sm' name='EmailOrtu' value='$detailmhs->EmailOrtu'></td></tr>
</tbody>
</table>";
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
