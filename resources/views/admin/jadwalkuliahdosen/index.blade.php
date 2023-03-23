<?php if($jadwal) { ?>  
<form action="{{ asset('admin/jadwalkuliahdosen/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-3 col-md-4">
<?php
echo"<select class='form-control form-control-sm select2' name='DosenID'> 
<option value='0' selected>- Pilih Dosen -</option>"; 
foreach ($dosen as $a){
  if ($dosenplh == $a->Login){
	echo "<option value='$a->Login' selected>$a->Nama $a->Gelar</option>";
  }else{
	echo "<option value='$a->Login'>$a->Nama  $a->Gelar</option>";
  }
}
  echo "</select>";
?>
</div>

<div class="input-group mb-3 col-md-8">
<select style='height:38px' name="tahun" class="form-control form-control-sm ">
<?php foreach($tahun as $tahun) { ?>
  <option value="<?php echo $tahun->TahunID ?>" 
    <?php if(isset($_POST['tahunplh']) && $_POST['tahunplh']==$tahun->TahunID) { echo "selected"; }
          elseif(isset($_GET['tahunplh']) && $_GET['tahunplh']==$tahun->TahunID) { echo 'selected'; }
          elseif($tahunplh==$tahun->TahunID) { echo 'selected'; } ?>>
    <?php echo $tahun->TahunID  ?>
  </option>
<?php } ?>
</select>

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="6%">Hari</th>
        <th width="7%">Waktu</th>
        <th width="10%">Ruang</th>
        <th width="10%">Kode</th>
        <th width="35%">Matakuliah</th>
        <th width="11%">Kelas</th>
        <th width="5%" style="text-align:center">SKS</th>
     
        <th width="30%" style='text-align:left'>Prodi</th>
        <th width="5%">JmlMhs</th>
      
        <th width="5%">Aksi</th>     
    </tr>
</thead>
<tbody>

  <?php 					
       $i=0;        
       $HariID = -320; 
      foreach($jadwal as $jadwal) {
        // if ($HariID != $jadwal->HariID) {
        //   $HariID = $jadwal->HariID;
        //   echo "<tr style='background:purple;color:white'>
        //     <td class=ul1 colspan=11><b>$jadwal->NamaHari</b> </td>
        //     </tr>";   
        // }    
        $JadwalID = $jadwal->JadwalID;
        $NamaDosenx 		= strtolower($jadwal->NamaDosen);
        $NamaDosen	= ucwords($NamaDosenx);
        $NamaMKx 		= strtolower($jadwal->NamaMK);
        $NamaMK	= ucwords($NamaMKx);
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

  <tr style='font-size:15px;'>
    <td><?php echo $jadwal->NamaHari ?></td>
    <td><?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
    <td><?php echo $jadwal->RuangID ?></td>
    <td><?php echo $jadwal->MKKode ?></td>
    <td><a href="{{ asset('admin/jadwal/detail/'.$jadwal->JadwalID) }}"><?php echo $NamaMK ?></a></td>
    <td><a href="{{ asset('admin/jadwal/nilaidosen/'.$jadwal->JadwalID) }}"><?php echo $jadwal->NamaKelasx ?> - Nilai</a></td>
    <td style="text-align:center"><?php echo $jadwal->SKS ?></td>
  
    <td style='text-align:left'><?php echo $jadwal->NamaProdi ?></td>
    <td style='text-align:right'><?php echo $jadwal->JumlahMhsw ?>/<?php echo $jadwal->Kapasitas ?></td>
    

    <td>  
      <div class="btn-group">
        <!-- <a href="{{ asset('admin/jadwal/edit/'.$jadwal->JadwalID) }}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></a> -->
        <a href="{{ asset('admin/jadwalkuliahdosen/cetaknilaikelas_v/'.$jadwal->JadwalID) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i></a>
        <a href="{{ asset('admin/jadwal/delete/'.$jadwal->JadwalID) }}" class="btn btn-danger btn-sm delete-link"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
  </tr>

  <?php $i++; 
      }
  ?>
	
</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>