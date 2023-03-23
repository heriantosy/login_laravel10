  
           <div class="col-md-10">     
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

                <form action="{{ asset('admin/mahasiswa/filterangkalulusan') }}" method="post" accept-charset="utf-8">
                  {{ csrf_field() }}
                  <input type="hidden" name="pengalihan" value="{{ url()->full() }}">
                  <div class="form-group row">
                      <label class="col-md-9 col-form-label text-md-right"><b style='color:purple;font-size:17px'>Angka Penerimaan Mahasiswa Baru </b><b style='color:#FF8306;font-size:17px'><?php echo"$prd";?></b></label>
                      <div class="col-md-2">
                        <?php
                            echo"<select class='form-control form-control-sm' name='prodi' onChange='this.form.submit()'>"; 
                            echo "<option value=''>Pililh Prodi</option>";
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
                    <th style='width:20px' >No<center>(1)</center></th>                           
                    <th><div align='center'>Tahun </div><center>(2)</center></th>   
                    <th><div align='left'>Program Studi </div><left>(3)</left></th>
                    <th><div align='center'>Periode<br><center>(4)</center></th>              
                    <th><div align='center'>Reguler <br><center>(5)</center></th>
                    <th><div align='center'>Transfer <br><center>(6)</center></th>
                    <th><div align='center'>Pindahan <br><center>(7)</center></th> 
                    <th><div align='center'>Pria <br><center>(9)</center></th>
                    <th><div align='center'>Wanita <br><center>(9)</center></th>
                    <th><div align='center'>Total <br><center>(8+9) <br><center></center></th>                                
                    <th width='190px'><div align='center'>Action <br><center>(11)</center></th> 
                  </tr>
                    </thead>
                    <tbody>
                  <?php   
                
                  if ($prodi=='SI')	{	
                    $lulusan = DB::table('lulusan')->where('ProdiID',$prodi)->orderBy('TahunID','DESC')->get();
                  }
                  if ($prodi=='TI')	{	
                    $lulusan = DB::table('lulusan')->where('ProdiID',$prodi)->orderBy('TahunID','DESC')->get();
                  }
                  if ($prodi=='All')	{	
                    $lulusan = DB::table('lulusan')->orderBy('TahunID','DESC')->get();
                  }
                  $nom=0;
                  $regAll =  0;
                  $traAll =  0;
                  $pinAll =  0;
                  $grandTot = 0;
                  $grandTot2 =  0;
                  foreach ($lulusan as $r){
                    $nom++;
                    $regAll +=  $r->Reguler;
                    $traAll +=  $r->Transfer;
                    $pinAll +=  $r->Pindahan;
                    $grandTot = $r->Pria + $r->Wanita;
                    $grandTot2 +=  $grandTot;
                    echo"<tr >
                    <td align='center'>$nom</td>                  
                    <td align='center'>$r->TahunID</td>
                    <td align='left'> $r->ProdiID</td>
                    <td align='center'>$r->Periode</td>
                    <td align='center'>$r->Reguler</td>
                    <td align='center'>$r->Transfer</td>
                    <td align='center'>$r->Pindahan</td>
                    <td align='center'>$r->Pria</td>
                    <td align='center'>$r->Wanita</td>					
                    <td align='center'>$grandTot</td>";
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
                  echo"<tr><th align=left>Total Transfer</th><th>:</th><th style='text-align:right'> $traAll</th><th>mahasiswa</th></tr>";
                  echo"<tr><th align=left>Total Pindahan</th><th>:</th><th style='text-align:right'> $pinAll</th><th>mahasiswa</th></tr>";
                  echo"<tr><th align=left>Total Keseluruhan</th><th>:</th><th style='text-align:right'> ".number_format($grandTot2)."</th><th>mahasiswa</th></tr>";
                  echo"</table>";
                  ?>
                 </div>
                
                
                