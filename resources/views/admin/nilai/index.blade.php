<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Range Nilai</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/nilai/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
                    <hr>
                 
                    <table id="example1" class="table table-sm table-striped">
                            <thead>
                                <tr style="background:purple;color:white">
                                <th style='width:40px'>No</th>
                                <th style='text-align:center;width:60px'>Nilai</th>
                                <th style='text-align:right;width:60px'>Bobot</th>                                                             
                                <th style='text-align:center;width:60px'>Lulus</th>
                                <th style='text-align:right;width:120px'>Batas Bawah</th>
                                <th style='text-align:right;width:120px'>Batas Atas</th>
                                <th style='text-align:center;width:100px'>Max SKS</th>
                                <th style='text-align:center;width:200px'>Hitung dlm IPK</th>
                                <th style='text-align:left;width:200px'>Deskripsi</th>
                                <th style='text-align:center;width:200px'>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($nilai as $row)
                                    <tr><td>{{ $loop->index+1 }}</td>
                                        <td style='text-align:center;'>{{ $row->Nama}}</td>
                                        <td style='text-align:right;'>{{ $row->Bobot }}</td>                                     
                                        <td style='text-align:center;'>{{ $row->Lulus }}</td>
                                        <td style='text-align:right;'>{{ $row->NilaiMin }}</td>
                                        <td style='text-align:right;'>{{ $row->NilaiMax }}</td>
                                        <td style='text-align:center;'>{{ $row->MaxSKS }}</td>
                                        <td style='text-align:center;'>{{ $row->HitungIPK }}</td>
                                        <td>{{ $row->Deskripsi }}</td>
                                        <td width="90">
                                        <a href="{{ asset('admin/nilai/edit/'.$row->NilaiID.'/'.$kurikulumplh.'/'.$prodiplh) }}" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ asset('admin/nilai/delete/'.$row->NilaiID.'/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
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

