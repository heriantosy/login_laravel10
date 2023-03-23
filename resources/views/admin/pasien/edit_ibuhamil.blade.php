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
                 
                  <form action="/pasien/update_ibuhamil/{{ $ibuhamil->id_ibuhamil }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('nama_ibu')
                                is-invalid @enderror" id="nama_ibu"
                                    placeholder="" name="nama_ibu" value="{{ old('nama_ibu',$ibuhamil->nama_ibu) }}" >
                                    @error('nama_ibu')    
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
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('email')
                                is-invalid @enderror" id="email"
                                    placeholder="" name="email" value="{{ old('email',$ibuhamil->email) }}" >
                                    @error('email')    
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
                                <label for="tempat_lahir_ibu">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('tempat_lahir_ibu')
                                is-invalid @enderror" id="tempat_lahir_ibu"
                                    placeholder="" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu',$ibuhamil->tempat_lahir_ibu) }}" >
                                    @error('tempat_lahir_ibu')    
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
                                <label for="tgl_lahir_ibu">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('tgl_lahir_ibu')
                                is-invalid @enderror" id="tgl_lahir_ibu"
                                    placeholder="" name="tgl_lahir_ibu" value="{{ old('tgl_lahir_ibu',$ibuhamil->tgl_lahir_ibu) }}" >
                                    @error('tgl_lahir_ibu')    
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
                                <label for="hamil_ke">Kehamilan ke</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('hamil_ke')
                                is-invalid @enderror" id="hamil_ke"
                                    placeholder="" name="hamil_ke" value="{{ old('hamil_ke',$ibuhamil->hamil_ke) }}" >
                                    @error('hamil_ke')    
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
                                <label for="umur_anak_terakhir">Umur Anak Terakhir</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('umur_anak_terakhir')
                                is-invalid @enderror" id="umur_anak_terakhir"
                                    placeholder="" name="umur_anak_terakhir" value="{{ old('umur_anak_terakhir',$ibuhamil->umur_anak_terakhir) }}" >
                                    @error('umur_anak_terakhir')    
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
                                <label for="agama_ibu">Agama</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama1" value="1" name="agama_ibu" class="custom-control-input"
                                    {{ $ibuhamil->agama_ibu == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama1">ISLAM</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama2" value="2" name="agama_ibu" class="custom-control-input" 
                                    {{ $ibuhamil->agama_ibu == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama2" >KRISTEN</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama3" value="3" name="agama_ibu" class="custom-control-input"
                                    {{ $ibuhamil->agama_ibu == 3 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama3">HINDU</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama4" value="4" name="agama_ibu" class="custom-control-input"
                                    {{ $ibuhamil->agama_ibu == 4 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama4">BUDHA</label>
                                </div>
                                @error('agama_ibu')    
                                      <div class="alert alert-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pendidikan_ibu">Pendidikan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu1" value="0" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu1">Tidak Sekolah</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu2" value="1" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu2">SD</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu3" value="2" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu3">SMP</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu4" value="3" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 3 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu4">SMA</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu5" value="4" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 4 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu5">Akademi</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_ibu6" value="5" name="pendidikan_ibu" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_ibu == 5 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_ibu6">Perguruan Tinggi</label>
                                  </div>
                                    @error('pendidikan_ibu')    
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
                                <label for="goldarah_ibu">Gol. Darah Ibu</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="goldarah_ibu"
                                placeholder=" Gol. Darah Ibu" name="goldarah_ibu" value="{{ old('goldarah_ibu', $ibuhamil->goldarah_ibu) }}">
                                    @error('goldarah_ibu')    
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
                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="pekerjaan_ibu"
                                placeholder=" Gol. Darah Ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $ibuhamil->pekerjaan_ibu) }}">
                                    @error('pekerjaan_ibu')    
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
                                <label for="nama_suami">Nama Suami</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_suami"
                                placeholder=" Gol. Darah Ibu" name="nama_suami" value="{{ old('nama_suami', $ibuhamil->nama_suami) }}">
                                    @error('nama_suami')    
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
                                <label for="tempat_lahir_suami">Tempat Lahir Suami</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="tempat_lahir_suami"
                                placeholder=" Gol. Darah Ibu" name="tempat_lahir_suami" value="{{ old('tempat_lahir_suami', $ibuhamil->tempat_lahir_suami) }}">
                                    @error('tempat_lahir_suami')    
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
                                <label for="tgl_lahir_suami">Tanggal Lahir Suami</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="date" class="form-control" id="tgl_lahir_suami"
                                placeholder=" Gol. Darah Ibu" name="tgl_lahir_suami" value="{{ old('tgl_lahir_suami', $ibuhamil->tgl_lahir_suami) }}">
                                    @error('tgl_lahir_suami')    
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
                                <label for="agama_suami">Agama Suami</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama1" value="1" name="agama_suami" class="custom-control-input"
                                    {{ $ibuhamil->agama_suami == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama1">ISLAM</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama2" value="2" name="agama_suami" class="custom-control-input" 
                                    {{ $ibuhamil->agama_suami == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama2" >KRISTEN</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama3" value="3" name="agama_suami" class="custom-control-input"
                                    {{ $ibuhamil->agama_suami == 3 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama3">HINDU</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="agama4" value="4" name="agama_suami" class="custom-control-input"
                                    {{ $ibuhamil->agama_suami == 4 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="agama4">BUDHA</label>
                                </div>
                                @error('agama_suami')    
                                      <div class="alert alert-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pendidikan_suami">Pendidikan Suami</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami1" value="0" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami1">Tidak Sekolah</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami2" value="1" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami2">SD</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami3" value="2" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami3">SMP</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami4" value="3" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 3 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami4">SMA</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami5" value="4" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 4 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami5">Akademi</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="pendidikan_suami6" value="5" name="pendidikan_suami" class="custom-control-input"
                                    {{ $ibuhamil->pendidikan_suami == 5 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pendidikan_suami6">Perguruan Tinggi</label>
                                  </div>
                                    @error('pendidikan_suami')    
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
                                <a href="/pasien"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
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