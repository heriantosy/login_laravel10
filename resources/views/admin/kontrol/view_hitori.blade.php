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
                    
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush text-center" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Nama Ibu Hamil</th>
                                <th>Keluhan</th>
                                <th>Keterangan</th>
                                <th>Pemeriksa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Nama Ibu Hamil</th>
                                <th>Keluhan</th>
                                <th>Keterangan</th>
                                <th>Pemeriksa</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($konsultasi as $konsul)
                        @php
                        $ibuhamil = DB::table('ibuhamil')->where('id_ibuhamil',$konsul->ibuhamil_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $konsul->tanggal }}</td>
                            <td>{{ $ibuhamil->nama_ibu }}</td>
                            <td>{{ $konsul->keluhan }}</td>
                            <td>{{ $konsul->keterangan }}</td>
                            <td>{{ $konsul->user->nama }}</td>
                            <td>
                                <a href="/histori-konsul/{{ $konsul->id_konsul }}" class="btn btn-info ">
                                    <i class="fas fa-eye"></i></a>
                            </td>
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