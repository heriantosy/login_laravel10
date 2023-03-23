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
                    <a href="/dosen/create" class="btn btn-primary">Tambah Dosen</a>
                    <a href="/dosen_cetak" class="btn btn-success"><i class="fas fa-print"></i></a>

                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>Login</th>
                                <th>NAMA</th>                             
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($dosen as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->Login }}</td>
                            <td>{{ $dosen->Nama }}</td>
                         
                            <!-- <td>
                                @foreach($user as $u)
                                    @if ($dosen->email == $u->email)
                                        @if ($u->level == 1)
                                            Pimpinan
                                        @elseif ($u->level == 2)
                                            Kader
                                        @endif
                                    @endif
                                @endforeach
                            </td> -->
                            <td>
                                <a href="/dosen/{{ $dosen->Login }}/edit" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i></a>
                                @include('admin.dosen.hapus')
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