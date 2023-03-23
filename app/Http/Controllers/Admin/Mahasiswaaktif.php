<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Mahasiswaaktif extends Controller
{
    //Angka Mahasiswa
    public function angkamahasiswaaktif()
    {
        
        //$prodi= get_prodi('HeryAkses');
        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodi   ='.'.$prodix->ProdiID.'.';
        $prodik  = str_replace('.','',$prodi);
        //dd($prodik);
        $data = array('title'     => 'MAHASISWA AKTIF DALAM ANGKA',
                      'prodi'        => $prodi, 
                      'prodik'      => $prodik,                              
                      'content'      => 'admin/mahasiswa/angkamahasiswaaktif'
                     );
        return view('admin/layout/wrapper',$data);
    }

    public function filter(Request $request)
    {
         
        $prodi   = $request->prodi;
        $prodik  = str_replace('.','',$prodi);
        $data = array(  'title'     => 'MAHASISWA AKTIF DALAM ANGKA',
                        'prodi'	    => $prodi,
                        'prodik'	=> $prodik,
                        'content'   => 'admin/mahasiswa/angkamahasiswaaktif'
                    );
        return view('admin/layout/wrapper',$data);
    }

   
}
