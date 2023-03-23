<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-6">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Predikat</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/predikat/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
                    <hr>
                    <table id="example" class="table table-sm table-striped">
                            <thead>
                                <tr style="background:purple;color:white">
                                <th style='width:5px'>No</th>
                                <th style='text-align:right;width:50px'>IPK MIn</th>
                                <th style='text-align:right;width:50px'>IPK Max</th>                                   
                                <th style='text-align:left;width:200px'>Predikat</th>
                                <th style='text-align:left;width:100px'>Keterangan</th>
                                <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($predikat as $row)
                                    <tr><td>{{ $loop->index+1 }}</td>
                                        <td style='text-align:right'>{{ $row->IPKMin}}</td>
                                        <td style='text-align:right'>{{ $row->IPKMax }}</td>
                                        <td>{{ $row->Nama }}</td>
                                        <td>{{ $row->Keterangan }}</td>
                                        <td>
                                        <a href="{{ asset('admin/predikat/edit/'.$row->PredikatID.'/'.$kurikulumplh.'/'.$prodiplh) }}" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ asset('admin/predikat/delete/'.$row->PredikatID.'/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
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

