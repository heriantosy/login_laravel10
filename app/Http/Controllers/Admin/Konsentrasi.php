<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Konsentrasi extends Controller
{
    public function index($kurikulumx,$prodix)
    {
    	
		$konsentrasi 	= DB::table('konsentrasi')->where('ProdiID',$prodix)->orderBy('KonsentrasiKode','DESC')->get();

		$data = array(  'title'         => 'DATA KONSENTRASI',
                        'konsentrasi'	    => $konsentrasi,
                        'kurikulumplh'  => $kurikulumx,
                        'prodiplh'	    => $prodix,
                        'content'       => 'admin/konsentrasi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($konsentrasix,$kurikulumx,$prodix)
    {
        
        $konsentrasi 	= DB::table('konsentrasi')->where('KonsentrasiID',$konsentrasix)->first();

        $data = array(  'title'     => 'EDIT DATA KONSENTRASI',
            'konsentrasi'	 => $konsentrasi,
            'kurikulumplh'	 => $kurikulumx,
            'KonsentrasiID'  => $konsentrasi->KonsentrasiID,
            'prodiplh'	     => $prodix,
            'content'    => 'admin/konsentrasi/edit'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'Nama'       => 'required',
                           'KonsentrasiKode'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('konsentrasi')->where('KonsentrasiID',$request->KonsentrasiID)->update([
            'KonsentrasiKode'   => $request->KonsentrasiKode,
            'Nama'              => $request->Nama,
            'Keterangan'        => $request->Keterangan,
            'NA'                => $NA,
        ]);
        return redirect('admin/konsentrasi/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH KONSENTRASI',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/konsentrasi/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
                            //'KurikulumID' => 'required|unique:kurikulum',
					        'Nama' => 'required',
                            'KonsentrasiKode'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];
        DB::table('konsentrasi')->insert([
            'KonsentrasiKode' => $request->KonsentrasiKode,
            'KodeID'          => 'SISFO',    
            'Nama'          => $request->Nama,       
            'ProdiID'       => $request->ProdiID,
            'Keterangan'    => $request->Keterangan,
            'NA'            => $NA
        ]);
        
        return redirect('admin/konsentrasi/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('konsentrasi')->where('KonsentrasiID',$IDX)->delete();
    	return redirect('admin/konsentrasi/'.$kurikulumx.'/'.$prodix);
    }
}
