
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/tahun/tambah_proses') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type='hidden' name="ProdiID" value="<?php echo $prodiplh?>">
<input type='hidden' name="ProgramID" value="<?php echo $programplh?>">
<div class="row form-group">
  <label class="col-md-3">Tahun Akademik</label>
  <div class="col-md-8">
    <input type="text" name="TahunID" class="form-control form-control-sm" placeholder="Tahun Akademik" required="required" value="{{ old('TahunID') }}">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Nama Tahun</label>
  <div class="col-md-8">
    <input type="text" name="Nama" class="form-control form-control-sm" placeholder="Nama Tahun" value="{{ old('Nama') }}">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> KRS
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai KRS</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai KRS</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Akhir Cetak KSS-KRS</label>
  <div class="col-md-8">
    <input type="text" name="TglAkhirKSS" class="form-control tanggal form-control-sm" placeholder="Akhir Cetak KSS-KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>



<p class="alert alert-info">
  <i class="fa fa-book "></i> KRS Online (Untuk Mahasiswa)
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai KRS Online</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSOnlineMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai KRS Online</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSOnlineSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> KPRS
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai KPRS</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSMulaix" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai KPRS</label>
  <div class="col-md-8">
    <input type="text" name="TglKRSSelesaix" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Akhir Cetak KSS-KPRS</label>
  <div class="col-md-8">
    <input type="text" name="AkhirCetakKSS-KPRSxx" class="form-control tanggal form-control-sm" placeholder="Akhir Cetak KSS-KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> Batas-batas
</p>

<div class="row form-group">
  <label class="col-md-3">Batas Pengajuan Cuti</label>
  <div class="col-md-8">
    <input type="text" name="TglCuti" class="form-control tanggal form-control-sm" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Batas Mundur Kuliah</label>
  <div class="col-md-8">
    <input type="text" name="TglMundur" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Batas Ambil Kelebihan Uang Kuliah</label>
  <div class="col-md-8">
    <input type="text" name="TglKembaliUangKuliah" class="form-control tanggal form-control-sm" placeholder="Akhir Cetak KSS-KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> Masa Pembayaran
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai Pembayaran</label>
  <div class="col-md-8">
    <input type="text" name="TglBayarMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai Pembayaran</label>
  <div class="col-md-8">
    <input type="text" name="TglBayarSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pembayaran Autodebet 1</label>
  <div class="col-md-8">
    <input type="text" name="TglAutodebetSelesai" class="form-control tanggal form-control-sm" placeholder="Akhir Cetak KSS-KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Pembayaran Autodebet 2</label>
  <div class="col-md-8">
    <input type="text" name="TglAutodebetSelesai2" class="form-control tanggal form-control-sm" placeholder="Akhir Cetak KSS-KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> Tanggal Kuliah
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai Kuliah</label>
  <div class="col-md-8">
    <input type="text" name="TglKuliahMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai Kuliah</label>
  <div class="col-md-8">
    <input type="text" name="TglKuliahSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> Tanggal Ujian Tengah Semester
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai UTS</label>
  <div class="col-md-8">
    <input type="text" name="TglUTSMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai UTS</label>
  <div class="col-md-8">
    <input type="text" name="TglUTSSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<p class="alert alert-info">
  <i class="fa fa-book "></i> Tanggal Ujian Akhir Semester
</p>

<div class="row form-group">
  <label class="col-md-3">Mulai UAS</label>
  <div class="col-md-8">
    <input type="text" name="TglUASMulai" class="form-control tanggal form-control-sm" placeholder="Mulai KRS" value="<?php echo date('d-m-Y')?>">
  </div>
</div>


<div class="row form-group">
  <label class="col-md-3">Selesai UAS</label>
  <div class="col-md-8">
    <input type="text" name="TglUASSelesai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Akhir Penilaian</label>
  <div class="col-md-8">
    <input type="text" name="TglNilai" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tanggal Habis KSS</label>
  <div class="col-md-8">
    <input type="text" name="TglAkhirKSS" class="form-control tanggal form-control-sm"  value="<?php echo date('d-m-Y')?>">
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Catatan</label>
  <div class="col-md-8">
    <textarea name="Catatan" class="form-control form-control-sm" ></textarea>
   
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3">Tidak Aktif?</label>
  <div class="col-md-8">
  <input type=checkbox name='NA' value='Y'>
  </div>
</div>

<div class="row form-group">
  <label class="col-md-3"></label>
  <div class="col-md-9">
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
      <a href="{{ asset('admin/tahun') }}" class="btn btn-success btn-sm">
    <i class="fa fa-backward"></i> Kembali
  </a>
    </div>
  </div>
</div>
</form>

