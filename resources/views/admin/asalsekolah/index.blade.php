<?php if($asalsekolah) { ?>  
<div class="row">
<div class="col-md-12">
 

  <div class="btn-group">
  <a href="{{ asset('admin/asalsekolah/tambah') }}" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i> Tambah Baru</a>
 </div>

 <div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
    <th style='width:2px;text-align:center'>No</th>
        <th style='width:80px'>Kode</th>	
        <th style='width:190px'>Nama </th>						
        <th style='width:200px'>Kota</th>
                    
        <th style='width:70px;text-align:center'>Action</th>    
    </tr>
</thead>
<tbody>
  <?php 
      $i=0;     
      foreach($asalsekolah as $row) {
        $i++;
        $Namax 		  = strtolower($row->Nama);
        $Nama	      = ucwords($Namax);

  ?>
  <tr>
    
    <td style='width:2px;text-align:center'><?php echo $i ?></td>
    <td><?php echo $row->SekolahID ?></a></td>
    <td><?php echo $Nama ?></td>          						
    <td>{{ $row->Kota }}</td>  
     
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/asalsekolah/edit/'.$row->SekolahID) }}"><i class="fa fa-edit"></i></a>&nbsp;
        <a href="{{ asset('admin/asalsekolah/delete/'.$row->SekolahID) }}" onclick="return confirm('Yakin data akan dihapus ?')"><i class="fas fa-trash-alt"></i></a>&nbsp;
      </div>
    </td>
  </tr>

  <?php } ?>

</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>