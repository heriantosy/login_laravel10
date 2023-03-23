<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Predikat extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$predikat 	= DB::table('predikat')->where('ProdiID',$prodiplh)->orderBy('IPKMax','DESC')->get();

		$data = array(  'title'         => 'DATA PREDIKAT',
                        'predikat'      => $predikat,
                        'kurikulumplh'  => $kurikulumplh,
                        'prodiplh'      => $prodiplh,
                        'content'       => 'admin/predikat/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($predikatid,$kurikulumx,$prodix)
    {
        
        $predikat 	= DB::table('predikat')->where('PredikatID',$predikatid)->first();

        $data = array(  'title'  => 'EDIT PREDIKAT',
            'predikat'	       => $predikat,
            'kurikulumplh'	   => $kurikulumx,
            'SKS'             => $predikat->PredikatID,
            'prodiplh'	       => $prodix,
            'content'    => 'admin/predikat/edit'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'IPKMin'       => 'required',
                           'IPKMax'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                   
        DB::table('predikat')->where('PredikatID',$request->PredikatID)->update([
            'IPKMin'        => $request->IPKMin,
            'IPKMax'        => $request->IPKMax,
            'ProdiID'       => $request->ProdiID,
            'Nama'          => $request->Nama,
            'Keterangan'    => $request->Keterangan,
            'NA'            => $NA,
        ]);
        return redirect('admin/predikat/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH PREDIKAT',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/predikat/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
					        'IPKMin' => 'required',
                            'IPKMax'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('predikat')->insert([
            'KodeID'        => 'SISFO',
            'IPKMin'        => $request->IPKMin,
            'IPKMax'        => $request->IPKMax,
            'ProdiID'       => $request->ProdiID,
            'Nama'          => $request->Nama,
            'Keterangan'    => $request->Keterangan,
            'NA'            => $NA,
        ]);
        
        return redirect('admin/predikat/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('predikat')->where('PredikatID',$IDX)->delete();
    	return redirect('admin/predikat/'.$kurikulumx.'/'.$prodix);
    }
}
