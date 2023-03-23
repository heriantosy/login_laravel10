<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/plugins/jQuery/jquery.min.js"></script>
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
                    return '<b>' + this.series.name + '</b><br/>' +
                        'Ada ' + this.point.y + ' Orang';
                }
            }
        });
    });
</script>


  
<div class="card">
<div class="card-header">
<div class="card-tools">
<a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_agenda'>Tambahkan Data</a>
</div>
  <?php
  if ($prodi=='SI'){
    $prd="Sistem Informasi";
  }
  elseif ($prodi=='TI'){
    $prd="Teknik Informatika";
  }
  elseif ($prodi=='All'){
    $prd="Seluruh Program Studi";
  }
  ?>

<div class="form-group row">
<label class="col-md-9 col-form-label text-md-right"><b style='color:purple;font-size:20px'>Angka Penerimaan Mahasiswa Baru </b><b style='color:#FF8306;font-size:20px'><?php echo"$prd";?></b></label>
<div class="col-md-2">
      <?php
            $attributes = array('class'=>'form-horizontal','role'=>'form');
            echo form_open_multipart($this->uri->segment(1).'/angkamahasiswa',$attributes); 
    
          echo"<select name='prodi' class='form-control'>";
          echo "<option value=''>Pililh Prodi</option>";
          echo "<option value='All'>Seluruh Program Studi</option>";
          $recx = $this->db->query("select * from prodi order by Nama asc");
          foreach ($recx->result_array() as $r){  
              if ($prodi == $r['ProdiID']){
                echo "<option value='$r[ProdiID]' selected>$r[Nama]</option>";
              }else{
                echo "<option value='$r[ProdiID]'>$r[Nama]</option>";
              }
          }
          echo"</select>";
          ?>
    </div>                 
    
    <div class="col-md-1">
      <?php
          echo"<input class='pull-right btn btn-primary btn-sm' type='submit' value='Lihat Data'>";
          echo"</form>";
      ?>
    </div>
    </div>
</div>

<?php
if ($prodi=='SI'){
  $prd="Sistem Informasi";
}
elseif ($prodi=='TI'){
  $prd="Teknik Informatika";
}
elseif ($prodi=='All'){
  $prd="Secara Keseluruhan";
}
?>
    <div class="card-header">
        <h3 class="card-title">Grafik Angka Mahasiswa Program Studi <?php echo"<b style='color:purple'>$prd</b>";?></h3>
    </div>

<div class="card-body chat" id="chat-card">
<div id="container" style="min-width: 310px; height: 205px; margin: 0 auto"></div>
<table id="datatable" style='display:none'>
<thead>
<tr>
    <th></th>
    <th>Reguler</th>
    <th>Transfer</th>
    <th>Pindahan</th>
    <th>Total</th> 
</tr>
</thead>
<tbody>
    <?php 
$grafik = $this->db->query("SELECT * FROM t_tahunx GROUP BY Tahun order by Tahun ASC");	
foreach($grafik->result_array() as $r){
if ($prodi=='SI'){	
	$reg =$this->db->query("SELECT count(MhswID) as JumReg,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='1'")->row_array(); //1 reguler
	$tra =$this->db->query("SELECT count(MhswID) as JumTra,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='2'")->row_array(); //2 transfer
	$tra2 =$this->db->query("SELECT count(MhswID) as JumTra2,ProdiID,TahunID 
										  FROM mhsw 
										  WHERE ProdiID='$prodi' 
										  AND LEFT(MhswID,2)='$r[Tahun]' 
										  AND SUBSTR(MhswID,5,1)='5'")->row_array(); //5 transfer kode lama	
	//tranfer nim lama + nim baru
	$tranfer = $tra[JumTra] + $tra2[JumTra2];	
	
	$pin =$this->db->query("SELECT count(MhswID) as JumPin,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='3'")->row_array(); //3 pindahan									   
	$tot =$this->db->query("SELECT count(MhswID) as JumTot,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]'")->row_array();
	
	}
else if ($prodi=='TI'){
	$reg =$this->db->query("SELECT count(MhswID) as JumReg,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='1'")->row_array(); //1 reguler
	$tra =$this->db->query("SELECT count(MhswID) as JumTra,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='2'")->row_array(); //2 transfer
	$tra2 =$this->db->query("SELECT count(MhswID) as JumTra2,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='5'")->row_array(); //5 transfer kode lama	
	//tranfer nim lama + nim baru
	$tranfer = $tra[JumTra] + $tra2[JumTra2];
	
	$pin =$this->db->query("SELECT count(MhswID) as JumPin,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='3'")->row_array(); //3 pindahan									   
	$tot =$this->db->query("SELECT count(MhswID) as JumTot,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE ProdiID='$prodi' 
								  AND LEFT(MhswID,2)='$r[Tahun]'")->row_array();
}//tutup TI
else if ($prodi=='All'){
	$reg =$this->db->query("SELECT count(MhswID) as JumReg,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='1'")->row_array(); //1 reguler
	$tra =$this->db->query("SELECT count(MhswID) as JumTra,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='2'")->row_array(); //2 transfer
	$tra2 =$this->db->query("SELECT count(MhswID) as JumTra2,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='5'")->row_array(); //5 transfer kode lama	
	//tranfer nim lama + nim baru
	$tranfer = $tra[JumTra] + $tra2[JumTra2];
	
	$pin =$this->db->query("SELECT count(MhswID) as JumPin,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE LEFT(MhswID,2)='$r[Tahun]' 
								  AND SUBSTR(MhswID,5,1)='3'")->row_array(); //3 pindahan									   
	$tot =$this->db->query("SELECT count(MhswID) as JumTot,ProdiID,TahunID 
								  FROM mhsw 
								  WHERE LEFT(MhswID,2)='$r[Tahun]'")->row_array();
} //Tutup All
		
	if ($r[Tahun]=='10'){
	$tahunx="2010";
	}
	if ($r[Tahun]=='11'){
	$tahunx="2011";
	}
	elseif ($r[Tahun]=='12'){
	$tahunx="2012";
	}
	elseif ($r[Tahun]=='13'){
	$tahunx="2013";
	}
	elseif ($r[Tahun]=='14'){
	$tahunx="2014";
	}
	elseif ($r[Tahun]=='15'){
	$tahunx="2015";
	}
	elseif ($r[Tahun]=='16'){
	$tahunx="2016";
	}
	elseif ($r[Tahun]=='17'){
	$tahunx="2017";
	}
	elseif ($r[Tahun]=='18'){
	$tahunx="2018";
	}
	elseif ($r[Tahun]=='19'){
	$tahunx="2019";
	}
	elseif ($r[Tahun]=='20'){
	$tahunx="2020";
  }	
  echo "<tr>
	<th>$tahunx</th>
	<td>$reg[JumReg]</td>
	<td>$tranfer</td>
	<td>$pin[JumPin]</td>
	<td>$tot[JumTot]</td>
	</tr>";
	}
    ?>
</tbody>
</table>
</div>
</div>