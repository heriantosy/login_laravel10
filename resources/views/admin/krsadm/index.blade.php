


<?php if($krs) { ?>  
  <table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			
			<th><b style='color:white'>DATA MAHASISWA</b></th>
			<th width="50%"><b style='color:white'>INFORMASI KRS</b></th>
		</tr>
	</thead>
	<tbody>
    <tr>
      <td>
         Mahasiswa: <?php echo $MhswIDplh ?> - <?php echo strtoupper($mhs->Nama) ?>
        <br>Tempat & Tgl Lahir: <?php echo $mhs->TempatLahir ?>, <?php echo date('d-M-Y', strtotime($mhs->TanggalLahir)) ?>
         <br>Hanphone: <?php echo $mhs->Handphone ?>
      </td>
      <td>
          Tahun Akademik: <?php echo $tahunplh ?>
          <br>Program Studi : (<?php echo strtoupper($mhs->ProgramID) ?>) <?php echo strtoupper($prd->Nama) ?>
          <br>Semester: 
      </td>
    </tr>
	</tbody>
</table>


<form action="{{ asset('admin/krsadm/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-3 col-md-6">&nbsp;</div>

<div class="input-group mb-3 col-md-6">
<select name="tahun" class="form-control form-control-sm">
<?php foreach($tahun as $tahun) { ?>
  <option value="<?php echo $tahun->TahunID ?>" 
    <?php if(isset($_POST['tahunplh']) && $_POST['tahunplh']==$tahun->TahunID) { echo "selected"; }
          elseif(isset($_GET['tahunplh']) && $_GET['tahunplh']==$tahun->TahunID) { echo 'selected'; }
          elseif($tahunplh==$tahun->TahunID) { echo 'selected'; } ?>>
    <?php echo $tahun->TahunID  ?>
  </option>
<?php } ?>
</select>

<input type="text" class="form-control form-control-sm" name="MhswID" value="<?php echo $MhswIDplh ?>" placeholder="Cari..." required>
<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat
  </button>
</span>

<a href="{{ asset('admin/krsadm/tambah/'.$tahunplh.'/'.$MhswIDplh) }}" class="btn btn-success btn-sm">
<i class="fa fa-plus"></i> Tambah KRS
</a>

<a href="{{ asset('admin/krsadm/tambah/'.$tahunplh.'/'.$MhswIDplh) }}" class="btn btn-danger btn-sm">
<i class="fa fa-print"></i> Cetak KRS
</a>
</div>
</div>

<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%" style='text-align:center'>No</th>
        <th width="11%">Waktu</th>
        <th width="10%">Ruang</th>
        <th width="10%">Kode</th>
        <th width="25%">NamaMK</th>
        <th width="10%">Kelas</th>
        <th width="5%" style='text-align:center'>SKS</th>
        <th width="25%">Dosen</th> 
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php   
  $i=1;  
  foreach($krs as $krs) {
    // $idx = Crypt::encryptString($krs->KHSID);
    // $NamaMKx = strtolower($jadwal->NamaMK);
    // $NamaMK	= ucwords($NamaMKx);

  ?> 

  <tr style='font-size:15px;'>
    <td style='text-align:center'><?php echo $i ?></td>
    <td><?php echo substr($krs->NamaHari,0,5) ?>, <?php echo substr($krs->JamMulai,0,5) ?>-<?php echo substr($krs->JamSelesai,0,5) ?></td>
    <td><?php echo $krs->NamaRuang ?></td>
    <td><?php echo $krs->MKKode ?></td>
    <td><?php echo $krs->NamaMK ?></td>
    <td><?php echo $krs->NamaKelasx ?></td>
    <td style='text-align:center'><?php echo $krs->SKS ?></td>
    <td><?php echo $krs->NamaDosen ?>, <?php echo $krs->Gelar ?></td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/krsadm/edit/'.$krs->KRSID) }}" ><i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/krsadm/cetak_krs/'.$krs->KHSID) }}"  target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/krsadm/delete/'.$krs->KRSID.'/'.$krs->TahunID.'/'.$krs->MhswID) }}"><i class="fas fa-trash-alt"></i></a> &nbsp;
      </div>
    </td>
  </tr>
  <?php $i++;   }//End looping?>
<tr><td colspan='6'><b>Total SKS</b> </td><td style='text-align:center'><b> <?php echo $totsks ?></b></td><td colspan='2'></td></tr>
</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>