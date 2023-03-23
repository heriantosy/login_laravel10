<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal_model;
use App\Models\Krs_model;
use App\Models\Absensi_model;
use Illuminate\Support\Str;
use Image;
use PDF;

class Jadwalujian extends Controller
{
    public function index()
    {
    	
        $tahunak     = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh    = $tahunak->TahunID;

        $programx    = DB::table('program')->whereNotIn('ProgramID',['SORE'])->orderBy('ProgramID','DESC')->limit(1)->first(); 
        $programplh  = $programx->ProgramID;
        
        $prodix      = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh    =$prodix->ProdiID;

        $myjadwal    = new Jadwal_model();
        $jadwalujian = $myjadwal->filter_def($tahunplh, $programplh, $prodiplh);
        
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();
        $data = array(  'title'       => 'JADWAL UJIAN: '.$tahunplh.' PRODI: '.$prodiplh,
                        'jadwalujian' => $jadwalujian,
                        'tahun'    => $tahun,
                        'program'  => $program,
                        'prodi'    => $prodi,
                      
                        'tahunplh'   => $tahunplh,
                        'programplh' => $programplh,                    
                        'prodiplh'   => $prodiplh,
                        'hari'       => $hari,                     
                        'matakuliah' => $matakuliah,
                        'ruang'    => $ruang,
                        'dosen'    => $dosen,
                        'content'     => 'admin/jadwalujian/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->program=='' ||$request->prodi=='' || $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/jadwalujian/filter/'.$request->tahun.'/'.$request->program.'/'.$request->prodi);
            }
        }
    }

    // Main page
    public function filter($tahun, $program, $prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunplh      = $tahun;
        $programplh    = $program;
        $prodiplh      = $prodi;

        $myjadwal    = new Jadwal_model();
        $jadwalujian      = $myjadwal->filter_def($tahunplh, $programplh, $prodiplh);
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $data = array(  'title'      => 'JADWAL UJIAN: '.$tahunplh.' PRODI: '.$prodiplh,
                        'jadwalujian'=> $jadwalujian,
                        'tahun'     => $tahun,
                        'program'   => $program,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunplh,
                        'programplh'=> $programplh,
                        'prodiplh'  => $prodiplh,
                        'content'   => 'admin/jadwalujian/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function detail($JadwalID)
    {
        
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);

        $mykrs = new Krs_model();
        $krs   = $mykrs->krs_detail($JadwalID);

        $mypresmhs = new Absensi_model();
        $presmhs   = $mypresmhs->absensi_mhs($JadwalID);
        
        $site     = DB::table('identitas')->first();
        $prodix   = $jadwal->ProdiID;
        $prodi    = DB::table('prodi')->where('ProdiID',$prodix)->first();
        $data = array(  'title'     => ''.$jadwal->NamaDosen.', '.$jadwal->Gelar.' - Matakuliah: '.$jadwal->NamaMK.' - ThnAkademik: '.$jadwal->TahunID,
                        'jadwal'    => $jadwal,
                        'krs'       => $krs,
                        'presmhs'   => $presmhs,
                        'site'      => $site,
                        'prodi'     => $prodi,
                        'content'   => 'admin/jadwalujian/detail'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($JadwalID)
    {
        
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
    
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();

        $data = array(  'title'         => 'Edit Jadwal Ujian:'. $jadwal->ProdiID,
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
                        'content'       => 'admin/jadwalujian/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                'UTSTanggal'  => 'required',
                'UASTanggal'  => 'required',
                ]);

        $MKKode    = DB::table('mk')->where('MKID',$request->MKID)->first();
        DB::table('jadwal')->where('JadwalID',$request->JadwalID)->update([ 
            'UTSTanggal'    => date('Y-m-d', strtotime($request->UTSTanggal)),
            'UTSJamMulai'   => $request->UTSJamMulai,
            'UTSJamSelesai' => $request->UTSJamSelesai,
            'UASTanggal'    => date('Y-m-d', strtotime($request->UASTanggal)),
            'UASJamMulai'   => $request->UASJamMulai,
            'UASJamSelesai' => $request->UASJamSelesai,
            'KehadiranMin'  => $request->KehadiranMin,
            'LoginEdit'     => Session()->get('username'),
            'TglEdit'       => date('Y-m-d H:i:s')
        ]);
        $prodiplh = str_replace('.','',$request->ProdiID);
        
        return redirect('admin/jadwalujian/filter/'.$request->TahunID.'/'.$prodiplh)->with(['sukses' => 'Data telah diedit']);
    }
    
    //Cek kehadiran per Mahasiswa
    public function cekkehadiran()
    {
        
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   = $tahunak->TahunID;
        $MhswIDplh  = "-";
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $data = array(  'title'     => 'CEK KEHADIRAN',
                        'tahun'     => $tahun,
                        'tahunplh'  => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,       
                        'content'   => 'admin/jadwalujian/cekkehadiran'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function proseskehadiran(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->MhswID=='' || $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/jadwalujian/filterkehadiran/'.$request->tahun.'/'.$request->MhswID);
            }
        }
    }

    public function filterkehadiran($tahun,$MhswID) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $tahun       = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $mhs     = DB::table('mhsw')->where('MhswID',$MhswID)->first();
        if(empty($mhs->MhswID)){
            return redirect('admin/jadwalujian/cekkehadiran')->with(['warning' => 'Mahasiswa tidak ditemukan!']);
            //return redirect('admin/jadwalujian/filterkehadiran/'.$tahun.'/'.$MhswID)->with(['warning' => 'Mahasiswa tidak ditemukan!']);
        }else{
        $data = array(  'title'     => 'CEK KEHADIRAN : '.$MhswID. ' - '.$mhs->Nama.' - '.$tahunx,
                        'mhs'     => $mhs,
                        'tahun'     => $tahun,
                        'tahunplh'  => $tahunx,
                        'MhswIDplh' => $MhswID,
                        'content'   => 'admin/jadwalujian/cekkehadiran'
                    );
        return view('admin/layout/wrapper',$data);
        }
    }

    public function cetak_absensi_uts($JadwalID) {
                       
            $judul_web 	= "Cetak Absensi UTS";
            $jdw     = DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
            $hari    = DB::table('hari')->where('HariID',$jdw->HariID)->first();
            $prod     = str_replace(".", "", $jdw->ProdiID);
            $prodi    = DB::table('prodi')->where('ProdiID',$prod)->first();
            $mk       = DB::table('mk')->where('MKID',$jdw->MKID)->first();
            $Matakulx = strtolower($mk->Nama);
            $Matakul  = ucwords($Matakulx);

            $ds       = DB::table('dosen')->where('Login',$jdw->DosenID)->first();
            $NamaDosx = strtolower($ds->Nama);
            $NamaDos = ucwords($NamaDosx);
            $data = array('judul_web' => $judul_web,
                        'jdw'       => $jdw,
                        'hari'      => $hari,
                        'prodi'      => $prodi,
                        'mk'        => $mk,
                        'ds'        => $ds,
                        'Matakul'   => $Matakul,
                        'NamaDos'   => $NamaDos
                    );
            return view('admin/jadwalujian/cetak_absensi_uts', $data);
        } 
        
    public function cetak_absensi_uas($JadwalID) {
                       
            $judul_web 	= "Cetak Absensi UAS";
            $jdw     = DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
            $hari    = DB::table('hari')->where('HariID',$jdw->HariID)->first();
            $prod     = str_replace(".", "", $jdw->ProdiID);
            $prodi    = DB::table('prodi')->where('ProdiID',$prod)->first();
            $mk       = DB::table('mk')->where('MKID',$jdw->MKID)->first();
            $Matakulx = strtolower($mk->Nama);
            $Matakul  = ucwords($Matakulx);

            $ds       = DB::table('dosen')->where('Login',$jdw->DosenID)->first();
            $NamaDosx = strtolower($ds->Nama);
            $NamaDos = ucwords($NamaDosx);
            $data = array('judul_web' => $judul_web,
                        'jdw'       => $jdw,
                        'hari'      => $hari,
                        'prodi'      => $prodi,
                        'mk'        => $mk,
                        'ds'        => $ds,
                        'Matakul'   => $Matakul,
                        'NamaDos'   => $NamaDos
                    );
            return view('admin/jadwalujian/cetak_absensi_uas', $data);
    }     
    
    public function cetak_formnilai($JadwalID) {
                 
            $data['judul_web'] 	= "Cetak Form Nilai Kuliah";
            $data['jdw'] 		= DB::table('jadwal', "JadwalID='$JadwalID'")->first();
           
            $data['dosen'] 		= DB::table('dosen', "Login='".$data['jdw']->DosenID."'")->first();
            $data['ruang'] 		= DB::table('ruang', "RuangID='".$data['jdw']->RuangID."'")->first();
            $data['mk'] 		= DB::table('mk', "MKID='".$data['jdw']->MKID."'")->first();
            $data['prodi'] 		= DB::table('prodi', "ProdiID='".$data['mk']->ProdiID."'")->first();
            $data['hari'] 		= DB::table('hari', "HariID='".$data['jdw']->HariID."'")->first();
            return view('admin/jadwalujian/cetak_formnilai', $data);
        }    

}
