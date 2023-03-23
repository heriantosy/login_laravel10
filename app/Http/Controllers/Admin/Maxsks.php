<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Maxsks extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$maxsks 	= DB::table('maxsks')->orderBy('DariIP','DESC')->get();
		$data = array(  'title'       => 'DATA MAX SKS',
                        'maxsks'      => $maxsks,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh' => $prodiplh,
                        'content'     => 'admin/maxsks/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
    
    public function edit($maxsksid,$kurikulumx,$prodix)
    {
        
        $maxsks 	= DB::table('maxsks')->where('MaxSKSID',$maxsksid)->first();

        $data = array(  'title'  => 'EDIT MAX SKS',
            'maxsks'	       => $maxsks,
            'kurikulumplh'	   => $kurikulumx,
            'SKS'             => $maxsks->MaxSKSID,
            'prodiplh'	       => $prodix,
            'content'    => 'admin/maxsks/edit'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'DariIP'       => 'required',
                           'SampaiIP'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                   
        DB::table('maxsks')->where('MaxSKSID',$request->MaxSKSID)->update([
            'DariIP'        => $request->DariIP,
            'SampaiIP'      => $request->SampaiIP,
            'ProdiID'       => $request->ProdiID,
            'SKS'           => $request->SKS,
            'NA'            => $NA,
        ]);
        return redirect('admin/maxsks/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH MAX SKS',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/maxsks/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
					        'DariIP' => 'required',
                            'SampaiIP'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('maxsks')->insert([
            'DariIP'        => $request->DariIP,
            'SampaiIP'      => $request->SampaiIP,
            'ProdiID'       => $request->ProdiID,
            'SKS'           => $request->SKS,
            'NA'            => $NA,
        ]);
        
        return redirect('admin/maxsks/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('maxsks')->where('MaxSKSID',$IDX)->delete();
    	return redirect('admin/maxsks/'.$kurikulumx.'/'.$prodix);
    }
}
