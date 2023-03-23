<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class Paketmk extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
        $paketmk 	= DB::table('mkpaket')
        ->join('kurikulum','kurikulum.KurikulumID','=','mkpaket.KurikulumID')
        ->select('mkpaket.*','kurikulum.Nama as NamaKur')
        ->where('mkpaket.ProdiID',$prodiplh)
        ->orderBy('mkpaket.MKPaketID','ASC')->get();

		$data = array(  'title'       => 'DATA PAKET MATAKULIAH',
                        'paketmk'      => $paketmk,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh' => $prodiplh,
                        'content'     => 'admin/paketmk/index'
                    );
        return view('admin/layout/wrapper',$data);
    }


    public function isipaket($mkpaketid,$kurikulumx,$prodix)
    {
        
        $paketmk 	= DB::table('mkpaket')
        ->join('kurikulum','kurikulum.KurikulumID','=','mkpaket.KurikulumID')
        ->join('prodi','prodi.ProdiID','=','mkpaket.ProdiID')
        ->select('mkpaket.*','kurikulum.Nama as NamaKur','prodi.Nama as NamaProdi')
        ->where('mkpaket.ProdiID',$prodix)
        ->where('MKPaketID',$mkpaketid)->first();

        $matakuliah 	= DB::table('mk')->where('ProdiID',$prodix)->where('KurikulumID',$kurikulumx)->orderby('Sesi','ASC')->get();

        $data = array(  'title'  => 'ISI PAKET',
            'paketmk'	       => $paketmk,
            'kurikulumplh'	   => $kurikulumx,
            'matakuliah'       => $matakuliah,
            'prodiplh'	       => $prodix,
            'content'    => 'admin/paketmk/isipaket'
        );
        return view('admin/layout/wrapper',$data);
    }

    public function isipaket_proses(Request $request)
    {
        //dd('OK');
    	
    	// request()->validate([
		// 			        'DariIP' => 'required',
        //                     'SampaiIP'  => 'required',
		// 			        ]);
        //$NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('mkpaketisi')->insert([
            'MKPaketID'     => $request->MKPaketID,
            'KurikulumID'   => $request->KurikulumID,
            'MKID'          => $request->MKID,
        ]);    
        return redirect('admin/paketmk/isipaket/'.$request->MKPaketID.'/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
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
                 
        $kurikulum 	= DB::table('kurikulum')->where('ProdiID',$prodix)->orderBy('KurikulumKode','ASC')->get();
        $data = array(  'title'         => 'TAMBAH PAKET',  
                        'kurikulum'	    => $kurikulum,  
                        'prodiplh'	    => $prodix,
                        'kurikulumplh'	=> $Kurikulumx,     
                        'content'       => 'admin/paketmk/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
					        'KurikulumID' => 'required',
                            'Nama'  => 'required',
					        ]);
        $NA = (empty($_POST['NA']))? 'N' : $_POST['NA'];                    
        DB::table('mkpaket')->insert([
            'KodeID'          => 'SISFO',
            'KurikulumID'     => $request->KurikulumID,
            'Nama'            => $request->Nama,
            'Deskripsi'       => $request->Deskripsi,
            'ProdiID'         => $request->ProdiID,
            'NA'              => $NA,
        ]);    
        return redirect('admin/paketmk/'.$request->KurikulumID.'/'.$request->ProdiID)->with(['sukses' => 'Data telah ditambah']);
    }

    public function deletepaket($idz,$kurikulumx,$prodix)
    {
        //dd($prodix);
    	
    	DB::table('mkpaket')->where('MKPaketID',$idz)->delete();
    	return redirect('admin/paketmk/'.$kurikulumx.'/'.$prodix);
    }

    public function delete($idx,$paketidx,$kurikulumx,$prodix)
    {
        //dd($prodix);
    	
    	DB::table('mkpaketisi')->where('MKPaketIsiID',$idx)->delete();
    	return redirect('admin/paketmk/isipaket/'.$paketidx.'/'.$kurikulumx.'/'.$prodix);
    }
}
