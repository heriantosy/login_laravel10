<script type="text/javascript" src="plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
	$('#container').highcharts({
		data: {
			table: 'datatable'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: ''
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: ''
			}
		},
		tooltip: {
			formatter: function () {
				return '<b> ' + this.series.name + '</b><br/>' +
					' ' + this.point.y + ' Orang';
			}
		}
	});
});
</script>




<div class="box-header">
<i class="fa fa-th-list"></i>
<h3 class="box-title"><b style=color:green;>Grafik PMB <b style=color:#FF8306;><?php echo" Seluruh Program Studi";?> dalam Beberapa Tahun</b>
<?php echo"<a href='index.php?ndelox=pmbmonitor&tahun=".date('Y')."'> <font style=font-size:12px>[Selengkapnya]</font> </a>"?>
</b></h3>
<p></p>
<div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
</div>
</div>

<div class="box-body chat" id="chat-box">
<script src="plugins/highchart/highcharts.js"></script>
<script src="plugins/highchart/modules/data.js"></script>
<script src="plugins/highchart/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style='display:none'>
<thead>
<tr>
    <th></th>
    <th>Reg Jalur A</th>
    <th>Transfer D3 Ke S1</th>
	<th>Non Reg B</th>
    <th>Pindahan</th>	
	<th>Total</th>
</tr>
</thead>
<tbody>
<?php 

//group by harus sama dengan kriteria where kemudian ambil tahun format yy
// $sqdata = mysqli_query($koneksi, "SELECT * FROM t_tahunnormal GROUP BY Tahun order by Tahun asc");	
// while ($r = mysqli_fetch_array($sqdata)){
// $GelRegA = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(PMBID) as Jumlah,ProdiID,PMBPeriodID,RegUlang 
// 									  FROM pmb 
// 									  WHERE Left(PMBPeriodID,4)='$r[Tahun]'
// 									  and ProgramID='REG A'
// 									  Group By pmb.ProgramID"));
									  
// $GelTransfer = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(PMBID) as Jumlah,ProdiID,PMBPeriodID,RegUlang 
// 									  FROM pmb 
// 									  WHERE Left(PMBPeriodID,4)='$r[Tahun]'
// 									  and ProgramID='TRANS'
// 									  Group By pmb.ProgramID"));


// $GelNREGB = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(PMBID) as Jumlah,ProdiID,PMBPeriodID,RegUlang 
// 									  FROM pmb 
// 									  WHERE Left(PMBPeriodID,4)='$r[Tahun]'
// 									  and ProgramID='NREG B'
// 									  Group By pmb.ProgramID"));	
// $GelPindahan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(PMBID) as Jumlah,ProdiID,PMBPeriodID,RegUlang 
// 									  FROM pmb 
// 									  WHERE Left(PMBPeriodID,4)='$r[Tahun]'
// 									  and ProgramID='PINDAHAN'
// 									  Group By pmb.ProgramID"));									  
// $Total = $GelRegA[Jumlah] + $GelTransfer[Jumlah] + $GelPindahan[Jumlah] + $GelNREGB[Jumlah];									  
			
    //balok grafik
	echo "<tr>
	<th>r[Tahun]</th>
    <th>GelRegA[Jumlah]</th>
    <th>GelTransfer[Jumlah]</th>	
	<th>GelNREGB[Jumlah]</th>
	<th >GelPindahan[Jumlah]</th>
	<th>Total</th>
	</tr>";
	//}
	?>
</tbody>
</table>

<table id="example" class="table table-bordered table-striped">
<thead>
<tr style='background:purple;color:white;font-weight:bold'>
  <th style='width:10px;text-align:center'>No</th>              
  <th style='width:150px;text-align:center'>Tahun Penerimaan Mahasiswa Baru</th>
  <th style='width:80px;text-align:right'>Jumlah</th>
  <th style='width:150px;text-align:right'>Selengkapnya</th>              
</tr>
</thead>
<tbody>
<?php

$tahun = DB::table('t_tahunnormal')->orderBy('Tahun','ASC')->get();
$nom=0;$total=0;
foreach ($tahun as $r){
	$nom++;
	$jml = DB::table('pmb')->where(DB::raw('substr(PMBPeriodID, 1, 4)'), '=' ,$r->Tahun)->count();	 	
	$total += $jml;
	echo "<tr>
	<td style='text-align:center'>$nom</td>            
	<td style='text-align:center'><a href=''>$r->Tahun</a></td>
	<td style='text-align:right'>$jml</td>
	<td style='text-align:right'><a href=''>Data PMB</a> 							
	</td>
	</tr>";
}
?>
<tbody>
<tr style='background:purple;color:white;font-weight:bold'>
  <th style='width:10px'></th>               
  <th style='width:20px'>Total</th>
  <th style='width:110px;text-align:right'><?php echo"".number_format($total)." Orang";?></th>  
  <th style='width:10px;text-align:right'><a href='?index.php&ndelox=pmbmonitor&act=grafikpmball&prodi=<?php echo"&tahun=".date('Y').""; ?>'>Grafik PMB All Prodi</a></th>              
</tr>
</table>