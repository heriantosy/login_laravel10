<style type="text/css" media="screen">
  .nav ul li p !important {
    font-size: 12px;
  }
  .infoku {
    margin-left: 20px; 
    text-transform: uppercase;
    color: yellow;
    font-size: 11px;
  }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('admin/dasbor') }}" class="brand-link">
     
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- DASHBOARD -->
          <li class="nav-item">
            <a href="{{ asset('admin/dasbor') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- leweh add -->
 <!-- Website Content -->
 <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Master</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Master<i class="fas fa-angle-left right"></i></p>
            </a>
            @if (auth()->user()->level == 1)
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/tahun') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Data Tahun</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/prodi') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Prodi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/dosen') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Dosen</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/matakuliah') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Matakuliah</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/mahasiswa') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Mahasiswa</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/ruang') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Ruang</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/asalsekolah') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data Asal Sekolah</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>PMB<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/setuppmb') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Setup PMB</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pmb/pmbjualform') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Penjualan Formulir</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pmb') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Data PMB</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pmb/pmbtahun') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>PMB Per Tahun</p></a>
              </li>
            </ul>
          </li>

          
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Jurusan<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/jadwal') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Jadwal Kuliah</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/jadwalx') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Jadwal & File</p></a>
              </li>

              <li class="nav-item"><a href="{{ asset('admin/jadwalujian') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Jadwal Ujian</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/absensi') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Absensi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/krsadm') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>KRS</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/nilaieditmhs') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Edit Matakuliah Mhsw</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/khsadm') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>KHS</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/transkrip') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Transkrip</p></a>
              </li>
            </ul>
          </li>
          @elseif (auth()->user()->level == 2)

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Dosen<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/jadwalkuliahdosen') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Jadwal Kuliah</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/jadwalkuliahdosen') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Nilai Kuliah</p></a>
              </li>

            </ul>
          </li>
          @elseif (auth()->user()->level == 3)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Mahasiswa<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/krsadm') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Kartu Rencana Studi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/jadwalujian/cekkehadiran') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Cek Kehadiran</p></a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Semester Pendek<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/pengajuansp') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Pengajuan SP</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pengajuansp/nilaisp/20201/SI') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Nilai SP</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/khsadmsp') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Cetak Kartu Hasil Studi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/transkripsp') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Cetak Transkrip</p></a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Kerja Praktek<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/pengajuansp') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Pengajuan Judul KP</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kerjapraktekpro') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Proposal KP</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kerjapraktekpro/hasilkp') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Hasil KP</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kerjapraktekpro/nilaikp/20201/SI') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Proses Nilai KP</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Skripsi<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/pengajuanta') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Pengajuan Judul</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/skripsipro') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Proposal Skripsi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/skripsihsl/2021/SI') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Hasil Skripsi</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/skripsinilai/nilaita/20201/SI') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Proses Nilai</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/refjudul') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Referensi Judul</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/ujianprogram') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Ujian Program</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/yudisium') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Yudisium</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/sinkronskripsi') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Sinkron Skripsi</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Dok SPMI<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/agenda') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Kebijakan SPMI</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/agenda/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Event &amp; Agenda</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_agenda') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Event &amp; Agenda</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Kepegawaian<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ asset('admin/pegawai') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>List Pegawai</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pelatihan') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Pelatihan/Workshop</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pengajuancuti') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Pengajuan Cuti</p></a>
              </li>
            </ul>
          </li>
          @elseif (auth()->user()->level == 3)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Laporan<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/lapakademik') }}" class="nav-link"><i class="fas fa-tags nav-icon"></i><p>Laporan Akademik</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/sppangkatan') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>SPP Per Angkatan</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/pmb/angkapmb') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>PMB Dalam Angka</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/mahasiswa/angkamahasiswa') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Mhs Baru Dalam Angka</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/mahasiswaaktif/angkamahasiswaaktif') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Mhs Aktif Dalam Angka</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/mahasiswa/angkalulusan') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Lulus Dalam Angka</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/lapakademik/lapbkddosen') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Laporan BKD</p></a>
              </li>
            </ul>
          </li>
          <!-- end leweh add -->
          
          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Berita &amp; Updates</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Berita &amp; Update<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/berita') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Berita &amp; Update</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/berita/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Berita/Update</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori berita</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Galeri &amp; Banner<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/galeri') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Galeri</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/galeri/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Galeri</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_galeri') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Galeri</p></a>
              </li>
            </ul>
          </li>

          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Event &amp; Agenda<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/agenda') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Event &amp; Agenda</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/agenda/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Event &amp; Agenda</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_agenda') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Event &amp; Agenda</p></a>
              </li>
            </ul>
          </li>
          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-download"></i>
              <p>Download &amp; File<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/download') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data File</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/download/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah File</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_download') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori File</p></a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin/video') }}" class="nav-link">
              <i class="nav-icon fas fa-film"></i>
              <p>Video Webinar</p>
            </a>
          </li>

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Profil &amp; Layanan</span></li>
          <li class="batas"><hr></li>

          <li class="nav-item">
            <a href="{{ asset('admin/konfigurasi/profil') }}" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>Update Profil</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin/berita/jenis_berita/Layanan') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Layanan</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Board &amp; Team<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/staff') }}" class="nav-link"><i class="fas fa-newspaper nav-icon"></i><p>Data Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/staff/tambah') }}" class="nav-link"><i class="fa fa-plus nav-icon"></i><p>Tambah Board &amp; Team</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/kategori_staff') }}" class="nav-link"><i class="fa fa-tags nav-icon"></i><p>Kategori Board &amp; Team</p></a>
              </li>
            </ul>
          </li>

          <!-- Website Content -->
          <li class="batas"><hr> <span class="infoku"><i class="fa fa-certificate"></i> Website Setting</span></li>
          <li class="batas"><hr></li>
          <li class="nav-item">
            <a href="{{ asset('admin/user') }}" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Pengguna Web</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ asset('admin/heading') }}" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>Header Gambar</p>
            </a>
          </li>
          
          <!-- MENU -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Konfigurasi
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Konfigurasi Umum</p></a>
              </li>
            
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/logo') }}" class="nav-link"><i class="fa fa-home nav-icon"></i><p>Ganti Logo</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/icon') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Ganti Icon</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/konfigurasi/email') }}" class="nav-link"><i class="fa fa-envelope nav-icon"></i><p>Email Setting</p></a>
              </li>
              <li class="nav-item"><a href="{{ asset('admin/rekening') }}" class="nav-link"><i class="fas fa-book nav-icon"></i><p>Rekening</p></a>
              </li>
            </ul>
          </li>

          @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              <div class="col-md-12">
                 <h2 class="card-title"><?php echo $title ?></h2> 
              </div>
             
              
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
<div class="table-responsive konten">
    
    
    <!-- Leweh add-->
<script>
  /** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    return this.href == url;
}).addClass('active');

// for treeview
$('ul.nav-treeview a').filter(function() {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open') .prev('a').addClass('active');
</script>

<!-- end leweh add-->

    