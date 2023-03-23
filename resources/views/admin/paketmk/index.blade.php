<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Paket MK</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/paketmk/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
            <hr>  
            <table id="example" class="table table-sm table-striped">
            <thead>
                <tr style="background:purple;color:white">
                <th style='width:40px'>No</th>
                <th>Nama Paket</th>
                <th>Kurikulum</th>                              
                <th>Deskripsi</th>
                <th style='text-align:center'>NA</th>
                <th style='text-align:right'>Jml MK</th>
                <th style='text-align:right'>SKS</th>
                <th style='text-align:center'>Aksi</th>
              
                </tr>
                </thead>
                <tbody>
                    @foreach($paketmk as $row)
                    <?php
                    //$namakur	= DB::table('kurikulum')->where('KurikulumID',$row->KurikulumID)->get();
                    $jmlMK		= DB::table('mkpaketisi')->where('MKPaketID',$row->MKPaketID)->where('KurikulumID',$row->KurikulumID)->count();
                    $totSKS		= DB::table('mkpaketisi')
                    ->join('mk','mk.MKID','=','mkpaketisi.MKID')
                    //->select(DB::raw('SUM(mk.SKS) as tSKS'))
                    ->select('mkpaketisi.*','mk.SKS')
                    ->where('mkpaketisi.MKPaketID',$row->MKPaketID)
                    ->where('mkpaketisi.KurikulumID',$row->KurikulumID)
                    ->sum('mk.SKS');
                    ?>
                    <tr><td>{{ $loop->index+1 }}</td>
                        <td>{{ $row->Nama }}</td>
                        <td>{{ $row->NamaKur }}</td>             
                        <td>{{ $row->Deskripsi }}</td>
                        <td style='text-align:center'>{{ $row->NA }}</td>
                        <td style='text-align:right'>{{ $jmlMK }}</td>
                        <td style='text-align:right'>{{ $totSKS }}</td>
                        <td style='text-align:center'>
                        <a href="{{ asset('admin/paketmk/isipaket/'.$row->MKPaketID.'/'.$row->KurikulumID.'/'.$row->ProdiID) }}" 
                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ asset('admin/paketmk/deletepaket/'.$row->MKPaketID.'/'.$row->KurikulumID.'/'.$row->ProdiID) }}" class="btn btn-danger btn-sm  delete-link">
                            <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>  

