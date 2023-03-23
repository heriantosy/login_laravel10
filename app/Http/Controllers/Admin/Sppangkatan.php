<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use PDF;

class Sppangkatan extends Controller
{
    public function index()
    {
    	
        //$tahunaktif = \DB::table('tahun')->where('NA','N')->where('ProdiID','SI')->where('ProgramID','REG A')->first();
        $tahunaktif = \DB::table('tahun')->where('NA','N')->orderBy('TahunID','DESC')->first();
        $tahunplh   = $tahunaktif->TahunID;
        $prodiplh   = "SI";
       
                   
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();
		$data = array(  'title'       => 'DATA PEMBAYARAN SPP',
                      
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunplh,
                        'prodiplh'  => $prodiplh,
                        'hari'      => $hari,                     
                        'matakuliah'=> $matakuliah,
                        'ruang'     => $ruang,
                        'dosen'     => $dosen,
                       
                        'content'   =>'admin/sppangkatan/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if( $request->prodi==''|| $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/sppangkatan/filter/'.$request->tahun.'/'.$request->prodi);
            }
        }
    }

    // Main page
    public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        // $tgl_mulai          = date('Y-m-d',strtotime($mulai));
        // $tgl_selesai        = date('Y-m-d',strtotime($selesai));
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        //untuk menampilkan kembali pada combo
        $tahun      = DB::table('tahun')->where('ProdiID','SI')->where('ProgramID','REG A')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Noreg','DESC')->get();
        
        $data = array(  'title'      => 'Data Tahun: '.$tahunx.' Program Studi: '.$prodix,
                      
                        'dosen'     => $dosen,
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,
                        'content'   => 'admin/sppangkatan/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

  
      public function detail($JadwalID)
      {
          
          
          $jadwal = DB::table('jadwal')
          ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
          ->join('mk', 'mk.MKID', '=', 'jadwal.MKID')
          ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
          ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'mk.SKS','hari.Nama as NamaHari')
          ->where('jadwal.JadwalID',$JadwalID)
          ->first();          
          
          $krs = DB::table('krs')
          ->join('mhsw','mhsw.MhswID','=','krs.MhswID')
          ->select('krs.JadwalID','krs.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.Handphone')
          ->where('krs.JadwalID',$JadwalID)
          ->orderBy('krs.MhswID','ASC')
          ->get();
          $site     = DB::table('identitas')->first();
          $prodix   = str_replace('.','',$jadwal->ProdiID);
          $prodi    = DB::table('prodi')->where('ProdiID',$prodix)->first();
          $data = array(  'title'     => ''.$jadwal->NamaDosen.', '.$jadwal->Gelar.' - Matakuliah: '.$jadwal->NamaMK.' - ThnAkademik: '.$jadwal->TahunID,
                          'jadwal'    => $jadwal,
                          'krs'       => $krs,
                          'site'      => $site,
                          'prodi'      => $prodi,
                          'content'   => 'admin/jadwal/detail'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function nilaidosen($JadwalID)
      {
          
          
          $jadwal = DB::table('jadwal')
          ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
          ->join('mk', 'mk.MKID', '=', 'jadwal.MKID')
          ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
          ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'mk.SKS','hari.Nama as NamaHari')
          ->where('jadwal.JadwalID',$JadwalID)
          ->first();          
          
          $krs = DB::table('krs')
          ->join('mhsw','mhsw.MhswID','=','krs.MhswID')
          ->select('krs.JadwalID','krs.MhswID','krs.Tugas1','krs.Tugas2','krs.Tugas3','krs.Tugas4','krs.Tugas5',
          'krs.Presensi','krs.UTS','krs.UAS','krs.NilaiAkhir','krs.GradeNilai',
          'mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.Handphone')
          ->where('krs.JadwalID',$JadwalID)
          ->orderBy('krs.MhswID','ASC')
          ->get();
          $site      = DB::table('identitas')->first();
  
          $data = array(  'title'     => ''.$jadwal->NamaDosen.', '.$jadwal->Gelar.' - Matakuliah: '.$jadwal->NamaMK.' - ThnAkademik: '.$jadwal->TahunID,
                          'jadwal'    => $jadwal,
                          'krs'       => $krs,
                          'site'      => $site,
                          'content'   => 'admin/jadwal/nilaidosen'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function simpannilaidosen(Request $request){ 
        $MhswID= $request->MhswID;
        $JadwalID= $request->JadwalID;
        //dd($MhswID);
        $Tugas1= $request->Tugas1;
        $Tugas2= $request->Tugas2;
        $Tugas3= $request->Tugas3;
        $Presensi= $request->Presensi;
        $UTS= $request->UTS;
        $UAS= $request->UAS;

        foreach($MhswID as $key => $no)
        {          
            $datax['MhswID'] = $no;
            $datax['Tugas1'] = $Tugas1[$key];
            $datax['Tugas2'] = $Tugas2[$key];
            $datax['Tugas3'] = $Tugas3[$key]; 
            $datax['Presensi'] = $Presensi[$key]; 
            $datax['UTS']    = $UTS[$key]; 
            $datax['UAS']    = $UAS[$key];            
            //\DB::table('krsnilai')->insert($datax); //untuk insert ke table baru
            \DB::table('krs')
            ->where('JadwalID',$JadwalID[$key])
            ->where('MhswID',$datax['MhswID'])
            ->update($datax); //untuk update nilai tabel yang sudah ada
            //bisa menggunakan model namun field fillable model penilaian harus terisi
            //Penilaian::create($datax); 
        }
        
        //ambil JadwalID untuk mengembalikan nilai JadwalID agar bisa diredirect
        $dt = \DB::table('jadwal')->where('JadwalID',$JadwalID)->first();
        $jdw= $dt->JadwalID;
        ///filter/'.$JadwalID.'/'.$MhswID
        return redirect('admin/jadwal/nilaidosen/'.$dt->JadwalID);
    }

  
      // cetak page
      public function cetak($JadwalID)
      {
          
          $jadwal = DB::table('jadwal')
                    ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
                    ->join('mk', 'mk.MKID', '=', 'jadwal.MKID')
                    ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
                    ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
                    ->where('jadwal.JadwalID',$JadwalID)
                    ->first();                    
          $site      = DB::table('identitas')->first();
  
          //dd($site->namaweb);  
          $data = array(  'title'     => 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen,
                          'jadwal' => $jadwal,              
                          'site'      => $site
                      );
               
          $config = [ 'format' => 'A4-L', // Landscape
                      'margin_top' => 25
                      
                    ];
          $pdf = PDF::loadview('admin/jadwal/cetak',$data,[],$config);
          // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
          $nama_file = 'Order Nomor '.$jadwal->JadwalID.' atas nama '.$jadwal->NamaDosen.'.pdf';
          return $pdf->stream($nama_file, 'I');
      }


    // Tambah
    public function tambah()
    {
        
        // $myproduk          = new Produk_model();
        // $produk             = $myproduk->semua();
        $tahun    = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();
        $data = array(  'title'     => 'Tambah Jadwal',                       
                        'tahun'    => $tahun,
                        'prodi'    => $prodi,
                        'hari'    => $hari,                     
                        'matakuliah'  => $matakuliah,
                        'ruang'    => $ruang,
                        'dosen'    => $dosen,
                        'content'   => 'admin/jadwal/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($JadwalID)
    {
        
        $jadwal = DB::table('jadwal')
        ->join('dosen', 'dosen.Login', '=', 'jadwal.DosenID')
        ->join('mk', 'mk.MKID', '=', 'jadwal.MKID','LEFT')
        ->join('hari', 'hari.HariID', '=', 'jadwal.HariID')
        ->select('jadwal.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
        ->where('Jadwal.JadwalID',$JadwalID)
        ->orderBy('Jadwal.JadwalID','DESC')
        ->first();
        //$myproduk   = new Produk_model();
        //$produk     = $myproduk->semua();
       
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $hari       = DB::table('hari')->orderBy('HariID','ASC')->get();
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();
        $ruang      = DB::table('ruang')->orderBy('RuangID','ASC')->get();
        $dosen      = DB::table('dosen')->orderBy('Login','ASC')->get();

        $data = array(  'title'     => 'Edit Jadwal',
                        'jadwal' => $jadwal, 
                        'tahun'    => $tahun,
                        'prodi'    => $prodi,
                        'hari'    => $hari,                     
                        'matakuliah'  => $matakuliah,
                        'ruang'    => $ruang,
                        'dosen'    => $dosen,
                        'content'   => 'admin/jadwal/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
        // request()->validate([
        //                     'nama_pemesan'  => 'required|unique:pemesanan',
        //                     'bukti'         => 'file|image|mimes:jpeg,png,jpg|max:2048',
        //                     ]);
        // $model          = new Produk_model();
        // $produk         = $model->detail($request->id_produk);
        // $pesan          = new Pemesanan_model();
        // $tanggal_order  = date('Y-m-d',strtotime($request->tanggal_order));
        // $check          = $pesan->nomor_akhir_tanggal($tanggal_order);
        // // NOMOR
       
        $prodibro = '.'.$request->ProdiID.'.';
        DB::table('jadwal')->insert([
            'LoginBuat'     => Session()->get('id_user'),
            'TahunID'       => $request->tahun,
            'ProdiID'       => $prodibro,
            'HariID'        => $request->HariID,
            'RuangID'       => $request->RuangID,
            'MKID'          => $request->MKID,
            'TglBuat'       => date('Y-m-d',strtotime($request->TglBuat)),
            'NamaKelas'     => $request->NamaKelas
        ]);
        
        return redirect('admin/jadwal')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit_proses(Request $request)
    {
        
        // request()->validate([
        //                     'nama_pemesan'  => 'required',
        //                     'bukti'        => 'file|image|mimes:jpeg,png,jpg|max:2048',
        //                     ]);
        // $model          = new Produk_model();
        // $produk         = $model->detail($request->id_produk);
      
        DB::table('jadwal')->where('JadwalID',$request->JadwalID)->update([
            'LoginEdit'          => Session()->get('id_user'),
            'NamaKelas'          => $request->NamaKelas,
            'RuangID'            => $request->RuangID,
            'HariID'             => $request->HariID,
            'DosenID'            => $request->DosenID,
            'RencanaKehadiran'   => $request->RencanaKehadiran,
            'KehadiranMin'       => $request->KehadiranMin,
            'JamMulai'           => $request->JamMulai,
            'JamSelesai'         => $request->JamSelesai,
            'TglEdit'            => date('Y-m-d H:i:s')
        ]);
        
        return redirect('admin/jadwal')->with(['sukses' => 'Data telah diedit']);
    }

    // Delete
    public function delete($JadwalID)
    {
        
        DB::table('jadwal')->where('JadwalID',$JadwalID)->delete();
        return redirect('admin/jadwal')->with(['sukses' => 'Data telah dihapus']);
    }
}
