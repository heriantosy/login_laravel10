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
                  <form action="/imunisasi/update/{{ $imunisasi->id_imunisasi }}" method="post">
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
                                    <option value="{{ $balita->id_balita }}">{{ $balita->nama_anak }}</option>   
                                    
                                </select>
                            </div>
                        </div>
                        @error('balita_id')    
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jenis_vaksin">Jenis Vaksin</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <select name="jenis_vaksin" id="jenis_vaksin" class="form-control " style="width: 100%">
                                    <option value="1" {{ $imunisasi->jenis_vaksin == 1 ? 'selected' : ''}}>HB 0 (0-24 jam)</option>
                                    <option value="2" {{ $imunisasi->jenis_vaksin == 2 ? 'selected' : ''}}>BCG</option>
                                    <option value="3" {{ $imunisasi->jenis_vaksin == 3 ? 'selected' : ''}}>*Polio</option>
                                    <option value="4" {{ $imunisasi->jenis_vaksin == 4 ? 'selected' : ''}}>*DPT-HB-Hib 1</option>
                                    <option value="5" {{ $imunisasi->jenis_vaksin == 5 ? 'selected' : ''}}>*Polio 2</option>
                                    <option value="6" {{ $imunisasi->jenis_vaksin == 6 ? 'selected' : ''}}>*DPT-HB-Hib 2</option>
                                    <option value="7" {{ $imunisasi->jenis_vaksin == 7 ? 'selected' : ''}}>*Polio 3</option>
                                    <option value="8" {{ $imunisasi->jenis_vaksin == 8 ? 'selected' : ''}}>*DPT-HB-Hib 3</option>
                                    <option value="9" {{ $imunisasi->jenis_vaksin == 9 ? 'selected' : ''}}>*Polio 4</option>
                                    <option value="10" {{ $imunisasi->jenis_vaksin == 10 ? 'selected' : ''}}>*IPV</option>
                                    <option value="11" {{ $imunisasi->jenis_vaksin == 11 ? 'selected' : ''}}>Campak</option>
                                    
                                </select>
                            </div>
                        </div>
                        @error('jenis_vaksin')    
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                                    placeholder="... bulan" name="umur" value="{{ old('umur',$imunisasi->umur) }}" >
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
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="date" class="form-control @error('tanggal')
                                is-invalid @enderror" id="tanggal"
                                    placeholder="... kg" name="tanggal" value="{{ old('tanggal',$imunisasi->tanggal) }}" >
                                    @error('tanggal')    
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
                                <a href="/imunisasi"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
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