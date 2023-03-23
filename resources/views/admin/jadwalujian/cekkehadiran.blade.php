

<form action="{{ asset('admin/jadwalujian/proseskehadiran') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}
<input type="hidden" name="pengalihan" value="{{ url()->full() }}">
<div class="row">
  <div class="input-group mb-3 col-md-4">
  </div>  
<div class="input-group mb-3 col-md-8">
<?php
//different way
echo"<select name='tahun' class='form-control form-control-sm' select2 "; 
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
<input type="text" class="form-control form-control-sm" name="MhswID" value="<?php echo $MhswIDplh ?>" placeholder="Cari..." required>


<span class="input-group-append">
  <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
    <i class="fa fa-eye"></i> Cek
  </button>
</span>
</div>

</div>
<div class="table-responsive mailbox-messages">
<table id="example1" class="table table-striped table-sm" cellspacing="0" width="100%">
<thead>
    <tr class="bg-dark" style='color:white;height:5px;'>     
        <th width="2%" style='text-align:center'>No</th>
        <th width="5%" style='text-align:center'>Kode</th>
        <th width="30%">Matakuliah</th>
        <th width="10%">Kelas</th>
		    <th width="5%" style='text-align:center'>Jumlah Hadir</th>
        <th width="5%" style='text-align:center'>Hadir</th>  
    </tr>
</thead>
<tbody>
<?php 
$pres = DB::table('presensimhsw')
		->join('jadwal', 'jadwal.JadwalID', '=', 'presensimhsw.JadwalID', 'LEFT OUTER')
		->select('presensimhsw.*', 'jadwal.Kehadiran','jadwal.MKKode', 'jadwal.Nama AS NamaMK',DB::raw('SUM(presensimhsw.Nilai) as JML'),
		'jadwal.NamaKelas','jadwal.JenisJadwalID','jadwal.TahunID')
		->where('jadwal.TahunID',$tahunplh)
		->where('presensimhsw.MhswID',$MhswIDplh)
		->groupBy('presensimhsw.JadwalID')
		->get();
$i=1;     
foreach($pres as $row) {
	$persen			= ($row->JML / $row->Kehadiran)* 100;
	$persentase		= number_format(($row->JML / $row->Kehadiran)* 100,0);	
?>
  <tr style='font-size:15px;'>
  <td style='text-align:center'><?php echo $i ?></td>
	<td style='text-align:center'><?php echo $row->MKKode ?></td>
	<td><?php echo $row->NamaMK ?></td>
	<td><?php echo $row->NamaKelas ?></td>
	<td style='text-align:center'><?php echo $row->JML ?> X</td>
	<td style='text-align:center'><?php echo $persentase ?> %</td>
  </tr>
<?php 
$i++; }
?>
</tbody>
</table>
</div>
</form>

