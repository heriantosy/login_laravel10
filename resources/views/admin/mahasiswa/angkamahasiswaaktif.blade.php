  <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                    <?php
                   
                    if ($prodik=='SI'){
                      $prd="Sistem Informasi";
                    }
                    elseif ($prodik=='TI'){
                      $prd="Teknik Informatika";
                    }
                    elseif ($prodik=='All'){
                      $prd="Seluruh Program Studi";
                    }
                    ?>
                <form action="{{ asset('admin/mahasiswaaktif/filter') }}" method="post" accept-charset="utf-8">
                  {{ csrf_field() }}
                  <input type="hidden" name="pengalihan" value="{{ url()->full() }}">
                  <div class="form-group row">
                      <label class="col-md-7 col-form-label text-md-right"><b style='color:purple;font-size:17px'>Angka Mahasiswa Aktif </b><b style='color:#FF8306;font-size:17px'><?php echo"$prd";?></b></label>
                      <div class="col-md-3">
                        <?php
                            echo"<select class='form-control form-control-sm' name='prodi' onChange='this.form.submit()'>"; 
                            //dd('xs');
                            //echo "<option value='0'>Pililh Prodi</option>";
                            echo "<option value='All' selected>Seluruh Prodi</option>";
                            $recx = DB::table('prodi')->orderBy('Nama','ASC')->get();
                            foreach ($recx as $r){  
                                if ($prodi == $r->ProdiID){
                                  echo "<option value='$r->ProdiID' selected>$r->Nama</option>";
                                }else{
                                  echo "<option value='$r->ProdiID'>$r->Nama</option>";
                                }
                            }
                            echo"</select>";
                            ?>                       
                      </div>                                      
                      <div class="col-md-1">
                        <?php
                            echo"<input class='pull-right btn btn-primary btn-sm' type='submit' name='filter' value='Lihat Data'>";
                            echo"</form>";
                        ?>
                      </div>
                      </div>
                </div>


                <div class="card-body">
                <div class="table-responsive">

                  <table id="example" class="table table-sm table-striped">
                    <thead>
                    <tr style="background:purple;color:white">
                      <th style='width:10px;text-align:center' >No <br>(1)</th>                           
                      <th style='width:200px;text-align:center'>Tahun <br>(2)</th>                        
                      <th style='width:200px;text-align:center'>Reguler <br>(4)</th>
                      <th style='width:200px;text-align:center'>Transfer <br>(5)</th>
                      <th style='width:200px;text-align:center'>Pindahan <br>(6)</th> 
                      <th style='width:200px;text-align:center'>Total <br>(4+5+6) <br></th>                                
                      <th style='width:200px;text-align:center'>Action <br>(10)</th> 
                      </tr>
                    </thead>
                    <tbody>
                  <?php   
                  $nom =0; 
                   $tahun = DB::table('t_tahunakademik')->orderBy('TahunID','DESC')->get();
                   foreach ($tahun as $r){
                   $nom++;
                   if ($prodik=='SI')	{	
                     //dd($prodi);
                     $prd="07";
                     $reg   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //reguler
                     $tra   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer1
                     $tra2  = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer2
                     $pin   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //pindahan
                     $tranx = $tra + $tra2;
                     $total = $reg + $tranx + $pin;
                   }
                  if ($prodik=='TI')	{	
                       $prd="08";
                       $reg   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //reguler
                       $tra   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer1
                       $tra2  = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer2
                       $pin   = DB::table('krs')->where(DB::raw('substr(MhswID, 3, 2)'), '=' ,$prd)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //pindahan
                       $tranx = $tra + $tra2;
                       $total = $reg + $tranx + $pin;
                     }
                  if ($prodik=='All')	{	
                    $reg   = DB::table('krs')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //reguler
                    $tra   = DB::table('krs')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer1
                    $tra2  = DB::table('krs')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //transfer2
                    $pin   = DB::table('krs')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where('TahunID',$r->TahunID)->distinct('MhswID')->count(); //pindahan
                    $tranx = $tra + $tra2;
                    $total = $reg + $tranx + $pin;
                  }
        
                   
                  echo"<tr>
                      <td align=center>$nom</td>
                      <td align=center>$r->TahunID</td>
                      <td align=center>$reg</td>
                      <td align=center>$tranx</td>
                      <td align=center>$pin</td>
                      <td align=center>$total</td>
                      <td style='width:100px !important'><center>";
                ?>      
                      <a href="{{ asset('admin/jadwal/edit') }}" ><i class="fa fa-edit"></i></a> &nbsp;              
                      <a href="{{ asset('admin/jadwal/cetaknilaikelas_v') }}" title="Cetak Nilai Kelas"  target="_blank"><i class="fa fa-print"></i></a> &nbsp;
                      <a href="{{ asset('admin/jadwal/delete') }}" onclick="return confirm('Yakin data akan dihapus ?')"><i class="fas fa-trash-alt"></i></a>
                      </center>
                      </td>
                      </tr>
                  <?php 
                  }
                  
                  echo" <tbody>
                  </table>";  
                  
                  // echo"<table id='example' class='table table-sm table-striped'>";  
                  // echo"<tr><th align=left  width='320px'>Total Reguler</th><th width='1px'>:</th><th style='text-align:right' width='80px'> $regAll</th><th>mahasiswa</th></tr>";
                  // echo"<tr><th align=left>Total Transfer</th><th>:</th><th style='text-align:right'> $transAll</th><th>mahasiswa</th></tr>";
                  // echo"<tr><th align=left>Total Pindahan</th><th>:</th><th style='text-align:right'> $pinAll</th><th>mahasiswa</th></tr>";
                  // echo"<tr><th align=left>Total Keseluruhan</th><th>:</th><th style='text-align:right'> ".number_format($totalAll)."</th><th>mahasiswa</th></tr>";
                  //echo"</table>";
                  ?>
                 
                
                
</div>                