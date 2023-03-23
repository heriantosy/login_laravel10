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
                  <form action="/status-pasien/update_balita/{{ $balita->id_balita }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Status Balita</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status1" value="1" name="status"
                                     class="custom-control-input" {{ old('status',$balita->status) == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status1">Balita</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="status2" value="0" name="status" 
                                    class="custom-control-input" {{ old('status',$balita->status) == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status2">Bukan Balita</label>
                                  </div>
                                </div>
                                @error('status')    
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="/status-pasien"  class="btn btn-danger"><i class="fas fa-times"></i> batal</a>
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