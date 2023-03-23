<form action="{{ asset('admin/setuppmb/proses') }}" method="post" accept-charset="utf-8">
<?php $site   = DB::table('konfigurasi')->first(); ?>
{{ csrf_field() }}
<p class="btn-group">
  


  <a href="{{ asset('admin/setuppmb/komponen') }}" class="btn btn-danger" >
    <i class="fas fa-trash-alt"></i>
  </a> 

  <a href="{{ asset('admin/setuppmb') }}" class="btn btn-success ">
  <i class="fa fa-check"></i> PERIODE</a>

  <a href="{{ asset('admin/setuppmb/formulir') }}" class="btn btn-warning">
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
    <th width="12%">Nama</th>
    <th width="10%">Pendaftaran</th>
    <th width="10%">Ujian</th>
    <th width="10%">Pembayaran</th>
    <th width="10%">Aksi</th>
</tr>
</thead>
<tbody>

<?php $i=1; foreach($setuppmb as $setuppmb) { ?>

<tr class="odd gradeX">
    <td class="text-center">
      <div class="icheck-primary">
        <input type="checkbox" class="icheckbox_flat-blue " name="PMBPeriodID[]" value="<?php echo $setuppmb->PMBPeriodID ?>">
        <label for="check<?php echo $i ?>"></label>
      </div>
    </td>
    <td>{{ $setuppmb->PMBPeriodID }}</td>
    <td>{{ $setuppmb->Nama }}</td>
    <td><?php echo date('d-m-Y', strtotime($setuppmb->TglMulai)) ?> s/d  <?php echo  date('d-m-Y', strtotime($setuppmb->TglSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($setuppmb->UjianMulai)) ?> s/d  <?php echo  date('d-m-Y', strtotime($setuppmb->UjianSelesai)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($setuppmb->BayarMulai)) ?> s/d  <?php echo  date('d-m-Y', strtotime($setuppmb->BayarSelesai)) ?></td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('setuppmb/read/'.$setuppmb->PMBPeriodID) }}" 
        class="btn btn-success btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
        <a href="{{ asset('admin/setuppmb/edit/'.$setuppmb->PMBPeriodID) }}" 
        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

        <a href="{{ asset('admin/setuppmb/delete/'.$setuppmb->PMBPeriodID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
</form>