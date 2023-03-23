
<section class="content">
    <div class="row">
        <div class="col-12">       
          <div class="card">
          
            <div class="card-body">

            <div class="row">
                <div class="col-md-6">

                    <table class="table table-sm table-striped">
                        <tr style="background:purple;color:white">
                         
                            <th>MATAKULIAH</th>
                            <th>: {{ $matakuliah->Nama }}</th>
                            <th>TAHUN</th>
                            <th>: {{ $jdwl->TahunID }}</th>
                        </tr>
                        <tr style="background:purple;color:white">
                            <th>DOSEN</th>
                            <th>: {{ $dosen->Nama }}, {{ $dosen->Gelar }}</th>
                            <th>KELAS</th>
                            <th>: {{ $jdwl->NamaKelas }}</th>
                        </tr>
                        </table>

                    <form action="{{ asset('admin/absensi/createpertemuan/'.$jdwl->JadwalID.$jdwl->JadwalID) }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">   										
                    @csrf
                    <?php $tglnow=date('Y-m-d'); ?>
                        <table class="table table-sm table-striped">
                        <tr>

                        <td style='text-align:center;font-weight:bold'>Ke</td>
                        <td style='text-align:center;font-weight:bold'>Tanggal</td>
                        <td style='text-align:center;font-weight:bold'>Jam Mulai</td>
                        <td style='text-align:center;font-weight:bold'>Jam Selesai</td>
                        <td style='text-align:center;font-weight:bold'>Aksi</td>
                        </tr>
                        <tr>                       
                                <input type="hidden" class="form-controlx" name="TahunID" value="{{ $jdwl->TahunID }}">  
                                <input type="hidden" class="form-controlx" name="JadwalID" value="{{ $jdwl->JadwalID }}">
                                <input type="hidden" class="form-controlx" name="DosenID" value="{{ $jdwl->DosenID }}">  
                            
                            <td>    
                                <input type="text" style='width:30px; text-align:center; padding:0px' maxlength='3' class="form-control form-control-sm" name="Pertemuan" placeholder="Pertemuan Ke" value="{{ $urut }}">
                            </td>
                            <td>
                                <input type="text" class="form-control tanggal form-control-sm" style='width:140px; text-align:center; padding:0px' maxlength='10'  class="form-control" name="Tanggal" value="<?php echo date('d-m-Y');  ?>">  
                            </td>
                            <td>
                                <input type="text" style='width:100px; text-align:center; padding:0px' maxlength='10' class="form-control form-control-sm" name="JamMulai" value="{{ $jdwl->JamMulai }}"> 
                            </td>
                            <td>
                                <input type="text" style='width:100px; text-align:center; padding:0px' maxlength='10' class="form-control form-control-sm" name="JamSelesai" value="{{ $jdwl->JamSelesai }}">                
                            </td>
                            <td>    
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> </button>                                      
                                <a href="{{ asset('admin/absensi') }}" class="btn btn-info btn-sm"><i class="fa fa-backward" aria-hidden="true"></i></a>
                            </td>
                           
                        </tr>
                        </form>
                    </table>
               
                </div>

                <div class="col-md-6">
                <table  class="table table-sm table-striped">
                <tr style="background:purple;color:white">
                <th width="25">Ke</th>                       
                    <th width="110" style='text-align:center'>Tanggal</th>
                    <th width="110" style='text-align:center'>Waktu</th>
                    <th>Absen</th>
                    <th style='text-align:center'>Jml Hadir</th>
                    <th style='text-align:center'>Jml Sakit</th>
                    <th style='text-align:center'>Jml Izin</th>
                    <th style='text-align:center'>Jml Mangkir</th>
                    <th>Aksi</th>
                    
                </tr>
                 @foreach($absen as $row)
                 <?php
                    $mhshdr = \DB::table('presensimhsw')->where('PresensiID',$row->PresensiID)->where('JenisPresensiID','H')->count();
                    $mhsskt = \DB::table('presensimhsw')->where('PresensiID',$row->PresensiID)->where('JenisPresensiID','S')->count();
                    $mhsizin = \DB::table('presensimhsw')->where('PresensiID',$row->PresensiID)->where('JenisPresensiID','I')->count();
                    $mhsmangkir = \DB::table('presensimhsw')->where('PresensiID',$row->PresensiID)->where('JenisPresensiID','M')->count();
                 ?>
                <tr><td style='text-align:center'>{{ $row->Pertemuan }}</td>                    
                    <td><a href="{{ asset('admin/absensi/edit_tanggalabsensi/'.$row->PresensiID) }}">{{ Carbon\Carbon::parse($row->Tanggal)->format('d-m-Y') }} </a></td>
                    <td>{{ Carbon\Carbon::parse($row->JamMulai)->format('H:i') }}-{{ Carbon\Carbon::parse($row->JamSelesai)->format('H:i') }}</td>                       
                    <td style='text-align:center'> 
                    <?php
                    if (empty($mhshdr)){ ?>
                        <a href="{{ asset('admin/absensi/viewpresensi_isi/'.$row->PresensiID.'/'.$row->JadwalID) }}" ><i class="fa fa-check"></i></a> |
                    <?php } ?>   
                        <a href="{{ asset('admin/absensi/viewpresensi_edit/'.$row->PresensiID.'/'.$row->JadwalID) }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td style='text-align:center'>{{ $mhshdr }} </td>
                    <td style='text-align:center'>{{ $mhsskt }}</td>
                    <td style=text-align:center>{{ $mhsizin }}</td>
                    <td style=text-align:center>{{ $mhsmangkir }}</td>
                    <td><a href="{{ asset('admin/absensi/delete/'.$row->PresensiID.'/'.$row->JadwalID) }}"><i class="fas fa-trash-alt"></i></a></td>
                <tr>
				@endforeach
                    </table>
                </div>
        </div>
    </div>
</div>
</section>

