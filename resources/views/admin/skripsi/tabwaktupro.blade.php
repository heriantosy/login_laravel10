<?php 
    $kemx = date('Y-m-d',strtotime("-1 days"));
    $todx = date('Y-m-d',strtotime("now"));
    $besx = date('Y-m-d',strtotime("+1 days"));
    $lusx = date('Y-m-d',strtotime("+2 days"));
?>
<p class="btn-group">

 <a href="{{ asset('admin/skripsipro/pro/kemxpro/'.$tahunplh.'/'.$prodiplh.'/'.$kemx) }}"  class="btn btn-danger btn-sm">
 <i class="fa fa-check"></i> Kemaren</a>

  <a href="{{ asset('admin/skripsipro/pro/todxpro/'.$tahunplh.'/'.$prodiplh.'/'.$todx) }}" class="btn btn-warning btn-sm">
  <i class="fa fa-check"></i> Hari Ini</a>

  <a href="{{ asset('admin/skripsipro/pro/besxpro/'.$tahunplh.'/'.$prodiplh.'/'.$besx) }}" class="btn btn-primary btn-sm">
      <i class="fa fa-check"></i> Besok
  </a>

  <a href="{{ asset('admin/skripsipro/pro/lusxpro/'.$tahunplh.'/'.$prodiplh.'/'.$lusx) }}" class="btn btn-success btn-sm">
      <i class="fa fa-check"></i> Lusa
  </a>
		 

</p>