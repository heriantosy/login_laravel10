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
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->nama_ibu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->email }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat, Tgl Lahir Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $ibuhamil->tempat_lahir_ibu }}, {{ $ibuhamil->tgl_lahir_ibu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kehamilan ke</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->hamil_ke }} </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Umur Anak Terakhir</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $ibuhamil->umur_anak_terakhir }} Tahun</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Agama Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($ibuhamil->agama_ibu == 1)
                                ISLAM
                            @elseif($ibuhamil->agama_ibu == 2)
                                KRISTEN
                            @elseif($ibuhamil->agama_ibu == 3)
                                HINDU
                            @elseif($ibuhamil->agama_ibu == 4)
                                BUDHA
                            @endif</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($ibuhamil->pendidikan_ibu == 0)
                                Tidak Sekolah
                            @elseif($ibuhamil->pendidikan_ibu == 1)
                                SD
                            @elseif($ibuhamil->pendidikan_ibu == 2)
                                SMP
                            @elseif($ibuhamil->pendidikan_ibu == 3)
                                SMA
                            @elseif($ibuhamil->pendidikan_ibu == 4)
                                AKADEMI
                            @elseif($ibuhamil->pendidikan_ibu == 5)
                                PERGURUAN TINGGI
                            @endif</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Gol. Darah Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->goldarah_ibu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->pekerjaan_ibu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Suami</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->nama_suami }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat, Tgl Lahir Suami</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            {{ $ibuhamil->tempat_lahir_ibu }}, {{ $ibuhamil->tgl_lahir_ibu }}</label>
                            
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Agama Suami</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($ibuhamil->agama_suami == 1)
                                ISLAM
                            @elseif($ibuhamil->agama_suami == 2)
                                KRISTEN
                            @elseif($ibuhamil->agama_suami == 3)
                                HINDU
                            @elseif($ibuhamil->agama_suami == 4)
                                BUDHA
                            @endif</label>
                            
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Pendidikan Suami</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">
                            @if ($ibuhamil->pendidikan_suami == 0)
                                Tidak Sekolah
                            @elseif($ibuhamil->pendidikan_suami == 1)
                                SD
                            @elseif($ibuhamil->pendidikan_suami == 2)
                                SMP
                            @elseif($ibuhamil->pendidikan_suami == 3)
                                SMA
                            @elseif($ibuhamil->pendidikan_suami == 4)
                                AKADEMI
                            @elseif($ibuhamil->pendidikan_suami == 5)
                                PERGURUAN TINGGI
                            @endif</label>
                            
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
@endsection