<div class="row">

<div class="col-md-12 ">

    <form action="{{ asset('admin/matakuliah/proses') }}" method="post" accept-charset="utf-8">
      {{ csrf_field() }}
    <input type="hidden" name="pengalihan" value="{{ url()->full() }}"><div class="row">
    <!-- mb spasi -->
    <div class="input-group mb-3 col-md-6">    
    <select name="prodi" class="form-control form-control-sm" >
    <?php 
    foreach($prodi as $prodi) { ?>
      <option value="<?php echo $prodi->ProdiID ?>" 
        <?php if(isset($_POST['prodiplh']) && $_POST['prodiplh']==$prodi->ProdiID) { echo "selected"; }
              elseif(isset($_GET['prodiplh']) && $_GET['prodiplh']==$prodi->ProdiID) { echo 'selected'; }
              elseif($prodiplh==$prodi->ProdiID) { echo 'selected'; } ?>>
        <?php echo $prodi->Nama  ?>
      </option>
    <?php } // onChange='this.form.submit()'?>
    </select>
    &nbsp;
    <span class="input-group-append">
      <button class="btn btn-info btn-sm" type="submit" name="filter" value="Filter">
        <i class="fa fa-eye"></i> Lihat Data
      </button>
    </span>
    &nbsp;
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
      <a href="{{ asset('admin/matakuliah/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i> Add
      </a>
</div>
</form>



<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>


<div class="col-xs-12">  
<div class="box">
<div class="box-header">   
<?php
  $arrKurid =\DB::table('kurikulum')->where('KurikulumID',$kurikulumplh)->first();
  $mx   = \DB::table('mk')->orderBy('KurikulumID', 'desc')->first(); //cari nilai max
  //cari lain 
  //$totAll = DB::table('mk')->where('KurikulumID', '=', $kurikulumplh)->max('SKS');

  // Tampilkan
  $arrKurid->JmlSesi = ($arrKurid->JmlSesi == 0)? 1 : $arrKurid->JmlSesi;
  $lebar = 100 / $arrKurid->JmlSesi;
  $mxx = $mx->Sesi;
  $mxx = 6;

  echo "<p><table class=bsc width=100% cellspacing=1 cellpadding=4>";
  for ($i=1; $i<=$mxx; $i++) {
    //$col++;
    if ($i % $arrKurid->JmlSesi == 1) echo "<tr>";
    echo "<td valign=top width=$lebar%>";
	// $s = "select  mk.*, kons.KonsentrasiKode, kons.Nama as KONS
	// 	from mk as mk	
	// 	left outer join konsentrasi kons on mk.KonsentrasiID=kons.KonsentrasiID
	// 	where mk.ProdiID='$prodi' 
	// 	and mk.Sesi='$i'
	// 	and mk.KurikulumID='$kurikulum' 
	// 	order by kons.KonsentrasiKode, mk.MKKode";
	// $record = DB::table($s)->get();
  $matakuliah = \DB::table('mk')
  ->join('konsentrasi', 'konsentrasi.KonsentrasiID', '=', 'mk.KonsentrasiID','LEFT') //must be left
  ->select('mk.*', 'konsentrasi.KonsentrasiKode','konsentrasi.Nama as KONS')
  ->where('mk.KurikulumID',$kurikulumplh)
  ->where('mk.ProdiID',$prodiplh)
  ->where('mk.Sesi',$i)
  ->orderBy('konsentrasi.KonsentrasiKode','DESC')
  ->get();
	$nom = 0;
	$tot = 0;
	$kons = 0;
	echo "<p><table  cellspacing=1 cellpadding=4 width=100%>";
	echo "<tr><td colspan=4><b>$arrKurid->Sesi: &nbsp;$i</b></td></tr>";
	echo "<tr style='background:purple;color:white;height:30px'>
	  <th class=ttl style='width:30px;text-align:center;height:20px'>NO</th>
	  <th class=ttl style='width:80px;text-align:center'>KODE</th>
	  <th class=ttl style='width:480px;text-align:left'>NAMA MATAKULIAH</th>
	 
	  <th class=ttl style='width:30px;text-align:center'>SKS</th>
	  <th class=ttl title='Prasyarat' style='width:50px;text-align:center'>AKSI</th>
	  <th class=ttl title='Prasyarat' style='width:70px;text-align:center'>PRA</th>
	  <th style='background:white'>&nbsp;</th></tr>";
    foreach($matakuliah as $w) {
		if ($kons != $w->KonsentrasiID) {
			$kons = $w->KonsentrasiID;
			echo "<tr style='background:#efe6eb;font-size:14px'><td colspan=4 class=inp1>$w->KonsentrasiKode - <b>$w->KONS</td></tr>";
		  }
		  //$n++;
		  $tot += $w->SKS;
		  $c = ($w->NA == 'Y')? 'class=nac' : 'class=ul';
		  $wjb = ($w->Wajib == 'Y')? "<font color=red title='Wajib'>*</font>" : '&nbsp;';
	  $nom++;
	  echo "<tr style='font-size:13px'>
	    <td $c style='text-align:center;height:25px'>$nom</td>
		<td $c style='text-align:center;'>$w->MKKode</a></td>
		<td $c>$w->Nama $wjb</td>
		<td $c align=center>$w->SKS</td>
		<td $c align=center>";
    ?>
    <a href="{{ asset('admin/matakuliah/edit/'.$w->MKID) }}"><span class='nav-icon fas fa-edit'></span></a>
    <?php
    echo"</td>
		<td $c align=center><a href=''><span class='nav-icon fas fa-edit'></span></a></td>
		<td style='background:white'>&nbsp;</td>
		</tr>";
	}
	echo "<tr style='background:#eecadf'><td colspan=3 align=right><b>TOTAL :</b></td><td align=center><b>$tot</b></td><td colspan='2'></td></tr>";
	echo "</table></p>";
    echo "</td>";
    if ($i % $arrKurid->JmlSesi == 0) echo "</tr>";
  }
  //$totAll = $this->db->query("select sum(mk.SKS) as totAll from mk WHERE KurikulumID='$kurikulum'")->row_array();
  //$totAll = DB::table('mk')->where('KurikulumID', '=', $kurikulumplh)->max('SKS');
  $totAll = DB::table('mk')->where('KurikulumID', '=', $kurikulumplh)->sum('SKS');
  echo "</table>
  <table width='100%'>
  <tr><td style='text-align:right'><b style='color:purple;font-size:18px;'>TOTAL KESELURUHAN :  $totAll SKS</b></td><td>&nbsp;</td>
  </table>
  </p>";


  echo"</div>
  </div>
  </div>";