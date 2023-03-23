<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Nilai extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$nilai 	= DB::table('nilai')->where('ProdiID',$prodiplh)->orderBy('NilaiMax','DESC')->get();

		$data = array(  'title'       => 'DATA NILAI',
                        'nilai'      => $nilai,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh' => $prodiplh,
                        'content'     => 'admin/nilai/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
    
    public function edit($nilaix,$kurikulumx,$prodix)
    {
        
        $nilai 	= DB::table('nilai')->where('NilaiID',$nilaix)->first();

        $data = array(  'title'  => 'EDIT RANGE NILAI',
            'nilai'	           => $nilai,
            'kurikulumplh'	   => $kurikulumx,
            'NilaiID'          => $nilai->NilaiID,
            'prodiplh'	       => $prodix,
            'content'    => 'admin/nilai/edit'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'Nama'       => 'required',
                           'Bobot'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA']; 
        $Lulus = (empty($_POST['Lulus']))? 'N' : $_POST['Lulus'];                    
        DB::table('nilai')->where('NilaiID',$request->NilaiID)->update([
            'Nama'         => $request->Nama,
            'Bobot'        => $request->Bobot,
            'Lulus'        => $Lulus,
            'NilaiMin'     => $request->NilaiMin,
            'NilaiMax'     => $request->NilaiMax,
            'MaxSKS'       => $request->MaxSKS,
            'Deskripsi'       => $request->Deskripsi,
            'NA'           => $NA,
        ]);
        return redirect('admin/nilai/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'         => 'TAMBAH RANGE NILAI',    
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/nilai/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
					        'Nama' => 'required',
                            'Bobot'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA']; 
        $Lulus = (empty($_POST['Lulus']))? 'N' : $_POST['Lulus'];                    
        DB::table('nilai')->insert([
            'Nama'         => $request->Nama,
            'Bobot'        => $request->Bobot,
            'KodeID'       => 'SISFO',
            'ProdiID'      => $request->ProdiID,
            'Lulus'        => $Lulus,
            'NilaiMin'     => $request->NilaiMin,
            'NilaiMax'     => $request->NilaiMax,
            'MaxSKS'       => $request->MaxSKS,
            'Deskripsi'    => $request->Deskripsi,
            'NA'           => $NA,
        ]);
        
        return redirect('admin/nilai/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($IDX,$kurikulumx,$prodix)
    {
    	
    	DB::table('nilai')->where('NilaiID',$IDX)->delete();
    	return redirect('admin/nilai/'.$kurikulumx.'/'.$prodix);
    }
}
