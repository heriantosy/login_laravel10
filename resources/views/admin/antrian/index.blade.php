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
            <div class="card mb-4">
                @if ($loket->status == 1)
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <a href="/tutup_loket/" class="btn btn-danger">Tutup Antrian</a>
                    </div>
                @else
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <a href="/buka_loket/" class="btn btn-primary">Buka Antrian</a>
                    </div>
                @endif
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable2">
                        <thead class="thead-light">
                            <tr  class="text-center">
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Nomor Antrian</th>
                                <th>Nama Pasien</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($antrian as $antri)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y',strtotime($antri->waktu)) }}</td>
                            <td>{{ $antri->nomor_antrian }}</td>
                            <td>{{ $antri->user->nama }}</td>
                            <td>
                                @if ($antri->status == 1)
                                    <b>Sudah Dipanggil</b>
                                @else
                                    <a href="list-antrian/cek/{{ $antri->id_antrian }}" class="btn btn-success"><i class="fa fa-check"></i></a>
                                @endif
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