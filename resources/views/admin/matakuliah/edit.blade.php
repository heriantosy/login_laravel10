 
<form action="{{ asset('admin/matakuliah/edit_proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
@csrf
  
<?php
//start kolom 1
echo"<div class='row'>
    <div class='col-6'>"; //end

  echo"
  <table class='table table-sm table-borderless'>
  <tbody>
  <input type='hidden' name='MKID' value=$mk->MKID>
  <input type='hidden' name='ProdiID' value=$prodiplh>
  <input type='hidden' name='KurikulumID' value='$kurikulumplh'>
  <tr><th  scope='row' colspan='2' style='background-color:#E7EAEC'>STMIK HANG TUAH PEKANBARU</th></tr>                       
  <tr><th scope='row'>Kode Matakuliah</th> <td><input type='text' class='form-control form-control-sm' name='MKKode' value='$mk->MKKode'></td></tr>
  <tr><th scope='row'>Nama Matakuliah</th> <td><input type='text' class='form-control form-control-sm' name='Nama' value='$mk->Nama'></td></tr>   
  <tr><th scope='row'>Nama (Inggris) </th> <td><input type='text' class='form-control form-control-sm' name='Nama_en' value='$mk->Nama_en'></td></tr>
  <tr><th scope='row'>Singkatan</th> <td><input type='text' class='form-control form-control-sm' name='Singkatan' value='$mk->Singkatan'></td></tr> 
  <tr><th scope='row'>Jenis</th>          
  <td><select class='form-control form-control-sm' name='JenisMKID'> 
  <option value='0' selected>- Pilih Jenis Matakuliah -</option>"; 

foreach($status as $a){
  if ($mk->JenisMKID==$a->JenisMKID){
      echo "<option value='$a->JenisMKID' selected>$a->Nama</option>";
    }else{
     echo "<option value='$a->JenisMKID'>$a->Nama</option>";
  }
}
echo "</select></td></tr>  
<tr><th scope='row'>Pilihan Wajib</th>          
<td><select class='form-control form-control-sm' name='JenisPilihanID'> "; 
//$jn = DB::table('jenispilihan')->where('ProdiID',$prodiplh)->get();
foreach($jn as $a){
  if ($mk->JenisPilihanID==$a->JenisPilihanID){
    echo "<option value='$a->JenisPilihanID' selected>$a->Nama </option>";	
  }else{
    echo "<option value='$a->JenisPilihanID'>$a->Nama</option>";
  }	
}
echo "</select></td></tr> 
<tr><th scope='row'>Pilihan Kurikulum</th>          
<td><select class='form-control form-control-sm' name='JenisKurikulumID'> "; 
$jnskur = DB::table('jeniskurikulum')->where('ProdiID',$prodiplh)->get();
foreach($jnskur as $a){
  if ($mk->JenisKurikulumID==$a->JenisKurikulumID){
    echo "<option value='$a->JenisKurikulumID' selected> $a->Nama</option>";
  }else{
    echo "<option value='$a->JenisKurikulumID'>$a->Nama</option>";
  }
  }
echo "</select></td></tr> 



<tr><th scope='row'>Matakuliah Wajib?</th> <td>";

$NA = ($mk->Wajib == 'Y')? 'checked' : '';
echo"<input type=checkbox name='Wajib' value='Y' $NA>
</td></tr>


<tr><th scope='row'>Konsentrasi</th>          
<td><select class='form-control form-control-sm' name='KonsentrasiID'> "; 
$konsentrasi = DB::table('konsentrasi')->where('ProdiID',$prodiplh)->get();
foreach($konsentrasi as $a){
  if ($mk->KonsentrasiID==$a->KonsentrasiID){
  echo "<option value='$a->KonsentrasiID' selected> $a->Nama</option>";
  }else{
    echo "<option value='$a->KonsentrasiID'>$a->Nama</option>";
  }
}
echo "</select></td></tr>
<tr><th scope='row'>Sesi</th> <td><input type='text' class='form-control form-control-sm' name='Sesi' value='$mk->Sesi'></td></tr>

</tbody>
</table>";
//close kolom 1
echo"</div>";

//start kolom 2
echo "<div class='col-6'>  
<table class='table table-sm table-borderless'>
<tbody>

<tr><th  scope='row' colspan='2' style='background-color:#E7EAEC'>MORE..</th></tr>
<tr><th scope='row'>SKS</th> <td><input type='text' class='form-control form-control-sm' name='SKS' value='$mk->SKS'></td></tr>
<tr><th scope='row'> - SKS Tatap Muka</th> <td><input type='text' class='form-control form-control-sm' name='SKSTatapMuka' value='$mk->SKSTatapMuka'></td></tr>
<tr><th scope='row'> - SKS Praktikum</th> <td><input type='text' class='form-control form-control-sm' name='SKSPraktikum' value='$mk->SKSPraktikum'></td></tr>
<tr><th scope='row'> - SKS Praktek Lapangan</th> <td><input type='text' class='form-control form-control-sm' name='SKSPraktekLap' value='$mk->SKSPraktekLap'></td></tr>
<tr><th scope='row'>SKS Minimal</th> <td><input type='text' class='form-control form-control-sm' name='SKSMin' value='$mk->SKSMin'></td></tr>
<tr><th scope='row'>IPK Minimal </th> <td><input type='text' class='form-control form-control-sm' name='IPKMin' value='$mk->IPKMin'></td></tr>
<tr><th scope='row'>Penanggung Jawab</th>          
<td><select class='form-control form-control-sm' name='Penanggungjawab'> "; 
$dosen = DB::table('dosen')->where('NA','N')->get();
foreach($dosen as $a){
  if ($mk->Penanggungjawab==$a->Login){
	  echo "<option value='$a->Login' selected>$a->Nama</option>";
  }else{
    echo "<option value='$a->Login'>$a->Nama</option>";
  }
}  
echo "</select></td></tr>
<tr><th scope='row'>Keterangan </th> <td><input type='text' class='form-control form-control-sm' name='Deskripsi' value='$mk->Deskripsi'></td></tr>
<tr>
<th scope='row'>Aktif </th><td>"; 
if ($mk->NA=='N'){ 
    echo "<input type='radio' name='NA' value='N' checked> Ya &nbsp; 
          <input type='radio' name='NA' value='Y'> Tidak"; 
}else{ 
    echo "<input type='radio' name='NA' value='N'> Ya &nbsp; 
          <input type='radio' name='NA' value='Y' checked> Tidak"; 
} 
echo "</td>
</tr>
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

