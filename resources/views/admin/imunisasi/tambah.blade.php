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
                  <form action="/imunisasi/store" method="post">
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
                                    <option value=""></option>
                                    @foreach ($balita as $item)
                                        <option value="{{ $item->id_balita }}">{{ $item->nama_anak }}</option>   
                                    @endforeach
                                    
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
                                    <option value="1">HB 0 (0-24 jam)</option>
                                    <option value="2">BCG</option>
                                    <option value="3">*Polio</option>
                                    <option value="4">*DPT-HB-Hib 1</option>
                                    <option value="5">*Polio 2</option>
                                    <option value="6">*DPT-HB-Hib 2</option>
                                    <option value="7">*Polio 3</option>
                                    <option value="8">*DPT-HB-Hib 3</option>
                                    <option value="9">*Polio 4</option>
                                    <option value="10">*IPV</option>
                                    <option value="11">Campak</option>
                                    
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
                                    placeholder="... bulan" name="umur" value="{{ old('umur') }}" >
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
                                    placeholder="... kg" name="tanggal" value="{{ old('tanggal') }}" >
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