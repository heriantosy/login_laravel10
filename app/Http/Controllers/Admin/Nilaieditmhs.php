<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use PDF;

class Nilaieditmhs extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;

        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh  = $prodix->ProdiID;
        
        $mhsx    = DB::table('mhsw')->orderBy('MhswID','DESC')->limit(1)->first(); 
        $MhswIDplh  = $mhsx->MhswID;
        $datamhs = \DB::table('mhsw')
        ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
        ->where('mhsw.MhswID',$MhswIDplh)
        ->first();

        //untuk ditampilkan sebagai detail
        $krs = \DB::table('krs')
        ->select('krs.*','mk.Nama as NamaMK','mk.SKS')
        ->join('mk','mk.MKID','=','krs.MKID')
        ->where('krs.TahunID',$tahunplh)
        ->where('krs.MhswID',$MhswIDplh)
        ->orderBy('krs.TahunID','DESC')
        ->get();
        
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
		$data = array(  'title'    => 'Edit Matakuliah Mahasiswa',
                        'krs'      => $krs,
                        'datamhs'  => $datamhs,
                        'tahun'    => $tahun,
                        'tahunplh' => $tahunplh,
                        'MhswIDplh' => $MhswIDplh,
                      
                        'content'     => 'admin/nilaieditmhs/index'
                    );
        return view('admin/layout/wrapper',$data);
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
                return redirect('admin/nilaieditmhs/filter/'.$request->tahun.'/'.$request->MhswID);
            }
        }
    }

    public function filter($tahun,$MhswID) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $MhswIDx      = $MhswID;
       
        $krs = \DB::table('krs')
        ->select('krs.*','mk.Nama as NamaMK','mk.SKS')
        ->join('mk','mk.MKID','=','krs.MKID')
        ->where('krs.TahunID',$tahunx)
        ->where('krs.MhswID',$MhswIDx)
        ->orderBy('krs.TahunID','DESC')
        ->get(); //->whereBetween('jadwal.TglBuat', [$tgl_mulai, $tgl_selesai])
    
        //untuk menampilkan kembali pada combo
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDx)->where('TahunID',$tahunx)->sum('SKS'); 
        $mhs        = DB::table('mhsw')->where('MhswID',$MhswIDx)->first(); 
        //dd($totsks);
        $data = array(  'title'     => ''.$MhswIDx. ' - '.$mhs->Nama.' ('.$mhs->ProgramID.' - '.$mhs->ProdiID.')',
                        'krs'       => $krs,
                        'tahun'     => $tahun,
                        'MhswID'    => $MhswID,
                        'tahunplh'  => $tahunx,
                        'MhswIDplh' => $MhswIDx,
                        'totsks'    => $totsks,
                        'content'   => 'admin/nilaieditmhs/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit($krsidx,$MhswIDx)
    {
        
        $krs = DB::table('krs')->where('KRSID',$krsidx)->where('MhswID',$MhswIDx)->first();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $mhs        = DB::table('mhsw')->where('MhswID',$MhswIDx)->first(); 
        $matakuliah = DB::table('mk')->where('ProdiID',$mhs->ProdiID)->orderBy('Sesi','ASC')->get();
        
        $data = array(  'title'     => ''.$MhswIDx. ' - '.$mhs->Nama.' ('.$mhs->ProgramID.' - '.$mhs->ProdiID.')',
                        'krs'       => $krs,
                        'tahun'     => $tahun,
                        'tahunplh'  => $krs->TahunID,
                        'MhswID'    => $MhswIDx,
                        'matakuliah'=> $matakuliah,
                        'MhswIDplh' => $MhswIDx,
                        'content'   => 'admin/nilaieditmhs/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
        
        request()->validate([
                'MKID' => 'required',
                'NilaiAkhir'  => 'required',
                ]);

        $uas    = $request->NilaiAkhir;
        $nilai  = $request->NilaiAkhir;
        if ($nilai >= 85 AND $nilai <= 100){
            $huruf = "A";
            $bobot = "4";
        }
        elseif ($nilai >= 80 AND $nilai <= 84.99){
            $huruf = "A-";
            $bobot = "3.70";
        }
        elseif ($nilai >= 75 AND $nilai <= 79.99){
            $huruf = "B+";
            $bobot = "3.30";
        }
        elseif ($nilai >= 70 AND $nilai <= 74.99){
            $huruf = "B";
            $bobot = "3";
        }
        elseif ($nilai >= 65 AND $nilai <= 69.99){
            $huruf = "B-";
            $bobot = "2.70";
        }
        elseif ($nilai >= 60 AND $nilai <= 64.99){
            $huruf = "C+";
            $bobot = "2.30";
        }
        elseif ($nilai >= 55 AND $nilai <= 59.99){
            $huruf = "C";
            $bobot = "2";
        }
        elseif ($nilai >= 50 AND $nilai <= 54.99){
            $huruf = "C-";
            $bobot = "1.70";
        }
        elseif ($nilai >= 40 AND $nilai <= 49.99){
            $huruf = "D";
            $bobot = "1";
        }
        elseif ($nilai < 40){
            $huruf = "E";
            $bobot = "0";
        }
        DB::table('krs')->where('KRSID',$request->KRSID)->update([ 
            'UAS'           => $request->NilaiAkhir,
            'NilaiAkhir'    => $request->NilaiAkhir,
            'GradeNilai'    => $huruf,
            'BobotNilai'    => $bobot,
            'LoginEdit'     => Session()->get('username'),
            'TanggalEdit'   => date('Y-m-d H:i:s')
        ]);

        DB::table('koreksinilai')->insert([ 
            'Tanggal'    => date('Y-m-d'),
            'TahunID'    => $request->TahunID,
            'KRSID'      => $request->KRSID,
            'MhswID'     => $request->MhswID,
            'MKID'       => $request->MKID,
            'GradeLama'  => $request->GradeLama,
            'GradeNilai' => $huruf,
            'LoginBuat'  => Session()->get('username'),
            'TglBuat'   => date('Y-m-d H:i:s')
        ]);
       
        return redirect('admin/nilaieditmhs/filter/'.$request->TahunID.'/'.$request->MhswID)->with(['sukses' => 'Data telah diedit']);
    }


    public function tambah($tahunx, $MhswIDx)
    {
                 
       // $krs = DB::table('krs')->where('KRSID',$krsidx)->where('MhswID',$MhswIDx)->first();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $mhs        = DB::table('mhsw')->where('MhswID',$MhswIDx)->first(); 
        $matakuliah = DB::table('mk')->where('ProdiID',$mhs->ProdiID)->orderBy('Sesi','ASC')->get();
        
        $data = array(  'title'     => ''.$MhswIDx. ' - '.$mhs->Nama.' ('.$mhs->ProgramID.' - '.$mhs->ProdiID.')',
                        //'krs'       => $krs,
                        'tahun'     => $tahun,
                        'tahunplh'  => $tahunx,
                        'MhswID'    => $MhswIDx,
                        'matakuliah'=> $matakuliah,
                        'MhswIDplh' => $MhswIDx,
                        'content'   => 'admin/nilaieditmhs/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
    	
    	request()->validate([
            'MKID' => 'required',
            'NilaiAkhir'  => 'required',
        ]);
        $mk = DB::table('mk')->where('MKID',$request->MKID)->first();
        //dd($mk->SKS);
        $uas    = $request->NilaiAkhir;
        $nilai  = $request->NilaiAkhir;
        if ($nilai >= 85 AND $nilai <= 100){
            $huruf = "A";
            $bobot = "4";
        }
        elseif ($nilai >= 80 AND $nilai <= 84.99){
            $huruf = "A-";
            $bobot = "3.70";
        }
        elseif ($nilai >= 75 AND $nilai <= 79.99){
            $huruf = "B+";
            $bobot = "3.30";
        }
        elseif ($nilai >= 70 AND $nilai <= 74.99){
            $huruf = "B";
            $bobot = "3";
        }
        elseif ($nilai >= 65 AND $nilai <= 69.99){
            $huruf = "B-";
            $bobot = "2.70";
        }
        elseif ($nilai >= 60 AND $nilai <= 64.99){
            $huruf = "C+";
            $bobot = "2.30";
        }
        elseif ($nilai >= 55 AND $nilai <= 59.99){
            $huruf = "C";
            $bobot = "2";
        }
        elseif ($nilai >= 50 AND $nilai <= 54.99){
            $huruf = "C-";
            $bobot = "1.70";
        }
        elseif ($nilai >= 40 AND $nilai <= 49.99){
            $huruf = "D";
            $bobot = "1";
        }
        elseif ($nilai < 40){
            $huruf = "E";
            $bobot = "0";
        }

        DB::table('krs')->insert([
            'MhswID'        => $request->MhswID,
            'TahunID'       => $request->TahunID,
            'MKID'          => $request->MKID,
            'MKKode'        => $mk->MKKode,
            'SKS'           => $mk->SKS,          
            'UAS'           => $request->NilaiAkhir,
            'NilaiAkhir'    => $request->NilaiAkhir,
            'GradeNilai'    => $huruf,
            'BobotNilai'    => $bobot,
            'LoginBuat'     => Session()->get('username'),
            'TanggalBuat'   => date('Y-m-d H:i:s')
        ]);
        
        return redirect('admin/nilaieditmhs/filter/'.$request->TahunID.'/'.$request->MhswID)->with(['sukses' => 'Data telah ditambah']);
    }
    
}
