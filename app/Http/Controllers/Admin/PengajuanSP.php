<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PengajuanSP extends Controller
{
    public function index()
    {
    	
        $tahunplh="20191";
        $prodiplh ="SI";
        $pengajuansp = DB::table('t_sp')
        ->join('mk', 'mk.MKID', '=', 't_sp.MKID')
        ->select('t_sp.*','mk.Nama as NamaMK','mk.SKS','mk.MKKode')
        ->where('t_sp.TahunID',$tahunplh)
        ->where('mk.ProdiID',$prodiplh)
        ->groupBy('t_sp.MKID')
        ->orderBy('t_sp.SpID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'PENGAJUAN SEMESTER PENDEK',
                        'pengajuansp'	=> $pengajuansp,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/pengajuansp/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

 public function proses(Request $request)
 {
     if(isset($_POST['filter'])) {
         if($request->tahun=='' || $request->prodi==''){
             return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
         }
        else{
             return redirect('admin/pengajuansp/filter/'.$request->tahun.'/'.$request->prodi);
         }   
     }
 }
 
public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
      
    $tahunplh   = $tahun;
    $prodiplh   = $prodi;
    $pengajuansp = DB::table('t_sp')
    ->join('mk', 'mk.MKID', '=', 't_sp.MKID')
    ->select('t_sp.*','mk.Nama as NamaMK','mk.SKS','mk.MKKode')
    ->where('t_sp.TahunID',$tahunplh)
    ->where('mk.ProdiID',$prodiplh)
    ->orderBy('t_sp.SpID','DESC')
    ->groupBy('t_sp.MKID')
    ->get();
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
       
        $data = array(  'title'     => 'PENGAJUAN SEMESTER PENDEK',
                        'pengajuansp'=> $pengajuansp,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                  
                        'content'   => 'admin/pengajuansp/index'
                     );
    return view('admin/layout/wrapper',$data);
}

public function mahasiswa($tahunplh, $prodiplh)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_sp.MhswID')
    ->select('t_sp.*','mhsw.Nama as NamaMhs','mhsw.Handphone','mhsw.ProdiID')
    //->distinct('t_sp.MhswID')
    ->where('t_sp.TahunID',$tahunplh)
    ->where('mhsw.ProdiID',$prodiplh)
    ->orderBy('t_sp.MhswID','ASC')
    ->groupBy('t_sp.MhswID')
    ->get();
    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN SEMESTER PENDEK',
                    'pengajuansp'	=> $pengajuansp,
                    'tahun'	=> $tahun,
                    'prodi'	=> $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/pengajuansp/mahasiswa'
                );
    return view('admin/layout/wrapper',$data);
}

public function detailmhs($mkidx, $tahunx,$prodix)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_sp.MhswID')
    ->select('t_sp.*','mhsw.Nama as NamaMhs','mhsw.Handphone','mhsw.ProdiID')
    //->distinct('t_sp.MhswID')
    ->where('t_sp.TahunID',$tahunx)
    ->where('mhsw.ProdiID',$prodix)
    ->where('t_sp.MKID',$mkidx)
    ->orderBy('t_sp.MhswID','ASC')
    ->get();
    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'         => 'PENGAJUAN SEMESTER PENDEK',
                    'pengajuansp'	=> $pengajuansp,
                    'tahun'	        => $tahun,
                    'prodi'	        => $prodi,
                    'tahunplh'	    => $tahunx,
                    'prodiplh'	    => $prodix,
                    'content'       => 'admin/pengajuansp/detailmhs'
                );
    return view('admin/layout/wrapper',$data);            
    //return redirect('admin/pengajuansp/detailmhs/'.$tahunplh.'/'.$prodiplh);
}

public function detailmk($mhswidx, $tahunx,$prodix)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mk', 'mk.MKID', '=', 't_sp.MKID')
    ->select('t_sp.*','mk.Nama as NamaMK','mk.SKS','mk.MKKode')
    ->where('t_sp.TahunID',$tahunx)
    ->where('mk.ProdiID',$prodix)
    ->where('t_sp.MhswID',$mhswidx)
    ->orderBy('t_sp.MKID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'         => 'PENGAJUAN SEMESTER PENDEK',
                    'pengajuansp'	=> $pengajuansp,
                    'tahun'	        => $tahun,
                    'prodi'	        => $prodi,
                    'tahunplh'	    => $tahunx,
                    'prodiplh'	    => $prodix,
                    'content'       => 'admin/pengajuansp/detailmk'
                );
    return view('admin/layout/wrapper',$data);            
    //return redirect('admin/pengajuansp/detailmhs/'.$tahunplh.'/'.$prodiplh);
}

public function tambah($tahunx, $prodix)
{
    
    $kurikulumktif = \DB::table('kurikulum')->where('NA','N')->where('ProdiID',$prodix)->where('NA','N')->first();
    $kurikulumplh   = $kurikulumktif->KurikulumID;

    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $mahasiswa      = DB::table('mhsw')->where('ProdiID',$prodix)->where('NA','N')->get();
    $matakuliah = DB::table('mk')->where('KurikulumID',$kurikulumplh)->orderBy('Sesi','ASC')->get();
    
    $data = array(  'title'         => 'PENGAJUAN SEMESTER PENDEK : '.$prodix,                       
                    'tahun'         => $tahun,
                    'prodi'         => $prodi,
                    'mahasiswa'     => $mahasiswa,
                    'matakuliah'    => $matakuliah,
                    'tahunplh'      => $tahunx, 
                    'prodiplh'      => $prodix,  
                    'content'       => 'admin/pengajuansp/tambah'
                );
    return view('admin/layout/wrapper',$data);
}

public function tambah_proses(Request $request)
{

$mk     = DB::table('mk')->where('MKID',$request->MKID)->first();
request()->validate([
    //'JadwalID'      => 'required|unique:jadwal',
    'MKID'     => 'required',
    'MhswID'     => 'required',
     ]);

        DB::table('t_sp')->insert([
            'TahunID'      => $request->TahunID,
            'MhswID'       => $request->MhswID,
            'MKID'         => $request->MKID,
            'SKS'          => $mk->SKS,
            'Periode'      => '1',
            'LoginBuat'    => Session()->get('username'),
            'Tanggal'      => date('Y-m-d')
        ]);
return redirect('admin/pengajuansp/filter/'.$request->TahunID.'/'.$request->ProdiID);
}

public function edit($id)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_sp.MhswID')
    ->select('t_sp.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_sp.SpID',$id)
    ->first();
    $dosen = DB::table('dosen')->where('NA','N')->get();  
    $data  = array(  'title'       => 'Edit Pengajuan',
                    'pengajuansp' => $pengajuansp,
                    'dosen'       => $dosen,
                    'content'     => 'admin/pengajuansp/edit'
                );
    return view('admin/layout/wrapper',$data);
}

public function edit_proses(Request $request)
{
    
    request()->validate([
            'Judul'               => 'required',
            'TempatPenelitian'    => 'required',
            ]);
         
    DB::table('t_sp')->where('SpID',$request->id)->update([
        'TahunID'           => $request->TahunID,
        'ProdiID'           => $request->ProdiID,
        'MhswID'            => $request->MhswID,
        'Judul'             => $request->Judul,
        'TempatPenelitian'  => $request->TempatPenelitian,
        'Abstrak'           => $request->Abstrak,
        'URLX'              => $request->URLX,
        'Pembimbing1'       => $request->Pembimbing1,
        'Pembimbing2'       => $request->Pembimbing2,
        'Kota'              => $request->Kota,
        'Ke'                => $request->Ke
    ]);
    return redirect('admin/pengajuansp/filter/'.$request->TahunID.'/'.$request->ProdiID);
}

public function nilaisp($tahunx, $prodix)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mk', 'mk.MKID', '=', 't_sp.MKID')
    ->select('t_sp.*','mk.Nama as NamaMK','mk.SKS','mk.MKKode')
    ->where('t_sp.TahunID',$tahunx)
    ->where('mk.ProdiID',$prodix)
    ->orderBy('t_sp.SpID','DESC')
    ->groupBy('t_sp.MKID')
    ->get();
    
    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
	$data       = array(  'title'     => 'NILAI SEMESTER PENDEK',
                        'pengajuansp'	=> $pengajuansp,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunx,
                        'prodiplh'	=> $prodix,
                        'content'   => 'admin/pengajuansp/nilaisp'
                    );
        return view('admin/layout/wrapper',$data);
}

public function inputnilaisp($mkidx,$tahunx, $prodix)
{
    
    $pengajuansp = DB::table('t_sp')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_sp.MhswID')
    ->select('t_sp.*','mhsw.Nama as NamaMhs','mhsw.ProdiID')
    ->where('t_sp.TahunID',$tahunx)
    ->where('mhsw.ProdiID',$prodix)
    ->where('t_sp.MKID',$mkidx)
    ->orderBy('t_sp.MhswID','ASC')
    ->get();
    $mk = DB::table('mk')->where('MKID',$mkidx)->first();
    //$ds = DB::table('dosen')->where('Login',$pengajuansp->DosenID)->first();
    
    $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
	$data       = array(  'title'     => 'INPUT NILAI SEMESTER PENDEK',
                        'pengajuansp'	=> $pengajuansp,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunx,
                        'prodiplh'	=> $prodix,
                        'mk'        => $mk,
                        //'ds'        => $ds,
                        'content'   => 'admin/pengajuansp/inputnilaisp'
                    );
        return view('admin/layout/wrapper',$data);
}

public function simpannilaisp(Request $request){ 

    //dd('OK');
    $MhswID         = $request->MhswID;
    $MKID           = $request->MKID;
    $NilaiAkhir     = $request->NilaiAkhir;

    foreach($MhswID as $key => $no)
    {          
        if ($NilaiAkhir[$key]>=85 AND $NilaiAkhir[$key] <= 100){
            $GradeNilai[$key] ="A";
            $Bobot[$key] ="4";
        }
        elseif ($NilaiAkhir[$key]>=80 AND $NilaiAkhir[$key] <= 84.99){
            $GradeNilai[$key] ="A-";
            $Bobot[$key] ="3.70";
        }
        elseif ($NilaiAkhir[$key]>=75 AND $NilaiAkhir[$key] <= 79.99){
            $GradeNilai[$key] ="B+";
            $Bobot[$key] ="3.30";
        }
        elseif ($NilaiAkhir[$key]>=70 AND $NilaiAkhir[$key] <= 74.99){
            $GradeNilai[$key] ="B";
            $Bobot[$key] ="3";
        }
        elseif ($NilaiAkhir[$key]>=65 AND $NilaiAkhir[$key] <= 69.99){
            $GradeNilai[$key] ="B-";
            $Bobot[$key] ="2.70";
        }
        elseif ($NilaiAkhir[$key]>=60 AND $NilaiAkhir[$key] <= 64.99){
            $GradeNilai[$key] ="C+";
            $Bobot[$key] ="2.30";
        }
        elseif ($NilaiAkhir[$key]>=55 AND $NilaiAkhir[$key] <= 59.99){
            $GradeNilai[$key] ="C";
            $Bobot[$key] ="2";
        }
        elseif ($NilaiAkhir[$key]>=50 AND $NilaiAkhir[$key] <= 54.99){
            $GradeNilai[$key] ="C-";
            $Bobot[$key] ="1.70";
        }
        elseif ($NilaiAkhir[$key]>=40 AND $NilaiAkhir[$key] <= 49.99){
            $GradeNilai[$key] ="D";
            $Bobot[$key] ="1";
        }
        else{
            $GradeNilai[$key] ="E";
            $Bobot[$key] ="0";
        }

        $datax['MhswID']        = $no;
        $datax['NilaiAkhir']    = $NilaiAkhir[$key];
        $datax['GradeNilai']    = $GradeNilai[$key]; 
        $datax['BobotNilai']    = $Bobot[$key];            
        \DB::table('t_sp')
        ->where('MKID',$request['MKID'])
        ->where('MhswID',$datax['MhswID'])
        ->update($datax); 
    }
    
    return redirect('admin/pengajuansp/nilaisp/'.$request->TahunID.'/'.$request->ProdiID);
}


    public function delete($IDX,$tahunplh,$prodiplh)
    {
        
        DB::table('t_sp')->where('SpID',$IDX)->delete();
        return redirect('admin/pengajuansp/ditolak/'.$tahunplh.'/'.$prodiplh);
    }
}
