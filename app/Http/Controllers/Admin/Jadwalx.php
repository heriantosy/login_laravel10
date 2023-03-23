<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\Jadwal_model;
use App\Models\Dosen_model;
use App\Models\Matakuliah_model;
use App\Models\Ruang_model;
use App\Models\Program_model;
use App\Models\Prodi_model;
use App\Models\Kelas_model;
use App\Models\Hari_model;
use App\Models\Tahun_model;
use App\Models\Krs_model;
use Illuminate\Support\Facades\Crypt; //add leweh
use Image;
use PDF;

class Jadwalx extends Controller
{
    public function index()
    {
    	
        $tahunak      = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh     = $tahunak->TahunID;
        $programx     = DB::table('program')->whereNotIn('ProgramID',['SORE'])->orderBy('ProgramID','DESC')->limit(1)->first(); 
        $programplh   = $programx->ProgramID;
        $prodix       = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh     = $prodix->ProdiID;

        // try{
        //     $periode = PeriodeMusrenbang::where('status','dibuka')->first();
        //         if($periode->status != 'dibuka'){
        //             $id_periode = 'nothing';
        //         }else{
        //             $id_periode = $periode->id;
        //         }
        //     }catch(Exception $e){
        //         $id_periode = 'nothing';
        //     }

        // Using Query Builder -------------------------------------------------------------------------------
        // $myjadwal   = new Jadwal_model();
        // $jadwal     = $myjadwal->filter_def($tahunplh, $programplh, $prodiplh);

        // $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        // $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        // $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        // $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        // $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        // $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();

        // Using Elloquent ----------------------------------------------------------------------------------
        $tahun      = Tahun_model::select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = Prodi_model::orderBy('ProdiID','ASC')->get();
        //$program    = Program_model::orderBy('ProgramID','ASC')->get();
        $hari       = Hari_model::orderBy('HariID','ASC')->get();
        $kelas      = Kelas_model::orderBy('KelasID','ASC')->get();
        $matakuliah = Matakuliah_model::orderBy('MKID','ASC')->get();
        $ruang      = Ruang_model::orderBy('RuangID','ASC')->get();
        $dosen      = Dosen_model::orderBy('Login','ASC')->get();
        $jadwal     = Jadwal_model::where('NA','N')->where('ProgramID', $programplh)->where('ProdiID', $prodiplh)->where('TahunID', $tahunplh)->orderBy('HariID', 'ASC')->get();
		$data = array(  'title'    => 'Jadwal Kuliah',
                        'jadwalx'   => $jadwal,                    
                        'hari'     => $hari,                     
                        'matakuliah'  => $matakuliah,
                        'hari'     => $hari,
                        'dosen'     => $dosen,
                        'tahun'     => $tahun,
                        'program'   => $program,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunplh,
                        'programplh'=> $programplh,
                        'prodiplh'  => $prodiplh,
                        'hariplh'   => 'Senin',
                        'content'   => 'admin/jadwalx/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function filterjadwal(Request $request) 
    {
        
        $tahunplh       = $request->tahun;       
        $programplh     = $request->program;
        $prodiplh       = $request->prodi;
        $hariplh        = $request->hari;
        $semesterplh    = $request->semester;
        
         //Using Query Builder
        // $myjadwal           = new Jadwal_model();
        // if(empty($hariplh) && !empty($semesterplh)){
        //     $jadwal = $myjadwal->filter_smt($tahunplh, $programplh, $prodiplh, $semesterplh);
        // }
        // elseif(!empty($hariplh) && empty($semesterplh)){
        //     $jadwal = $myjadwal->filter_hari($tahunplh, $programplh, $prodiplh, $hariplh);
        // }
        // elseif(!empty($hariplh) && !empty($semesterplh)){
        //     $jadwal = $myjadwal->filter_hari_smt($tahunplh, $programplh, $prodiplh, $semesterplh, $hariplh);
        // }
        // else{
        //     $jadwal = $myjadwal->filter_def($tahunplh, $programplh, $prodiplh);
        // }

         //Using Query Builder
        // $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        // $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        // $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $prd        = DB::table('prodi')->where('ProdiID',$prodiplh)->first();
        $prg        = DB::table('program')->where('ProgramID',$programplh)->first();
        //dd($prdr);

        //Using Elloquent
        $tahun      = Tahun_model::select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = Prodi_model::orderBy('ProdiID','ASC')->get();
        //$program    = Program_model::orderBy('ProgramID','ASC')->get();
        $hari       = Hari_model::orderBy('HariID','ASC')->get();
        $kelas      = Kelas_model::orderBy('KelasID','ASC')->get();
        $matakuliah = Matakuliah_model::orderBy('MKID','ASC')->get();
        $ruang      = Ruang_model::orderBy('RuangID','ASC')->get();
        $dosen      = Dosen_model::orderBy('Login','ASC')->get();
        $jadwal     = Jadwal_model::where('NA','N')->where('ProgramID', $programplh)->where('ProdiID', $prodiplh)->where('TahunID', $tahunplh)->orderBy('HariID', 'ASC')->get();
        $data = array(  'title'      => 'Jadwal Kuliah '.$tahunplh.' - '.$prd->Nama,
                        'jadwalx'    => $jadwal,
                        'dosen'     => $dosen,
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'program'   => $program,
                        'hari'      => $hari,
                        'tahunplh'  => $tahunplh,
                        'prodiplh'  => $prodiplh,
                        'programplh'=> $programplh,
                        'hariplh'   => $hariplh,
                        'semesterplh'=> $semesterplh,
                        'content'   => 'admin/jadwalx/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

      public function detail($JadwalID)
      {
          
          $myjadwal = new Jadwal_model();
          $jadwal   = $myjadwal->jadwal_detail($JadwalID); 
          
          $mykrs    = new Krs_model();
          $krs      = $mykrs->krs_detail($JadwalID);
          $site     = DB::table('identitas')->first();
          $prodix   = $jadwal->ProdiID;
          $prodi    = DB::table('prodi')->where('ProdiID',$prodix)->first();
          $data = array(   'title'     => ''.$jadwal->NamaMK.' - '.$jadwal->NamaDosen.', '.$jadwal->Gelar.' - '.$jadwal->TahunID,
                          'jadwalx'    => $jadwal,
                          'krs'       => $krs,
                          'site'      => $site,
                          'prodi'      => $prodi,
                          'content'   => 'admin/jadwalx/detail'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function nilaidosen($JadwalID)
      {
          
          
          $myjadwal = new Jadwal_model();
          $jadwal   = $myjadwal->jadwal_detail($JadwalID); 
          
          $mykrs    = new Krs_model();
          $krs      = $mykrs->nilai_detail($JadwalID);
          $site     = DB::table('identitas')->first();
          $prodi    = Prodi_model::select('ProdiID','Nama')->where('ProdiID', $jadwal->ProdiID)->first();
          $data = array(  'title'     => ''.$jadwal->NamaMK.' - '.$jadwal->NamaDosen.', '.$jadwal->Gelar.' - '.$jadwal->TahunID,
                          'jadwalx'   => $jadwal,
                          'krs'       => $krs,
                          'site'      => $site,
                          'prodi'     => $prodi,
                          'content'   => 'admin/jadwalx/nilaidosen'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function simpannilaidosen(Request $request){ 
        $KRSID      = $request->KRSID;
        $MhswID     = $request->MhswID;
        $JadwalID   = $request->JadwalID;
        //dd($MhswID);
        $Tugas1     = $request->Tugas1;
        $Tugas2     = $request->Tugas2;
        $Tugas3     = $request->Tugas3;
        $Presensi   = $request->Presensi;
        $UTS        = $request->UTS;
        $UAS        = $request->UAS;

        foreach($KRSID as $key => $no)
        {          
            $datax['KRSID']     = $no;
            $datax['Tugas1']    = $Tugas1[$key];
            $datax['Tugas2']    = $Tugas2[$key];
            $datax['Tugas3']    = $Tugas3[$key]; 
            $datax['Presensi']  = $Presensi[$key]; 
            $datax['UTS']       = $UTS[$key]; 
            $datax['UAS']       = $UAS[$key];            
            //\DB::table('krsnilai')->insert($datax); //untuk insert ke table baru
            \DB::table('krs')
            ->where('KRSID',$KRSID[$key])
            ->update($datax); //untuk update nilai tabel yang sudah ada
            //bisa menggunakan model namun field fillable model penilaian harus terisi
            //Penilaian::create($datax); 
        }
        
        //ambil JadwalID untuk mengembalikan nilai JadwalID agar bisa diredirect
        // $dt = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        // $jdw= $dt->JadwalID;
        ///filter/'.$JadwalID.'/'.$MhswID
        //return redirect('admin/jadwalx/nilaidosen/'.$dt->JadwalID);
        return redirect()->back(); //leweh musrem
    }

    // Tambah
    public function tambah($tahunx, $prodix)
    {
        
        $prodiplh      =str_replace('.','',$prodix);
        //dd($prodiplh);
        $kurikulumktif = \DB::table('kurikulum')->where('NA','N')->where('ProdiID',$prodiplh)->where('NA','N')->first();
        $kurikulumplh   = $kurikulumktif->KurikulumID;

        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->where('KurikulumID',$kurikulumplh)->orderBy('Sesi','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();
        $data = array(  'title'     => 'PENJADWALAN KULIAH : '.$prodiplh,                       
                        'tahun'    => $tahun,
                        'program'    => $program,
                        'prodi'    => $prodi,
                        'hari'    => $hari,                     
                        'matakuliah'  => $matakuliah,
                        'ruang'    => $ruang,
                        'dosen'    => $dosen,
                        'tahunplh'    => $tahunx, 
                        'prodiplh'    => $prodix,  
                        'content'   => 'admin/jadwalx/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

public function tambah_proses(Request $request)
{
    
    request()->validate([
        //'JadwalID'      => 'required|unique:jadwal',
        'NamaKelas'     => 'required',
         ]);

    $arrProgramID = $request->ProgramID;
    //$ProgramID = (empty($arrProgramID))? '' : '.'.implode('.', $arrProgramID).'.'; //oribro
    $ProgramID = (empty($arrProgramID))? '.REG A.' : '.'.implode('.', $arrProgramID).'.'; //if empty set REG A as default value
    //$prodibro  = '.'.$request->prodi.'.';
    $MKKode    = DB::table('mk')->where('MKID',$request->MKID)->first();
    $Ruang     = DB::table('ruang')->where('RuangID',$request->RuangID)->first();
    DB::table('jadwal')->insert([
        'KodeID'        => 'SISFO',
        'TahunID'       => $request->tahun,
        'ProgramID'     => $ProgramID,
        'ProdiID'       => $request->ProdiID,
        'HariID'        => $request->HariID,
        'JamMulai'      => $request->JamMulai,
        'JamSelesai'    => $request->JamSelesai,
        'DosenID'       => $request->DosenID,
        'RuangID'       => $request->RuangID,
        'Kapasitas'     => $request->Kapasitas,
        'MKID'          => $request->MKID,
        'MKKode'        => $MKKode->MKKode,
        'Nama'          => $MKKode->Nama,
        'SKSAsli'       => $MKKode->SKS,
        'SKS'           => $MKKode->SKS,
        'NamaKelas'     => $request->NamaKelas,
        'RencanaKehadiran' => $request->RencanaKehadiran,
        'KehadiranMin'  => $request->KehadiranMin,
        'LoginBuat'     => Session()->get('username'),
        'TglBuat'       => date('Y-m-d',strtotime($request->TglBuat))
    ]);
    
    return redirect('admin/jadwalx')->with(['sukses' => 'Data telah ditambah']);
}

    public function edit($JadwalID)
    {
        
        $myjadwal   = new Jadwal_model();
        $jadwal     = $myjadwal->jadwal_detail($JadwalID);
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->where('ProdiID',$jadwal->ProdiID)->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $kelas      = DB::table('kelas')->orderBy('KelasID','ASC')->where('ProgramID',$jadwal->ProgramID)->where('ProdiID',$jadwal->ProdiID)->where('TahunID',$jadwal->TahunID)->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal :'. $jadwal->ProdiID,
                        'jadwalx'        => $jadwal, 
                        'tahun'         => $tahun,
                        'program'       => $program,
                        'prodi'         => $prodi,
                        'hari'          => $hari,                     
                        'matakuliah'    => $matakuliah,
                        'ruang'         => $ruang,
                        'kelas'         => $kelas,
                        'dosen'         => $dosen,
                        'tahunplh'      => $jadwal->TahunID, 
                        'prodiplh'      => $jadwal->ProdiID, 
                        'content'       => 'admin/jadwalx/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                'TahunID'  => 'required',
                'NamaKelas'        => 'required',
                ]);
        
        //$arrProgramID = $request->ProgramID;    
        //$ProgramID = (empty($arrProgramID))? '' : '.'.implode('.', $arrProgramID).'.'; //if empty set REG A as default value
        $MKKode    = DB::table('mk')->where('MKID',$request->MKID)->first();
        DB::table('jadwal')->where('JadwalID',$request->JadwalID)->update([ 
            'ProgramID'     => $request->ProgramID,
            'ProdiID'       => $request->ProdiID,
            'HariID'        => $request->HariID,
            'JamMulai'      => $request->JamMulai,
            'JamSelesai'    => $request->JamSelesai,
            'DosenID'       => $request->DosenID,
            'RuangID'       => $request->RuangID,
            'Kapasitas'     => $request->Kapasitas,
            'MKID'          => $request->MKID,
            'MKKode'        => $MKKode->MKKode,
            'Nama'          => $MKKode->Nama,
            'SKSAsli'       => $MKKode->SKS,
            'SKS'           => $MKKode->SKS,
            'NamaKelas'     => $request->NamaKelas,
            'RencanaKehadiran' => $request->RencanaKehadiran,
            'KehadiranMin'  => $request->KehadiranMin,
            'LoginEdit'     => Session()->get('username'),
            'TglEdit'       => date('Y-m-d H:i:s')
        ]);
        //$prodiplh = str_replace('.','',$request->ProdiID);
        $prodiplh = $request->ProdiID;
        //return redirect('admin/jadwal/filterjadwal/'.$request->TahunID.'/'.$prodiplh)->with(['sukses' => 'Data telah diedit']);
        //return redirect('admin/jadwalx')->with(['sukses' => 'Data telah diedit']);
        return redirect()->back();
    }

    public function delete($JadwalID)
    {
        
        DB::table('jadwal')->where('JadwalID',$JadwalID)->delete();
        return redirect('admin/jadwalx');
    }


    public function cetak($JadwalID)
    {
        
        
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);                        
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Absensi '.$jadwal->JadwalID.' Nama '.$jadwal->NamaDosen,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );            
        $config = [ 'format' => 'A4-L', // Landscape
                    'margin_top' => 25                    
                ];
        $pdf = PDF::loadview('admin/jadwalx/cetak',$data,[],$config);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function print_absensi($JadwalID)
    {
        
        // $idx = Crypt::decryptString($JadwalID);
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
                        
        $site  = DB::table('identitas')->first();
        $prodi = DB::table('prodi')->where('ProdiID', $jadwal->ProdiID)->first();
        $mykrs = new Krs_model();
        $krs   = $mykrs->krs_detail_s($JadwalID);     
        $data = array(  'title'     => 'Absensi '.$jadwal->JadwalID.' Nama '.$jadwal->NamaDosen,
                        'jadwalx'   => $jadwal,
                        'krs'       => $krs,
                        'prodi'     => $prodi,               
                        'site'      => $site
                    );
        return view('admin/jadwalx/print_absensi',$data);
    }

    public function cetakabsdos($JadwalID)
    {
        
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);                  
        $site      = DB::table('identitas')->first();
        $data = array(  'title'     => 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen,
                        'jadwalx' => $jadwal,              
                        'site'      => $site
                    );       
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10                
                ];
        $pdf = PDF::loadview('admin/jadwalx/print-absensidosen',$data,[],$config);
        ob_get_clean();
        $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function labelujian($tahunx, $prodix)
    {
        
        // $myjadwal = new Jadwal_model();
        // $jadwal   = $myjadwal->jadwal_detail($JadwalID);
              
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();      
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodif     = $prodix;
        $data = array(  'title'     => 'CETAK LABEL UJIAN',
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodif,
                        'prodi'     => $prodi,
                        'tahun'     => $tahun,
                        'content'   => 'admin/jadwalx/label_ujian'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function cetaklbluts($tahunx, $prodix, $harix)
    {
                           
        $data = array(  'title'     => 'CETAK LABEL UTS',
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,
                        'hari'      => $harix              
                    );
            
        $config = [ 'format' => 'A4-L', // Landscape
                    'margin_top' => 10                 
                ];
        $pdf = PDF::loadview('admin/jadwalx/cetak_label_uts',$data,[],$config);
        ob_get_clean();
        $nama_file = 'LABEL_UAS_'.$tahunx.' PRODI '.$prodix.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetaklbluas($tahunx, $prodix, $harix)
    {
                           
        $data = array(  'title'     => 'CETAK LABEL UAS',
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,
                        'hari'      => $harix              
                    );            
        $config = [ 'format' => 'A4-L', // Landscape
                    'margin_top' => 10                 
                ];
        $pdf = PDF::loadview('admin/jadwalx/cetak_label_uas',$data,[],$config);
        ob_get_clean();
        $nama_file = 'LABEL_UAS_'.$tahunx.' PRODI '.$prodix.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakformnilaikelas($JadwalID)
    {
           
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
        
        $mykrs = new Krs_model();
        $krs   = $mykrs->nilai_kelas($JadwalID);                         
        $data = array(  'title'     => 'CETAK LABEL UAS',
                        'jadwalx'    => $jadwal,
                        'krs'       => $krs,
                        'tahunplh'  => $jadwal->TahunID,
                        'prodiplh'  => $jadwal->ProdiID           
                    );            
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10                 
                ];
        $pdf = PDF::loadview('admin/jadwalx/cetak_formnilai_kelas',$data,[],$config);
        ob_get_clean();
        $nama_file = 'FORMNILAI_'.$jadwal->NamaMK.' PRODI '.$jadwal->ProdiID.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetaknilaikelas_v($JadwalID) {
           

        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
        
        $mykrs = new Krs_model();
        $krs   = $mykrs->nilai_kelas($JadwalID); 
                          
        $data = array(  'title'     => 'Cetak Nilai Kelas',
                'jadwal'    => $jadwal,
                'krs'       => $krs,
                'tahunplh'  => $jadwal->TahunID,
                'prodiplh'  => $jadwal->ProdiID           
            );                                                    
        return view('admin/jadwalx/cetak_nilai_kelas', $data);           
	}

    public function cetak_formnilai($JadwalID) {
                 
            $myjadwal = new Jadwal_model();
            $jadwal   = $myjadwal->jadwal_detail($JadwalID);
            
            $mykrs = new Krs_model();
            $krs   = $mykrs->nilai_kelas($JadwalID);     
            
            $data['judul_web'] 	= "Cetak Form Nilai Kuliah";
            $data['jdw'] 		= DB::table('jadwal', "JadwalID='$JadwalID'")->first();
           
            $data['dosen'] 		= DB::table('dosen', "Login='".$data['jdw']->DosenID."'")->first();
            $data['ruang'] 		= DB::table('ruang', "RuangID='".$data['jdw']->RuangID."'")->first();
            $data['mk'] 		= DB::table('mk', "MKID='".$data['jdw']->MKID."'")->first();
            $data['prodi'] 		= DB::table('prodi', "ProdiID='".$data['mk']->ProdiID."'")->first();
            $data['hari'] 		= DB::table('hari', "HariID='".$data['jdw']->HariID."'")->first();
            return view('admin/jadwalx/cetak_formnilai', $data);
        }  

    public function cetakabsdos_v($JadwalID) {
                 
        $data['judul_web'] 	= "Cetak Form Absensi Dosen";
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
        $site      = DB::table('identitas')->first();

        $data = array('title'     => 'Absensi'.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen,
                    'jadwal' => $jadwal,              
                    'site'      => $site
                );
            return view('admin/jadwalx/cetakabsdos_v', $data);
        }  

}
