@include('admin/dosen/tabdosen')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='20px'>DATA PRIBADI</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/dosen/detailpribadisimpan/'.$detaildosen->Login) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end
    
  echo"<br>
  <table class='table table-sm table-borderless'>
  <tbody>
  <input type='hidden' name='id' value='$detaildosen->Login'>
  <tr><th width='220px' scope='row'>Nama Lengkap</th>    <td><input type='text' class='form-control form-control-sm' name='Nama' value='$detaildosen->Nama'></td></tr>
  <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control form-control-sm' name='TempatLahir' value='$detaildosen->TempatLahir'></td></tr>
  <tr><th scope='row'>Tanggal Lahir</th>    <td><input type='text' class='form-control form-control-sm' name='TanggalLahir' value='$detaildosen->TanggalLahir'></td></tr>

  <tr>
  <th scope='row'>Jenis Kelamin </th><td>"; 
  if ($detaildosen->KelaminID=='P'){ 
      echo "<input type='radio' name='KelaminID' value='P' checked> Pria &nbsp; 
            <input type='radio' name='KelaminID' value='W'> Wanita"; 
  }else{ 
      echo "<input type='radio' name='KelaminID' value='P'> Pria &nbsp; 
            <input type='radio' name='KelaminID' value='W' checked> Wanita"; 
  } 
  echo "</td>
  </tr>

<tr><th scope='row'>Handphone</th>    <td><input type='text' class='form-control form-control-sm' name='Handphone' value='$detaildosen->Handphone'></td></tr>
<tr><th scope='row'>Agama</th>          
<td><select class='form-control form-control-sm' name='AgamaID'> 
<option value='0' selected>- Pilih Agama -</option>"; 
foreach ($agama as $a){
  if ($detaildosen->AgamaID == $a->Agama){
	echo "<option value='$a->Agama' selected>$a->Agama - $a->Nama</option>";
  }else{
	echo "<option value='$a->Agama'>$a->Agama - $a->Nama</option>";
  }
}
echo "</select></td></tr>

<tr><th scope='row'>Alamat</th> <td><textarea class='form-control form-control-sm' name='Alamat' value='$detaildosen->Alamat'>$detaildosen->Alamat</textarea></td></tr>

</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<br>
<table class='table table-sm table-borderless'>
<tbody>

<tr><th scope='row'>Kota</th> <td><input type='text' class='form-control form-control-sm' name='Kota' value='$detaildosen->Kota'></td></tr>   
<tr><th scope='row'>Propinsi</th> <td><input type='text' class='form-control form-control-sm' name='Propinsi' value='$detaildosen->Propinsi'></td></tr>   
<tr><th scope='row'>Negara</th> <td><input type='text' class='form-control form-control-sm' name='Negara' value='$detaildosen->Negara'></td></tr>   
<tr><th scope='row'>Telp</th> <td><input type='text' class='form-control form-control-sm' name='Telephone' value='$detaildosen->Telephone'></td></tr>   
<tr><th scope='row'>Email</th> <td><input type='text' class='form-control form-control-sm' name='Email' value='$detaildosen->Email'></td></tr>
</tbody>
</table>";
?>
<?php
echo"
<div class='card-footer'>
<button type='submit' name='submit' class='btn btn-info btn-sm'>Update</button>&nbsp;";
?>
<a href="{{ asset('admin/dosen') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";

//tutup kolom 2
echo"</div>";

?>

