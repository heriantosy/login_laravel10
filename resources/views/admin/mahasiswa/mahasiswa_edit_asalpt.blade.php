@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA ASAL PERGURUAN TINGGI</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/mahasiswa/detailasalptsimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
echo "
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th  scope='row' width='220px'>Asal Perguruan Tinggi</th> <td><input type='text' class='form-control form-control-sm' name='AsalPT' value='$detailmhs->AsalPT'></td></tr>
<tr><th  scope='row'>Jurusan</th> <td><input type='text' class='form-control form-control-sm' name='ProdiAsalPT' value='$detailmhs->ProdiAsalPT'></td></tr>
<tr><th  scope='row'>Lulus</th> <td><input type='text' class='form-control form-control-sm' name='LulusUjian' value='$detailmhs->LulusUjian'></td></tr>
<tr><th  scope='row'>Nilai IPK</th> <td><input type='text' class='form-control form-control-sm' name='IPKAsalPT' value='$detailmhs->IPKAsalPT'></td></tr>
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
