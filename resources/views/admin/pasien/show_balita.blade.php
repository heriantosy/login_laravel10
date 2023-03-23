@extends('template.main')

@section('container')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="/pasien" class="m-0 font-weight-bold text-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Anak</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->nama_anak }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->email }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->jenis_kelamin === "L" ? 'Laki-Laki' : 'Perempuan' }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nik anak</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->nik_anak }} </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Anak Ke</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->anak_ke }} </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">BB Lahir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->bb_lahir }} Kg</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tgl Lahir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->tgl_lahir }} </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No. KK</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->no_kk }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Orang TUa</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->nama_ortu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nik Orang TUa</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->nik_ortu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No. HP Orang Tua</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->hp_ortu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $balita->alamat }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">BB Sekarang</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->bb_sekarang }} kg</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">TB Sekarang</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $balita->tb_sekarang }} Cm</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Asi Ekslusif</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($balita->asi_ekslusif == 1)
                                YA
                            
                            @elseif($balita->asi_ekslusif == 2)
                                TIDAK
                            @endif</label>
                            
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">IMD</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($balita->imd == 1)
                                YA
                            
                            @elseif($balita->imd == 2)
                                TIDAK
                            @endif</label>
                            
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
@endsection