
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin/prodi/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
								
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">ProdiID</label>
					<div class="col-sm-9">
						<input type="text" name="ProdiID" class="form-control" placeholder="ProdiID" value="{{ old('ProdiID') }}" required>
					</div>
				</div>
				

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama Program Studi</label>
					<div class="col-sm-9">
						<input type="text" name="Nama" class="form-control" placeholder="Nama Program Studi" value="{{ old('Nama') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Pejabat</label>
					<div class="col-sm-9">
						<input type="text" name="Pejabat" class="form-control" placeholder="Nama Pejabat" value="{{ old('Pejabat') }}" required>
					</div>
				</div>

				
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-9">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
							<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>
