 
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
    <i class="fa fa-print"></i> Filter Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>  
    <th style=width:60px;>No</th>                        				
    <th style=width:100px;>NIM</th>
    <th>Nama Mahasiswa</th>
    <th>Program</th>
    <th>Jumlah MK</th>
    <th>Total SKS</th>
    <th>IPS Lalu</th>
    <th>Aksi</th>   
    </tr>
</thead>
<tbody>
<?php 
if ($prodiplh=='SI'){
  $prd='07';
}else{
  $prd='08';
}	
$krstemp =DB::table('krstemp')
->join('mhsw','mhsw.MhswID','=','krstemp.MhswID')
->where(DB::raw('substr(krstemp.MhswID, 3, 2)'), '=' ,$prd)
->where('krstemp.TahunID',$tahunplh)
->distinct('krstemp.MhswID')
->orderBy('krstemp.MhswID','ASC')
->groupBy('krstemp.MhswID')
->get();

$no=0;
foreach ($krstemp as $r){
  $cek = DB::table('krs')->where('MhswID',$r->MhswID)->where('TahunID',$tahunplh)->count();
  if ($cek >0){
    $c="style=color:#666666";
  }else{
    $c="style=color:#FF6702";
  }
$no++;
$Namax 	= strtolower($r->Nama);
$Nama	= ucwords($Namax);
echo"<tr>
<td $c>$no</td>				
<td $c>$r->MhswID</td> 
<td $c>$Nama </td>
<td $c>$r->ProgramID</td>
<th $c></th>
<td $c></td>
<td $c></td>
<td $c><a href=''>Lihat KRS</a></td>
</tr>";
}
echo"</tbody>
</table>
</div>";
