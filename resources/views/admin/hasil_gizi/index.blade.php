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
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Laki-laki</h6>
                </div>
                <!-- Area Chart -->


                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>Nama Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($balita as $b)
                        @php
                            $penimbangan = DB::table('penimbangan')->where('balita_id',$b->id_balita)
                                            ->first();    
                            @endphp
                        @if ($b->jenis_kelamin === "L")
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_anak }}</td>
                            <td>
                                @if (!empty($penimbangan) )
                                <a href="/perhitungan-gizi/{{ $b->id_balita }}" class="btn btn-info ">
                                    <i class="fas fa-eye"></i> Cek Hasil</a>
                                <a href="/perhitungan-gizi/{{ $b->id_balita }}/cetak" class="btn btn-success ">
                                    <i class="fas fa-print"></i> Print</a>
                                @else
                                    <p class="text-danger">Tidak Ada Data</p>
                                @endif
                                
                            </td>

                        </tr>
                            
                        @endif
                            
                        
                        
                        
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Perempuan</h6>
                </div>
                <!-- Area Chart -->


                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>NO</th>
                                <th>Nama Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>Nama Anak</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($balita as $b)
                        @php
                            $penimbangan = DB::table('penimbangan')->where('balita_id',$b->id_balita)
                                            ->first();    
                            @endphp
                        @if ($b->jenis_kelamin === "P")
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_anak }}</td>
                            <td>
                                @if (!empty($penimbangan) )
                                <a href="/perhitungan-gizi/{{ $b->id_balita }}" class="btn btn-info ">
                                    <i class="fas fa-eye"></i> Cek Hasil</a>
                                <a href="/perhitungan-gizi/{{ $b->id_balita }}/cetak" class="btn btn-success ">
                                    <i class="fas fa-print"></i> Print</a>
                                @else
                                    <p class="text-danger">Tidak Ada Data</p>
                                @endif
                                
                            </td>

                        </tr>
                            
                        @endif
                            
                        
                        
                        
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
@endsection