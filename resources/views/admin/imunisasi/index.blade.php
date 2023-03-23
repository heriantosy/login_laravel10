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
                <div class="card-body ">
                    <form action="imunisasi/cetak" method="POST" target="_blank" class="">
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
                    <a href="/imunisasi/create" class="btn btn-primary">Tambah Data</a>
                    @endif
                    

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
                                @if(auth()->user()->level == 2)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($imunisasi as $imun)
                        @php
                        $balita = DB::table('balita')->where('id_balita',$imun->balita_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $imun->tanggal }}</td>
                            <td>{{ $balita->nama_anak }}</td>
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
                            @if(auth()->user()->level == 2)
                                <td>
                                    <a href="/imunisasi/{{ $imun->id_imunisasi }}/edit" class="btn btn-warning ">
                                        <i class="fas fa-edit"></i></a>
                                    @include('admin.imunisasi.hapus')
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