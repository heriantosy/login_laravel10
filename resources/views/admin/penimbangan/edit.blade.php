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
                  <form action="/penimbangan/update/{{ $nimbang->id_timbang }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="email">Nama Anak</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <select name="balita_id" id="id_balita" class="select2 form-control " style="width: 100%">
                                        <option value="{{ $balita->id_balita }}" selected>{{ $balita->nama_anak }}</option>
                                </select>
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
                                is-invalid @enderror" id="tanggal" placeholder="tanggal penimbangan" 
                                name="tanggal" value="{{ old('tanggal',$nimbang->tanggal) }}" >
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
                                <label for="umur">Umur (Bulan)</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control @error('umur')
                                is-invalid @enderror" id="umur"
                                    placeholder="... bulan" name="umur" 
                                    value="{{ old('umur',$nimbang->umur) }}" >
                                    @error('umur')    
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
                                <input type="number" class="form-control @error('berat_badan')
                                is-invalid @enderror" id="berat_badan"
                                    placeholder="... kg" name="berat_badan" 
                                    value="{{ old('berat_badan',$nimbang->berat_badan) }}" >
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
                                <label for="tinggi_badan">Tinggi Badan</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control @error('tinggi_badan')
                                is-invalid @enderror" id="tinggi_badan"
                                    placeholder="... cm" name="tinggi_badan" 
                                    value="{{ old('tinggi_badan',$nimbang->tinggi_badan) }}" >
                                    @error('tinggi_badan')    
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
                                <label for="lingkar_kepala">Lingkar Kepala</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="number" class="form-control @error('lingkar_kepala')
                                is-invalid @enderror" id="lingkar_kepala"
                                    placeholder="... cm" name="lingkar_kepala" 
                                    value="{{ old('lingkar_kepala',$nimbang->lingkar_kepala) }}" >
                                    @error('lingkar_kepala')    
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
                                <a href="/penimbangan"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
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