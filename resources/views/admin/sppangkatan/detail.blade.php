
<p class="text-right">
	<a href="{{ asset('admin/jadwal/edit/'.$jadwal->JadwalID) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Update Status
	</a>
	<a href="{{ asset('admin/jadwal/cetak/'.$jadwal->JadwalID) }}" class="btn btn-info btn-sm" target="_BLANK">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>



<table class="table table-bordered">
	<thead>
		<tr class="bg-info">
			
			<th><b style='color:white'>INSTITUSI</b></th>
			<th width="50%"><b style='color:white'>PERKULIAHAN</b></th>
		</tr>
	</thead>
	<tbody>
    <tr>
      <td>
        <strong><?php echo strtoupper($site->Nama) ?></strong>
              <br><?php echo nl2br($site->Alamat1) ?>
                <br>Telepon: <?php echo $site->Telepon ?>
                <br>Email: <?php echo $site->Email ?>
                <br>Website: <?php echo $site->Website ?>
                <br>NoAkta: <?php echo $site->NoAkta ?>
      </td>
      <td>
        <strong><?php echo strtoupper($jadwal->NamaDosen) ?>, <?php echo $jadwal->Gelar ?></strong>
          <br><strong>Informasi Kuliah: </strong>
          <br>Program Studi: <?php echo nl2br($jadwal->ProdiID) ?>
          <br>Matakuliah: <?php echo $jadwal->NamaMK ?> (<?php echo $jadwal->SKS ?> SKS)
          <br>Nama Kelas / Waktu: <?php echo $jadwal->NamaKelas ?>, <?php echo substr($jadwal->JamMulai,0,5) ?>- <?php echo substr($jadwal->JamSelesai,0,5) ?> WIB
          <br>Thn Akademik: <?php echo $jadwal->TahunID ?>
      </td>
    </tr>
	</tbody>
</table>

<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
	    <th width="3%" style='text-align:right;vertical-align:middle;'>No</th>
        <th width="10%" style='text-align:center;vertical-align:middle;'>NIM</th>
        <th width="18%">Nama Mahasiswa</th>
        <th width="25%">Tempat dan Tanggal Lahir</th>
		<th width="30%">Handphone</th>
    </tr>
</thead>
<tbody>
	@foreach ($krs as $row)

	<?php
	   	$NamaMhsx	= strtolower($row->NamaMhs); //strtoupper($kalimat);
		$NamaMhs	= ucwords($NamaMhsx);
		$TempatLahirx	= strtolower($row->TempatLahir); //strtoupper($kalimat);
		$TempatLahir	= ucwords($TempatLahirx);
	?>
		<tr>
		<td style='text-align:right'>{{ $loop->index+1 }}</td>
		<td class="text-center">{{ $row->MhswID }}</td>
		<td class="text-left">{{ $NamaMhs }}</td>
		<td class="text-left">{{ $TempatLahir }}, <?php echo date('d-m-Y',strtotime($row->TanggalLahir));?></td>
		<td class="text-left">{{ $row->Handphone }}</td>
		
		</tr>
	@endforeach	
	</tbody>
</table>
