<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Konsentrasi</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/konsentrasi/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
            <hr>                 
            <table id="example" class="table table-sm table-striped">
            <thead>
                <tr style="background:purple;color:white">
                <th style='width:40px'>No</th>
                <th>konsentrasi</th>
                <th>Nama</th>                                 
                <th>Prodi</th>
                <th>Aktif</th>
                <th>Aksi</th>
              
                </tr>
                </thead>
                <tbody>
                    @foreach($konsentrasi as $row)
                    <tr><td>{{ $loop->index+1 }}</td>
                        <td>{{ $row->KonsentrasiKode}}</td>
                        <td>{{ $row->Nama }}</td>                                      
                        <td>{{ $row->ProdiID }}</td>
                        <td>{{ $row->NA }}</td>
                        <td width="90">
                        <a href="{{ asset('admin/konsentrasi/edit/'.$row->KonsentrasiID.'/'.$kurikulumplh.'/'.$prodiplh) }}" ><i class="fa fa-edit"></i></a>
                        <a href="{{ asset('admin/konsentrasi/delete/'.$row->KonsentrasiID.'/'.$kurikulumplh.'/'.$prodiplh) }}" onclick="return confirm('Yakin data akan dihapus ?')">
                        <i class="fa fa-trash"></i>
                        </a>
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

