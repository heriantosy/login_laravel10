<form action="{{ asset('admin/persyaratan/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}
<p class="btn-group">
  
<a href="{{ asset('admin/setuppmb/komponen') }}" class="btn btn-danger" >
    <i class="fas fa-trash-alt"></i>
  </a> 

  <a href="{{ asset('admin/setuppmb') }}" class="btn btn-success ">
  <i class="fa fa-check"></i> PERIODE</a>
  
  <a href="{{ asset('admin/setuppmb/persyaratan') }}" class="btn btn-warning">
      <i class="fa fa-check"></i> HARGA FORMULIR
  </a>

  <a href="{{ asset('admin/setuppmb/komponen') }}" class="btn btn-primary">
      <i class="fa fa-check"></i> KOMPONEN USM
  </a>
  
  <a href="{{ asset('admin/setuppmb/persyaratan') }}" class="btn btn-success ">
  <i class="fa fa-check"></i> PERSYARATAN</a>

</p>
<div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="2%">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-info btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th>
    <th width="5%">Kode</th>
    <th width="20%">Nama</th>
    <th width="10%">Aksi</th>
</tr>
</thead>
<tbody>

<?php $i=1; foreach($persyaratan as $persyaratan) { ?>

<tr class="odd gradeX">
    <td class="text-center">
      <div class="icheck-primary">
        <input type="checkbox" class="icheckbox_flat-blue " name="PMBSyaratID[]" value="<?php echo $persyaratan->PMBSyaratID ?>">
        <label for="check<?php echo $i ?>"></label>
      </div>
    </td>
    <td>{{ $persyaratan->PMBSyaratID }}</td>
    <td>{{ $persyaratan->Nama }}</td>
  
    <td>
      <div class="btn-group">
        <a href="{{ asset('persyaratan/read/'.$persyaratan->PMBSyaratID) }}" 
        class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
        <a href="{{ asset('admin/persyaratan/edit/'.$persyaratan->PMBSyaratID) }}" 
        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

        <a href="{{ asset('admin/persyaratan/delete/'.$persyaratan->PMBSyaratID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>