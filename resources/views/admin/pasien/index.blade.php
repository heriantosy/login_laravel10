@extends('template.main')

@section('container')
    <!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </div>

    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4 p-4">
            <form action="pasien/cetak" method="POST" target="_blank">
                @csrf
            <div class="form-group row">
                <div class="col-md-4">
                  <label for="mulai_cetak">Mulai Filter Cetak</label>
                  <input type="date" class="form-control" id="mulai_cetak" name="mulai_cetak" required>
                </div>
                <div class="col-md-4">
                  <label for="selesai_cetak">Selesai Filter Cetak</label>
                  <input type="date" class="form-control" id="selesai_cetak" name="selesai_cetak" required>
                </div>
                <div class="col-md-4">
                  <label for="jenis_laporan">Jenis Laporan</label>
                  <select name="jenis_laporan" class="form-control" id="jenis_laporan" >
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="1">Ibu Hamil</option>
                    <option value="2">Balita</option>
                  </select>
                </div>
                
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-1"></div>
                <div class="col-md-9">
                  <button type="submit" class="btn btn-success btn-block"><i class="fa fa-print"></i> Cetak Laporan</button>
                </div>
                <div class="col-md-1"></div>
              </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $judul1 }}</h6>
                    <div>
                        
                        @if(auth()->user()->level == 2)
                        <a href="/pasien/notif1/" class="btn btn-success ">
                            Notifikasi Wa</a>
                                @endif
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>Nama Anak</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Orang Tua</th>
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($balita as $b)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_anak }}</td>
                            <td>{{ $b->email }}</td>
                            <td>@if ($b->jenis_kelamin==="L")
                                Laki-Laki
                            @else
                                Perempuan
                            @endif</td>
                            <td>{{ $b->nama_ortu }}</td>
                            @if(auth()->user()->level == 2)

                            <td>
                                
                                <a href="/pasien/{{ $b->id_balita }}/balita/" class="btn btn-info ">
                                <i class="fas fa-eye"></i></a>
                                <a href="/pasien/edit_balita/{{ $b->id_balita }}" class="btn btn-warning ">
                                <i class="fas fa-edit"></i></a>
                                <a href="/pasien/delete_balita/{{ $b->id_balita }}" class="btn btn-danger ">
                                <i class="fas fa-trash"></i></a>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $judul2 }}</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable2">
                        <thead class="thead-light">
                            <tr  class="text-center">
                                <th>NO</th>
                                <th>Nama Ibu Hamil</th>
                                <th>Email</th>
                                <th>Tempat, Tgl Lahir Ibu</th>
                                <th>Kehamilan ke</th>
                                <th>Umur Anak Terakhir</th>
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($ibuhamil as $bumil)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bumil->nama_ibu }}</td>
                            <td>{{ $bumil->email }}</td>
                            <td>{{ $bumil->tempat_lahir_ibu }},{{ $bumil->tgl_lahir_ibu }}</td>
                            <td>{{ $bumil->hamil_ke }}</td>
                            <td>{{ $bumil->umur_anak_terakhir }}</td>
                            @if(auth()->user()->level == 2)
                                
                                <td>
                                    
                                    <a href="/pasien/{{ $bumil->id_ibuhamil }}/ibuhamil/" class="btn btn-info ">
                                        <i class="fas fa-eye"></i></a>
                                    <a href="/pasien/edit_ibuhamil/{{ $bumil->id_ibuhamil }}" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i></a>
                                    <a href="/pasien/delete_ibuhamil/{{ $bumil->id_ibuhamil }}" class="btn btn-danger ">
                                    <i class="fas fa-trash"></i></a>
                                </td>
                                @endif

                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection