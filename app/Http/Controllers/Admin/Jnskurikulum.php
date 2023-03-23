<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Jnskurikulum extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$jeniskurikulum 	= DB::table('jeniskurikulum')->where('ProdiID',$prodiplh)->get();

		$data = array(  'title'       => 'JENIS KURIKULUM',
                        'jeniskurikulum'	 => $jeniskurikulum,
                        'kurikulumplh'  => $kurikulumplh,
                        'prodiplh'      => $prodiplh,
                        'content'       => 'admin/jnskurikulum/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
    
    public function edit($jeniskurx,$kurikulumx,$prodix)
    {
        
        $jeniskurikulum 	= DB::table('jeniskurikulum')->where('JenisKurikulumID',$jeniskurx)->first();

        $data = array(  'title'  => 'EDIT JENIS KURIKULUM',
            'jeniskurikulum'	 => $jeniskurikulum,
            'kurikulumplh'	     => $kurikulumx,
            'JenisKurikulumID'   => $jeniskurikulum->JenisKurikulumID,
            'prodiplh'	         => $prodix,
            'content'    => 'admin/jnskurikulum/edit'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'Nama'       => 'required',
                           'Singkatan'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('jeniskurikulum')->where('JenisKurikulumID',$request->JenisKurikulumID)->update([
            'Singkatan'         => $request->Singkatan,
            'Nama'              => $request->Nama,
            'NA'                => $NA,
        ]);
        return redirect('admin/jnskurikulum/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH JENIS KURIKULUM',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/jnskurikulum/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
					        'Nama' => 'required',
                            'Singkatan'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];
        DB::table('jeniskurikulum')->insert([
            'Singkatan'     => $request->Singkatan,
            'KodeID'        => 'SISFO',    
            'Nama'          => $request->Nama,       
            'ProdiID'       => $request->ProdiID,
            'NA'            => $NA
        ]);
        
        return redirect('admin/jnskurikulum/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('jeniskurikulum')->where('JenisKurikulumID',$IDX)->delete();
    	return redirect('admin/jnskurikulum/'.$kurikulumx.'/'.$prodix);
    }
}
