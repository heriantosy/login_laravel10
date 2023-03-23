<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Pengajuancuti extends Controller
{
    public function index()
    {
    	
        $noregplh   = 1031230515011;
        $cuti = DB::table('t_simpegcuti')
            ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegcuti.Noreg')
            ->select('t_simpegcuti.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
            ->orderBy('t_simpegcuti.TanggalMulai','DESC')
            ->get();
            $pegawai 	= DB::table('t_simpegpegawai')->orderBy('Urut','ASC')->get();
            $data = array(  'title'     => 'DATA PENGAJUAN CUTI',
                            'cuti'=> $cuti,
                            'pegawai'	=> $pegawai,
                            'noregplh'	=> $noregplh,                    
                            'content'   => 'admin/kepegawaian/cuti'
                         );
        return view('admin/layout/wrapper',$data);
    }

   
 // Proses
 public function proses(Request $request)
 {
     if(isset($_POST['filter'])) {
         if($request->noreg==''){
             return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
         }else{
             return redirect('admin/pengajuancuti/filter/'.$request->noreg);
         }   
     }
 }
 
public function filter($noreg) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
      
    $noregplh   = $noreg;
    $cuti = DB::table('t_simpegcuti')
        ->join('t_simpegpegawai', 't_simpegpegawai.Noreg', '=', 't_simpegcuti.Noreg')
        ->select('t_simpegcuti.*','t_simpegpegawai.Nama','t_simpegpegawai.Gelar')
        ->where('t_simpegcuti.Noreg',$noregplh)
        ->orderBy('t_simpegcuti.TanggalMulai','DESC')
        ->get();
        $pegawai 	= DB::table('t_simpegpegawai')->orderBy('Urut','ASC')->get();
            $data = array(  'title'     => 'DATA PENGAJUAN CUTI',
                            'cuti'=> $cuti,
                            'pegawai'	    => $pegawai,
                            'noregplh'	=> $noregplh,                   
                        'content'   => 'admin/kepegawaian/cuti'
                     );
    return view('admin/layout/wrapper',$data);
}

    // Delete
    public function delete($MhswID)
    {
    	
    	DB::table('mhsw')->where('MhswID',$MhswID)->delete();
    	return redirect('admin/mahasiswa')->with(['sukses' => 'Data telah dihapus']);
    }
}
