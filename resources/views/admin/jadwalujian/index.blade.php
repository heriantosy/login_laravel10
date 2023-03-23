<?php if($jadwalujian) { ?>  

<form action="{{ asset('admin/jadwalujian/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="form-group row ">
<label class="col-md-2 col-form-label text-md-right"><b style='color:purple'>JADWAL UJIAN</b></label>
        <div class="col-md-1">
      <?php
      echo"<select name='tahun' class='form-control form-control-sm'> "; 
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
      </div>

      <div class="col-md-2">
      <select name="program" class="form-control form-control-sm">
      <?php 
      foreach($program as $program) { ?>
        <option value="<?php echo $program->ProgramID ?>" 
          <?php if(isset($_POST['programplh']) && $_POST['programplh']==$program->ProgramID) { echo "selected"; }
                elseif(isset($_GET['programplh']) && $_GET['programplh']==$program->ProgramID) { echo 'selected'; }
                elseif($programplh==$program->ProgramID) { echo 'selected'; } ?>>
          <?php echo $program->Nama  ?>
        </option>
      <?php } ?>
      </select>
      </div>

      <div class="col-md-3">
      <select name="prodi" class="form-control form-control-sm">
      <?php 
      foreach($prodi as $prodi) { ?>
        <option value="<?php echo $prodi->ProdiID ?>" 
          <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
                elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
                elseif($prodiplh==$prodi->ProdiID) { echo 'selected'; } ?>>
          <?php echo $prodi->Nama  ?>
        </option>
      <?php } ?>
      </select>
      </div>

      <div class="col-md-1">
      <span class="input-group-append">
        <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
          <i class="fa fa-eye"></i> Lihat Data
        </button>
      </span>
      </div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white;height:5px;'> 
        <th width="8%">Tgl UTS</th>
        <th width="8%">Tgl UAS</th>    
        <th width="8%">Waktu</th>
        <th width="10%">Ruang</th>
       
        <th width="30%%">Matakuliah</th>
        <th width="10%">Kelas</th>
        <th width="5%">SKS</th>
        <th width="35%">Dosen</th>
        <th width="5%">JmlMhs</th>
        <th width="5%" style='text-align:right'>Pres</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php 
      $i=1;     
      foreach($jadwalujian as $jadwal) {
        $JadwalID   = $jadwal->JadwalID;
        $NamaDosenx = strtolower($jadwal->NamaDosen);
        $NamaDosen	= ucwords($NamaDosenx);
        $NamaMKx 		= strtolower($jadwal->NamaMK);
        $NamaMK	    = ucwords($NamaMKx);

        // $totmhstmp  = \DB::table('krstemp')->where('JadwalID',$jadwal->JadwalID)->count();
        // $totmhs     = \DB::table('krs')->where('JadwalID',$jadwal->JadwalID)->count();
        // $totpres    = \DB::table('presensi')->where('JadwalID',$jadwal->JadwalID)->count();
  ?>

  <tr style='font-size:15px;'>
    <td><?php echo date('d-m-Y', strtotime($jadwal->UTSTanggal)) ?></td>
    <td><?php echo date('d-m-Y', strtotime($jadwal->UASTanggal)) ?></td>
    <td><?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
    <td><?php echo $jadwal->NamaRuang ?></td>
    
    <td><a href="{{ asset('admin/jadwalujian/detail/'.$jadwal->JadwalID) }}"><?php echo $NamaMK ?></a></td>
    <td><a href="{{ asset('admin/jadwal/nilaidosen/'.$jadwal->JadwalID) }}"><?php echo $jadwal->NamaKelasx ?></a></td>
    <td><?php echo $jadwal->SKS ?></td>
    <td><?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?></td>
    <td style='text-align:right'><?php echo $jadwal->JumlahMhsw ?>/<?php echo $jadwal->Kapasitas ?></td>
    <td style='text-align:right'><a href="{{ asset('admin/absensi/createabsensi/'.$jadwal->JadwalID) }}"><?php echo 'tot' ?></a></td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/jadwalujian/edit/'.$jadwal->JadwalID) }}" ><i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwalujian/cetak_absensi_uts/'.$jadwal->JadwalID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwalujian/cetak_absensi_uas/'.$jadwal->JadwalID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwalujian/cetak_formnilai/'.$jadwal->JadwalID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/jadwalujian/delete/'.$jadwal->JadwalID) }}"><i class="fas fa-trash-alt"></i></a> &nbsp;
      </div>
    </td>
  </tr>

  <?php $i++; }//End looping?>
</tbody>
</table>
</div>


</form>

<?php }else{ ?>
<div class="alert alert-info">
  <p>Tidak ditemukan data</p>
</div>

<?php } ?>