
<p class="text-right">
	<a href="{{ asset('admin/jadwalujian/edit/'.$jadwal->JadwalID) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Update Status
	</a>
	<a href="{{ asset('admin/jadwalujian/cetak/'.$jadwal->JadwalID) }}" class="btn btn-info btn-sm" target="_BLANK">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('admin/jadwalujian') }}" class="btn btn-success btn-sm">
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
          <br>Program Studi: <?php echo nl2br($prodi) ?>
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
        <th width="30%">Nama Mahasiswa</th>
        <th width="10%" style='text-align:center;vertical-align:middle;'>Tatap Muka</th>
		<th width="10%" style='text-align:center;vertical-align:middle;'>Jumlah Hadir</th>
		<th width="10%" style='text-align:center;vertical-align:middle;'>Persentase</th>
		<th width="30%">Keterangan</th>
    </tr>
</thead>
<tbody>	 
	<?php
        $no=0;
		foreach ($presmhs as $row) {

		$no++;
		//dd($row->JML);	
		$persen			= ($row->JML / $row->Kehadiran)* 100;
		$persentase		= number_format(($row->JML / $row->Kehadiran)* 100,0);				       			
		
		//DB::table('krs', "update krs set Presensi='$persen' where MhswID=$r[MhswID] and JadwalID='$r[JadwalID]'");
		// DB::table('krs')->where('MhswID',$row->MhswID)->where('JadwalID',$row->JadwalID)->update([ 
        //     'Presensi'   => $persen
		// ]);
		
	   	$NamaMhsx		= strtolower($row->NamaMhs);
		$NamaMhs		= ucwords($NamaMhsx);
	?>
		<tr>
		<td style='text-align:right'><?php echo $no ?></td>
		<td class="text-center">{{ $row->MhswID }}</td>
		<td class="text-left">{{ $NamaMhs }}</td>
		<td style='text-align:center;vertical-align:middle;'><?php echo $row->Kehadiran ?></td>
		<td style='text-align:center;vertical-align:middle;'><?php echo $row->JML ?></td>
		<td style='text-align:center;vertical-align:middle;'><?php echo $persentase ?> %</td>
		<td >-</td>
		</tr>
	<?php 
	}
	 ?>
	</tbody>
</table>
