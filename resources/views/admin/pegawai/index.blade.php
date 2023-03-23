<?php if($pegawai) { ?>  
<div class="row">
<div class="col-md-10">
 

  <div class="btn-group">
  <a href="{{ asset('admin/pegawai/tambah') }}" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i> Tambah Baru</a>
 </div>

 <div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
<table id="dataTable" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
    <th style='width:10px;text-align:center'>No</th>
        <th style='width:80px'>Noreg</th>	
        <th style='width:190px'>Nama Pegawai</th>						
        <th style='width:200px'>Tempat dan Tgl Lahir</th>
        <th style='width:120px'>TMT</th>
        <th style='width:70px'>Handphone</th>                      
        <th style='width:160px'>Masa Kerja</th>                       
        <th style='width:70px;text-align:center'>Action</th>    
    </tr>
</thead>
<tbody>
  <?php 
      $i=0;     
      foreach($pegawai as $row) {
        $i++;
        $Namax 		  = strtolower($row->Nama);
        $Nama	      = ucwords($Namax);
        $TempatLahirx 	= strtolower($row->TempatLahir);
        $TempatLahir	= ucwords($TempatLahirx);

  ?>
  <tr>
    
    <td><?php echo $i ?></td>
    <td><?php echo $row->Noreg ?></a></td>
    <td><?php echo $Nama ?></td>          						
    <td>{{ $row->TempatLahir }}</td>
    <td>{{ $row->TMT }}</td>
    <td>{{ $row->Handphone }}</td>    
    <td></td>     
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/pegawai/edit/'.$row->IDPeg) }}"><i class="fa fa-edit"></i></a>&nbsp;
        <a href="{{ asset('admin/pegawai/delete/'.$row->IDPeg) }}"><i class="fas fa-trash-alt"></i></a>&nbsp;
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