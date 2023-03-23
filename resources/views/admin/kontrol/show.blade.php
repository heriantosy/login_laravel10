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
                    <a href="/konsultasi" class="m-0 font-weight-bold text-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ibu Hamil</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $ibuhamil->nama_ibu }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->tanggal }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Keluhan Sekarang</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->keluhan }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tekanan Darah</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->tekanan_darah }} mmHg</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Berat Badan</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->berat_badan }} Kg</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Umur Kehamilan</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->umur_kehamilan }} Minggu</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tinggi Fundus</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->tinggi_fundus }} Cm</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Letak Janin</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->letak_janin }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Denyut Jantung Janin /Menit</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->denyut_janin == 1 ? 'Ya' : 'Tidak' }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kaki Bengkak</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->kaki_bengkak  == 1 ? 'Ya' : 'Tidak' }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil Pemeriksaan Laboratorium</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->hasil_lab }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tindakan</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->tindakan }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nasihat yang disampaikan</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->nasihat }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->keterangan }}</label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kapan Harus Kembali</label>
                        <label for="inputEmail3" class="col-form-label">:</label>
                        <label for="inputEmail3" class="col-sm-5 col-form-label">{{ $konsultasi->kpn_kembali }}</label>
                    </div>
                    
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
@endsection