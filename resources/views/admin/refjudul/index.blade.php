 
<div class="row">
<div class="col-md-5">
   
</div>
<div class="col-md-7">
   
</div>

</div>

<form action="{{ asset('admin/refjudul/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">

<div class="input-group mb-3 col-md-4">
    &nbsp;
</div>

<div class="input-group mb-3 col-md-8" >
<select name="tahun" class="form-control form-control-sm">
<option value="0">Pilih Tahun</option>
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
<option value="0">Pilih Prodi</option>
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
    <i class="fa fa-print"></i> Filter Data
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table class="table table-bordered table-sm" id="example1" width="100%" cellspacing="0">
<thead>
    <tr class="bg-dark" style='color:white'>
    <th  width="10px">No</th>					  					 
    <th width="40px"> NIM</th>
    <th width="150px">Mahasiswa</th> 
    <th width="400px">Judul</th>
    <th width="30px">Tahun</th>
    <th width="30px">Prodi</th>
    <th width="30px">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					
  $i=0;     
  if ($tahunplh!='' && $prodiplh!=''){
    $refjudul = DB::table('ta')
    ->join('mhsw','mhsw.MhswID','=','ta.MhswID')
    ->where('ta.ProdiID',$prodiplh)
    ->where('ta.TahunID',$tahunplh)
    ->orderBy('ta.MhswID','ASC')->get();                    
  }
  if ($tahunplh!='' && $prodiplh=='0'){
    $refjudul = DB::table('ta')
    ->join('mhsw','mhsw.MhswID','=','ta.MhswID')
    ->where('ta.TahunID',$tahunplh)
    ->orderBy('ta.MhswID','ASC')->get();                    
  }
  if ($tahunplh=='0' && $prodiplh!==''){
    $refjudul = DB::table('ta')
    ->join('mhsw','mhsw.MhswID','=','ta.MhswID')
    ->where('ta.ProdiID',$prodiplh)
    ->orderBy('ta.MhswID','ASC')->get();                    
  }
  if ($tahunplh=='0' && $prodiplh=='0'){
    $refjudul = DB::table('ta')
    ->join('mhsw','mhsw.MhswID','=','ta.MhswID')
    ->orderBy('ta.MhswID','ASC')->get();                                    
  }		

  foreach($refjudul as $refjudul) {
  $i++;
  $NamaMhsx = strtolower($refjudul->Nama);
  $NamaMhs	= ucwords($NamaMhsx);
  $Judulx   = strtolower($refjudul->Judul);
  $Judul	  = ucwords($Judulx);
?>

  <tr style='font-size:15px;'>  
    <td><?php echo $i ?></td>
    <td><?php echo $refjudul->MhswID ?></td>
    <td><?php echo $NamaMhs ?></td>
    <td><?php echo $Judul ?></td>
    <td><?php echo $refjudul->TahunID ?></td>
    <td><?php echo $refjudul->ProdiID ?></td>
    <td><a href=''>Detail</a></td>
  </tr>
  <?php  }//End looping?>

</tbody>
</table>
</div>
