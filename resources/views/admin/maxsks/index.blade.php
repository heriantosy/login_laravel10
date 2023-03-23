<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Max SKS</b></h3>
            </div>
            <div class="card-body">                    
            <a href="{{ asset('admin/maxsks/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
            <hr>               
            <table id="example" class="table table-sm table-striped">
            <thead>
                <tr style="background:purple;color:white">
                <th style='width:40px'>No</th>
                <th>Dari IPS</th>
                <th>Sampai IPS</th>                              
                <th>Max SKS</th>
                <th>Aksi</th>           
                </tr>
                </thead>
                <tbody>
                    @foreach($maxsks as $row)
                    <tr><td>{{ $loop->index+1 }}</td>
                        <td>{{ $row->DariIP}}</td>
                        <td>{{ $row->SampaiIP }}</td>
                        <td>{{ $row->SKS }}</td>
                        <td>
                        <a href="{{ asset('admin/maxsks/edit/'.$row->MaxSKSID.'/'.$kurikulumplh.'/'.$prodiplh) }}" 
                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ asset('admin/maxsks/delete/'.$row->MaxSKSID.'/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
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

