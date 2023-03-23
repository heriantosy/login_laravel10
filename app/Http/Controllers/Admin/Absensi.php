<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Jadwal_model;
use App\Models\Krs_model;
use App\Models\Absensi_model;
use Image;
use PDF;

class Absensi extends Controller
{

    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   = $tahunak->TahunID;

        $programx   = DB::table('program')->whereNotIn('ProgramID',['SORE'])->orderBy('ProgramID','DESC')->limit(1)->first(); 
        $programplh = $programx->ProgramID;
                
        $prodix     = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh   = $prodix->ProdiID;

        $myabsensi  = new Absensi_model();
        $jadwal     = $myabsensi->absensi_jadwal($tahunplh, $programplh, $prodiplh);

        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();
		$data = array(  'title'    => 'ABSENSI PERKULIAHAN: '. $tahunplh,
                        'jadwal'   => $jadwal,
                        'tahun'    => $tahun,
                        'program'  => $program,
                        'prodi'    => $prodi,
                        'tahunplh' => $tahunplh,
                        'programplh'  => $programplh,
                        'prodiplh'    => $prodiplh,                        
                        'hari'        => $hari,                     
                        'matakuliah'  => $matakuliah,
                        'ruang'       => $ruang,
                        'dosen'       => $dosen,
                        'content'     => 'admin/absensi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->tahun=='' ||$request->program=='' || $request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/absensi/filter/'.$request->tahun.'/'.$request->program.'/'.$request->prodi);
            }
        }
    }

    public function filter($tahun, $program, $prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        $tahunplh   = $tahun;       
        $programplh = $program;
        $prodiplh   = $prodi;
             
        $myabsensi  = new Absensi_model();
        $jadwal     = $myabsensi->absensi_jadwal($tahunplh, $programplh, $prodiplh);
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $program    = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $data = array(  'title'      => 'ABSENSI PERKULIAHAN: '. $tahunplh,
                        'jadwal'     => $jadwal,
                        'tahun'      => $tahun,
                        'prodi'      => $prodi,
                        'program'    => $program,
                        'tahunplh'   => $tahunplh,
                        'programplh' => $programplh,
                        'prodiplh'   => $prodiplh,
                        'content'    => 'admin/absensi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function createabsensi($JadwalID){
             
        $myabsensi  = new Absensi_model();
        $absen     = $myabsensi->create_absensi($JadwalID);

        //HEADER BRO ---------------------------------------------------------------------------
        $jdwl = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();    
        //$pres = \DB::table('presensi')->where('PresensiID',$absen->PresensiID)->first();
        //dd($pres->PresensiID);
        $dosen = \DB::table('dosen')->where('Login',$jdwl->DosenID)->first();
        $matakuliah = \DB::table('mk')->where('MKID',$jdwl->MKID)->first();
        //$totmhshdr  = \DB::table('presensimhsw')->where('PresensiID',$pres->PresensiID)->count();

        $urutx = \DB::table('presensi')->where('JadwalID',$jdwl->JadwalID)->orderBy('Pertemuan', 'desc')->first();
        if (!empty($urutx->Pertemuan)){
            $urut = $urutx->Pertemuan + 1;  
        }else{
            $urut = 1;  
        }

        //return view('absensi.index',$data);
        $data = array(  'title' => 'ABSENSI PERKULIAHAN: '. $jdwl->TahunID,
        
        'jdwl'      => $jdwl,
        'absen'     => $absen,
        'dosen'     => $dosen,
        'matakuliah'=> $matakuliah,
        'urut'      => $urut,
        'content'     => 'admin/absensi/create_absensi'
    );
        return view('admin/layout/wrapper',$data);
    }

    public function viewpresensi_isi($PresensiID, $JadwalID){
              
        $myabsensi  = new Absensi_model();
        $presensimhs= $myabsensi->view_absensi_isi($JadwalID);
        
        //header Penilaian dosen 
        $pertemuan  = \DB::table('presensi')->select('PresensiID','Pertemuan')->where('PresensiID',$PresensiID)->first();
        $jdwl       = \DB::table('jadwal')->select('JadwalID','DosenID','MKID','TahunID','NamaKelas')->where('JadwalID',$JadwalID)->first();
        $dosen      = \DB::table('dosen')->select('Login','Nama')->where('Login',$jdwl->DosenID)->first();
        $matakuliah = \DB::table('mk')->select('MKID','Nama')->where('MKID',$jdwl->MKID)->first();
        $PresensiID = \DB::table('presensi')->select('PresensiID')->where('PresensiID',$PresensiID)->first();
        $stat       = \DB::table('jenispresensi')->get();
                            
        //return view('absensi.listpresensi_isi',$data);
        $data = array(  'title' => 'ABSENSI KULIAH',
        'presensimhs'   => $presensimhs,
        'jdwl'          => $jdwl,
        'pertemuan'     => $pertemuan,
        'dosen'         => $dosen,
        'matakuliah'    => $matakuliah,
        'stat'          => $stat,
        'PresensiID'    => $PresensiID,
        'content'       => 'admin/absensi/listpresensi_isi'
         );
        return view('admin/layout/wrapper',$data);
    }

    public function simpanpresensi(Request $request){
        
        //return 'abc';
         $MhswID            = $request->MhswID;
         $JadwalID          = $request->JadwalID;
         $PresensiID        = $request->PresensiID;
         //dd($PresensiID);
         $KRSID             = $request->KRSID;
         $JenisPresensiID   = $request->JenisPresensiID;
        foreach($MhswID as $key => $no)
        {          
            if ($JenisPresensiID[$key]=='H'){
                $Nilai[$key] =1;
            }
            elseif ($JenisPresensiID[$key]=='I'){
                $Nilai[$key] =1;
            }
            elseif ($JenisPresensiID[$key]=='S'){
                $Nilai[$key] =1;
            }
            else{
                $Nilai[$key] =0;
            } 
            $datax['MhswID'] = $no;            
            $datax['JadwalID'] = $JadwalID[$key];
            $datax['KRSID'] = $KRSID[$key];
            $datax['PresensiID'] = $PresensiID[$key];
            $datax['JenisPresensiID'] = $JenisPresensiID[$key];
            $datax['Nilai'] = $Nilai[$key];
           
            \DB::table('presensimhsw')->insert($datax); //untuk insert ke table baru
        }    
        //ambil satu nilai JadwalID agar tidak dilooping untuk nilai redirect
        $pertemuan  = \DB::table('presensi')->where('PresensiID',$PresensiID)->first();
        $jdwl       = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        $dosen      = \DB::table('dosen')->where('Login',$jdwl->DosenID)->first();
        $matakuliah = \DB::table('mk')->where('MKID',$jdwl->MKID)->first();
        // $PresensiID = \DB::table('presensi')->where('PresensiID',$PresensiID)->first();
        // $stat = \DB::table('jenispresensi')->get();
        $jdwl       = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        $pres       = \DB::table('presensi')->where('PresensiID',$PresensiID)->first();
        $urutx      = \DB::table('presensi')->where('JadwalID',$jdwl->JadwalID)->orderBy('Pertemuan', 'desc')->first();
        if (!empty($urutx->Pertemuan)){
            $urut = $urutx->Pertemuan + 1;  
        }else{
            $urut = 1;  
        }
        $myabsensi  = new Absensi_model();
        $absen= $myabsensi->absensi_simpan_view($JadwalID);        
        $data = array(  'title' => 'ABSENSI KULIAH',
        'absen'          => $absen,
        'jdwl'          => $jdwl,
        'pertemuan'     => $pertemuan,
        'dosen'         => $dosen,
        'matakuliah'    => $matakuliah,
        'urut'          => $urut,
        'content'       => 'admin/absensi/create_absensi'
         );
        return view('admin/layout/wrapper',$data);
    }

    public function viewpresensi_edit($PresensiID, $JadwalID){
        
       
        $myabsensi  = new Absensi_model();
        $presensiedit= $myabsensi->view_absensi_edit($PresensiID);

        $pertemuan  = \DB::table('presensi')->select('PresensiID','Pertemuan')->where('PresensiID',$PresensiID)->first();
        $jdwl       = \DB::table('jadwal')->select('JadwalID','DosenID','MKID','TahunID','NamaKelas')->where('JadwalID',$JadwalID)->first();
        $dosen      = \DB::table('dosen')->select('Login','Nama')->where('Login',$jdwl->DosenID)->first();
        $matakuliah = \DB::table('mk')->select('MKID','Nama')->where('MKID',$jdwl->MKID)->first();
        $PresensiID = \DB::table('presensi')->select('PresensiID')->where('PresensiID',$PresensiID)->first();
        $stat       = \DB::table('jenispresensi')->get();
        //dd($PresensiID->PresensiID);
                            
        //return view('absensi.listpresensi_edit',$data);
        $data = array(  'title' => 'ABSENSI KULIAH',
        'presensiedit'  => $presensiedit,
        'jdwl'          => $jdwl,
        'pertemuan'     => $pertemuan,
        'dosen'         => $dosen,
        'matakuliah'    => $matakuliah,
        'stat'          => $stat,
        'PresensiID'    => $PresensiID,
        'content'       => 'admin/absensi/listpresensi_edit'
         );
        return view('admin/layout/wrapper',$data);
    }

    public function createpertemuan(Request $request){
    
    DB::table('presensi')->insert([    
       'Pertemuan'     => $request->Pertemuan,
       'JadwalID'      => $request->JadwalID,
       'TahunID'       => $request->TahunID,
       'DosenID'       => $request->DosenID,
       'Tanggal'       => date('Y-m-d',strtotime($request->Tanggal)),
       'JamMulai'      => $request->JamMulai,
       'JamSelesai'    => $request->JamSelesai,
       'LoginBuat'     => Session()->get('id_user'),
       'TanggalBuat'   => date('Y-m-d H:i:s')
       ]);
       
       $data = array(  'title' => 'ABSENSI KULIAH',
       'Pertemuan'      => $request->Pertemuan,
       'JadwalID'       => $request->JadwalID,
       'TahunID'        => $request->TahunID,
       'DosenID'        => $request->DosenID,
       'Tanggal'        => $request->Tanggal,
       'JamMulai'       => $request->JamMulai,
       'JamSelesai'     => $request->JamSelesai,
       'LoginBuat'      => Session()->get('id_user'),
       'TanggalBuat'    => date('Y-m-d H:i:s'),
       'content'        => 'admin/absensi/create_absensi'
        );
       return redirect ('admin/absensi/createabsensi/'.$request->JadwalID);     
    }    

    public function simpaneditpresensi(Request $request){
        
        //return 'abc';
         $MhswID            = $request->MhswID;
         $JadwalID          = $request->JadwalID;
         $PresensiID        = $request->PresensiID;
         $KRSID             = $request->KRSID;
         $JenisPresensiID   = $request->JenisPresensiID;

        foreach($MhswID as $key => $no)
        {       
            if ($JenisPresensiID[$key]=='H'){
                $Nilai[$key] =1;
            }
            elseif ($JenisPresensiID[$key]=='I'){
                $Nilai[$key] =1;
            }
            elseif ($JenisPresensiID[$key]=='S'){
                $Nilai[$key] =1;
            }
            else{
                $Nilai[$key] =0;
            }   
            $datax['MhswID'] = $no;            
            $datax['JadwalID'] = $JadwalID[$key];
            $datax['KRSID'] = $KRSID[$key];
            $datax['PresensiID'] = $PresensiID[$key];
            $datax['Nilai'] = $Nilai[$key];
            $datax['JenisPresensiID'] = $JenisPresensiID[$key];
           
            \DB::table('presensimhsw')
            ->where('PresensiID',$PresensiID[$key])
            ->where('MhswID',$datax['MhswID'])
            ->update($datax); 
            
            //untuk update nilai tabel yang sudah ada
            //bisa menggunakan model namun field fillable model penilaian harus terisi
            //Penilaian::create($datax); 
        }    
        //ambil satu nilai JadwalID agar tidak dilooping untuk nilai redirect
        $jdwl = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        $pres = \DB::table('presensi')->where('PresensiID',$PresensiID)->first();
        
        //dd($jdwl->JadwalID);
        //return redirect ('admin/absensi/viewpresensi_edit/'.$pres->PresensiID.'/'.$jdwl->JadwalID);
        return redirect ('admin/absensi/createabsensi/'.$jdwl->JadwalID);
    }

    public function edit_tanggalabsensi($PresensiID){
        
 
        $dtpresensi = \DB::table('presensi')->where('PresensiID',$PresensiID)->first();
        $dtjdwl = \DB::table('jadwal')->where('JadwalID',$dtpresensi->JadwalID)->first();
        $dsn = \DB::table('dosen')->where('Login',$dtjdwl->DosenID)->first();
                            
        $data = array(  'title' => 'EDIT PRESENSI '.$dsn->Nama.', '.$dsn->Gelar,
        'dtpresensi'   => $dtpresensi,
        'content'       => 'admin/absensi/edit_tanggal_absensi'
         );
        return view('admin/layout/wrapper',$data);
    }

    public function simpatedittglabsensi(Request $request){
    	
            
           request()->validate([
					       'Pertemuan' => 'required',
                           'Tanggal'    => 'required',
                            ]);
            $jdwl  = \DB::table('presensi')->where('PresensiID',$request->id)->first();               
            DB::table('presensi')->where('PresensiID',$request->id)->update([
                'Pertemuan'  => $request->Pertemuan,
                'Tanggal'    => date('Y-m-d', strtotime($request->Tanggal)),
                'JamMulai'   => $request->JamMulai,
                'JamSelesai' => $request->JamSelesai,
                'Catatan'    => $request->Catatan,
            ]);
        return redirect('admin/absensi/createabsensi/'.$jdwl->JadwalID);
    }

    public function delete($PresensiID,$JadwalID)
    {
        
        DB::table('presensi')->where('PresensiID',$PresensiID)->delete();
        return redirect('admin/absensi/createabsensi/'.$JadwalID);//->with(['sukses' => 'Data telah dihapus'])
    }

    public function cetakabsensihsl($JadwalID)
    {
        
        $myjadwal = new Jadwal_model();
        $jadwal   = $myjadwal->jadwal_detail($JadwalID);
              
        $site      = DB::table('identitas')->first(); 
        $data = array(  'title'     => 'Absensi '.$jadwal->JadwalID.' Dosen '.$jadwal->NamaDosen,
                        'jadwal' => $jadwal,              
                        'site'      => $site
                    );
            
        $config = [ 'format' => 'A4-L', // Landscape
                    'margin_top' => 25
                    
                ];
        $pdf = PDF::loadview('admin/absensi/print-absensihsl',$data,[],$config);
        ob_get_clean();
        $nama_file = 'Absensi '.$jadwal->JadwalID.' Nama '.$jadwal->NamaDosen.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetak_formnilai($JadwalID) {
                 
            $myjadwal = new Jadwal_model();
            $jadwal   = $myjadwal->jadwal_detail($JadwalID); 

            $mykrs = new Krs_model();
            $krs   = $mykrs->nilai_kelas($JadwalID);  
        
            // $data['jdw'] 		= DB::table('jadwal', "JadwalID='$JadwalID'")->first();           
            // $data['dosen'] 		= DB::table('dosen', "Login='".$data['jdw']->DosenID."'")->first();
            // $data['ruang'] 		= DB::table('ruang', "RuangID='".$data['jdw']->RuangID."'")->first();
            // $data['mk'] 		= DB::table('mk', "MKID='".$data['jdw']->MKID."'")->first();
            // $data['prodi'] 		= DB::table('prodi', "ProdiID='".$data['mk']->ProdiID."'")->first();
            // $data['hari'] 		= DB::table('hari', "HariID='".$data['jdw']->HariID."'")->first();
            
            $data = array(  'title'     => 'Cetak Nilai '.$jadwal->JadwalID.' Dosen '.$jadwal->NamaDosen,
                    'jdw'       => $jadwal,  
                    'judul_web' => 'Cetak Form Nilai Kuliah',           
                    'krs'       => $krs
            );
            return view('admin/absensi/cetak_formnilai', $data);
        }     
}
