<p class="btn-group">

 <a href="{{ asset('admin/mahasiswa') }}"  class="btn btn-success btn-sm">
 <i class="fa fa-check"></i> Master</a>

  <a href="{{ asset('admin/mahasiswa/detailpribadi/'.$nimplh) }}" class="btn btn-warning btn-sm">
  <i class="fa fa-check"></i> Pribadi</a>

  <a href="{{ asset('admin/mahasiswa/detailalamat/'.$nimplh) }}" class="btn btn-primary btn-sm">
      <i class="fa fa-check"></i>Alamat Tetap
  </a>

  <a href="{{ asset('admin/mahasiswa/detailakademik/'.$nimplh) }}" class="btn btn-danger btn-sm">
      <i class="fa fa-check"></i>Akademik
  </a>

    <a href="{{ asset('admin/mahasiswa/detailortu/'.$nimplh) }}" class="btn btn-info btn-sm">
      <i class="fa fa-check"></i>Orang Tua
  </a>		

    <a href="{{ asset('admin/mahasiswa/detailasalsekolah/'.$nimplh) }}" class="btn btn-success btn-sm">
        <i class="fa fa-check"></i>Asal Sekolah
    </a>	

    <a href="{{ asset('admin/mahasiswa/detailasalpt/'.$nimplh) }}" class="btn btn-warning btn-sm">
        <i class="fa fa-check"></i>Asal Perguruan Tinggi
    </a>	

 

    <a href="{{ asset('admin/mahasiswa/detailbank/'.$nimplh) }}" class="btn btn-primary btn-sm">
    <i class="fa fa-check"></i>Bank
    </a>			 

</p>