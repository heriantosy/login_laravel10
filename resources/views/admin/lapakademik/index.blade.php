 
<form action="{{ asset('admin/lapakademik/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
<div class="input-group mb-3 col-md-4">
</div>

<div class="input-group mb-3 col-md-8">
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
 $prodiplhok = str_replace(".","",$prodiplh);
 echo"<option value='0'>Semua Prodi</option>"; 
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
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>  
    <th style=width:60px;>No</th>                       				
    <th>Nama Laporan </th>
    <th>Keterangan</th>    
    </tr>
</thead>
<tbody>

  <?php 
if ($prodiplh!='' && $tahunplh!=''){
    if ($prodiplh=='SI'){
      $prd='07';
    }else{
      $prd='08';
    }
    //GROUP BY krstemp.MhswID"));
    //$jmlDf =0; $jmlKRSTemp =0; $jmlKRS =0;
    $jmlDf =DB::table('khs')->where('ProdiID',$prodiplh)->where('TahunID',$tahunplh)->count();
    $jmlKRSTemp =DB::table('krstemp')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where('TahunID',$tahunplh)->distinct('MhswID')->count(); 
    $jmlKRS =DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where('TahunID',$tahunplh)->distinct('MhswID')->count();
    //$jmlKRS =DB::table('khs')->where('ProdiID',$prodiplh)->where('StatusMhswID','A')->where('TahunID',$tahunplh)->count(); 
    $Selisih = $jmlKRSTemp - $jmlKRS;
}
if ($prodiplh=='0' && $tahunplh!=''){
    $jmlDf =DB::table('khs')->where('TahunID',$tahunplh)->distinct('MhswID')->count();
    $jmlKRSTemp =DB::table('krstemp')->where('TahunID',$tahunplh)->distinct('MhswID')->count(); 
    $jmlKRS =DB::table('krs')->where('TahunID',$tahunplh)->distinct('MhswID')->count(); 
    $Selisih = $jmlKRSTemp - $jmlKRS;
}	
//{{ asset('admin/matakuliah/edit/'.$matakuliah->MKID) }}
?>

<tr ><td>1</td><td><a href="{{ asset('admin/lapakademik/daftmhsterdaftarkrs/'.$tahunplh.'/'.$prodiplh) }}">Daftar Mahasiswa  Terdaftar KRS</a></td><td style='text-align:right'><b><?php echo $jmlDf ?> Orang</b></td></tr>
<tr><td>&nbsp;</td><td></td><td></td></tr>
<tr ><td>2</td><td><a href="{{ asset('admin/lapakademik/dafmhsisikrs/'.$tahunplh.'/'.$prodiplh) }}">Daftar Mahasiswa  Telah Mengisi KRS Belum Aktif</a></td><td style='text-align:right'><b><?php echo $jmlKRSTemp ?> Orang</b></td></tr>
<tr ><td>3</td><td><a href="{{ asset('admin/lapakademik/dafmhsisikrsaktif/'.$tahunplh.'/'.$prodiplh) }}">Daftar Mahasiswa  Telah Mengisi KRS Telah Aktif</a></td><td style='text-align:right'><b><?php echo $jmlKRS ?> Orang</b></td></tr>
<?php
echo"<tr ><td>&nbsp;</td><td style='text-align:right'><b>Jumlah Mahasiswa Belum Diaktifkan </b></td><td style='text-align:right'><b>$Selisih Orang</b></td></tr>";
echo"<tr ><td>4</td><td><a href=''>Daftar Pembayaran SPP</a></td><td>-</td></tr>";
echo"<tr ><td>5</td><td><a href=''>Daftar IPK Mahasiswa Per Angkatan</a></td><td>-</td></tr>";
echo"</tbody>
</table>
</div>";
