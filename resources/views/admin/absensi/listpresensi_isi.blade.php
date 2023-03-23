

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

            <form action="{{ asset('admin/absensi/simpanpresensi/'.$PresensiID->PresensiID.'/'.$jdwl->JadwalID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">									
            @csrf  
                <div class="col-md-8">
                <table  class="table table-sm table-striped">
                <tr>			
                    <td colspan="4">
                    <div align="right">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            SET PRESENSI</button>
                        <a href="{{ asset('admin/absensi/createabsensi/'.$jdwl->JadwalID) }}" class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            KEMBALI</a>
                    </div>        
                    </td>
                </tr>
                
                <tr style='color:white;background:purple'>
                    <th style='text-align:right;width:50px'>No</th>                       
                    <th width="110" style='text-align:center;'>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Status</th>
                </tr>
                 @foreach($presensimhs as $row)
						<tr><td style='text-align:right;'>{{ $loop->index+1 }}</td>
                            <td style='text-align:center;'>{{ $row->MhswID }}</td>                    							
							<td >{{ $row->Nama }}</td>
							<input type="hidden" name="MhswID[]" value="{{ $row->MhswID }}">
                            <input type="hidden" name="JadwalID[]" value="{{ $row->JadwalID }}">
                            <input type="hidden" name="KRSID[]" value="{{ $row->KRSID }}">
                            <input type="hidden" name="PresensiID[]" value="{{ $PresensiID->PresensiID }}">
                            <td>
                            		
                            <select  name="JenisPresensiID[]">                         
                            @foreach($stat as $k)
                            <option value="{{ $k->JenisPresensiID }}">{{ $k->JenisPresensiID }}</option>             
                            @endforeach
                    </select>
                            </td>
							
						</tr>
				@endforeach
                    </table>
                    <tr>			
                    <td colspan="4">
                    <div align="right">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            SET PRESENSI</button>
                        <a href="{{ asset('admin/absensi/createabsensi/'.$jdwl->JadwalID) }}" class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            KEMBALI</a>
                    </div>        
                    </td>
                </tr>    
                </form>    
                </div>
        </div>
    </div>
</div>
</section>

