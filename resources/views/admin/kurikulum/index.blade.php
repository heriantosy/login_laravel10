<div class="col-md-12 text-center" >
@include('admin/matakuliah/tabmatakuliah')
</div>
<section class="content">
    <div class="row">
        <div class="col-8">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Data Kurikulum</b></h3>
            </div>
            <div class="card-body">                    
                    <a href="{{ asset('admin/kurikulum/tambah/'.$kurikulumplh.'/'.$prodiplh) }}" class="btn btn-danger btn-sm">Tambah Data</a>
                    <hr>
                 
                    <table id="example1" class="table table-sm table-striped">
                            <thead>
                                <tr style="background:purple;color:white">
                                <th style='width:40px'>No</th>
                                <th>Kode</th>
                                <th>Nama</th>                              
                                <th>Sesi</th>
                                <th>Jml/Tahun</th>
                                <th>NA</th>
                                <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($kurikulum as $row)
                                    <tr><td>{{ $loop->index+1 }}</td>
                                        <td>{{ $row->KurikulumKode}}</td>
                                        <td>{{ $row->Nama }}</td>                                      
                                        <td>{{ $row->Sesi }}</td>
                                        <td>{{ $row->JmlSesi }}</td>
                                        <td>{{ $row->NA }}</td>
                                        <td width="90">
                                        <a href="{{ asset('admin/kurikulum/edit/'.$row->KurikulumID.'/'.$prodiplh) }}" 
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                                        <a href="{{ asset('admin/kurikulum/delete/'.$row->KurikulumID.'/'.$prodiplh) }}" class="btn btn-danger btn-sm  delete-link">
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

