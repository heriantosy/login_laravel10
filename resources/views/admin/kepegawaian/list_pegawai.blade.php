<?php if($jadwal) { ?>  


<form action="{{ asset('admin/jadwal/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-2 col-md-4">
  <?php
  
  ?>
    <a href="{{ asset('admin/jadwal/tambah/'.$tahunplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	  </a>
    &nbsp;
    <span class="input-group-append">
      <button class="btn btn-danger btn-sm btn-flat" type="submit" name="hapus" onClick="check();" >
        <i class="fas fa-trash-alt"></i>
      </button>
    </span>
    <select name="status_aktif" class="form-control form-control-sm">
      <option value="N">Aktif</option>
      <option value="Y">Tidak Aktif</option>
    </select> 
    <span class="input-group-append">
      <button class="btn btn-success btn-sm" type="submit" name="status" value="status">
        <i class="fa fa-save"></i> Update 
      </button>&nbsp;
    </span>


  </div>
  
<div class="input-group mb-2 col-md-8">
<?php
//different way
echo"<select name='tahun' class='form-control form-control-sm' select2 "; 
echo"<option value='0'>Pilih Tahun</option>"; //it should be 
foreach ($tahun as $th){
  if ($tahunplh == $th->TahunID){
	   echo "<option value='$th->TahunID' selected>$th->TahunID</option>";
  }else{
	   echo "<option value='$th->TahunID'>$th->TahunID</option>";
  }
}
echo "</select>";
?>

<select name="prodi" class="form-control form-control-sm  ">
<?php 
 $prodiplhok = str_replace(".","",$prodiplh);
foreach($prodi as $prodi) { ?>
  <option value="<?php echo $prodi->ProdiID ?>" 
    <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
          elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
          elseif($prodiplhok==$prodi->ProdiID) { echo 'selected'; } ?>>
    <?php echo $prodi->Nama  ?>
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
<a href="{{ asset('admin/jadwal/labelujian/'.$tahunplh.'/'.$prodiplh) }}">[ ~~ Print Label Ujian ~~ ]</a>
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white;height:5px;'>
        <th width="5%" height=5px>
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th>
       
        <th width="11%">Waktu</th>
        <th width="5%">Ruang</th>
        <th width="5%">Kode</th>
        <th width="30%%">Matakuliah</th>
        <th width="8%">Kelas</th>
        <th width="5%">SKS</th>
        <th width="25%">Dosen</th>
        <th width="5%">JmlMhs</th>
        <th width="5%" style='text-align:right'>Pres</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php 
					
  $hari=DB::table('hari')
  ->whereNotIn('HariID',[0])	
  ->orderBy('HariID')
  ->get();
  ?>
  @foreach($hari as $h)	
  <?php
  $HariID 	= $h->HariID;
  $Nama 		= $h->Nama;

   echo"<tr class='bg-dark' style='color:white'><td colspan='11'><b>$h->Nama</b></td></tr>";  
          $jadwal = DB::table('jadwal')
          ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
          ->join('mk', 'mk.MKID', '=', 'jadwal.MKID','LEFT')
          ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
          ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
          ->where('jadwal.TahunID',$tahunplh)
          ->where('jadwal.ProdiID',$prodiplh)
          ->where('jadwal.HariID',$HariID)
          ->orderBy('jadwal.HariID','ASC')
          ->orderBy('jadwal.JamMulai','ASC')
          ->paginate(100);
      $i=1;     
      foreach($jadwal as $jadwal) {
        $idx = Crypt::encryptString($jadwal->JadwalID);
        $JadwalID = $jadwal->JadwalID;
        $NamaDosenx 		= strtolower($jadwal->NamaDosen);
        $NamaDosen	= ucwords($NamaDosenx);
        $NamaMKx 		= strtolower($jadwal->NamaMK);
        $NamaMK	= ucwords($NamaMKx);
        $totmhstmp = \DB::table('krstemp')
        ->where('JadwalID',$jadwal->JadwalID)
        ->count();
        $totmhs = \DB::table('krs')
        ->where('JadwalID',$jadwal->JadwalID)
        ->count();
        $totpres = \DB::table('presensi')
        ->where('JadwalID',$jadwal->JadwalID)
        ->count();
  ?>

  <tr height="6px">
    <td class="text-center" >
        <div >
            <input type="checkbox" name="JadwalID[]" value="<?php echo $jadwal->JadwalID ?>" id="check<?php echo $i ?>">
            <label for="check<?php echo $i ?>"></label>
        </div>
    </td>
   
    <td><?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
    <td><?php echo $jadwal->RuangID ?></td>
    <td><?php echo $jadwal->MKKode ?></td>
    <td><a href="{{ asset('admin/jadwal/detail/'.$jadwal->JadwalID) }}"><?php echo $NamaMK ?></a></td>
    <td><a href="{{ asset('admin/jadwal/nilaidosen/'.$jadwal->JadwalID) }}"><?php echo $jadwal->NamaKelas ?></a></td>
    <td><?php echo $jadwal->SKS ?></td>
    <td><?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?> <a href="{{ asset('admin/jadwal/cetakabsdos_v/'.$jadwal->JadwalID) }}" target="_blank">[ Abs ]</a></td>
    <td style='text-align:right'><?php echo $totmhstmp ?>/<?php echo $totmhs ?></td>
    <td style='text-align:right'><a href="{{ asset('admin/absensi/createabsensi/'.$jadwal->JadwalID) }}"><?php echo $totpres ?></a></td>

    <td>

     
      <div class="btn-group">
        <a href="{{ asset('admin/jadwal/edit/'.$jadwal->JadwalID) }}" ><i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwal/print_absensi/'.$idx) }}" title="Cetak Absensi"  target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwal/cetak_formnilai/'.$jadwal->JadwalID) }}" title="Cetak Form Nilai"  target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwal/cetaknilaikelas_v/'.$jadwal->JadwalID) }}" title="Cetak Nilai Kelas"  target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwal/delete/'.$jadwal->JadwalID) }}" onclick="return confirm('Yakin data akan dihapus ?')"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
  </tr>

  <?php $i++; }//End looping?>
	@endforeach
</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>