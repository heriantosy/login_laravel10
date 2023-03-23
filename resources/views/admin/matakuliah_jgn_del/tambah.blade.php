 
<form action="{{ asset('admin/matakuliah/tambah_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end

  echo"
  <table class='table table-sm table-borderless'>
  <tbody>
  <input type='hidden' name='ProdiID' value=$prodiplh>
  <input type='hidden' name='KurikulumID' value='$kurikulumplh'>
  <tr><th  scope='row' colspan='2' style='background-color:#E7EAEC'>STMIK HANG TUAH PEKANBARU</th></tr>                       
<tr><th scope='row'>Kode Matakuliah</th> <td><input type='text' class='form-control form-control-sm' name='MKKode' ></td></tr>
<tr><th scope='row'>Nama Matakuliah</th> <td><input type='text' class='form-control form-control-sm' name='Nama' ></td></tr>   
<tr><th scope='row'>Nama (Inggris) </th> <td><input type='text' class='form-control form-control-sm' name='Nama_en' ></td></tr>
<tr><th scope='row'>Singkatan</th> <td><input type='text' class='form-control form-control-sm' name='Singkatan' ></td></tr> 
<tr><th scope='row'>Jenis</th>          
<td><select class='form-control form-control-sm' name='JenisMKID'> 
<option value='0' selected>- Pilih Jenis Matakuliah -</option>"; 
$status = DB::table('jenismk')->where('ProdiID',$prodiplh)->get();
foreach($status as $a){
	echo "<option value='$a->JenisMKID'>$a->Singkatan - $a->Nama</option>";
}
echo "</select></td></tr>  
<tr><th scope='row'>Pilihan Wajib</th>          
<td><select class='form-control form-control-sm' name='JenisPilihanID'> "; 
$jn = DB::table('jenispilihan')->where('ProdiID',$prodiplh)->get();
foreach($jn as $a){
	echo "<option value='$a->JenisPilihanID'>$a->Singkatan - $a->Nama </option>";		
}
echo "</select></td></tr> 
<tr><th scope='row'>Pilihan Kurikulum</th>          
<td><select class='form-control form-control-sm' name='JenisKurikulumID'> "; 
$status = DB::table('jeniskurikulum')->where('ProdiID',$prodiplh)->get();
foreach($status as $a){
	echo "<option value='$a->JenisKurikulumID'>$a->Singkatan - $a->Nama</option>";
}
echo "</select></td></tr> 
<tr><th scope='row'>Matakuliah Wajib?</th> <td>";
echo"<input type=checkbox name='Wajib' value='Y'>";

echo"</td></tr>
<tr><th scope='row'>Konsentrasi</th>          
<td><select class='form-control form-control-sm' name='KonsentrasiID'> "; 
$status = DB::table('konsentrasi')->get();
foreach($status as $a){
	echo "<option value='$a->KonsentrasiKode'> $a->KonsentrasiKode - $a->Nama</option>";
}
echo "</select></td></tr>
<tr><th scope='row'>Sesi</th> <td><input type='text' class='form-control form-control-sm' name='Sesi' ></td></tr>

</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<table class='table table-sm table-borderless'>
<tbody>

<tr><th  scope='row' colspan='2' style='background-color:#E7EAEC'>MORE..</th></tr>
<tr><th scope='row'>SKS</th> <td><input type='text' class='form-control form-control-sm' name='SKS' ></td></tr>
<tr><th scope='row'> - SKS Tatap Muka</th> <td><input type='text' class='form-control form-control-sm' name='SKSTatapMuka' ></td></tr>
<tr><th scope='row'> - SKS Praktikum</th> <td><input type='text' class='form-control form-control-sm' name='SKSPraktikum' ></td></tr>
<tr><th scope='row'> - SKS Praktek Lapangan</th> <td><input type='text' class='form-control form-control-sm' name='SKSPraktekLap' ></td></tr>
<tr><th scope='row'>SKS Minimal</th> <td><input type='text' class='form-control form-control-sm' name='SKSMin' ></td></tr>
<tr><th scope='row'>IPK Minimal </th> <td><input type='text' class='form-control form-control-sm' name='IPKMin' ></td></tr>
<tr><th scope='row'>Penanggung Jawab</th>          
<td><select class='form-control form-control-sm' name='Penanggungjawab'> "; 
$ds = DB::table('dosen')->where('NA','N')->get();
foreach($ds as $a){
	echo "<option value='$a->Login'>$a->Nama</option>";
}
echo "</select></td></tr>
<tr><th scope='row'>Keterangan </th> <td><input type='text' class='form-control form-control-sm' name='Deskripsi' ></td></tr>
<tr><th scope='row'>Aktif</th><td>";
echo "<input type='radio' name='at' value='N' checked> Ya 
      <input type='radio' name='at' value='Y'> Tidak";
echo "</td></tr>
</tbody>
</table>";
?>
<?php
echo"
<div class='card-footer'>
<button type='submit' name='submit' class='btn btn-info btn-sm'>Simpan</button>&nbsp;";
?>
<a href="{{ asset('admin/matakuliah') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Back
</a>
<?php
echo"</div>
</form>";

//tutup kolom 2
echo"</div>";

?>

