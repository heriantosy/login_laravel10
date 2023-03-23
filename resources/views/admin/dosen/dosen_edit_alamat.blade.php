
@include('admin/dosen/tabdosen')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
 <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA ALAMAT</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/dosen/detailalamatsimpan/'.$detaildosen->Login) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
echo "
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='Login' value='$detaildosen->Login'>
<tr><th width='220px' scope='row'>Alamat</th>    <td><input type='text' class='form-control form-control-sm' name='Alamat' value='$detaildosen->Alamat'></td></tr>
<tr><th scope='row'>Kota</th> <td><input type='text' class='form-control form-control-sm' name='Kota' value='$detaildosen->Kota'></td></tr>                              
<tr><th  scope='row'>Propinsi</th> <td><input type='text' class='form-control form-control-sm' name='Propinsi' value='$detaildosen->Propinsi'></td></tr>
<tr><th scope='row'>Negara </th> <td><input type='text' class='form-control form-control-sm' name='Negara' value='$detaildosen->Negara'></td></tr>                              
<tr><th  scope='row'>Telepon</th> <td><input type='text' class='form-control form-control-sm' name='Telephone' value='$detaildosen->Telephone'></td></tr>
<tr><th  scope='row'>NIK</th> <td><input type='text' class='form-control form-control-sm' name='KTP' value='$detaildosen->KTP'></td></tr>

</tbody>
</table>";
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
