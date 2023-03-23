
@include('admin/dosen/tabdosen')
<?php 
echo "
<div class='card card-info'>
<div class='card-header with-border'>
  <h3 class='card-title'><b style=color:purple;font-size='15px'>GANTI FOTO</b></h3>
</div>";
?>
<form action="{{ asset('admin/dosen/editfotodosensimpan/'.$detaildosen->Login) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf

<?php
echo "<br>
<table class='table table-sm table-borderless'>
<tbody>

<input type='hidden' name='Login' value='$detaildosen->Login'>
<tr><th width='220px' scope='row'>Nama Dosen</th>    <td><input type='text' class='form-control form-control-sm' name='Nama' value='$detaildosen->Nama'></td></tr>
<tr><th width='220px' scope='row'>FotoBro</th>    <td><input type='file' name='FotoBro' class='form-control form-control-sm' placeholder='Upload FotoBro'></td></tr>
<tr><th width='220px' scope='row'></th>
<td>";
    if($detaildosen->FotoBro!="") { ?>
      <img src="{{ asset('assets/upload/dosen/thumbs/'.$detaildosen->FotoBro) }}" class="img img-thumbnail img-responsive" >
    <?php }else{ ?>
      <img src="{{ asset('assets/upload/dosen/thumbs/'.$site->icon) }}" class="img img-thumbnail img-responsive" >
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
<a href="{{ asset('admin/dosen') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";
?>
