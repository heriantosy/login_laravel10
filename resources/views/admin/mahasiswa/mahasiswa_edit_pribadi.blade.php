@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='20px'>DATA PRIBADI</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/mahasiswa/detailpribadisimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end
    
  echo"<br>
  <table class='table table-sm table-borderless'>
  <tbody>
  <input type='hidden' name='id' value='$detailmhs->MhswID'>
  <tr><th width='220px' scope='row'>Nama Lengkap</th>    <td><input type='text' class='form-control form-control-sm' name='Nama' value='$detailmhs->Nama'></td></tr>
  <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control form-control-sm' name='TempatLahir' value='$detailmhs->TempatLahir'></td></tr>
  <tr><th scope='row'>Tanggal Lahir</th>    <td><input type='text' class='form-control form-control-sm tanggal' name='TanggalLahir' value='$detailmhs->TanggalLahir'></td></tr>
  <tr>
  <th scope='row'>Jenis Kelamin </th><td>"; 
  if ($detailmhs->Kelamin=='P'){ 
      echo "<input type='radio' name='Kelamin' value='P' checked> Pria &nbsp; 
            <input type='radio' name='Kelamin' value='W'> Wanita"; 
  }else{ 
      echo "<input type='radio' name='Kelamin' value='P'> Pria &nbsp; 
            <input type='radio' name='Kelamin' value='W' checked> Wanita"; 
  } 
  echo "</td>
  </tr>
  <tr><th scope='row'>Handphone</th>    <td><input type='text' class='form-control form-control-sm' name='Handphone' value='$detailmhs->Handphone'></td></tr>
  <tr><th scope='row'>Warga Negara</th>          
<td><select class='form-control form-control-sm' name='WargaNegara'>"; 
foreach ($warganegara as $a){
  if ($detailmhs->WargaNegara == $a->WargaNegara){
		  echo "<option value='$a->WargaNegara' selected>$a->Nama</option>";
		}else{
		  echo "<option value='$a->WargaNegara'>$a->Nama</option>";
		}
	  }
	  echo "</select></td></tr> 
<tr><th scope='row'>Agama</th>          
<td><select class='form-control form-control-sm' name='Agama'> 
<option value='0' selected>- Pilih Agama -</option>"; 
foreach ($agama as $a){
  if ($detailmhs->Agama == $a->Agama){
	echo "<option value='$a->Agama' selected>$a->Agama - $a->Nama</option>";
  }else{
	echo "<option value='$a->Agama'>$a->Agama - $a->Nama</option>";
  }
}
echo "</select></td></tr>
<tr><th scope='row'>Status Sipil</th>          
<td><select class='form-control form-control-sm' name='StatusSipil'> 
<option value='0' selected>- Pilih Status Sipil -</option>"; 
foreach ($statussipil as $a){
  if ($detailmhs->StatusSipil == $a->StatusSipil){
	echo "<option value='$a->StatusSipil' selected>$a->StatusSipil - $a->Nama</option>";
  }else{
	echo "<option value='$a->StatusSipil'>$a->StatusSipil - $a->Nama</option>";
  }
} 
echo "</select></td></tr>
<tr><th scope='row'>Alamat</th> <td><textarea class='form-control form-control-sm' name='Alamat' value='$detailmhs->Alamat'>$detailmhs->Alamat</textarea></td></tr>

</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<br>
<table class='table table-sm table-borderless'>
<tbody>
<tr><th scope='row'>RT</th> <td><input type='text' class='form-control form-control-sm' name='RT' value='$detailmhs->RT'></td></tr>
<tr><th scope='row'>RW</th> <td><input type='text' class='form-control form-control-sm' name='RW' value='$detailmhs->RW'></td></tr>   
<tr><th scope='row'>Kota</th> <td><input type='text' class='form-control form-control-sm' name='Kota' value='$detailmhs->Kota'></td></tr>   
<tr><th scope='row'>Propinsi</th> <td><input type='text' class='form-control form-control-sm' name='Propinsi' value='$detailmhs->Propinsi'></td></tr>   
<tr><th scope='row'>Negara</th> <td><input type='text' class='form-control form-control-sm' name='Negara' value='$detailmhs->Negara'></td></tr>   
<tr><th scope='row'>Telp</th> <td><input type='text' class='form-control form-control-sm' name='Telepon' value='$detailmhs->Telepon'></td></tr>   
<tr><th scope='row'>Email</th> <td><input type='text' class='form-control form-control-sm' name='Email' value='$detailmhs->Email'></td></tr>
</tbody>
</table>";
?>
<?php
echo"
<div class='card-footer'>
<button type='submit' name='submit' class='btn btn-info btn-sm'>Update</button>&nbsp;";
?>
<a href="{{ asset('admin/mahasiswa') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";

//tutup kolom 2
echo"</div>";

?>

