<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Refjudul extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   = $tahunak->TahunID;
        //$prodiplh   = '.'.get_prodi('HeryAkses').'.'; //identified Helper login user
        $prodix     = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh   = $prodix->ProdiID;     
       
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'DATA REFERENSI JUDUL',
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/refjudul/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

 // Proses
 public function proses(Request $request)
 {
     if(isset($_POST['filter'])) {
         if($request->tahun=='' || $request->prodi==''){
             return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
         }else{
             return redirect('admin/refjudul/filter/'.$request->tahun.'/'.$request->prodi);
         }   
     }
 }
 
public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
      
    $tahunplh   = $tahun;
    $prodiplh   = $prodi;
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'DATA REFERENSI JUDUL',
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/refjudul/index'
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
