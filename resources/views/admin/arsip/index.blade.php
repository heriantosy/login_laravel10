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

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $judul1 }}</h6>
                    
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>Nama Anak</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>nama_ortu</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($balita as $b)
                        @if ($b->status == 0)
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
                                
                            </tr>
                        @endif
                        
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
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($ibuhamil as $bumil)
                        @if ($bumil->status == 0)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bumil->nama_ibu }}</td>
                                <td>{{ $bumil->email }}</td>
                                <td>{{ $bumil->tempat_lahir_ibu }},{{ $bumil->tgl_lahir_ibu }}</td>
                                <td>{{ $bumil->hamil_ke }}</td>
                                <td>{{ $bumil->umur_anak_terakhir }}</td>
                                

                            </tr>
                        @endif
                        
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection