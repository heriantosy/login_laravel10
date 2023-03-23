<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Krs_model;
use App\Models\Mahasiswa_model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Image;
use PDF;

class Krsadm extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;
        try{
            $mhsx = DB::table('mhsw')->select('MhswID','ProdiID')->orderBy('MhswID','DESC')->limit(1)->first(); 
                if($mhsx->MhswID != '101'){
                    $MhswIDplh = '19311012';
                    $prodiplh = '311';
                }else{
                    $MhswIDplh = $mhsx->MhswID;
                    $prodiplh = $mhsx->ProdiID;
                }
            }catch(Exception $e){
                $MhswIDplh = 'Inputkan NPM';
            }
        $datamhs = Mahasiswa_model::select('MhswID','Nama','ProgramID','ProdiID')->where('MhswID', $MhswIDplh)->first();
        $prd     = DB::table('prodi')->select('ProdiID','Nama','Pejabat','Gelar', 'FakultasID')->where('ProdiID', $prodiplh )->first();
    
        $mykrs      = new Krs_model();
        $krs        = $mykrs->krs_detail_more($tahunplh, $MhswIDplh);
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');
        //dd($totsks);
        
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
		$data = array(  'title'     => 'Kartu Rencana Studi (KRS)',
                        'krs'       => $krs,
                        'mhs'       => $datamhs,
                        'prd'       => $prd,
                        'tahun'     => $tahun,
                        'totsks'    => $totsks,
                        'tahunplh'  => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,        
                        'content'   => 'admin/krsadm/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['ambil'])) {
            //dd('OK');
            $id_jadwalnya       = $request->JadwalID;
            $SKS                = $request->SKS;
            $MKID               = $request->MKID;
            $MKKode             = $request->MKKode;
            for($i=0; $i < sizeof($id_jadwalnya);$i++) {
                //DB::table('jadwal')->where('JadwalID',$id_jadwalnya[$i])->delete();
                $jad = DB::table('krs')->where('JadwalID',$id_jadwalnya[$i])->first();
                // left outer join hari h on j.HariID=h.HariID",
                // 'j.JadwalID', $jdwl[$i],
                // "j.*, h.Nama as HR");
                DB::table('krs')->insert([
                    'KHSID'         => $request->khsid,
                    'MhswID'        => $request->MhswID,
                    'TahunID'       => $request->tahun,
                    'JadwalID'      => $id_jadwalnya[$i],
                    'SKS'           => $SKS[$i],
                    'MKID'          => $MKID[$i],
                    'MKKode'        => $MKKode[$i],
                    'LoginBuat'     => Session()->get('username'),
                    'TanggalBuat'   => date('Y-m-d')
                ]);
            }
            return redirect('admin/krsadm/filter/'.$request->tahun.'/'.$request->MhswID);

        // PROSES SETTING DRAFT
        }
        elseif(isset($_POST['filter'])) {
            if($request->tahun=='' || $request->MhswID==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/krsadm/filter/'.$request->tahun.'/'.$request->MhswID);
            }

        }
    }

    // Main page
    public function filter($tahun,$MhswID) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
          
        $tahunplh    =$tahun;
        $MhswIDplh   =$MhswID;
        // $datamhs = \DB::table('mhsw')
        // ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID','mhsw.Handphone')
        // ->where('mhsw.MhswID',$MhswIDplh)
        // ->first();

        $datamhs = Mahasiswa_model::select('MhswID','Nama','ProgramID','ProdiID')->where('MhswID', $MhswIDplh)->first();
        $prd     = DB::table('prodi')->select('ProdiID','Nama','Pejabat','Gelar', 'FakultasID')->where('ProdiID', $datamhs->ProdiID )->first();
    
        //untuk ditampilkan sebagai detail
        $mykrs      = new Krs_model();
        $krs        = $mykrs->krs_detail_more($tahunplh, $MhswIDplh);
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');    
        $tahun      = DB::table('tahun')->select('TahunID')->distinct()->orderBy('TahunID','DESC')->get();
        $data = array(  'title'    => 'Data Rencana Studi',                       
                        'krs'      => $krs,
                        'prd'      => $prd,
                        'totsks'   => $totsks,
                        'mhs'      => $datamhs,
                        'tahun'    => $tahun,
                        'tahunplh' => $tahunplh,
                        'MhswIDplh'=> $MhswIDplh,
                        'content'  => 'admin/krsadm/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah($tahun,$MhswID)
    {
        $mhs = \DB::table('mhsw')
        ->select('mhsw.MhswID','mhsw.ProdiID','mhsw.ProgramID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.Handphone',
        'prodi.Nama as NamaProdi')
        ->join('prodi', 'prodi.ProdiID','=','mhsw.ProdiID')
        ->where('MhswID',$MhswID)->first();
        $tahunplh   = $tahun;
        $prodiplh   = $mhs->ProdiID;
        $site       = DB::table('identitas')->first();
        $mykrs_jdwl = new Krs_model();
        $jadwal = $mykrs_jdwl->jadwal_krs_ambil($tahunplh, $prodiplh);
        $khsid  = \DB::table('khs')->where('MhswID',$MhswID)->where('TahunID',$tahun)->first();        
        $data   = array(  'title'    =>'Pengisian KRS',
                        'jadwal'   => $jadwal,
                        'khsid'    => $khsid->KHSID,
                        'MhswID'   => $MhswID,
                        'mhs'      => $mhs,
                        'tahunplh' => $tahunplh,
                        'prodiplh' => $prodiplh,
                        'site'     => $site,
                        'content'  => 'admin/krsadm/tambah'
                        );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses($JadwalID,$MhswID)
    {
        
        //ambil semua data jadwal, gunakan first untuk mengambil 1 row

        $jdwl   = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        $mk     = \DB::table('mk')->where('MKID',$jdwl->MKID)->first();
        $khsid  = \DB::table('khs')->where('MhswID',$MhswID)->where('TahunID',$jdwl->TahunID)->first();

        //cek matakuliah sudah diambil?
        $cek    = \DB::table('krs')->where('MhswID',$MhswID)->where('MKID',$jdwl->MKID)->where('TahunID',$jdwl->TahunID)->count();
        $totkrssmt = \DB::table('krs')->where('MhswID',$MhswID)->where('TahunID',$jdwl->TahunID)->sum('SKS');
        $sksambil = $mk->SKS;
        $totkrssmtx = $totkrssmt + $sksambil;
        //dd($khsid->MaxSKS);

        if ($cek >= 1){
            return redirect('admin/krsadm/filter/'.$jdwl->TahunID.'/'.$MhswID)->with(['warning' => 'Matakuliah sudah diambil untuk semester ini']);
        }

        $MaxSKS =$khsid->MaxSKS;
        if ($totkrssmtx > $MaxSKS){
            //dd($khsid->MaxSKS);
           return redirect('admin/krsadm/filter/'.$jdwl->TahunID.'/'.$MhswID)->with(['warning' => 'Total SKS sudah melebihi Max SKS yang harus diambil']);
        }else{    
            DB::table('krs')->insert([
                'LoginBuat'     => Session()->get('id_user'),
                'TanggalBuat'   => date('Y-m-d H:i:s'),
                'KHSID'         => $khsid->KHSID,
                'JadwalID'      => $JadwalID,
                'TahunID'       => $jdwl->TahunID,
                'MKID'          => $jdwl->MKID,
                'MKKode'        => $mk->MKKode,
                'SKS'           => $jdwl->SKS,
                'MhswID'        => $MhswID
            ]);
            return redirect('admin/krsadm/filter/'.$jdwl->TahunID.'/'.$MhswID);
        }
       
        //return redirect('admin/krsadm')->with(['sukses' => 'Data telah ditambah']);
    }

   
    public function cetak_krs($khsid)
    {
        
        
        
        // $khsid    = Crypt::decryptString($khsidx);
        $khsidx     = \DB::table('khs')->where('khs.KHSID',$khsid)->first();
        // dd($khsidx->MhswID);

        // $datamhs     = \DB::table('mhsw')
        // ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
        // ->where('mhsw.MhswID',$khsidx->MhswID)
        // ->first();

        // $krs = \DB::table('krs')
        // ->select('krs.*','mk.Nama as NamaMK','mk.SKS','mk.Sesi','jadwal.NamaKelas','dosen.Nama as NamaDosen')
        // ->join('jadwal','jadwal.JadwalID','=','krs.JadwalID')
        // ->join('dosen','dosen.Login','=','jadwal.DosenID')
        // ->join('mk','mk.MKID','=','krs.MKID')
        // ->where('krs.TahunID',$khsidx->TahunID)
        // ->where('krs.MhswID',$khsidx->MhswID)
        // ->orderBy('krs.MKID','ASC')
        // ->get();                  
        $datamhs = Mahasiswa_model::select('MhswID','Nama','ProgramID','ProdiID')->where('MhswID', $khsidx->MhswID)->first();
        $prd     = DB::table('prodi')->select('ProdiID','Nama','Pejabat','Gelar', 'FakultasID')->where('ProdiID', $datamhs->ProdiID )->first();
    
        //untuk ditampilkan sebagai detail
        $mykrs      = new Krs_model();
        $krs        = $mykrs->krs_detail_more($khsidx->TahunID, $khsidx->MhswID);

        $site    = DB::table('identitas')->first();
        $prodi  = DB::table('prodi')->where('ProdiID', $khsidx->ProdiID)->first();
        //$totsks  = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');   
        $data = array(  'title'     => 'Cetak KRS',
                        'mheader'   => $datamhs,
                        'khsidx'    => $khsidx,  
                        'krs'       => $krs,  
                        'tahunplh'  => $khsidx->TahunID,
                        'MhswIDplh' => $khsidx->MhswID,            
                        'site'      => $site,
                        'prodi'     => $prodi,
                        'khsid'     => $khsid,
                        'judul_web' => 'KHS'
                    );
        return view('admin/krsadm/cetak_krs',$data);
    }

    public function delete($KRSID,$tahun,$MhswID)
    {
        
        DB::table('krs')->where('KRSID',$KRSID)->delete();
        return redirect('admin/krsadm/filter/'.$tahun.'/'.$MhswID);
    }
}
