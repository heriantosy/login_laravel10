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
                    <form action="penimbangan/cetak" method="POST" target="_blank" class="">
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
                    <a href="/penimbangan/create" class="btn btn-primary">Tambah Data</a>
                    @endif
                    
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush text-center" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Nama Balita</th>
                                <th>Umur (Bulan)</th>
                                <th>Berat Badan (kg)</th>
                                <th>Tinggi Badan (cm)</th>
                                <th>Lingkar Kepala (cm)</th>
                                <th>Pemeriksa</th>
                            @if(auth()->user()->level == 2)

                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($timbangan as $nimbang)
                        @php
                        $balita = DB::table('balita')->where('id_balita',$nimbang->balita_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m -Y',strtotime($nimbang->tanggal)) }}</td>
                            <td>{{ $balita->nama_anak }}</td>
                            <td>{{ $nimbang->umur }}</td>
                            <td>{{ $nimbang->berat_badan }}</td>
                            <td>{{ $nimbang->tinggi_badan }}</td>
                            <td>{{ $nimbang->lingkar_kepala }}</td>
                            <td>{{ $nimbang->user->nama }}</td>
                            @if(auth()->user()->level == 2)
                            <td>
                                <a href="/penimbangan/{{ $nimbang->id_timbang }}/edit" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i></a>
                                @include('admin.penimbangan.hapus')
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