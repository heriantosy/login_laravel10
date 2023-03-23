<p class="btn-group">

 <a href="{{ asset('admin/pmb/pmbjualform') }}"  class="btn btn-success btn-sm">
 <i class="fa fa-check"></i> Daftar Form</a>

  <a href="{{ asset('admin/pmb/formulirterjual/'.$pmbperiodplh.'/'.$formulirplh) }}" class="btn btn-warning btn-sm">
  <i class="fa fa-check"></i> Jumlah Formulir Terjual</a>

  <a href="{{ asset('admin/pmb/jualformulir/'.$pmbperiodplh.'/'.$formulirplh) }}" class="btn btn-primary btn-sm">
      <i class="fa fa-check"></i>Jual Formulir
  </a>

  <a href="{{ asset('admin/pmb/editkwitansi/'.$pmbperiodplh.'/'.$formulirplh) }}" class="btn btn-danger btn-sm">
      <i class="fa fa-check"></i>Edit Kwitansi
  </a>

</p>