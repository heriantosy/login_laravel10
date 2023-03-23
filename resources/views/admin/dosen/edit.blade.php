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
                  <form action="/pegawai/{{ $pegawai->id_pegawai }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('nama_pegawai')
                                is-invalid @enderror" id="nama_pegawai" placeholder="John" name="nama_pegawai" 
                                    value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" >
                                    @error('nama_pegawai')    
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
                                <input type="email" class="form-control @error('email')
                                is-invalid @enderror" id="email" placeholder="email@example.com" name="email" 
                                    value="{{ old('email', $pegawai->email) }}" >
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
                                <label for="no_hp">No. Hp</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control @error('no_hp')
                                is-invalid @enderror" id="no_hp" placeholder="08*******" name="no_hp" 
                                    value="{{ old('no_hp', $pegawai->no_hp) }}" >
                                    @error('no_hp')    
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
                                <label>Alamat</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat')
                                is-invalid @enderror" >{{ old('alamat', $pegawai->alamat) }}</textarea>
                                @error('alamat')    
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
                                    <label>Hak Akses</label>
                                </div>
                        </div>
                        <div class="col-md-10">
                                <div class="form-group d-flex flex-row align-items-center">
                                    
                                    
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="level" name="level" class="custom-control-input"
                                        value="2" 
                                        @foreach ($user as $p)
                                        {{ old('level',$p->level) == 2 ? 'checked' : '' }}
                                        @endforeach
                                        >
                                        <label class="custom-control-label" for="level">Kader</label>
                                    </div>
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="level2" name="level" class="custom-control-input"
                                        value="1" 
                                        @foreach ($user as $p)
                                        {{ old('level',$p->level) == 1 ? 'checked' : '' }}
                                        @endforeach
                                        >
                                        <label class="custom-control-label" for="level2">Pimpinan</label>
                                    </div>
                                </div>
                                @if(session()->has('levelError'))
                                <p class="alert alert-danger">{{ session('levelError') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="/pegawai"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
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