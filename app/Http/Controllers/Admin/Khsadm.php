<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Khs_model;
use App\Models\Mahasiswa_model;
use Illuminate\Support\Str;

use Image;
use PDF;

class Khsadm extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;

        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh  = $prodix->ProdiID;
        
        // $mhsx    = DB::table('mhsw')->orderBy('MhswID','DESC')->limit(1)->first(); 
        // $MhswIDplh  = $mhsx->MhswID;

        // $datamhs = \DB::table('mhsw')
        // ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
        // ->where('mhsw.MhswID',$MhswIDplh)
        // ->first();

        try{
            $mhsx = DB::table('mhsw')->select('MhswID')->orderBy('MhswID','DESC')->limit(1)->first(); 
                if($mhsx->MhswID != '101'){
                    $MhswIDplh = 'Inputkan NPM';
                }else{
                    $MhswIDplh = $mhsx->MhswID;
                }
            }catch(Exception $e){
                $MhswIDplh = 'Inputkan NPM';
            }
        $datamhs      = Mahasiswa_model::select('MhswID','Nama')->where('MhswID', $MhswIDplh)->first();    

        //untuk ditampilkan sebagai detail
        $mykhs      = new Khs_model();
        $khs        = $mykhs->khs_detail($tahunplh, $MhswIDplh);
       
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
		$data = array(  'title'    => 'Kartu Hasil Studi (KHS)',
                        'khs'      => $khs,
                        'datamhs'  => $datamhs,
                        'tahun'    => $tahun,
                        'tahunplh' => $tahunplh,
                        'MhswIDplh'=> $MhswIDplh,                      
                        'content'  => 'admin/khsadm/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
  
      // cetak page
      public function cetakkhs($tahun,$MhswID)
      {
          
          $tahunplh    = $tahun;
          $MhswIDplh   = $MhswID;
          $datamhs = \DB::table('mhsw')
          ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
          ->where('mhsw.MhswID',$MhswIDplh)
          ->first();
  
          //untuk ditampilkan sebagai detail
          $mykhs      = new Khs_model();
          $khs        = $mykhs->khs_detail($tahunplh, $MhswIDplh);              
          $site      = DB::table('identitas')->first();
          $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS'); 
          //dd($site->namaweb);  
          $data = array(  'title'     => 'Tahun Akademik',
                          'datamhs'   => $datamhs,
                          'khs'       => $khs, 
                          'totsks'    => $totsks, 
                          'tahunplh'  => $tahunplh,
                          'MhswIDplh' => $MhswIDplh,            
                          'site'      => $site
                      );
               
          $config = [ 'format' => 'A4-P', // L=Landscape 'format' => [233,500] manual
                      'margin_top' => 10               
                    ];
          $pdf = PDF::loadview('admin/khsadm/cetak',$data,[],$config);
          // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
          ob_get_clean();
          $nama_file = 'Mahasiswa '.$MhswIDplh.' atas nama '.$tahunplh.'.pdf';
          return $pdf->stream($nama_file, 'I');
      }

    public function cetak_khs_v($tahun,$MhswID)
    {
        
        $tahunplh    = $tahun;
        $MhswIDplh   = $MhswID;
        // $datamhs     = \DB::table('mhsw')
        // ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
        // ->where('mhsw.MhswID',$MhswIDplh)
        // ->first();

        $datamhs = Mahasiswa_model::select('MhswID','Nama', 'ProgramID', 'ProdiID')->where('MhswID', $MhswIDplh)->first();
        $prd     = DB::table('prodi')->select('ProdiID','Nama','Pejabat','Gelar', 'FakultasID')->where('ProdiID', $datamhs->ProdiID)->first();
        $mykhs   = new Khs_model();
        $khs     = $mykhs->khs_detail($tahunplh, $MhswIDplh);
        $site    = DB::table('identitas')->first();
        $kaprod  = DB::table('prodi')->where('ProdiID', $datamhs->ProdiID)->first();
        $khsid   = DB::table('khs')->where('TahunID', $tahunplh)->where('MhswID', $MhswIDplh)->first();
        //$totsks  = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');   
        $data = array(  'title'     => 'Tahun Akademik',
                        'datamhs'   => $datamhs,
                        'khs'       => $khs,
                        'prd'       => $prd,  
                        'tahunplh'  => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,            
                        'site'      => $site,
                        'kaprod'    => $kaprod,
                        'khsid'     => $khsid,
                        'judul_web' => 'KHS'
                    );
        return view('admin/khsadm/cetak_khs_v',$data);
    }


    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        //$site           = DB::table('konfigurasi')->first();
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->tahun=='' || $request->MhswID==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filterx']);
            }else{
                return redirect('admin/khsadm/filter/'.$request->tahun.'/'.$request->MhswID);
            }
        }
    }

    // Main page
    public function filter($tahun,$MhswID) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunplh      = $tahun;
        $MhswIDplh      = $MhswID;

        $mykhs      = new Khs_model();
        $khs        = $mykhs->khs_detail($tahunplh, $MhswIDplh);         
    
        //untuk menampilkan kembali pada combo
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS'); 
        $mhs        = DB::table('mhsw')->where('MhswID',$MhswIDplh)->first(); 
        //dd($totsks);
        $data = array(  'title'     => ''.$MhswIDplh. ' - '.$mhs->Nama.' ('.$mhs->ProgramID.' - '.$mhs->ProdiID.')',
                        'khs'       => $khs,
                        'tahun'     => $tahun,
                        'MhswID'    => $MhswID,
                        'tahunplh'  => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,
                        'totsks'    => $totsks,
                        'content'   => 'admin/khsadm/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($JadwalID)
    {
        
        DB::table('jadwal')->where('JadwalID',$JadwalID)->delete();
        return redirect('admin/jadwal')->with(['sukses' => 'Data telah dihapus']);
    }
}
