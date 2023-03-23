<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Jenismk extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$jenismk 	= DB::table('jenismk')->where('ProdiID',$prodiplh)->orderBy('JenisMKID','DESC')->get();

		$data = array(  'title'       => 'JENISMK',
                        'jenismk'      => $jenismk,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh'     => $prodiplh,
                        'content'     => 'admin/jenismk/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($jenismkx,$kurikulumx,$prodix)
    {
        
        $jenismk 	= DB::table('jenismk')->where('JenisMKID',$jenismkx)->first();

        $data = array(  'title'     => 'EDIT DATA JENIS MK',
            'jenismk'	    => $jenismk,
            'kurikulumplh'	=> $kurikulumx,
            'JenisMKID'     => $jenismk->JenisMKID,
            'prodiplh'	    => $prodix,
            'content'       => 'admin/jenismk/edit'
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
        DB::table('jenismk')->where('JenisMKID',$request->JenisMKID)->update([
            'Singkatan'   => $request->Singkatan,
            'Nama'        => $request->Nama,
            'NA'          => $NA,
        ]);
        return redirect('admin/jenismk/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH JENIS MK',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/jenismk/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
                            //'KurikulumID' => 'required|unique:kurikulum',
					        'Nama' => 'required',
                            'Singkatan'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];
        DB::table('jenismk')->insert([
            'Singkatan'     => $request->Singkatan,
            'KodeID'        => 'SISFO',    
            'Nama'          => $request->Nama,       
            'ProdiID'       => $request->ProdiID,
            'NA'            => $NA
        ]);
        
        return redirect('admin/jenismk/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('jenismk')->where('JenisMKID',$IDX)->delete();
    	return redirect('admin/jenismk/'.$kurikulumx.'/'.$prodix);
    }
}
