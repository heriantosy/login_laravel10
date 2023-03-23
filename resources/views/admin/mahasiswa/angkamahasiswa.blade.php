<div class="col-md-8">  
              <div class="card">
                <div class="card-header">

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

                <form action="{{ asset('admin/mahasiswa/filterangkamhs') }}" method="post" accept-charset="utf-8">
                  {{ csrf_field() }}
                  <input type="hidden" name="pengalihan" value="{{ url()->full() }}">
                  <div class="form-group row">
                      <label class="col-md-9 col-form-label text-md-right"><b style='color:purple;font-size:17px'>Angka Penerimaan Mahasiswa Baru </b><b style='color:#FF8306;font-size:17px'><?php echo"$prd";?></b></label>
                      <div class="col-md-2">
                        <?php
                            echo"<select class='form-control form-control-sm' name='prodi' onChange='this.form.submit()'>"; 
                            //echo "<option value=''>Pililh Prodi</option>";
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
                   $tahun = DB::table('t_tahunx')->orderBy('Tahun','DESC')->get();
                   foreach ($tahun as $r){
                   $nom++;
                   if ($prodi=='SI')	{	
                     $reg = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //reguler
                     $tra = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer1
                     $tra2= DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer2
                     $pin = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //pindahan
                     $tranx = $tra + $tra2;
                     $total = $reg + $tranx + $pin;
                     //Informasi bottom
                     $regAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->count();
                     $traAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->count();
                     $traAll2  = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->count();
                     $transAll = $traAll + $traAll2;
                     $pinAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->count();
                     $totalAll = DB::table('mhsw')->where('ProdiID',$prodi)->count();
                   }
                   if ($prodi=='TI')	{	
                    $reg = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //reguler
                    $tra = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer1
                    $tra2= DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer2
                    $pin = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //pindahan
                    $tranx = $tra + $tra2;
                    $total = $reg + $tranx + $pin; 
                    //Informasi bottom
                    $regAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->count();
                    $traAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->count();
                    $traAll2  = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->count();
                    $transAll = $traAll + $traAll2;
                    $pinAll   = DB::table('mhsw')->where('ProdiID',$prodi)->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->count();
                    $totalAll = DB::table('mhsw')->where('ProdiID',$prodi)->count();
                   }
                   if ($prodi=='All')	{	
                    $reg = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //reguler
                    $tra = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer1
                    $tra2= DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //transfer2
                    $pin = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->where(DB::raw('substr(MhswID, 1, 2)'), '=' , $r->Tahun)->count(); //pindahan
                    $tranx = $tra + $tra2;
                    $total = $reg + $tranx + $pin; 
                     //Informasi bottom
                     $regAll   = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'1')->count();
                     $traAll   = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'2')->count();
                     $traAll2  = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'5')->count();
                     $transAll = $traAll + $traAll2;
                     $pinAll   = DB::table('mhsw')->where(DB::raw('substr(MhswID, 5, 1)'), '=' ,'3')->count();
                     $totalAll = DB::table('mhsw')->count();
                   }
           
                   if ($r->Tahun=='10'){
                     $tahunx="2010";
                   }
                   elseif ($r->Tahun=='11'){
                     $tahunx="2011";
                   }
                   elseif ($r->Tahun=='12'){
                     $tahunx="2012";
                   }
                   elseif ($r->Tahun=='13'){
                     $tahunx="2013";
                   }
                   elseif ($r->Tahun=='14'){
                     $tahunx="2014";
                   }
                   elseif ($r->Tahun=='15'){
                     $tahunx="2015";
                   }
                   elseif ($r->Tahun=='16'){
                     $tahunx="2016";
                   }
                   elseif ($r->Tahun=='17'){
                     $tahunx="2017";
                   }
                   elseif ($r->Tahun=='18'){
                     $tahunx="2018";
                   }
                   elseif ($r->Tahun=='19'){
                     $tahunx="2019";
                   }
                   elseif ($r->Tahun=='20'){
                     $tahunx="2020";
                   }
                   
                  echo"<tr>
                      <td align=center>$nom</td>
                      <td align=center>$tahunx</td>
                      <td align=center>$reg</td>
                      <td align=center>$tranx</td>
                      <td align=center>$pin</td>
                      <td align=center>$total</td>";
                      ?>     
                      <td> <center>
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
                  
                  echo"<table id='example' class='table table-sm table-striped'>";  
                  echo"<tr><th align=left  width='320px'>Total Reguler</th><th width='1px'>:</th><th style='text-align:right' width='80px'> $regAll</th><th>mahasiswa</th></tr>";
                  echo"<tr><th align=left>Total Transfer</th><th>:</th><th style='text-align:right'> $transAll</th><th>mahasiswa</th></tr>";
                  echo"<tr><th align=left>Total Pindahan</th><th>:</th><th style='text-align:right'> $pinAll</th><th>mahasiswa</th></tr>";
                  echo"<tr><th align=left>Total Keseluruhan</th><th>:</th><th style='text-align:right'> ".number_format($totalAll)."</th><th>mahasiswa</th></tr>";
                  echo"</table>";
                  ?>
                 
</div>               
                
                