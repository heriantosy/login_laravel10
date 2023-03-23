<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use PDF;

class Laporanakademik extends Controller
{
    public function index()
    {
    	
        $tahunaktif = \DB::table('tahun')->OrderBy('TahunID','DESC')->first();
        $tahunplh   = $tahunaktif->TahunID;
        $prodiplh   = "SI";
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'LAPORAN AKADEMIK',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunplh,
                        'prodiplh'  => $prodiplh,                     
                        'content'   =>'admin/lapakademik/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->prodi==''|| $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/lapakademik/filter/'.$request->tahun.'/'.$request->prodi);
            }
        }
    }

    public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'LAPORAN AKADEMIK',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function daftmhsterdaftarkrs($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'DATA MAHASISWA TERDAFTAR KRS',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/daftmhsterdaftarkrs'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function dafmhsisikrs($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'DAFTAR MAHASISWA MENGISI KRS',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/daftmhsisikrs'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function dafmhsisikrsaktif($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'DAFTAR MAHASISWA TELAH AKTIF',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/daftmhsisikrsaktif'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function lapbkddosen() //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        //$tahunaktif = \DB::table('tahun')->where('NA','N')->where('ProdiID','SI')->where('ProgramID','REG A')->first();
        $tahunaktif = \DB::table('tahun')->where('NA','N')->orderBy('TahunID','DESC')->first();
        $tahunx     = $tahunaktif->TahunID;
        $prodix     =".SI.";
    
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'BEBAN KERJA DOSEN',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/lapbkddosen'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function prosesbkd(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->prodi==''|| $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/lapakademik/filterbkd/'.$request->tahun.'/'.$request->prodi);
            }
        }
    }

    public function filterbkd($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = '.'.$prodi.'.';
       
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'BEBAN KERJA DOSEN',                        
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,                     
                        'content'   =>'admin/lapakademik/lapbkddosen'
                    );
        return view('admin/layout/wrapper',$data);
    }


}
