@include('admin/dosen/tabdosen')

<div class="row">
<div class="col-md-12">
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr class="bg-dark" style='color:white'>
    <th width="3%">No</th>
    <th width="5%">Tahun</th>
    <th width="5%">Kode</th>
    <th width="30%%">Matakuliah</th>
    <th width="3%">SKS</th>
    <th width="8%">Kelas</th>
    <th width="5%">Hari</th>
    <th width="25%">Waktu</th>  
</tr>
</thead>
<tbody>
<?php 					
  $i=0; 
  $jadwal = DB::table('jadwal')
    ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
    ->join('mk', 'mk.MKID', '=', 'jadwal.MKID')
    ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
    ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
    ->where('jadwal.DosenID',$loginplh)
    ->orderBy('jadwal.TahunID','DESC')        
    ->get();     
foreach($jadwal as $jadwal) {
$i++;    
?>
<tr style='font-size:15px;'>
    <td><?php echo $i ?></td>
    <td><?php echo $jadwal->TahunID ?></td>
    <td><?php echo $jadwal->MKKode ?></td>
    <td><?php echo $jadwal->NamaMK ?></td>
    <td><?php echo $jadwal->SKS ?></td>
    <td><?php echo $jadwal->NamaKelas ?></td>
    <td><?php echo $jadwal->NamaHari ?></td>
    <td><?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
  </tr>

  <?php  }//End looping?>

</tbody>
</table>
</div>
</div>
</div>

