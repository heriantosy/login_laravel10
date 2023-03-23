<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Jenis Pilihan</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/jenispilihan/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
                    <hr>
                 
                    <table id="example" class="table table-sm table-striped">
                            <thead>
                                <tr style="background:purple;color:white">
                                <th style='width:40px'>No</th>
                                <th>Singkatan</th>
                                <th>Nama</th>                              
                               
                                <th>Prodi</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($jenispilihan as $row)
                                    <tr><td>{{ $loop->index+1 }}</td>
                                        <td>{{ $row->Singkatan}}</td>
                                        <td>{{ $row->Nama }}</td>
                                      
                                        <td>{{ $row->ProdiID }}</td>
                                        <td>{{ $row->NA }}</td>
                                        <td>
                                        <a href="{{ asset('admin/jenispilihan/edit/'.$row->JenisPilihanID.'/'.$kurikulumplh.'/'.$prodiplh) }}" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ asset('admin/jenispilihan/delete/'.$row->JenisPilihanID.'/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
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

