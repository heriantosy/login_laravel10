

<section class="content">
    <div class="row">
        <div class="col-12">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Absensi Kuliah  </b> <b style="color:green">Pertemuan Ke: {{ $pertemuan->Pertemuan }} </b></h3>
            </div>
            <div class="card-body">          
            <div class="row">
                <div class="col-md-8">               					               
                    <table class="table table-sm table-striped">
                        <tr style="background:purple;color:white">
                            <td><b>MATAKULIAH</b></td>
                            <td><b>: {{ $matakuliah->Nama }}</b></td>
                            <td><b>TAHUN AKADEMIK</b></td>
                            <td><b>: {{ $jdwl->TahunID }}</b></td>
                        </tr>
                        <tr style="background:purple;color:white">
                            <td><b>DOSEN PENGAMPU</b></td>
                            <td><b>: {{ $dosen->Nama }}</b></td>
                            <td><b>KELAS</b></td>
                            <td><b>: {{ $jdwl->NamaKelas }}</b></td>
                        </tr>
                    </table>
                </form>
                </div>
        </div>
    </div>
</div>
</section>

<section class="content">
    <div class="row">
        <div class="col-12">       
          <div class="card">
            <div class="card-body">

            <form action="{{ asset('admin/absensi/simpaneditpresensi/'.$PresensiID->PresensiID.'/'.$jdwl->JadwalID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">						
                @csrf 
                <div class="col-md-8">
                
                <table  class="table table-sm table-striped">
                <tr >			
                    <td colspan="4">
                        <div align="right">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            EDIT PRESENSI</button>
                        <a href="{{ asset('admin/absensi/createabsensi/'.$jdwl->JadwalID) }}" class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            KEMBALI</a>
                        </div>    
                    </td>
                </tr>
                <tr style="background:purple;color:white">
                <th width='10'>No</th>                       
                    <th width="110">NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Status</th>
                </tr>
               
                 @foreach($presensiedit as $row)
                <?php
                    if ($row->JenisPresensiID=='I'){
                        $c="style=color:green";
                    } 
                    elseif ($row->JenisPresensiID=='S'){
                        $c="style=color:purple";
                    } 
                    elseif ($row->JenisPresensiID=='M'){
                        $c="style=color:red";
                    }
                    else{
                        $c="style=color:black";
                    }
                ?>
                <tr <?php echo $c ?>>
                    <td >{{ $loop->index+1 }}</td>
                    <td>{{ $row->MhswID }}</td>                    							
                    <td >{{ $row->Nama }}</td>
                    <input type="hidden" name="MhswID[]" value="{{ $row->MhswID }}">
                    <input type="hidden" name="JadwalID[]" value="{{ $row->JadwalID }}">
                    <input type="hidden" name="KRSID[]" value="{{ $row->KRSID }}">
                    <input type="hidden" name="PresensiID[]" value="{{ $PresensiID->PresensiID }}">
                    <td>
                    <select name="JenisPresensiID[]" >
                    <?php 
                    $jenispres= DB::table('jenispresensi')->get();
                    foreach($jenispres as $w) { ?>
                    <option value="<?php echo $w->JenisPresensiID ?>" 
                    <?php                                        
                        if($w->JenisPresensiID==$row->JenisPresensiID) { echo 'selected'; } ?>>
                    <?php echo $w->JenisPresensiID  ?>
                    </option>
                    <?php } ?>
                    </select>                           
                    </td>							
                </tr>
				@endforeach
                <tr >			
                    <td colspan="4">
                        <div align="right">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            EDIT PRESENSI</button>
                        <a href="{{ asset('admin/absensi/createabsensi/'.$jdwl->JadwalID) }}" class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            KEMBALI</a>
                        </div>    
                    </td>
                </tr>
                </table>
                </form>    
                </div>
        </div>
    </div>
</div>
</section>

