<?php if($matakuliah) { ?>  
<div class="row">

<?php
//include"tabmatakuliah.php";
?>
@include('admin/matakuliah/tabmatakuliah')
<div class="col-md-5">
    <form action="{{ asset('admin/matakuliah/cari') }}" method="get" accept-charset="utf-8">

    </form>
</div>
<div class="col-md-7">
</div>
</div>

<form action="{{ asset('admin/matakuliah/proses') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">

  </div>
<div class="input-group mb-3 col-md-8">

<select name="kurikulum" class="form-control form-control-sm">
<?php foreach($kurikulum as $kurikulum) { ?>
  <option value="<?php echo $kurikulum->KurikulumID ?>" 
    <?php if(isset($_POST['kurikulumplh']) && $_POST['kurikulumplh']==$kurikulum->KurikulumID) { echo "selected"; }
          elseif(isset($_GET['kurikulumplh']) && $_GET['kurikulumplh']==$kurikulum->KurikulumID) { echo 'selected'; }
          elseif($kurikulumplh==$kurikulum->KurikulumID) { echo 'selected'; } ?>>
    <?php echo $kurikulum->KurikulumID  ?> -  <?php echo $kurikulum->Nama  ?>
  </option>
<?php } ?>
</select>
&nbsp;
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
&nbsp;

<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Lihat Data
  </button>&nbsp;
  <a href="{{ asset('admin/matakuliah/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
		<i class="fa fa-plus"></i> Add
	</a>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white'>
     
        <th width="3%">No</th>
        <th width="8%">Kode</th>
        <th width="35%">Matakuliah</th>
        <th width="15%">Singkatan</th>
        <th width="10%">SKS</th>
        <th width="8%">Prodi</th>
        <th width="5%">Aksi</th>
     
    </tr>
</thead>
<tbody>
<?php 					
$semester =DB::table('semester')->where('ProdiID',$prodiplh)->orderBy('Semester')->get();
?>
@foreach($semester as $h)	
<?php
  echo"<tr class='bg-dark' style='color:white'><td colspan='11'><b>$h->Semester - $h->Nama</b></td></tr>";
      $i=0;   
      $matakuliah = DB::table('mk')
      ->join('kurikulum', 'kurikulum.KurikulumID', '=', 'mk.KurikulumID')
      ->select('mk.*', 'kurikulum.Nama as NamaKurikulum')
      ->where('mk.KurikulumID',$kurikulumplh)
      ->where('mk.ProdiID',$prodiplh)
      ->where('mk.Sesi',$h->Semester)
      ->orderBy('mk.Sesi','DESC')
      ->get();  

      $totsks=0;
      foreach($matakuliah as $matakuliah) {
      $i++;
?>
  <tr > 
    <td><?php echo $i ?></td>
    <td><?php echo $matakuliah->MKKode ?></td>
    <td><?php echo $matakuliah->Nama ?></td>
    <td><?php echo $matakuliah->Singkatan ?></td>
    <td><?php echo $matakuliah->SKS ?></td>
    <td><?php echo $matakuliah->ProdiID ?></td>
    <td>
      <div class="btn-group">
        <a href="{{ asset('admin/matakuliah/edit/'.$matakuliah->MKID) }}"> <i class="fa fa-edit"></i></a> &nbsp;
        <a href="{{ asset('admin/matakuliah/cetak/'.$matakuliah->MKID) }}" target="_blank"><i class="fa fa-print"></i></a> &nbsp;
        <a href="{{ asset('admin/matakuliah/delete/'.$matakuliah->MKID) }}"><i class="fas fa-trash-alt"></i></a>
      </div>
    </td>
  </tr>
  <?php $totsks += $matakuliah->SKS ?>
  
  <?php  }//End looping?>
  <tr><td colspan='5'><b>Total SKS</b></td><td><?php echo $totsks ?></td><td colspan='2'></td></tr>
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