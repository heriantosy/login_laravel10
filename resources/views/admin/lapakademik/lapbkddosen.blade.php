 
<form action="{{ asset('admin/lapakademik/prosesbkd') }}" method="post" accept-charset="utf-8">
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
    <th style='width:40px'>No</th>
			<th style='width:80px'>NIDN/DosenID</th>
			<th style='width:300px'>Nama Dosen</th>
			<th style='text-align:center;width:40px'>Mengajar (SKS)</th>
			<th style='text-align:center;width:40px'>Membimbing <br>KP</th>
			<th style='text-align:center;width:40px'>Membimbing <br>Skripsi</th>	
			<th style='text-align:center;width:40px'>Menguji <br>Skripsi 3</th>
    </tr>
</thead>
<tbody>
<?php 
$prodix = str_replace('.','',$prodiplh);
$dosen =DB::table('dosen')
->whereNotIn('Noreg',['-'])
->get();

$no=0;
foreach ($dosen as $r){

$no++;
$Namax 	= strtolower($r->Nama);
$Nama	= ucwords($Namax);
$tsks		= DB::table('jadwal')->where('DosenID',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodiplh)
->count();

$jmlKP		= DB::table('jadwal_kp')->where('DosenID',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();
$jmlUtama		= DB::table('jadwal_skripsi')->where('PembimbingSkripsi1',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();
$jmlPendamping		= DB::table('jadwal_skripsi')->where('PembimbingSkripsi2',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();
$jmlBimbing		= $jmlUtama + $jmlPendamping;

$jmlMenguji1		= DB::table('jadwal_skripsi')->where('PengujiPro1',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();
$jmlMenguji2		= DB::table('jadwal_skripsi')->where('PengujiPro2',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();
$jmlMenguji3		= DB::table('jadwal_skripsi')->where('PengujiPro3',$r->Login)->where('TahunID',$tahunplh)->where('ProdiID',$prodix)->count();

$jmlMengujix    = $jmlMenguji1 + $jmlMenguji2 + $jmlMenguji3;

echo "<tr >
      <td>$no</td>
      <td><a href='' target=_BLANK>$r->Login</a></td>
      <td>$Nama, $r->Gelar</td>
      <td align=center>$tsks</td>
      <td align=center>$jmlKP</td>
      <td align=center>$jmlBimbing</td>
       <td align=center>$jmlMenguji3</td>	  
		</tr>";
}
echo"</tbody>
</table>
</div>";
