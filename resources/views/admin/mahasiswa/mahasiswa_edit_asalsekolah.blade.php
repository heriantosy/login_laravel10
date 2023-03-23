@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>DATA ASAL SEKOLAH</b></h3>
</div>";
?>
  
<form action="{{ asset('admin/mahasiswa/detailasalsekolahsimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
echo "
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th scope='row' width='220px'>Asal Sekolah</th>          
<td><select class='form-control form-control-sm select2' name='AsalSekolah'> 
<option value='0' selected>- Pilih Asal Sekolah -</option>"; 
//Asalsekolah dari tabel mhsw dan SekolahID dari tabel asalsekolah
foreach ($asalsekolah as $a){
  if ($detailmhs->AsalSekolah == $a->SekolahID){
	echo "<option value='$a->SekolahID' selected>$a->Nama</option>";
  }else{
	echo "<option value='$a->SekolahID'>$a->Nama</option>";
  }
}
echo "</select>
</td>
</tr>
<tr><th  scope='row'>Jenis Sekolah</th> <td><input type='text' class='form-control form-control-sm' name='JenisSekolahID' value='$detailmhs->JenisSekolahID'></td></tr>
<tr><th  scope='row'>Jurusan</th> <td><input type='text' class='form-control form-control-sm' name='JurusanSekolah' value='$detailmhs->JurusanSekolah'></td></tr>
<tr><th  scope='row'>Tahun Lulus</th> <td><input type='text' class='form-control form-control-sm' name='TahunLulus' value='$detailmhs->TahunLulus'></td></tr>
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

