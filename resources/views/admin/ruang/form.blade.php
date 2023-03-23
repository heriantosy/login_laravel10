<section class="content">
        <div class="row">
            <div class="col-12">       
            <div class="card">
            <div class="card-body">
                <table class="table table-sm table-striped">
                <tr scope='row'>
                    <th width="200">Tahun Akademik</th>
                    <th>{{ Form::text('TahunID',null,['class'=>'form-control','placeholder'=>'TahunID'])}}</th>
                </tr>
                <tr scope='row'>
                    <th width="200">Nama Tahun</th>
                    <th>{{ Form::text('Nama',null,['class'=>'form-control','placeholder'=>'Nama Tahun'])}}</th>
                </tr>
                <tr>                              
                <tr scope='row'>
                    <th width="200">Program Studi</th>
                    <th>{{ Form::select('ProdiID',$prodi,null,['class'=>'form-control'])}}</th>
                </tr>
                <tr scope='row'>
                    <th width="200">Program</th>
                    <th>{{ Form::select('ProgramID',$program,null,['class'=>'form-control'])}}</th>
                </tr>
                <tr>
                <th scope='row'>Aktif?</th>               
                <td>
                <?php  
                    if ($dt->NA=='N'){ 
                        echo "<input type='radio' name='NA' value='Y' checked> Ya &nbsp; <input type='radio' name='NA' value='N'> Tidak"; 
                    }else{ 
                        echo "<input type='radio' name='NA' value='Y'> Ya &nbsp; <input type='radio' name='NA' value='N' checked> Tidak"; 
                    } 
                echo "</td>
                </tr>";
                ?>
                </table>
            </div>
        </div>
    </div>
</div>  