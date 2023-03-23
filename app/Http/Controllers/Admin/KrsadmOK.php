<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use PDF;

class Krsadm extends Controller
{
    public function index()
    {
    	
        //baca tahun aktif
        $tahunaktif = \DB::table('tahun')->where('NA','N')->where('ProdiID','SI')->where('ProgramID','REG A')->first();
        //dd($tahunaktif->TahunID);

        $tahunplh    =$tahunaktif->TahunID;
        $MhswIDplh   ="17071001";
        $datamhs = \DB::table('mhsw')
        ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID','mhsw.Handphone')
        ->where('mhsw.MhswID',$MhswIDplh)
        ->first();

        //untuk ditampilkan sebagai detail
        $krs = \DB::table('krs')
        ->select('krs.*','mk.Nama as NamaMK','mk.SKS','jadwal.JamMulai','jadwal.JamSelesai',
        'hari.Nama as NamaHari','ruang.RuangID','jadwal.NamaKelas','jadwal.SKS','dosen.Nama as NamaDosen','dosen.Gelar')
        ->join('jadwal','jadwal.JadwalID','=','krs.JadwalID')
        ->join('mk','mk.MKID','=','jadwal.MKID')
        ->join('dosen','dosen.Login','=','jadwal.DosenID')
        ->join('hari','hari.HariID','=','jadwal.HariID')
        ->join('ruang','ruang.RuangID','=','jadwal.RuangID')
        ->where('jadwal.TahunID',$tahunplh)
        ->where('krs.MhswID',$MhswIDplh)
        ->orderBy('jadwal.HariID','ASC')
        ->orderBy('jadwal.JamMulai','ASC')
        ->get();


        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');
        //dd($totsks);
        
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
		$data = array(  'title'     => 'Kartu Rencana Studi (KRS)',
                        'krs'       => $krs,
                        'mhs'       => $datamhs,
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
        if(isset($_POST['filter'])) {
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
        $datamhs = \DB::table('mhsw')
        ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID','mhsw.Handphone')
        ->where('mhsw.MhswID',$MhswIDplh)
        ->first();

        //untuk ditampilkan sebagai detail
        $krs = \DB::table('krs')
        ->select('krs.*','mk.Nama as NamaMK','mk.SKS','jadwal.JamMulai','jadwal.JamSelesai',
        'hari.Nama as NamaHari','ruang.RuangID','jadwal.NamaKelas','jadwal.SKS','dosen.Nama as NamaDosen','dosen.Gelar')
        ->join('jadwal','jadwal.JadwalID','=','krs.JadwalID')
        ->join('mk','mk.MKID','=','jadwal.MKID')
        ->join('dosen','dosen.Login','=','jadwal.DosenID')
        ->join('hari','hari.HariID','=','jadwal.HariID')
        ->join('ruang','ruang.RuangID','=','jadwal.RuangID')
        ->where('jadwal.TahunID',$tahunplh)
        ->where('krs.MhswID',$MhswIDplh)
        ->orderBy('jadwal.HariID','ASC')
        ->orderBy('jadwal.JamMulai','ASC')
        ->get();
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->where('TahunID',$tahunplh)->sum('SKS');    
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $data = array(  'title'    => 'Data Rencana Studi',                       
                        'krs'      => $krs,
                        'totsks'   => $totsks,
                        'mhs'       => $datamhs,
                        'tahun'    => $tahun,
                        'tahunplh' => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,
                        'content'   => 'admin/krsadm/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah($tahun,$MhswID)
    {
        $mhs = \DB::table('mhsw')->where('MhswID',$MhswID)->first();
        $tahunplh  =$tahun;
        $prodiplh  ='.'.$mhs->ProdiID.'.';
        $site      = DB::table('identitas')->first();
       
        $jadwal = DB::table('jadwal')
                ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
                ->join('mk', 'mk.MKID', '=', 'jadwal.MKID','LEFT')
                ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
                ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
                ->where('jadwal.TahunID',$tahunplh)
                ->where('jadwal.ProdiID',$prodiplh)
                ->first();
        $data = array(  'title'    => 'Jadwal Kuliah',
                        'jadwal'   => $jadwal,
                        'MhswID'   => $MhswID,
                        'mhs'       => $mhs,
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

   

    // Delete
    public function delete($KRSID,$tahun,$MhswID)
    {
        
        DB::table('krs')->where('KRSID',$KRSID)->delete();
        return redirect('admin/krsadm/filter/'.$tahun.'/'.$MhswID);
    }
}
