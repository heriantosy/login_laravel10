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
                    <a href="/pegawai/create" class="btn btn-primary">Tambah Pegawai</a>
                    <a href="/pegawai_cetak" class="btn btn-success"><i class="fas fa-print"></i></a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>NO. HP</th>
                                <th>Alamat</th>
                                <th>HAK AKSES</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($pegawai as $pegawai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pegawai->nama_pegawai }}</td>
                            <td>{{ $pegawai->email }}</td>
                            <td>{{ $pegawai->no_hp }}</td>
                            <td>{{ $pegawai->alamat }}</td>
                            <td>
                                @foreach($user as $u)
                                    @if ($pegawai->email == $u->email)
                                        @if ($u->level == 1)
                                            Pimpinan
                                        @elseif ($u->level == 2)
                                            Kader
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="/pegawai/{{ $pegawai->id_pegawai }}/edit" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i></a>
                                @include('admin.pegawai.hapus')
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