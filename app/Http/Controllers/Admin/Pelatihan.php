<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Pelatihan extends Controller
{
    public function index()
    {
    	
        $tahunplh   = 2021;
        // if(!empty($request->tahun)){
        //     $pelatihan = DB::table('t_simpegpelatihan')
        //         ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegpelatihan.Noreg')
        //         ->select('t_simpegpelatihan.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
        //         ->where('t_simpegpelatihan.TahunID',$request->tahun)
        //         ->orderBy('t_simpegpelatihan.TanggalMulai','DESC')
        //         ->get();
        // }else{
            $pelatihan = DB::table('t_simpegpelatihan')
                ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegpelatihan.Noreg')
                ->select('t_simpegpelatihan.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
                ->where('t_simpegpelatihan.TahunID',$tahunplh)
                ->orderBy('t_simpegpelatihan.TanggalMulai','DESC')
                ->get();
        //}        
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'DATA PELATIHAN',
                        'pelatihan'=> $pelatihan,
                        'tahun'	    => $tahun,
                        'tahunplh'	=> $tahunplh,                    
                        'content'   => 'admin/kepegawaian/index'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function filter(Request $request)
    {
        if(!empty($request->tahun)){
            if(!empty($request->tahun)){
                $tahunplh = $request->tahun;
                $pelatihan = DB::table('t_simpegpelatihan')
                    ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegpelatihan.Noreg')
                    ->select('t_simpegpelatihan.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
                    ->where('t_simpegpelatihan.TahunID',$request->tahun)
                    ->orderBy('t_simpegpelatihan.TanggalMulai','DESC')
                    ->get();
            }else{
                $tahunplh="20201";
                $pelatihan = DB::table('t_simpegpelatihan')
                    ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegpelatihan.Noreg')
                    ->select('t_simpegpelatihan.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
                    ->where('t_simpegpelatihan.TahunID',$tahunplh)
                    ->orderBy('t_simpegpelatihan.TanggalMulai','DESC')
                    ->get();
            }        
            $tahun  = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
            $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
            $data = array(  'title'     => 'DATA PELATIHAN',
                            'pelatihan'=> $pelatihan,
                            'tahun'	    => $tahun,
                            'tahunplh'	=> $tahunplh,                    
                            'content'   => 'admin/kepegawaian/index'
                            );
            return view('admin/layout/wrapper',$data);
        }

    }
 
    public function delete($MhswID)
    {
    	
    	DB::table('mhsw')->where('MhswID',$MhswID)->delete();
    	return redirect('admin/mahasiswa')->with(['sukses' => 'Data telah dihapus']);
    }
}
