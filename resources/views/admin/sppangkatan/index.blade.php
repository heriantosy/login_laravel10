
<form action="{{ asset('admin/sppangkatan/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">


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
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
      <th style='width:40px'>No</th>
			<th style='width:80px'>NIM</th>
			<th style='width:200px'>Nama Mahasiswa</th>
			<th style='text-align:center' colspan='9'>Tahun Akademik</th>		
     
    </tr>
</thead>
<tbody>

  <?php 
 $angkatan = substr($tahunplh,2,2); //20191
 $mhs = DB::table('mhsw')->where('ProdiID',$prodiplh)->where(DB::raw('substr(MhswID, 1, 2)'), '=' ,$angkatan)->orderBy('MhswID','ASC')->get();      
  $i=1;     
  foreach($mhs as $mhs) {
    $Namax 	    = strtolower($mhs->Nama);
    $Nama 		= ucwords($Namax);  
    echo"<tr style='font-size:15px;'>
    <td>$i</td>
    <td>$mhs->MhswID</td>
    <td>$Nama</td>";
    $spp = DB::table('keuangan_bayar')
    ->join('mhsw','mhsw.MhswID','=','keuangan_bayar.MhswID')
    ->select('keuangan_bayar.*','mhsw.Nama')
    ->where('mhsw.ProdiID',$prodiplh)
    ->where('keuangan_bayar.id_jenis','SPP')
    ->where('keuangan_bayar.MhswID',$mhs->MhswID)
    ->orderBy('keuangan_bayar.TahunID','ASC')
    ->get();
    foreach($spp as $spp) {
      if ($spp->total_bayar <1880000){
        $c="style=color:red";
      } else{
          $c="style=color:black";
      }
      echo"<td style='text-align:right'>$spp->TahunID<br><b $c>".number_format($spp->total_bayar)."</td>";
    }
    $i++;
    echo"</tr>";
  }
  echo"</tbody>
  </table>
  </div>";
