<div class="row">
<div class="col-md-10">
<form action="{{ asset('admin/asalsekolah/edit_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<?php 
echo "
<div class='card card-info'>
  <div class='card-header with-border'>
    <h3 class='card-title'><b style='color:purple'>Edit Data </b></h3>
  </div>
<div class='card-body'>";

echo "
    <table class='table table-sm table-borderless'>
    <tbody>
      <input type='hidden' name='id' value='$rows->SekolahID'>
      <tr><th width='190px' scope='row'>Sekolah ID</th> <td><input type='text' class='form-control' name='SekolahID' value='$rows->SekolahID' readonly> </td></tr>
      <tr><th scope='row'>Nama Sekolah</th>       <td><input type='text' class='form-control' name='Nama' value='$rows->Nama'></td></tr>
      <tr><th scope='row'>Alamat</th>    <td><input type='text' class='form-control' name='Alamat1' value='$rows->Alamat1'></td></tr>
      <tr><th scope='row'>Kota</th>    <td><input type='text' class='form-control' name='Kota' value='$rows->Kota'></td></tr>
      <tr><th scope='row'>Telephone</th>    <td><input type='text' class='form-control' name='Telephone' value='$rows->Telephone'></td></tr>
      <tr><th scope='row'>Website</th>    <td><input type='text' class='form-control' name='Website' value='$rows->Website'></td></tr>
      <tr><th scope='row'>Email</th>    <td><input type='text' class='form-control' name='Email' value='$rows->Email'></td></tr>";

            echo "</tbody>
            </table>";
			?>

		<div class='card-footer'>
		<button type='submit' name='submit' class='btn btn-info'>Update</button>
		<a href="{{ asset('admin/asalsekolah') }}"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
		</div>
	</div>	
</div>
</form>
