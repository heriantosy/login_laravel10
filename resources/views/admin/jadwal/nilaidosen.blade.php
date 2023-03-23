<script>
function goBack() {
  window.history.back();
}
</script>

<p class="text-right">
	<a href="{{ asset('admin/jadwal/edit/'.$jadwal->JadwalID) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Update Status
	</a>
	<a href="{{ asset('admin/jadwal/cetak/'.$jadwal->JadwalID) }}" class="btn btn-info btn-sm" target="_BLANK">
		<i class="fa fa-print"></i> Cetak
	</a>
	<button class="btn btn-success btn-sm" onclick="goBack()"><i class="fa fa-backward"></i> Kembali</button>	
	
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
              <br><?php echo $site->Alamat1 ?>
                <br>Telepon: <?php echo $site->Telepon ?>
                <br>Email: <?php echo $site->Email ?>
                <br>Website: <?php echo $site->Website ?>
                <br>NoAkta: <?php echo $site->NoAkta ?>
      </td>
      <td>
        <strong><?php echo strtoupper($jadwal->NamaDosen) ?>, <?php echo $jadwal->Gelar ?></strong>
          <br><strong>Informasi Kuliah: </strong>
          <br>Program Studi: <?php echo $prodi->Nama ?>
          <br>Matakuliah: <?php echo $jadwal->NamaMK ?> (<?php echo $jadwal->SKS ?> SKS)
          <br>Nama Kelas / Waktu: <?php echo $jadwal->NamaKelas ?>, <?php echo substr($jadwal->JamMulai,0,5) ?>- <?php echo substr($jadwal->JamSelesai,0,5) ?> WIB
          <br>Thn Akademik: <?php echo $jadwal->TahunID ?>
      </td>
    </tr>
	</tbody>
</table>
<form action="{{ asset('admin/jadwal/simpannilaidosen/'.$jadwal->JadwalID) }}" enctype="multipart/form-data" method="get" accept-charset="utf-8">

<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
<tr style='text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;'>
<th height=5px rowspan='2' style='vertical-align:middle;text-align:center;'>NO</th>                        
<th height=5px rowspan='2' style='vertical-align:middle;text-align:center;'>NIM</th>
<th height=5px rowspan='2' style='text-align:left;vertical-align:middle'>NAMA MAHASISWA</th>
<th height=5px colspan='3' style='text-align:center;font-weight:bold;vertical-align:middle;'><b>Tugas</b></th>
<th height=5px rowspan='2' style='text-align:center;font-weight:bold;vertical-align:middle;'><b>Pres</b></th>
<th height=5px rowspan='2' style='text-align:center;font-weight:bold;vertical-align:middle;'><b>UTS</b></th>
<th  height=5px rowspan='2' style='text-align:center;font-weight:bold;vertical-align:middle;'><b>UAS</b></th>
<th height=5px colspan='2' style='text-align:center;font-weight:bold'><b>Nilai Akhir</b></th>
</tr>
<tr style=text-align:left;font-size:14px;color:#FFFFFF;font-weight:reguler;background-color:#3c8dbc;>
<th style='text-align:center;'>Tugas 1</th>
<th style='text-align:center;'>Tugas 2</th>
<th style='text-align:center;'>Tugas 3</th>
<th style='text-align:center;'>Nilai Akhir</th>
<th style='text-align:center;'>Grade Nilai</th>
</tr>
</thead>
<tbody>
    <?php $no=0; ?>
	@foreach ($krs as $row)
	<?php $no++; ?>
	<?php
	   	$NamaMhsx		= strtolower($row->NamaMhs); 
		$NamaMhs		= ucwords($NamaMhsx);
		$TempatLahirx	= strtolower($row->TempatLahir); 
		$TempatLahir	= ucwords($TempatLahirx);
	?>
		<tr>
		<input type="hidden" name="KRSID[]" value="{{ $row->KRSID }}"> 
		<input type="hidden" name="JadwalID[]" value="{{ $row->JadwalID }}"> 
        <input type="hidden" name="MhswID[]" value="{{ $row->MhswID }}">          
		<td style='text-align:right'>{{ $loop->index+1 }}</td>
		<td class="text-center">{{ $row->MhswID }}</td>
		<td class="text-left">{{ $NamaMhs }}</td>
		
		<td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="Tugas1[]" size="1" value="{{ $row->Tugas1 }}"></td>
			<td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="Tugas2[]" size="1" value="{{ $row->Tugas2 }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="Tugas3[]" size="1" value="{{ $row->Tugas3 }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="Presensi[]" size="1" value="{{ $row->Presensi }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="UTS[]" size="1" value="{{ $row->UTS }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="UAS[]" size="1" value="{{ $row->UAS }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="a" size="1" value="{{ $row->NilaiAkhir }}"></td>
            <td align=center><input type="text" style='width:60px; text-align:center; padding:0px' maxlength='3' name="b" size="1" value="{{ $row->GradeNilai }}"></td>
		</tr>
	@endforeach	
	<td colspan="4">
		<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
			Simpan Data</button>
			<a href="{{ asset('admin/jadwal') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
	</td>
	</tr>
	</tbody>
</table>
</form>
