<?php if($jadwal) { ?>  


<form action="{{ asset('admin/jadwal/filterjadwal') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<!-- <div class="row"> -->
<div class="form-group row ">
<label class="col-md-2 col-form-label text-md-right"><b style='color:purple'>JADWAL KULIAH</b></label>
	<div class="col-md-1">
            <?php
            echo"<select name='tahun' class='form-control form-control-sm' onChange='this.form.submit()'>"; 
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
            <?php
            echo"<select name='program' class='form-control form-control-sm' onChange='this.form.submit()'>"; 
            echo"<option value='0'>Pilih Program</option>"; //it should be 
            foreach ($program as $prg){
              if ($programplh == $prg->ProgramID){
                echo "<option value='$prg->ProgramID' selected>$prg->ProgramID</option>";
              }else{
                echo "<option value='$prg->ProgramID'>$prg->ProgramID</option>";
              }
            }
            echo "</select>";
            ?>    
        </div>  

        <div class="col-md-3">
        <?php 
        echo"<select name='prodi' class='form-control form-control-sm' onChange='this.form.submit()'>"; 
        echo"<option value='0' selected>Pilih Prodi</option>"; //it should be 
        foreach ($prodi as $prd){
          if ($prodiplh == $prd->ProdiID){
            echo "<option value='$prd->ProdiID' selected>$prd->Nama</option>";
          }else{
            echo "<option value='$prd->ProdiID'>$prd->Nama</option>";
          }
        }
        echo "</select>";
        ?>
        </div>

        <div class="col-md-1">
            <?php
            echo"<select name='hari' class='form-control form-control-sm'>"; 
            echo"<option value='' selected>Pilih Hari</option>"; //it should be 
            foreach ($hari as $hr){
              if ($hariplh == $hr->HariID){ //isset in order not error
                echo "<option value='$hr->HariID' selected>$hr->Nama</option>";
              }else{
                echo "<option value='$hr->HariID'>$hr->Nama</option>";
              }
            }
            echo "</select>";
            ?>
        </div> 

        <div class="col-md-1">
        <span class="input-group-append">
          <input type="text" class="form-control form-control-sm" name="semester" placeholder="Semester" size="6" value="<?php echo isset($semesterplh) ?>">
        </span>
        </div>

        	<div class="col-md-1">
        <span class="input-group-append">
          <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
            <i class="fa fa-eye"></i> Lihat
          </button>
        </span>
        </div>
</div>

<div class="table-responsive mailbox-messages">
<a href="{{ asset('admin/jadwal/labelujian/'.$tahunplh.'/'.$prodiplh) }}">[ ~~ Print Label Ujian ~~ ]</a>
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white;height:5px;'>
        <th width="2%">No</th>  
        <th width="2%">Hari</th>    
        <th width="10%">Waktu</th>
        <th width="10%">Ruang</th>
        <th width="8%">Kode</th>
        <th width="25%">Matakuliah</th>
        <th width="1%" align="center">Smt</th>
        <th width="10%">Kelas</th>
        <th width="1%" align="center">SKS</th>
        <th width="35%">Dosen</th>
        <th width="5%">JmlMhs</th>
      
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>

  <?php 
      $i=1;        
      $HariID = -320;          
      foreach($jadwal as $jadwal) {  
        if ($HariID != $jadwal->HariID) {
          $HariID = $jadwal->HariID;
          echo "<tr style='background:purple;color:white'>
            <td class=ul1 colspan=12><b>$jadwal->NamaHari</b> </td>
            </tr>";   
        }    
        $idx        = Crypt::encryptString($jadwal->JadwalID);
        $JadwalID   = $jadwal->JadwalID;
        $NamaDosenx = strtolower($jadwal->NamaDosen);
        $NamaDosen	= ucwords($NamaDosenx);
        $NamaMKx 		= strtolower($jadwal->NamaMK);
        $NamaMK	    = ucwords($NamaMKx);
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

  <tr height="6px">
    <td class="text-center" ><?php echo $i ?></td> 
    <td><?php echo $jadwal->NamaHari ?></td>
    <td><?php echo substr($jadwal->JamMulai,0,5) ?>-<?php echo substr($jadwal->JamSelesai,0,5) ?></td>
    <td><?php echo $jadwal->NamaRuang ?></td>
    <td><?php echo $jadwal->MKKode ?></td>
    <td><a href="{{ asset('admin/jadwal/detail/'.$jadwal->JadwalID) }}"><?php echo $NamaMK ?></a></td>
    <td><?php echo $jadwal->Sesi ?></td>
    <td><a href="{{ asset('admin/jadwal/nilaidosen/'.$jadwal->JadwalID) }}"><?php echo $jadwal->NamaKelasx ?></a></td>
    <td style='text-align:center'><?php echo $jadwal->SKS ?></td>
    <td><?php echo $NamaDosen ?>, <?php echo $jadwal->Gelar ?> <a href="{{ asset('admin/jadwal/cetakabsdos_v/'.$jadwal->JadwalID) }}" target="_blank">[ Abs ]</a></td>
    <td style='text-align:right'><?php echo $jadwal->JumlahMhsw ?> / <?php echo $jadwal->Kapasitas ?></td>
 

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

  <?php 
  $i++; 
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