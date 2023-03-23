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
                <div class="card-body">
                    <form action="konsultasi/cetak" method="POST" target="_blank" class="">
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
                        
                        <div class="col-md-3 mt-4">
                          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-print"></i> Cetak Laporan</button>
                        </div>
                      </div>
                    </form>
                    @if(auth()->user()->level == 2)
                    <a href="/konsultasi/create" class="btn btn-primary">Tambah Data</a>
                    @endif
                    
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
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
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
                            @if(auth()->user()->level == 2)
                                <td>
                                    <a href="/konsultasi/show/{{ $konsul->id_konsul }}" class="btn btn-info ">
                                        <i class="fas fa-eye"></i></a>
                                    <a href="/konsultasi/{{ $konsul->id_konsul }}/edit" class="btn btn-warning ">
                                        <i class="fas fa-edit"></i></a>
                                    @include('admin.kontrol.hapus')
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