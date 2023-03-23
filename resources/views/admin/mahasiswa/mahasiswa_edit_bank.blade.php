
@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>REKENING BANK</b></h3>
</div>";
?>
<form action="{{ asset('admin/mahasiswa/detailbank/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
echo "<br>
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th width='220px' scope='row'>Norek</th>    <td><input type='text' class='form-control form-control-sm' name='NomerRekening' value='$detailmhs->NomerRekening'></td></tr>
<tr><th width='220px' scope='row'>Nama Bank</th>    <td><input type='text' class='form-control form-control-sm' name='NamaBank' value='$detailmhs->NamaBank'></td></tr>
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
