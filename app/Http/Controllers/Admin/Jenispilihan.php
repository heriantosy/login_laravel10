<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Jenispilihan extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$jenispilihan 	= DB::table('jenispilihan')->where('ProdiID',$prodiplh)->orderBy('JenisPilihanID','DESC')->get();

		$data = array(  'title'         => 'JENIS PILIHAN MK',
                        'jenispilihan'  => $jenispilihan,
                        'kurikulumplh'  => $kurikulumplh,
                        'prodiplh'      => $prodiplh,
                        'content'       => 'admin/jenispilihan/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($jenispilihanx,$kurikulumx,$prodix)
    {
        
        $jenispilihan 	= DB::table('jenispilihan')->where('JenisPilihanID',$jenispilihanx)->first();

        $data = array(  'title'     => 'EDIT JENIS PILIHAN',
            'jenispilihan'	 => $jenispilihan,
            'kurikulumplh'	 => $kurikulumx,
            'JenisPilihanID'  => $jenispilihan->JenisPilihanID,
            'prodiplh'	     => $prodix,
            'content'    => 'admin/jenispilihan/edit'
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
        DB::table('jenispilihan')->where('JenisPilihanID',$request->JenisPilihanID)->update([
            'Singkatan'         => $request->Singkatan,
            'Nama'              => $request->Nama,
            'NA'                => $NA,
        ]);
        return redirect('admin/jenispilihan/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH JENIS PILIHAN',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/jenispilihan/tambah'
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
        DB::table('jenispilihan')->insert([
            'Singkatan'     => $request->Singkatan,
            'KodeID'        => 'SISFO',    
            'Nama'          => $request->Nama,       
            'ProdiID'       => $request->ProdiID,
            'NA'            => $NA
        ]);
        
        return redirect('admin/jenispilihan/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('jenispilihan')->where('JenisPilihanID',$IDX)->delete();
    	return redirect('admin/jenispilihan/'.$kurikulumx.'/'.$prodix);
    }
}
