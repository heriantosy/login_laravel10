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
                
                <div class="card-body">
                  <form action="/konsultasi/update/{{ $konsultasi->id_konsul }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="ibuhamil_id">Nama Ibu Hamil</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <select name="ibuhamil_id" id="ibuhamil_id" class="select2 form-control " style="width: 100%">
                                        <option value="{{ $ibuhamil->id_ibuhamil }}">{{ $ibuhamil->nama_ibu }}</option>   
                                    
                                </select>
                                @error('ibuhamil_id')    
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="date" class="form-control @error('tanggal')
                                is-invalid @enderror" id="tanggal"
                                    placeholder="... kg" name="tanggal" value="{{ old('tanggal',$konsultasi->tanggal) }}" >
                                    @error('tanggal')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="keluhan">Keluhan Sekarang</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('keluhan')
                                is-invalid @enderror" id="keluhan"
                                    placeholder="Masukkan Keluhan" name="keluhan" value="{{ old('keluhan',$konsultasi->keluhan) }}" >
                                    @error('keluhan')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tekanan_darah">Tekanan Darah</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('tekanan_darah')
                                is-invalid @enderror" id="tekanan_darah"
                                    placeholder=".. mmHg" name="tekanan_darah" value="{{ old('tekanan_darah',$konsultasi->tekanan_darah) }}" >
                                    @error('tekanan_darah')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="berat_badan">Berat Badan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('berat_badan')
                                is-invalid @enderror" id="berat_badan"
                                    placeholder=".. Kg" name="berat_badan" value="{{ old('berat_badan',$konsultasi->berat_badan) }}" >
                                    @error('berat_badan')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="umur_kehamilan">Umur Kehamilan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('umur_kehamilan')
                                is-invalid @enderror" id="umur_kehamilan"
                                    placeholder=".. Minggu" name="umur_kehamilan" value="{{ old('umur_kehamilan',$konsultasi->umur_kehamilan) }}" >
                                    @error('umur_kehamilan')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tinggi_fundus">Tinggi Fundus</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('tinggi_fundus')
                                is-invalid @enderror" id="tinggi_fundus"
                                    placeholder=".. Cm" name="tinggi_fundus" value="{{ old('tinggi_fundus',$konsultasi->tinggi_fundus) }}" >
                                    @error('tinggi_fundus')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="letak_janin">Letak Janin</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('letak_janin')
                                is-invalid @enderror" id="letak_janin"
                                    placeholder="Kep/Su/Li" name="letak_janin" value="{{ old('letak_janin',$konsultasi->letak_janin) }}" >
                                    @error('letak_janin')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="denyut_janin">Denyut Jantung <br> Janin /Menit</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="denyut_janin1" value="1" name="denyut_janin" 
                                    class="custom-control-input" {{ old('denyut_janin',$konsultasi->denyut_janin) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="denyut_janin1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="denyut_janin2" value="2" name="denyut_janin" 
                                    class="custom-control-input" {{ old('denyut_janin',$konsultasi->denyut_janin) == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="denyut_janin2">Tidak</label>
                                </div>
                                @error('denyut_janin')    
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="kaki_bengkak">Kaki Bengkak</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="kaki_bengkak1" value="1" name="kaki_bengkak" 
                                    class="custom-control-input" {{ old('kaki_bengkak',$konsultasi->kaki_bengkak) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="kaki_bengkak1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="kaki_bengkak2" value="2" name="kaki_bengkak" 
                                    class="custom-control-input" {{ old('kaki_bengkak',$konsultasi->kaki_bengkak) == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="kaki_bengkak2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="hasil_lab">Hasil Pemeriksaan Laboratorium</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('hasil_lab')
                                is-invalid @enderror" id="hasil_lab"
                                    placeholder="Masukkan Hasil laboratorium" name="hasil_lab" value="{{ old('hasil_lab',$konsultasi->hasil_lab) }}" >
                                    @error('hasil_lab')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tindakan">Tindakan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('tindakan')
                                is-invalid @enderror" id="tindakan"
                                    placeholder="pemberian TT/ Fe/ terapi/ rujukan/ umpan balik" name="tindakan" value="{{ old('tindakan',$konsultasi->tindakan) }}" >
                                    @error('tindakan')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nasihat">Nasihat yang disampaikan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('nasihat')
                                is-invalid @enderror" id="nasihat"
                                    placeholder="masukkan nasihat" name="nasihat" value="{{ old('nasihat',$konsultasi->nasihat) }}" >
                                    @error('nasihat')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('keterangan')
                                is-invalid @enderror" id="keterangan"
                                    placeholder="tempat pelayanan/ nama pemeriksa/ paraf" name="keterangan" value="{{ old('keterangan',$konsultasi->keterangan) }}" >
                                    @error('keterangan')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="kpn_kembali">Kapan Harus Kembali</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('kpn_kembali')
                                is-invalid @enderror" id="kpn_kembali"
                                    placeholder="masukkan kapan harus kembali" name="kpn_kembali" value="{{ old('kpn_kembali',$konsultasi->kpn_kembali) }}" >
                                    @error('kpn_kembali')    
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="/konsultasi"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
@endsection