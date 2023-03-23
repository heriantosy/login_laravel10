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
                 
                  <form action="/pasien/update_balita/{{ $balita->id_balita }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nama_anak">Nama Anak</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_anak"
                                placeholder="Nama Anak" name="nama_anak" value="{{ old('nama_anak', $balita->nama_anak) }}">
                                    @error('nama_anak')    
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
                                <input type="text" class="form-control" id="email"
                                placeholder="Email" name="email" value="{{ old('email', $balita->email) }}">
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
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="jenis_kelamin1" value="L" name="jenis_kelamin"
                                     class="custom-control-input" {{ old('level',$balita->jenis_kelamin) === "L" ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="jenis_kelamin1">Laki-Laki</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="jenis_kelamin2" value="P" name="jenis_kelamin" 
                                    class="custom-control-input" {{ old('level',$balita->jenis_kelamin) === "P" ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="jenis_kelamin2">Perempuan</label>
                                  </div>
                                    @error('jenis_kelamin')    
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
                                <label for="nik_anak">Nik Anak</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control" id="nik_anak"
                                    placeholder="Nik Anak" name="nik_anak" value="{{ old('nik_anak',$balita->nik_anak) }}">
                                    @error('nik_anak')    
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
                                <label for="anak_ke">Anak Ke</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control" id="anak_ke"
                                  placeholder="Anak ke .." name="anak_ke" value="{{ old('anak_ke',$balita->anak_ke) }}">
                                    @error('anak_ke')    
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
                                <label for="bb_lahir">Berat Badan Lahir <br>(kg)</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="bb_lahir"
                                  placeholder=".... Kg)" name="bb_lahir" value="{{ old('bb_lahir',$balita->bb_lahir) }}">
                                    @error('bb_lahir')    
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
                                <label for="tgl_lahir">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="date" class="form-control" id="tgl_lahir"
                                placeholder="" name="tgl_lahir" value="{{ old('tgl_lahir', $balita->tgl_lahir) }}">
                                    @error('tgl_lahir')    
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
                                <label for="no_kk">No. KK</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="no_kk"
                                placeholder="" name="no_kk" value="{{ old('no_kk', $balita->no_kk) }}">
                                    @error('no_kk')    
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
                                <label for="nama_ortu">Nama Orang tua ayah/ibu</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_ortu"
                                placeholder="" name="nama_ortu" value="{{ old('nama_ortu', $balita->nama_ortu) }}">
                                    @error('nama_ortu')    
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
                                <label for="nik_ortu">Nik Orang tua ayah/ibu</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nik_ortu"
                                placeholder="" name="nik_ortu" value="{{ old('nik_ortu', $balita->nik_ortu) }}">
                                    @error('nik_ortu')    
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
                                <label for="hp_ortu">Nomor HP Orang Tua</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="hp_ortu"
                                placeholder="" name="hp_ortu" value="{{ old('hp_ortu', $balita->hp_ortu) }}">
                                    @error('hp_ortu')    
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
                                <label for="alamat">Alamat</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea class="form-control" id="alamat" name="alamat" >{{ old('alamat',$balita->alamat) }}</textarea>
                                @error('alamat')    
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
                                <label for="bb_sekarang">Berat Badan sekarang <br> (Kg)</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="bb_sekarang"
                                  placeholder="Berat Badan sekarang (Kg)" name="bb_sekarang" 
                                  value="{{ old('bb_sekarang',$balita->bb_sekarang) }}">
                                    @error('bb_sekarang')    
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
                                <label for="tb_sekarang">Tinggi Badan sekarang <br> (Kg)</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="tb_sekarang"
                                  placeholder="Tinggi Badan sekarang (Cm)" name="tb_sekarang" 
                                  value="{{ old('tb_sekarang',$balita->tb_sekarang) }}">
                                    @error('tb_sekarang')    
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
                                <label for="asi_ekslusif">Asi Ekslusif</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="asi_ekslusif1" value="1" name="asi_ekslusif" 
                                    class="custom-control-input" {{ old('asi_ekslusif',$balita->asi_ekslusif) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="asi_ekslusif1">Ya</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="asi_ekslusif2" value="2" name="asi_ekslusif" 
                                    class="custom-control-input" {{ old('asi_ekslusif',$balita->asi_ekslusif) == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="asi_ekslusif2">Tidak</label>
                                  </div>
                                    @error('asi_ekslusif')    
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
                                <label for="imd">IMD</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="imd1" value="1" name="imd" 
                                    class="custom-control-input" {{ old('imd',$balita->imd) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="imd1">Ya</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="imd2" value="2" name="imd" 
                                    class="custom-control-input" {{ old('imd',$balita->imd) == 2 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="imd2">Tidak</label>
                                  </div>
                                    @error('imd')    
                                        <div class="alert alert-danger">
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