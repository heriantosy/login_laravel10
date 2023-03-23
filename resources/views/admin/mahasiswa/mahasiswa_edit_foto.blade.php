
@include('admin/mahasiswa/tabmahasiswa')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>REKENING BANK</b></h3>
</div>";
?>
<form action="{{ asset('admin/mahasiswa/editfotomhssimpan/'.$detailmhs->MhswID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
echo "<br>
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='id' value='$detailmhs->MhswID'>
<tr><th width='220px' scope='row'>Nama Mahasiswa</th>    <td><input type='text' class='form-control form-control-sm' name='Nama' value='$detailmhs->Nama'></td></tr>
<tr><th width='220px' scope='row'>Foto</th>    <td><input type='file' name='Foto' class='form-control form-control-sm' placeholder='Upload Foto'></td></tr>
<tr><th width='220px' scope='row'></th>
<td>";
    if($detailmhs->Foto!="") { ?>
      <img src="{{ asset('assets/upload/mahasiswa/thumbs/'.$detailmhs->Foto) }}" class="img img-thumbnail img-responsive" >
    <?php }else{ ?>
      <img src="{{ asset('assets/upload/mahasiswa/thumbs/'.$site->icon) }}" class="img img-thumbnail img-responsive" >
    <?php }
    echo"</td>
<tr>    
</tbody>
</table>";
?>
<?php
echo"
<div class='card-footer'>
<button type='submit' name='submit' class='btn btn-info btn-sm'>Simpan</button>&nbsp;";?>
<a href="{{ asset('admin/mahasiswa') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";
?>
