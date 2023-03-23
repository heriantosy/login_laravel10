

<div class="row">
<div class="col-md-5">
</div>
<div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/kerjapraktekpro/proses_nilai') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-4">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-8" >
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


<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>
        <th width="3%" style='text-align:center'>No</th>
        <th width="8%" style='text-align:center'>NIM</th>
        <th width="40%">Nama</th>
        <th width="12%" style='text-align:center'>Nilai Penguji1</th>
        <th width="12%" style='text-align:center'>Nilai Penguji2</th>
        <th width="12%" style='text-align:center'>Nilai Penguji3</th>
        <th width="12%" style='text-align:center'>Angka</th>
        <th width="12%" style='text-align:center'>Huruf</th>
        <th width="12%">Proses</th>
    </tr>
</thead>
<tbody>
<?php 					

$i=0;    
$nilaikp = DB::table('jadwal_kp_anggota')
->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp_anggota.MhswID')
->join('jadwal_kp', 'jadwal_kp.JadwalID', '=', 'jadwal_kp_anggota.JadwalID')
->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
->where('jadwal_kp.TahunID',$tahunplh)
->where('jadwal_kp.ProdiID',$prodiplh)
->orderBy('jadwal_kp_anggota.MhswID','DESC')
->get(); 
foreach($nilaikp as $r) {
  $i++;
  $NamaMhsx = strtolower($r->NamaMhs);
  $NamaMhs	= ucwords($NamaMhsx);
  if ($r->NA=='Y'){
    $c="style=color:#666666";
  }else{
    $c="style=color:#FF6702";
  }	
    $nilai = number_format(($r->NilaiPengujiSidang1 + $r->NilaiPengujiSidang2 + $r->NilaiPengujiSidang3)/3,0);
    if ($nilai >= 85 AND $nilai <= 100){
              $huruf = "A";
              $bobot = "4";
    }
    elseif ($nilai >= 80 AND $nilai <= 84.99){
      $huruf = "A-";
      $bobot = "3.70";
    }
    elseif ($nilai >= 75 AND $nilai <= 79.99){
      $huruf = "B+";
      $bobot = "3.30";
    }
    elseif ($nilai >= 70 AND $nilai <= 74.99){
      $huruf = "B";
      $bobot = "3";
    }
    elseif ($nilai >= 65 AND $nilai <= 69.99){
      $huruf = "B-";
      $bobot = "2.70";
    }
    elseif ($nilai >= 60 AND $nilai <= 64.99){
      $huruf = "C+";
      $bobot = "2.30";
    }
    elseif ($nilai >= 55 AND $nilai <= 59.99){
      $huruf = "C";
      $bobot = "2";
    }
    elseif ($nilai >= 50 AND $nilai <= 54.99){
      $huruf = "C-";
      $bobot = "1.70";
    }
    elseif ($nilai >= 40 AND $nilai <= 49.99){
      $huruf = "D";
      $bobot = "1";
    }
    elseif ($nilai < 40){
      $huruf = "E";
      $bobot = "0";
    }
?>

  <tr style='font-size:15px;'>
   
    <td style='text-align:center'><?php echo $i ?></td>
    <td style='text-align:center'><?php echo $r->MhswID ?></td>
    <td><?php echo $NamaMhs ?></td>
    <td style='text-align:center'><?php echo $r->NilaiPengujiSidang1 ?></td>
    <td style='text-align:center'><?php echo $r->NilaiPengujiSidang2 ?></td>
    <td style='text-align:center'><?php echo $r->NilaiPengujiSidang3 ?></td>
    <td style='text-align:center'><?php echo $nilai ?></td>
    <td style='text-align:center'><?php echo $huruf ?></td>
    <td>     
      <div class="btn-group">
        <a href="{{ asset('admin/r/editfotomhs/'.$r->JadwalID) }}">Validasi</a>
      </div>
    </td>
  </tr>

  <?php  }?>

</tbody>
</table>
</div>


</form>

