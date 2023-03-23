@extends('template')
@section('title','Input Data Data')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">       
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b style="color:purple">Tambah Data</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    @include('validation_error')                    
                    {{ Form::open(['url'=>'tahunakademik'])}}
                        @csrf
                        @include('tahun.form')
                    {{ Form::submit('Simpan Data',['class'=>'btn btn-primary'])}}
                    <a href="/tahunakademik" class="btn btn-primary">Kembali</a>
                    </div>
        </div>
    </div>
</div>
</section> 
@endsection
