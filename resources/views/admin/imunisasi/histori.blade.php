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
                                <th>Nama Balita</th>
                                <th>Jenis Vaksin</th>
                                <th>Umur (Bulan)</th>
                                <th>Pemeriksa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>Tanggal</th>
                                <th>Nama Balita</th>
                                <th>Jenis Vaksin</th>
                                <th>Umur (Bulan)</th>
                                <th>Pemeriksa</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($imunisasi as $imun)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $imun->tanggal }}</td>
                            <td>{{ $balita[0]->nama_anak }}</td>
                            <td>
                                @if ($imun->jenis_vaksin == 1)
                                    HB 0 (0-24 jam)
                                @elseif ($imun->jenis_vaksin == 2)
                                    BCG
                                @elseif ($imun->jenis_vaksin == 3)
                                    *Polio
                                @elseif ($imun->jenis_vaksin == 4)
                                    *DPT-HB-Hib 1
                                @elseif ($imun->jenis_vaksin == 5)
                                    *Polio 2
                                @elseif ($imun->jenis_vaksin == 6)
                                    *DPT-HB-Hib 2
                                @elseif ($imun->jenis_vaksin == 7)
                                    *Polio 3
                                @elseif ($imun->jenis_vaksin == 8)
                                    *DPT-HB-Hib 3
                                @elseif ($imun->jenis_vaksin == 9)
                                    *Polio 4
                                @elseif ($imun->jenis_vaksin == 10)
                                    *IPV
                                @elseif ($imun->jenis_vaksin == 11)
                                    Campak
                                @endif

                            </td>
                            <td>{{ $imun->umur }}</td>
                            <td>{{ $imun->user->nama }}</td>
                            
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