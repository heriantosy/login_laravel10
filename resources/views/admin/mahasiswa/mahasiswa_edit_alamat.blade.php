
@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
 <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA ALAMAT</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/mahasiswa/detailalamatsimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
echo "
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th width='220px' scope='row'>Alamat</th>    <td><input type='text' class='form-control form-control-sm' name='Alamat' value='$detailmhs->Alamat'></td></tr>
<tr><th scope='row'>RT</th> <td><input type='text' class='form-control form-control-sm' name='RT' value='$detailmhs->RT'></td></tr>
<tr><th scope='row'>RW</th> <td><input type='text' class='form-control form-control-sm' name='RW' value='$detailmhs->RW'></td></tr>
<tr><th scope='row'>Kota</th> <td><input type='text' class='form-control form-control-sm' name='Kota' value='$detailmhs->Kota'></td></tr>                              
<tr><th  scope='row'>Propinsi</th> <td><input type='text' class='form-control form-control-sm' name='Propinsi' value='$detailmhs->Propinsi'></td></tr>
<tr><th scope='row'>Negara </th> <td><input type='text' class='form-control form-control-sm' name='Negara' value='$detailmhs->Negara'></td></tr>                              
<tr><th  scope='row'>Telepon</th> <td><input type='text' class='form-control form-control-sm' name='Telepon' value='$detailmhs->Telepon'></td></tr>
<tr><th  scope='row'>NIK</th> <td><input type='text' class='form-control form-control-sm' name='NIK' value='$detailmhs->NIK'></td></tr>
<tr><th  scope='row'>ID KK</th> <td><input type='text' class='form-control form-control-sm' name='IDKK' value='$detailmhs->IDKK'></td></tr>
<tr><th  scope='row'>Kelurahan</th> <td><input type='text' class='form-control form-control-sm' name='Kelurahan' value='$detailmhs->Kelurahan'></td></tr>
<tr><th  scope='row'>Kecamatan</th> <td><input type='text' class='form-control form-control-sm' name='Kecamatan' value='$detailmhs->Kecamatan'></td></tr>

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
