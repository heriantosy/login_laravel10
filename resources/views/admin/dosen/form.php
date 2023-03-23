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
                  <form action="../proses/anggota.php?act=tambah_anggota" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id_identitas">Kode anggota</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="id_identitas"
                                    placeholder="Masukkan kode anggota anda" name="id_identitas" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nama_anggota">Nama Anggota</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_anggota"
                                    placeholder="John" name="nama_anggota" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="date" class="form-control" id="tgl_lahir"
                                name="tgl_lahir" required>
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
                                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            
                            <div class="form-group">
                                <label for="no_telp">No. Hp</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" id="no_telp"
                                    placeholder="08*******" name="no_telp" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="pekerjaan" class="form-control" id="pekerjaan"
                                        placeholder="buruh" name="pekerjaan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                </div>
                        </div>
                        <div class="col-md-10">
                                <div class="form-group d-flex flex-row align-items-center">
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="status1" name="status_anggota" class="custom-control-input"
                                        value="1">
                                        <label class="custom-control-label" for="status1">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="status0" name="status_anggota" class="custom-control-input"
                                        value="0">
                                        <label class="custom-control-label" for="status0">Tidak Aktif</label>
                                    </div>
                                
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
                                        <input type="radio" id="pimpinan" name="level" class="custom-control-input"
                                        value="1">
                                        <label class="custom-control-label" for="pimpinan">Pimpinan</label>
                                    </div>
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="petugas" name="level" class="custom-control-input"
                                        value="2">
                                        <label class="custom-control-label" for="petugas">Petugas</label>
                                    </div>
                                    <div class="custom-control custom-radio pr-3">
                                        <input type="radio" id="anggota" name="level" class="custom-control-input"
                                        value="3">
                                        <label class="custom-control-label" for="anggota">Anggota</label>
                                    </div>
                                
                                </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="?page=anggota"  class="btn btn-danger"><i class="fas fa-times"></i>batal</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>Simpan</button>
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