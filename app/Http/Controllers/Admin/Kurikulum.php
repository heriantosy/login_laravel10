<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Kurikulum extends Controller
{
    public function index($kurikulumx,$prodix)
    {
    	
		$kurikulum 	= DB::table('kurikulum')->where('ProdiID',$prodix)->orderBy('KurikulumKode','DESC')->get();

		$data = array(  'title'         => 'DATA KURIKULUM',
                        'kurikulum'	    => $kurikulum,
                        'kurikulumplh'  => $kurikulumx,
                        'prodiplh'	    => $prodix,
                        'content'       => 'admin/kurikulum/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($kurikulumx,$prodix)
    {
        
        $kurikulum 	= DB::table('kurikulum')->where('KurikulumID',$kurikulumx)->first();

        $data = array(  'title'     => 'EDIT DATA KURIKULUM',
        'kurikulum'	    => $kurikulum,
        'kurikulumplh'  => $kurikulum->KurikulumID,
        'prodiplh'	    => $prodix,
                        'content'   => 'admin/kurikulum/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
    	
    	request()->validate([
					       'Nama'       => 'required',
                           'Sesi'       => 'required',
                            ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('kurikulum')->where('KurikulumID',$request->KurikulumID)->update([
            'Nama'          => $request->Nama,
            'Sesi'          => $request->Sesi,
            'JmlSesi'       => $request->JmlSesi,
            'NA'            => $NA,
        ]);
        return redirect('admin/kurikulum/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah diupdate']);
    }

    public function tambah($Kurikulumx, $prodix)
    {
                 
        $data = array(  'title'     => 'TAMBAH KURIKULUM',    
                        'prodiplh'	=> $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'   => 'admin/kurikulum/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
                            //'KurikulumID' => 'required|unique:kurikulum',
					        'Nama' => 'required',
                            'Sesi'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];
        DB::table('kurikulum')->insert([
            'KurikulumKode' => $request->KurikulumKode,
            'KodeID'        => 'SISFO', 
            'Nama'          => $request->Nama,
            'Sesi'          => $request->Sesi,
            'ProdiID'       => $request->ProdiID,
            'JmlSesi'       => $request->JmlSesi,
            'NA'            => $NA
        ]);
        
        return redirect('admin/kurikulum/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }


    public function delete($kurikulumx,$prodix)
    {
    	
    	DB::table('kurikulum')->where('KurikulumID',$kurikulumx)->delete();
    	return redirect('admin/kurikulum/'.$kurikulumx.'/'.$prodix);
    }
}
