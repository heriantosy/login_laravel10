
<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>

<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">

            <div class="card-body">                    
                    <a href="/tahunakademik/create" class="btn btn-danger btn-sm">Tambah Data</a>
                    <hr>
                 
                    <table id="example1" class="table table-sm table-striped">
                            <thead>
                                <tr style="background:purple;color:white">
                                <th style='width:40px'>No</th>
                                <th>KodeMK</th>
                                <th>Nama</th>                              
                                <th>SKS</th>
                                <th>Setara</th>
                                <th>Aksi</th>
                                <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($mksetara as $row)
                                    <tr><td>{{ $loop->index+1 }}</td>
                                        <td>{{ $row->MKKode}}</td>
                                        <td>{{ $row->Nama }}</td>
                                        <td>{{ $row->SKS }}</td>
                                        <td>{{ $row->NA }}</td>
                                        <td width="50">
                                            <a href="/mksetara/{{ $row->MKID}}/edit"><i class="fas fa-edit"></i></a>                                      
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

