<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;

class Skripsi extends Controller
{
    public function index()
    {
    	
            $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
            $tahunplh   = $tahunak->TahunID;
            //$prodiplh   = '.'.get_prodi('HeryAkses').'.'; //identified Helper login user
            $prodix     = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
            $prodiplh   = $prodix->ProdiID;      
            $skripsipro = DB::table('jadwal_skripsi')
            ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
            ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
            ->where('jadwal_skripsi.TahunID',$tahunplh)
            ->where('jadwal_skripsi.ProdiID',$prodiplh)
            ->orderBy('jadwal_skripsi.MhswID','DESC')
            ->get();
   
            $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
            $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
            $data       = array(  'title'     => 'DATA SEMINAR PROPOSAL SKRIPSI',
                        'skripsipro'=> $skripsipro,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/skripsi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

 public function filter(Request $request)   
 {
      
    if(!empty($request->tahun)){
        $tahunplh = $request->tahun;   
        $prodiplh = $request->prodi;       
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
    }else{
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
    }    
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data       = array(  'title'     => 'DATA SEMINAR PROPOSAL SKRIPSI',
                'skripsipro'=> $skripsipro,
                'tahun'	    => $tahun,
                'prodi'	    => $prodi,
                'tahunplh'	=> $tahunplh,
                'prodiplh'	=> $prodiplh,
                'content'   => 'admin/skripsi/index'
                );
    return view('admin/layout/wrapper',$data);
 }
 
public function validasipro($JadwalID, $cek)
{
   
      
    if($cek=='N'){
        //dd('Normal');
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket' => '0']); 
    }
    else if($cek=='R'){
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket' => '1']); 
    }
    else{
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket' => '2']); 
    }

    $jadwalskripsi      = DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->first();

    $skripsipro = DB::table('jadwal_skripsi')
    ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
    ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('jadwal_skripsi.TahunID',$jadwalskripsi->TahunID)
    ->where('jadwal_skripsi.ProdiID',$jadwalskripsi->ProdiID)
    ->orderBy('jadwal_skripsi.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'DATA SEMINAR PROPOSAL SKRIPSI',
                    'skripsipro'=> $skripsipro,
                    'tahun'	    => $tahun,
                    'prodi'	    => $prodi,
                    'tahunplh'	=> $jadwalskripsi->TahunID,
                    'prodiplh'	=> $jadwalskripsi->ProdiID,                    
                    'content'   => 'admin/skripsi/index'
                    );
    return view('admin/layout/wrapper',$data);
}


public function validasihsl($JadwalID, $cek)
{ 
      
    if($cek=='N'){
        //dd('Normal');
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '0']); 
    }
    else if($cek=='R'){
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '1']); 
    }
    else{
        DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '2']); 
    }

    $jadwalskripsi = DB::table('jadwal_skripsi')->where('JadwalID',$JadwalID)->first();
    
    $hasilskripsi  = DB::table('jadwal_skripsi')
    ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
    ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('jadwal_skripsi.TahunID',$jadwalskripsi->TahunID)
    ->where('jadwal_skripsi.ProdiID',$jadwalskripsi->ProdiID)
    ->orderBy('jadwal_skripsi.MhswID','DESC')
    ->get();
    //dd($hasilskripsi);
    $tahun  = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'DATA SEMINAR HASIL SKRIPSI',
                    'hasilskripsi' => $hasilskripsi,
                    'tahun'	       => $tahun,
                    'prodi'	       => $prodi,
                    'tahunplh'	   => $jadwalskripsi->TahunID,
                    'prodiplh'	   => $jadwalskripsi->ProdiID,                    
                    'content'      => 'admin/skripsi/hasil_ta'
                    );
    return view('admin/layout/wrapper',$data);
}

//SEMINAR HADIL SKRIPSI
public function hasilta($tahun,$prodi)
{
      
    $tahunplh   = "20202";
    $prodiplh   = "SI";
    $hasilskripsi = DB::table('jadwal_skripsi')
    ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
    ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('jadwal_skripsi.TahunID',$tahunplh)
    ->where('jadwal_skripsi.ProdiID',$prodiplh)
    ->orderBy('jadwal_skripsi.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI',
                    'hasilskripsi'=> $hasilskripsi,
                    'tahun'	    => $tahun,
                    'prodi'	    => $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,                    
                    'content'   => 'admin/skripsi/hasil_ta'
                    );
    return view('admin/layout/wrapper',$data);
}

public function filterhsl(Request $request)
{
      
    if(!empty($request->tahun)){
        $tahunplh = $request->tahun;   
        $prodiplh = $request->prodi;  
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
    }else{
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
    }    
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI',
                        'hasilskripsi'=> $hasilskripsi,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/hasil_ta'
                        );
   return view('admin/layout/wrapper',$data);
}

public function nilaita($tahun,$prodi)
{
      
    $tahunplh   = $tahun;
    $prodiplh   = $prodi;
    $nilaita = DB::table('jadwal_skripsi')
    ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
    ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('jadwal_skripsi.TahunID',$tahunplh)
    ->where('jadwal_skripsi.ProdiID',$prodiplh)
    ->orderBy('jadwal_skripsi.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'NILAI HASIL SKRIPSI',
                    'nilaita'   => $nilaita,
                    'tahun'	    => $tahun,
                    'prodi'	    => $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,                    
                    'content'   => 'admin/skripsi/nilai_ta'
                    );
    return view('admin/layout/wrapper',$data);
}

public function proses_nilai(Request $request)
{
    if(isset($_POST['filter'])) {
        if($request->tahun=='' || $request->prodi==''){
            return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
        }else{
            return redirect('admin/skripsinilai/filternilaita/'.$request->tahun.'/'.$request->prodi);
        }   
    }
}

public function filternilaita($tahun,$prodi)
{
      
    $tahunplh   = $tahun;
    $prodiplh   = $prodi;
    $nilaita = DB::table('jadwal_skripsi')
    ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
    ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('jadwal_skripsi.TahunID',$tahunplh)
    ->where('jadwal_skripsi.ProdiID',$prodiplh)
    ->orderBy('jadwal_skripsi.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'NILAI HASIL SKRIPSI',
                    'nilaita'   => $nilaita,
                    'tahun'	    => $tahun,
                    'prodi'	    => $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,                    
                    'content'   => 'admin/skripsi/nilai_ta'
                    );
    return view('admin/layout/wrapper',$data);
}

public function edit($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
        ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
        ->where('jadwal_skripsi.JadwalID',$JadwalID)
        ->first();

        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian Seminar Proposal Skripsi: '. $jadwal->ProdiID,
                        'jadwal'        => $jadwal, 
                        'tahun'         => $tahun,
                        'program'       => $program,
                        'prodi'         => $prodi,
                        'hari'          => $hari,                     
                        'matakuliah'    => $matakuliah,
                        'ruang'         => $ruang,
                        'dosen'         => $dosen,
                        'tahunplh'      => $jadwal->TahunID, 
                        'prodiplh'      => $jadwal->ProdiID, 
                        'content'       => 'admin/skripsi/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                'PengujiPro1'     => 'required',
                'PengujiPro2'     => 'required',
                ]);
        DB::table('jadwal_skripsi')->where('JadwalID',$request->JadwalID)->update([ 
            'PengujiPro1'           => $request->PengujiPro1,
            'PengujiPro2'           => $request->PengujiPro2,
            'PengujiPro3'           => $request->PengujiPro3,
            'TglUjianProposal'      => date('Y-m-d', strtotime($request->TglUjianProposal)),
            'TempatUjian'           => $request->TempatUjian,
            'JamMulaiProSkripsi'    => $request->JamMulaiProSkripsi,
            'JamSelesaiProSkripsi'  => $request->JamSelesaiProSkripsi,
            'LoginEdit'             => Session()->get('username'),
            'TglEdit'               => date('Y-m-d H:i:s')
        ]); 
        return redirect('admin/skripsipro/filter/'.$request->tahun.'/'.$request->prodi);
    }

    public function editjudul($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
        ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
        ->where('jadwal_skripsi.JadwalID',$JadwalID)
        ->first();

        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian Seminar Proposal: '. $jadwal->ProdiID,
                        'jadwal'        => $jadwal, 
                        'tahun'         => $tahun,
                        'program'       => $program,
                        'prodi'         => $prodi,
                        'hari'          => $hari,                     
                        'matakuliah'    => $matakuliah,
                        'ruang'         => $ruang,
                        'dosen'         => $dosen,
                        'tahunplh'      => $jadwal->TahunID, 
                        'prodiplh'      => $jadwal->ProdiID, 
                        'content'       => 'admin/skripsi/editjudul'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function editjudul_proses(Request $request)
    {
        
        request()->validate([
                'PembimbingPro1'     => 'required',
                'PembimbingPro2'     => 'required',
                ]);
        DB::table('jadwal_skripsi')->where('JadwalID',$request->JadwalID)->update([ 
            'Judul'                => $request->Judul,
            'TempatPenelitian'     => $request->TempatPenelitian,
            'Kota'                 => $request->Kota,
            'Ke'                   => $request->Ke,
            'PembimbingPro1'       => $request->PembimbingPro1,
            'PembimbingPro2'       => $request->PembimbingPro2,
            'LoginEdit'            => Session()->get('username'),
            'TglEdit'              => date('Y-m-d H:i:s')
        ]); 
        return redirect('admin/skripsipro/filter/'.$request->tahun.'/'.$request->prodi);
    }    

    public function edithsl($JadwalID)
    {
        //dd('OK');
        
        $jadwal = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
        ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
        ->where('jadwal_skripsi.JadwalID',$JadwalID)
        ->first();

        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian Seminar Hasil: '. $jadwal->ProdiID,
                        'jadwal'        => $jadwal, 
                        'tahun'         => $tahun,
                        'program'       => $program,
                        'prodi'         => $prodi,
                        'hari'          => $hari,                     
                        'matakuliah'    => $matakuliah,
                        'ruang'         => $ruang,
                        'dosen'         => $dosen,
                        'tahunplh'      => $jadwal->TahunID, 
                        'prodiplh'      => $jadwal->ProdiID, 
                        'content'       => 'admin/skripsi/edit_hasil_ta'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edithsl_proses(Request $request)
    {
        //dd('OK');
        
        request()->validate([
                'PengujiSkripsi1'     => 'required',
                'PengujiSkripsi2'     => 'required',
                ]);
        DB::table('jadwal_skripsi')->where('JadwalID',$request->JadwalID)->update([ 
            'PengujiSkripsi1'           => $request->PengujiSkripsi1,
            'PengujiSkripsi2'           => $request->PengujiSkripsi2,
            'PengujiSkripsi3'           => $request->PengujiSkripsi3,
            'TglUjianSkripsi'           => date('Y-m-d', strtotime($request->TglUjianSkripsi)),
            'TempatUjian'               => $request->TempatUjian,
            'JamMulaiUjianSkripsi'      => $request->JamMulaiUjianSkripsi,
            'JamSelesaiUjianSkripsi'    => $request->JamSelesaiUjianSkripsi,
            'LoginEdit'                 => Session()->get('username'),
            'TglEdit'                   => date('Y-m-d H:i:s')
        ]); 
        return redirect('admin/skripsihsl/filterhsl/'.$request->tahun.'/'.$request->prodi);
    }

public function delete($MhswID)
    {
        
        DB::table('mhswxx')->where('MhswID',$MhswID)->delete();
        return redirect('admin/mahasiswa')->with(['sukses' => 'Data telah dihapus']);
    }

    public function cetakbapro($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $site      = DB::table('identitas')->first(); 
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 17,
                    'margin_bottom' => 15,
                    'margin_left' => 17                
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-baujianproskripsi',$data,[],$config);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakbapro_v($JadwalID)
    {
           
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Berita Acara";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $dsn1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $dsn2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiPro1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiPro2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiPro3)->first();
        $biaya 		= DB::table('t_biaya')->where('BiayaID', '6')->first();
        $data = array( 
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' => $judul_web,
                        'prodi'     => $prodi,
                        'dsn2'      => $dsn2,
                        'dsn2'      => $dsn2,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3,
                        'biaya'     => $biaya
                    );   
        return view('admin/skripsi/cetak-baujianproskripsi_v',$data);   
    }

    public function cetakfrmnilaipro_v($JadwalID)
    {
           
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Berita Acara";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $dsn1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $dsn2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi3)->first();
        $data = array( 
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' => $judul_web,
                        'prodi'     => $prodi,
                        'dsn2'      => $dsn2,
                        'dsn2'      => $dsn2,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3
                    );   
        return view('admin/skripsi/cetak-frmnilaiskripsipro_v',$data);   
    }

    public function cetakfrmnilaihsl_v($JadwalID)
    {
           
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Berita Acara";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $dsn1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $dsn2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi3)->first();
        $data = array( 
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' => $judul_web,
                        'prodi'     => $prodi,
                        'dsn2'      => $dsn2,
                        'dsn2'      => $dsn2,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3
                    );   
        return view('admin/skripsi/cetak-frmnilaiskripsihsl_v',$data);   
    }

    public function cetakbahsl_v($JadwalID)
    {
           
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Berita Acara";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $dsn1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $dsn2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi3)->first();
        $data = array( 
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' => $judul_web,
                        'prodi'     => $prodi,
                        'dsn2'      => $dsn2,
                        'dsn2'      => $dsn2,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3
                    );   
        return view('admin/skripsi/cetak-baujianhslskripsi_v',$data);   
    }

    public function cetakbahsl($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $site      = DB::table('identitas')->first();

        //dd($site->namaweb);  
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 17,
                    'margin_bottom' => 15,
                    'margin_left' => 17                
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-baujianhslskripsi',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakfrmnilaipro($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $site      = DB::table('identitas')->first();

        //dd($site->namaweb);  
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 15,
                    'margin_bottom' => 15,
                    'margin_left' => 15               
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-frmnilaiskripsipro',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakfrmnilaihsl($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 15,
                    'margin_bottom' => 15,
                    'margin_left' => 15               
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-frmnilaiskripsihsl',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetaksrpengantar($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $site      = DB::table('identitas')->first();

        //dd($site->namaweb);  
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 19,
                    'margin_bottom' => 15,
                    'margin_left' => 19              
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-srpengantar',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetaksrpengantar_v($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
                             
        $site      = DB::table('identitas')->first();

        //dd($site->namaweb);  
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        return view('admin/skripsi/cetak-srpengantar_v', $data);     
    }

    public function cetakkwitansiproskripsi($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
        //dd($jadwal->JadwalID);                      
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 15,
                    'margin_bottom' => 15,
                    'margin_left' => 15              
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-kwitansiproskripsi',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakkwitansiproskripsi_v($JadwalID)
    {
           
                $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
                $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
                $judul_web 	= "Cetak Kwitansi";
                $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
                $dsn1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
                $dsn2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();
                $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiPro1)->first();
                $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiPro2)->first();
                $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiPro3)->first();
                $biaya 		= DB::table('t_biaya')->where('BiayaID', '6')->first();
                $data = array( 
                                'jdwl'      => $jdwl,
                                'mhs'       => $mhs,
                                'judul_web' =>'Cetak Kwitansi',
                                'prodi'     => $prodi,
                                'dsn2'      => $dsn2,
                                'dsn2'      => $dsn2,
                                'penguji1'  => $penguji1,
                                'penguji2'  => $penguji2,
                                'penguji3'  => $penguji3,
                                'biaya'     => $biaya
                            );   
        return view('admin/skripsi/cetak-kwitansiproskripsi_v',$data);                        
    }

    public function cetakkwitansihslskripsi($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_skripsi')
                ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID')
                ->select('jadwal_skripsi.*', 'mhsw.Nama as NamaMhs')
                ->where('jadwal_skripsi.JadwalID',$JadwalID)
                ->first();       
        //dd($jadwal->JadwalID);                      
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 15,
                    'margin_right' => 15,
                    'margin_bottom' => 15,
                    'margin_left' => 15              
                ];      
        $pdf = PDF::loadview('admin/skripsi/print-kwitansihslskripsi',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakkwitansihslskripsi_v($JadwalID)
    {
        
                $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
                $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
                $judul_web 	= "Cetak Kwitansi";
                $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
                $pembimbing1 		= DB::table('dosen')->where('Login', $jdwl->PembimbingSkripsi1)->first();
                $pembimbing2 		= DB::table('dosen')->where('Login', $jdwl->PembimbingSkripsi2)->first();
                $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi1)->first();
                $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi2)->first();
                $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSkripsi3)->first();
             
                $honorpembimbing 		= DB::table('t_biaya')->where('BiayaID', '6')->first();
                $honorpenguji 		= DB::table('t_biaya')->where('BiayaID', '4')->first();
                $data = array(  
                                'jdwl'      => $jdwl,
                                'mhs'       => $mhs,
                                'judul_web' =>'Cetak Kwitansi',
                                'prodi'     => $prodi,
                                'pembimbing1'      => $pembimbing1,
                                'pembimbing2'      => $pembimbing2,
                                'penguji1'  => $penguji1,
                                'penguji2'  => $penguji2,
                                'penguji3'  => $penguji3,
                                'honorpembimbing'     => $honorpembimbing,
                                'honorpenguji'     => $honorpenguji
                            );   
        return view('admin/skripsi/cetak-kwitansihslskripsi_v',$data);       
    }

    public function cetakperusahaan_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing = DB::table('dosen')->where('Login', $jdwl->DosenID)->first();            
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Surat Permohonan Penelitian',
                        'prodi'     => $prodi,
                        'pembimbing'=> $pembimbing
                    );             
        return view('admin/skripsi/cetak-perusahaan_v', $data);
    }

    public function cetakpembimbing_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing1 = DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $pembimbing2 = DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();          
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Surat Pembimbing',
                        'prodi'     => $prodi,
                        'pembimbing1'=> $pembimbing1,
                        'pembimbing2'=> $pembimbing2
                    );             
        return view('admin/skripsi/cetak-pembimbing_v', $data);
    }

    public function cetakpembimbing2_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_skripsi')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing1 = DB::table('dosen')->where('Login', $jdwl->PembimbingPro1)->first();
        $pembimbing2 = DB::table('dosen')->where('Login', $jdwl->PembimbingPro2)->first();          
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Surat Pembimbing',
                        'prodi'     => $prodi,
                        'pembimbing1'=> $pembimbing1,
                        'pembimbing2'=> $pembimbing2
                    );             
        return view('admin/skripsi/cetak-pembimbing2_v', $data);
    }

    //SEMINAR PROPOSAL SKRIPSI
    public function kemxpro($tahunx,$prodix,$kemxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianProposal',$kemxpro)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL SKRIPSI KEMAREN',
                        'skripsipro'=> $skripsipro,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/index'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function todxpro($tahunx,$prodix,$todxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianProposal',$todxpro)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL SKRIPSI HARI INI',
                        'skripsipro'=> $skripsipro,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/index'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function besxpro($tahunx,$prodix,$besxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianProposal',$besxpro)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL SKRIPSI BESOK',
                        'skripsipro'=> $skripsipro,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/index'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function lusxpro($tahunx,$prodix,$lusxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $skripsipro = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianProposal',$lusxpro)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL SKRIPSI LUSA',
                        'skripsipro'=> $skripsipro,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/index'
                        );
        return view('admin/layout/wrapper',$data);
    }

    //SEMINAR HASIL SKRIPSI
    public function kemxhsl($tahunx,$prodix,$kemxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianSkripsi',$kemxhsl)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI KEMAREN',
                        'hasilskripsi'=> $hasilskripsi,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/hasil_ta'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function todxhsl($tahunx,$prodix,$todxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianSkripsi',$todxhsl)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI HARI INI',
                        'hasilskripsi'=> $hasilskripsi,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/hasil_ta'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function besxhsl($tahunx,$prodix,$besxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianSkripsi',$besxhsl)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI BESOK',
                        'hasilskripsi'=> $hasilskripsi,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/hasil_ta'
                        );
        return view('admin/layout/wrapper',$data);
    }

    public function lusxhsl($tahunx,$prodix,$lusxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilskripsi = DB::table('jadwal_skripsi')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_skripsi.MhswID','LEFT OUTER')
        //->join('dosen', 'dosen.Login', '=', 'jadwal_skripsi.PembimbingSkripsi1','LEFT OUTER')
        ->select('jadwal_skripsi.*','mhsw.Nama as NamaMhs','mhsw.Handphone') //,'dosen.Nama as NamaDosen'
        ->where('jadwal_skripsi.TahunID',$tahunplh)
        ->where('jadwal_skripsi.ProdiID',$prodiplh)
        ->where('jadwal_skripsi.TglUjianSkripsi',$lusxhsl)
        ->orderBy('jadwal_skripsi.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL SKRIPSI LUSA',
                        'hasilskripsi'=> $hasilskripsi,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/skripsi/hasil_ta'
                        );
        return view('admin/layout/wrapper',$data);
    }

}
