

<?php if($jadwal) { ?>  
  <p class="text-right">
	<a href="" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Update Status
	</a>
	<a href="" class="btn btn-info btn-sm">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('admin/krsadm/filter/'.$tahunplh.'/'.$MhswID) }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>



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
         Mahasiswa: <?php echo strtoupper($mhs->MhswID) ?> - <?php echo strtoupper($mhs->NamaMhs) ?>
        <br>Tempat & Tgl Lahir: <?php echo nl2br($mhs->TempatLahir) ?>, <?php echo date('d-M-Y', strtotime($mhs->TanggalLahir)) ?>
         <br>Hanphone: <?php echo $mhs->Handphone ?>
      </td>
      <td>
          Tahun Akademik: <?php echo strtoupper($tahunplh) ?>
          <br>Program Studi : (<?php echo strtoupper($mhs->ProgramID) ?>) <?php echo strtoupper($mhs->NamaProdi) ?>
          <br>Semester: 
      </td>
    </tr>
	</tbody>
</table>



<form action="{{ asset('admin/krsadm/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

</div>
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="5%">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th>
       
        <th width="12%">Waktu</th>
        <th width="10%">Ruang</th>
        <th width="10%">Kode</th>
        <th width="25%">Matakuliah</th>
        <th width="10%">Kelas</th>
        <th width="5%">SKS</th>
        <th width="35%">Dosen</th>
        <th width="5%">JmlMhs</th>
      
        <th width="10%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php
      $i=1;     
      $HariID = -320;    
      foreach($jadwal as $jadwal) {

        // if ($HariID != $jadwal->HariID) {
        //   $HariID = $jadwal->HariID;
        //   echo "<tr style='background:purple;color:white'>
        //     <td class=ul1 colspan=11><b>$jadwal->NamaHari</b> </td>
        //     </tr>";   
        // }    

        $JadwalID       = $jadwal->JadwalID;
        $NamaDosenx 		= strtolower($jadwal->NamaDosen);
        $NamaDosen	    = ucwords($NamaDosenx);
        $NamaMKx 		    = strtolower($jadwal->NamaMK);
        $NamaMK	        = ucwords($NamaMKx);
        // $totmhstmp = \DB::table('krstemp')
        // ->where('JadwalID',$jadwal->JadwalID)
        // ->count();
        // $totmhs = \DB::table('krs')
        // ->where('JadwalID',$jadwal->JadwalID)
        // ->count();
        // $totpres = \DB::table('presensi')
        // ->where('JadwalID',$jadwal->JadwalID)
        // ->count();
      
  ?>

  <tr >
    <td class="text-center" >
        <div>
            <input type="hidden" name="khsid" value="<?php echo $khsid ?>">
            <input type="hidden" name="tahun" value="<?php echo $jadwal->TahunID ?>">
            <input type="hidden" name="MhswID" value="<?php echo $mhs->MhswID ?>">
            <input type="hidden" name="SKS[]" value="<?php echo $jadwal->SKS ?>" id="check<?php echo $i ?>">
            <input type="hidden" name="MKID[]" value="<?php echo $jadwal->MKID ?>" id="check<?php echo $i ?>">
            <input type="hidden" name="MKKode[]" value="<?php echo $jadwal->MKKode ?>" id="check<?php echo $i ?>">
            <input type="checkbox" name="JadwalID[]" value="<?php echo $jadwal->JadwalID ?>" id="check<?php echo $i ?>">
            <label for="check<?php echo $i ?>"></label>
        </div>
    </td>
   
    <td><?php echo $jadwal->NamaHari ?>, <?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
    <td><?php echo $jadwal->RuangID ?></td>
    <td><?php echo $jadwal->MKKode ?></td>
    <td><a href="{{ asset('admin/jadwal/detail/'.$jadwal->JadwalID) }}"><?php echo $NamaMK ?></a></td>
    <td><?php echo $jadwal->NamaKelasx ?></td>
    <td><?php echo $jadwal->SKS ?></td>
    <td><?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?></td>
    <td style='text-align:right'><?php echo $jadwal->JumlahMhsw ?>/<?php echo $jadwal->Kapasitas ?></td>
  

    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/krsadm/tambah_proses/'.$jadwal->JadwalID.'/'.$MhswID) }}"><i class="fa fa-plus"></i></a> &nbsp;
        <a href="{{ asset('admin/krsadm/cetak/'.$jadwal->JadwalID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/krsadm/delete/'.$jadwal->JadwalID) }}"> <i class="fas fa-trash-alt"></i></a> 
      </div>
    </td>
  </tr>

  <?php $i++; }//End looping?>

</tbody>
</table>
<button class='btn btn-warning btn-sm' type='submit' name='ambil' onClick='check();'> Ambil </button>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>