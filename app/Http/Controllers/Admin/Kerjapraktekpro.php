<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;

class Kerjapraktekpro extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;

        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh  = $prodix->ProdiID;   
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'DATA SEMINAR PROPOSAL KP',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function filter(Request $request) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
          
        if(!empty($request->tahun)){
            $tahunplh   = $request->tahun;
            $prodiplh   = $request->prodi;    
            $kerjapraktekpro = DB::table('jadwal_kp')
            ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
            ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
            ->where('jadwal_kp.TahunID',$tahunplh)
            ->where('jadwal_kp.ProdiID',$prodiplh)
            ->orderBy('jadwal_kp.MhswID','DESC')
            ->get();
        }else{
            $kerjapraktekpro = DB::table('jadwal_kp')
            ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
            ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
            ->where('jadwal_kp.TahunID',$tahunplh)
            ->where('jadwal_kp.ProdiID',$prodiplh)
            ->orderBy('jadwal_kp.MhswID','DESC')
            ->get();
        }
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp.MhswID')
        ->select('jadwal_kp.*', 'mhsw.Nama as NamaMhs')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();

        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian Seminar Proposal KP: '. $jadwal->ProdiID,
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
                        'content'       => 'admin/kerjapraktek/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                'DosenID'     => 'required',
                'Penguji1'     => 'required',
                ]);
        DB::table('jadwal_kp')->where('JadwalID',$request->JadwalID)->update([ 
            'Judul'                 => $request->Judul,
            'DosenID'               => $request->DosenID,
            'Penguji1'              => $request->Penguji1,
            'Penguji2'              => $request->Penguji2,
            'Penguji3'              => $request->Penguji3,
            'TglMulaiSidang'        => date('Y-m-d', strtotime($request->TglMulaiSidang)),
            'TempatUjian'           => $request->TempatUjian,
            'JamMulai'              => $request->JamMulai,
            'JamSelesai'            => $request->JamSelesai,
            'LoginEdit'             => Session()->get('username'),
            'TglEdit'               => date('Y-m-d H:i:s')
        ]); 
        return redirect('admin/kerjapraktekpro/filter/'.$request->tahun.'/'.$request->prodi);
    }

    public function validasipro($JadwalID, $cek) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
          
        if($cek=='N'){
            //dd('Normal');
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket' => '0']); 
        }
        else if($cek=='R'){
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket' => '1']); 
        }
        else{
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket' => '2']); 
        }

        $jadwalkp      = DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->first();
        //dd($jadwalkp->ProdiID);
          
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$jadwalkp->TahunID)
        ->where('jadwal_kp.ProdiID',$jadwalkp->ProdiID)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $jadwalkp->TahunID,
                        'prodiplh'	=> $jadwalkp->ProdiID,
                        'content'   => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function validasihsl($JadwalID, $cek) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
          
        if($cek=='N'){
            //dd('Normal');
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '0']); 
        }
        else if($cek=='R'){
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '1']); 
        }
        else{
            DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->update([ 'Ket2' => '2']); 
        }

        $jadwalkp      = DB::table('jadwal_kp')->where('JadwalID',$JadwalID)->first();
        //dd($jadwalkp->ProdiID);
          
        $hasilkp = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$jadwalkp->TahunID)
        ->where('jadwal_kp.ProdiID',$jadwalkp->ProdiID)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $jadwalkp->TahunID,
                        'prodiplh'	=> $jadwalkp->ProdiID,
                        'content'   => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //SEMINAR HASIL KERJA PRAKTEK
    public function hasilkp()
    {
        
            $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
            $tahunplh   = $tahunak->TahunID;
            $prodix     = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
            $prodiplh   = $prodix->ProdiID;     

            $hasilkp = DB::table('jadwal_kp')
            ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
            ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
            ->where('jadwal_kp.TahunID',$tahunplh)
            ->where('jadwal_kp.ProdiID',$prodiplh)
            ->orderBy('jadwal_kp.MhswID','DESC')
            ->get();
    
            $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
            $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
            $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	    => $tahun,
                        'prodi' 	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function hasilkpfilter(Request $request)
    {
                 
            if(!empty($request->tahun)){    
                $tahunplh   = $request->tahun;
                $prodiplh   = $request->prodi;     

                $hasilkp = DB::table('jadwal_kp')
                ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
                ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
                ->where('jadwal_kp.TahunID',$tahunplh)
                ->where('jadwal_kp.ProdiID',$prodiplh)
                ->orderBy('jadwal_kp.MhswID','DESC')
                ->get();
            }
                $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
                $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
                $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK',
                            'hasilkp'	=> $hasilkp,
                            'tahun'	    => $tahun,
                            'prodi' 	=> $prodi,
                            'tahunplh'	=> $tahunplh,
                            'prodiplh'	=> $prodiplh,
                            'content'   => 'admin/kerjapraktek/hasilkp'
                        );
            return view('admin/layout/wrapper',$data);
    }

    public function edithsl($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp.MhswID')
        ->select('jadwal_kp.*', 'mhsw.Nama as NamaMhs')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();

        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian Seminar Hasil KP: '. $jadwal->ProdiID,
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
                        'content'       => 'admin/kerjapraktek/edit_hasil_kp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edithsl_proses(Request $request)
    {
        
        request()->validate([
                'DosenID'                   => 'required',
                'PengujiSeminarHasil1'      => 'required',
                ]);
        DB::table('jadwal_kp')->where('JadwalID',$request->JadwalID)->update([ 
            'Judul'                 => $request->Judul,
            'DosenID'               => $request->DosenID,
            'PengujiSeminarHasil1'  => $request->PengujiSeminarHasil1,
            'PengujiSeminarHasil2'  => $request->PengujiSeminarHasil2,
            'PengujiSeminarHasil3'  => $request->PengujiSeminarHasil3,
            'TglSeminarHasil'       => date('Y-m-d', strtotime($request->TglSeminarHasil)),
            'TempatUjian'           => $request->TempatUjian,
            'JamMulaiSeminarHasil'  => $request->JamMulaiSeminarHasil,
            'JamSelesaiSeminarHasil'=> $request->JamSelesaiSeminarHasil,
            'LoginEdit'             => Session()->get('username'),
            'TglEdit'               => date('Y-m-d H:i:s')
        ]); 
        return redirect('admin/kerjapraktekpro/filterhsl/'.$request->tahun.'/'.$request->prodi);
    }

    public function nilaikp($tahun,$prodi)
    {
          
        $tahunplh   = $tahun;
        $prodiplh   = $prodi;
        $nilaikp = DB::table('jadwal_kp_anggota')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp_anggota.MhswID')
        ->join('jadwal_kp', 'jadwal_kp.JadwalID', '=', 'jadwal_kp_anggota.JadwalID')
        ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->orderBy('jadwal_kp_anggota.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'NILAI HASIL KERJA PRAKTEK',
                        'nilaikp ' => $nilaikp,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/kerjapraktek/nilai_kp'
                        );
        return view('admin/layout/wrapper',$data);
    }



    public function proses_nilai(Request $request)
    {
        if(isset($_POST['filter'])) {
            if($request->tahun=='' || $request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/kerjapraktekpro/filternilaikp/'.$request->tahun.'/'.$request->prodi);
            }   
        }
    }

    public function filternilaikp($tahun,$prodi)
    {
          
        $tahunplh   = $tahun;
        $prodiplh   = $prodi;
        $nilaikp = DB::table('jadwal_kp_anggota')
        ->join('mhsw', 'mhsw.MhswID', '=', 'jadwal_kp_anggota.MhswID')
        ->join('jadwal_kp', 'jadwal_kp.JadwalID', '=', 'jadwal_kp_anggota.JadwalID')
        ->select('jadwal_kp_anggota.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->orderBy('jadwal_kp_anggota.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'NILAI HASIL KERJA PRAKTEK',
                        'nilaikp '   => $nilaikp,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                    
                        'content'   => 'admin/kerjapraktek/nilai_kp'
                        );
        return view('admin/layout/wrapper',$data);
    }


    public function cetakbapro($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
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
        $pdf = PDF::loadview('admin/kerjapraktek/print-baujianprokp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'BeritaAcaraProKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakbapro_v($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
        return view('admin/kerjapraktek/cetak-baujianprokp_v', $data);
    }

    public function cetakbahsl_v($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();    

        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );                       
        return view('admin/kerjapraktek/cetak-baujianhslkp_v', $data);
    }

    public function cetakfrmnilaiprokp_v($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        return view('admin/kerjapraktek/cetak-frmnilaiprokp_v', $data);
    }

    public function cetakbahsl($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $site      = DB::table('identitas')->first();
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
        $pdf = PDF::loadview('admin/kerjapraktek/print-baujianhslkp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'BeritaAcaraHslKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakfrmnilaiprokp($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10,
                    'margin_right' => 15,
                    'margin_bottom' => 10,
                    'margin_left' => 15                  
                ];      
        $pdf = PDF::loadview('admin/kerjapraktek/print-frmnilaiprokp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'FormNilaiProKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakfrmnilaihslkp($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10,
                    'margin_right' => 15,
                    'margin_bottom' => 10,
                    'margin_left' => 15                  
                ];      
        $pdf = PDF::loadview('admin/kerjapraktek/print-frmnilaihslkp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'FormNilaiHslKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakfrmnilaihslkp_v($JadwalID)
    {
        //return('OK');
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                             
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );

        return view('admin/kerjapraktek/cetak-frmnilaihslkp_v', $data);
    }

    public function cetakkwitansiprokp($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
                            
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10,
                    'margin_right' => 10,
                    'margin_bottom' => 10,
                    'margin_left' => 10                  
                ];      
        $pdf = PDF::loadview('admin/kerjapraktek/print-kwitansiprokp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'KwitansiProlKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakkwitansiprokp_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_kp')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing = DB::table('dosen')->where('Login', $jdwl->DosenID)->first();       
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->Penguji1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->Penguji2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->Penguji3)->first();    
        $biaya 		= DB::table('t_biaya')->where('BiayaID', '6')->first();
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Kwitansi',
                        'prodi'     => $prodi,
                        'pembimbing'=> $pembimbing,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3,
                        'biaya'     => $biaya
                    );             
        return view('admin/kerjapraktek/cetak-kwitansiprokp_v', $data);
    }

    public function cetakkwitansihslkp_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_kp')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing = DB::table('dosen')->where('Login', $jdwl->DosenID)->first();       
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil3)->first();    
        $honorpembimbing 	= DB::table('t_biaya')->where('BiayaID', '5')->first();
        $honorpenguji 		= DB::table('t_biaya')->where('BiayaID', '2')->first();      
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Kwitansi',
                        'prodi'     => $prodi,
                        'pembimbing'=> $pembimbing,
                        'penguji1'  => $penguji1,
                        'penguji2'  => $penguji2,
                        'penguji3'  => $penguji3,
                        'honorpembimbing'     => $honorpembimbing,
                        'honorpenguji'     => $honorpenguji
                    );             
        return view('admin/kerjapraktek/cetak-kwitansihslkp_v', $data);
    }

    public function cetakpembimbing_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_kp')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing = DB::table('dosen')->where('Login', $jdwl->DosenID)->first();       
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil3)->first();    
        $honorpembimbing 	= DB::table('t_biaya')->where('BiayaID', '5')->first();
        $honorpenguji 		= DB::table('t_biaya')->where('BiayaID', '2')->first();      
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Surat Permohonan Pembimbing',
                        'prodi'     => $prodi,
                        'pembimbing'=> $pembimbing
                    );             
        return view('admin/kerjapraktek/cetak-pembimbing_v', $data);
    }

    public function cetakperusahaan_v($JadwalID)
    {
        
        $jdwl 		= DB::table('jadwal_kp')->where('JadwalID', $JadwalID)->first();
        $mhs 		= DB::table('mhsw')->where('MhswID', $jdwl->MhswID)->first();
        $judul_web 	= "Cetak Kwitansi";
        $prodi 		= DB::table('prodi')->where('ProdiID', $jdwl->ProdiID)->first();
        $pembimbing = DB::table('dosen')->where('Login', $jdwl->DosenID)->first();       
        $penguji1	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil1)->first();
        $penguji2	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil2)->first();
        $penguji3 	= DB::table('dosen')->where('Login', $jdwl->PengujiSeminarHasil3)->first();    
        $honorpembimbing 	= DB::table('t_biaya')->where('BiayaID', '5')->first();
        $honorpenguji 		= DB::table('t_biaya')->where('BiayaID', '2')->first();      
        $data = array(  
                        'jdwl'      => $jdwl,
                        'mhs'       => $mhs,
                        'judul_web' =>'Cetak Surat Permohonan Penelitian',
                        'prodi'     => $prodi,
                        'pembimbing'=> $pembimbing
                    );             
        return view('admin/kerjapraktek/cetak-perusahaan_v', $data);
    }

    public function cetakkwitansihslkp($JadwalID)
    {
        
        $jadwal = DB::table('jadwal_kp')
        ->join('mhsw','mhsw.MhswID','=','jadwal_kp.MhswID')
        ->select('jadwal_kp.*','mhsw.Nama as NamaMhs','mhsw.ProgramID','mhsw.Handphone')
        ->where('jadwal_kp.JadwalID',$JadwalID)
        ->first();       
        $data = array(  'title'     => 'Nomor '.$jadwal->JadwalID.' nama '.$jadwal->NamaMhs,
                        'jadwal' => $jadwal
                    );
            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10,
                    'margin_right' => 10,
                    'margin_bottom' => 10,
                    'margin_left' => 10                  
                ];      
        $pdf = PDF::loadview('admin/kerjapraktek/print-kwitansihslkp',$data,[],$config);
        // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
        ob_get_clean();
        $nama_file = 'KwitansiHsllKP-'.$jadwal->JadwalID.'-'.$jadwal->NamaMhs.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    //SEMINAR PROPOSAL KERJA PRAKTEK
    public function kemxpro($tahunx,$prodix,$kemxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglMulaiSidang',$kemxpro)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK KEMAREN',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function todxpro($tahunx,$prodix,$todxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglMulaiSidang',$todxpro)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK HARI INI',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function besxpro($tahunx,$prodix,$besxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglMulaiSidang',$besxpro)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK BESOK',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function lusxpro($tahunx,$prodix,$lusxpro)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $kerjapraktekpro = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglMulaiSidang',$lusxpro)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR PROPOSAL KERJA PRAKTEK LUSA',
                        'kerjapraktekpro'	=> $kerjapraktekpro,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
    
    //SEMINAR HASIL KERJA PRAKTEK
    public function kemxhsl($tahunx,$prodix,$kemxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilkp = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglSeminarHasil',$kemxhsl)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
    
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK KEMAREN',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function todxhsl($tahunx,$prodix,$todxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilkp = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglSeminarHasil',$todxhsl)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK HARI INI',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function besxhsl($tahunx,$prodix,$besxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilkp = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglSeminarHasil',$besxhsl)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK BESOK',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function lusxhsl($tahunx,$prodix,$lusxhsl)
    {
          
        $tahunplh   = $tahunx;
        $prodiplh   = $prodix;
        $hasilkp = DB::table('jadwal_kp')
        ->join('dosen', 'dosen.Login', '=', 'jadwal_kp.DosenID')
        ->select('jadwal_kp.*','dosen.Nama as NamaDosen')
        ->where('jadwal_kp.TahunID',$tahunplh)
        ->where('jadwal_kp.ProdiID',$prodiplh)
        ->where('jadwal_kp.TglSeminarHasil',$lusxhsl)
        ->orderBy('jadwal_kp.MhswID','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $data = array(  'title'     => 'SEMINAR HASIL KERJA PRAKTEK LUSA',
                        'hasilkp'	=> $hasilkp,
                        'tahun'	            => $tahun,
                        'prodi'	            => $prodi,
                        'tahunplh'	        => $tahunplh,
                        'prodiplh'	        => $prodiplh,
                        'content'           => 'admin/kerjapraktek/hasilkp'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function delete($MhswID)
    {
    	
    	DB::table('mhsw')->where('MhswIDxxx',$MhswID)->delete();
    	return redirect('admin/mahasiswa')->with(['sukses' => 'Data telah dihapus']);
    }

}
