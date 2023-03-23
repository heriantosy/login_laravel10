<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#delete{{ $pegawai->id_pegawai }}">
    <i class="fas fa-trash-alt"></i>
</button>


<div class="modal fade" id="delete{{ $pegawai->id_pegawai }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus data - {{ $pegawai->nama_pegawai }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <ion-icon name="warning-sharp"></ion-icon>Apakah anda ingin mengahapus data ini?&hellip;
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                <form action="/pegawai/{{ $pegawai->id_pegawai }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger border-0"><i class="fas fa-trash-alt"></i> Hapus</button>
                </form> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->