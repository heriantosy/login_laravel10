<div class="row">
<div class="col-md-10">
<form action="{{ asset('admin/asalsekolah/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<?php 
echo "
<div class='card card-info'>
  <div class='card-header with-border'>
    <h3 class='card-title'><b style='color:purple'>Tambah Data </b></h3>
  </div>
<div class='card-body'>";

echo "
	<table class='table table-sm table-borderless'>
	<tbody>
	<tr><th width='190px' scope='row'>Sekolah ID</th> <td><input type='text' class='form-control' name='id' value='$kodeUrut'> </td></tr>
  <tr><th scope='row'>Nama Sekolah</th>       <td><input type='text' class='form-control' name='Nama'></td></tr>
  <tr><th scope='row'>Alamat</th>    <td><input type='text' class='form-control' name='Alamat1'></td></tr>
  <tr><th scope='row'>Kota</th>    <td><input type='text' class='form-control' name='Kota'></td></tr>
  <tr><th scope='row'>Telephone</th>    <td><input type='text' class='form-control' name='Telephone'></td></tr>
  <tr><th scope='row'>Website</th>    <td><input type='text' class='form-control' name='Website'></td></tr>
  <tr><th scope='row'>Email</th>    <td><input type='text' class='form-control' name='Email'></td></tr>";
	echo "</tbody>
	</table>";
?>			

		<div class="card-footer">
		<button type="submit" name="submit" class="btn btn-info">Simpan</button>
		<a href="{{ asset('admin/asalsekolah') }}"><button type="button" class="btn btn-default pull-right">Cancel</button></a>      
		</div>
	</div>
</div>
</form>
