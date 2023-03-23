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
                                <th>Status</th>
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($balita as $b)
                        @if ($b->status == 1)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->nama_anak }}</td>
                                <td>@if ($b->status==1)
                                    Balita
                                @elseif ($b->status==0)
                                    Bukan balita
                                @endif</td>
                                @if(auth()->user()->level == 2)
                                
                                <td>
                                    <a href="/status-pasien/balita/{{ $b->id_balita }}" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i></a>
                                </td>
                                @endif

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
                                <th>Status</th>
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($ibuhamil as $bumil)
                            @if ($bumil->status == 1)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bumil->nama_ibu }}</td>
                                <td>@if ($bumil->status==1)
                                    Hamil
                                @elseif ($bumil->status==0)
                                    Sudah melahirkan
                                @endif</td>
                                @if(auth()->user()->level == 2)
                                <td>
                                    <a href="/status-pasien/ibuhamil/{{ $bumil->id_ibuhamil }}" class="btn btn-warning ">
                                        <i class="fas fa-edit"></i></a>
                                </td>
                                @endif
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