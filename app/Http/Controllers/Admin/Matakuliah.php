<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Matakuliah_model;
use Illuminate\Support\Str;
use Image;
use PDF;

class Matakuliah extends Controller
{
    // Main page
    public function index()
    {
    	        
        $kurikulumaktif = \DB::table('kurikulum')->where('NA','N')->orderBy('KurikulumID', 'desc')->first();
        if (!empty($kurikulumplh)){
            $kurikulumplh   =$kurikulumplh;
            $prodiplh       =$prodiplh;
        }else{
            $kurikulumplh   =$kurikulumaktif->KurikulumID;
            $prodiplh       ="311";
        }
        $mymk       = new Matakuliah_model();
        $matakuliah = $mymk->view_mk_prodi($prodiplh, $kurikulumplh);

        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $kurikulum  = DB::table('kurikulum')->where('NA','N')->orderBy('KurikulumID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'       => 'Data matakuliah',
                        'matakuliah'   => $matakuliah,
                        'kurikulum'    => $kurikulum,
                        'prodi'    => $prodi,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh' => $prodiplh,
                        'content'     => 'admin/matakuliah/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        //$site           = DB::table('konfigurasi')->first();
        $pengalihan     = $request->pengalihan;
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_matakuliahnya       = $request->matakuliahID;
            for($i=0; $i < sizeof($id_matakuliahnya);$i++) {
                DB::table('mk')->where('MKID',$id_matakuliahnya[$i])->delete();
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah dihapus']);

        // PROSES SETTING DRAFT
        }elseif(isset($_POST['filter'])) {
            if($request->prodi=='' || $request->kurikulum==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/matakuliah/filter/'.$request->prodi.'/'.$request->kurikulum);
            }
        }
    }

    // Main page
    public function filter($prodi, $kurikulum) //posisi kurikulum dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $prodiplh      = $prodi;
        $kurikulumplh  = $kurikulum;
             
        $mymk       = new Matakuliah_model();
        $matakuliah = $mymk->view_mk_prodi($prodiplh, $kurikulumplh);

       
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $kurikulum  = DB::table('kurikulum')->where('ProdiID',$prodiplh)->where('NA','N')->orderBy('KurikulumID','DESC')->get();
        
        $data = array(  'title'         => 'Data kurikulum: '.$kurikulumplh.' Program Studi: '.$prodiplh,
                        'matakuliah'    => $matakuliah,
                        'kurikulum'     => $kurikulum,
                        'prodi'         => $prodi,
                        'prodiplh'      => $prodiplh,
                        'kurikulumplh'  => $kurikulumplh,
                       
                        'content'       => 'admin/matakuliah/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
      // detail page
      public function detail($MKID)
      {
          
          
          $mymk       = new Matakuliah_model();
          $matakuliah = $mymk->detail_mk($MKID);      
          
          $krs = DB::table('krs')
          ->join('mhsw','mhsw.MhswID','=','krs.MhswID')
          ->select('krs.matakuliahID','krs.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.Handphone')
          ->where('krs.matakuliahID',$MKID)
          ->orderBy('krs.MhswID','ASC')
          ->get();
          $site      = DB::table('identitas')->first();
  
          $data = array(  'title'     => 'matakuliah. '.$matakuliahID.' a.n: '.$matakuliahID,
                          'matakuliah'    => $matakuliah,
                          'krs'       => $krs,
                          'site'      => $site,
                          'content'   => 'admin/matakuliah/detail'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function nilaidosen($matakuliahID)
      {
          
          
          $matakuliah = DB::table('matakuliah')
          ->join('dosen', 'dosen.Login', '=', 'matakuliah.DosenID')
          ->join('mk', 'mk.MKID', '=', 'matakuliah.MKID')
          ->join('hari', 'hari.HariID', '=', 'matakuliah.HariID')
          ->select('matakuliah.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'mk.SKS','hari.Nama as NamaHari')
          ->where('matakuliah.matakuliahID',$matakuliahID)
          ->first();          
          
          $krs = DB::table('krs')
          ->join('mhsw','mhsw.MhswID','=','krs.MhswID')
          ->select('krs.matakuliahID','krs.MhswID','krs.Tugas1','krs.Tugas2','krs.Tugas3','krs.Tugas4','krs.Tugas5',
          'krs.Presensi','krs.UTS','krs.UAS','krs.NilaiAkhir','krs.GradeNilai',
          'mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.Handphone')
          ->where('krs.matakuliahID',$matakuliahID)
          ->orderBy('krs.MhswID','ASC')
          ->get();
          $site      = DB::table('identitas')->first();
  
          $data = array(  'title'     => 'matakuliah. '.$matakuliahID.' a.n: '.$matakuliahID,
                          'matakuliah'    => $matakuliah,
                          'krs'       => $krs,
                          'site'      => $site,
                          'content'   => 'admin/matakuliah/nilaidosen'
                      );
          return view('admin/layout/wrapper',$data);
      }


      public function simpannilaidosen(Request $request){ 
        $MhswID= $request->MhswID;
        $matakuliahID= $request->matakuliahID;
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
            ->where('matakuliahID',$matakuliahID[$key])
            ->where('MhswID',$datax['MhswID'])
            ->update($datax); //untuk update nilai tabel yang sudah ada
            //bisa menggunakan model namun field fillable model penilaian harus terisi
            //Penilaian::create($datax); 
        }
        
        //ambil matakuliahID untuk mengembalikan nilai matakuliahID agar bisa diredirect
        $dt = \DB::table('matakuliah')->where('matakuliahID',$matakuliahID)->first();
        $jdw= $dt->matakuliahID;
        ///filter/'.$matakuliahID.'/'.$MhswID
        return redirect('admin/matakuliah/nilaidosen/'.$dt->matakuliahID);
    }

  
      // cetak page
      public function cetak($matakuliahID)
      {
          
          $matakuliah = DB::table('matakuliah')
                    ->join('dosen', 'dosen.Login', '=', 'matakuliah.DosenID')
                    ->join('mk', 'mk.MKID', '=', 'matakuliah.MKID')
                    ->join('hari', 'hari.HariID', '=', 'matakuliah.HariID')
                    ->select('matakuliah.*', 'dosen.Nama as NamaDosen', 'dosen.Gelar', 'mk.Nama as NamaMK', 'hari.Nama as NamaHari')
                    ->where('matakuliah.matakuliahID',$matakuliahID)
                    ->first();                    
          $site      = DB::table('identitas')->first();
  
          //dd($site->namaweb);  
          $data = array(  'title'     => 'Order Nomor '.$matakuliah->matakuliahID.' atas nama '.$matakuliah->NamaDosen,
                          'matakuliah' => $matakuliah,              
                          'site'      => $site
                      );
               
          $config = [ 'format' => 'A4-L', // Landscape
                      'margin_top' => 25
                      
                    ];
          $pdf = PDF::loadview('admin/matakuliah/cetak',$data,[],$config);
          // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
          $nama_file = 'Order Nomor '.$matakuliah->matakuliahID.' atas nama '.$matakuliah->NamaDosen.'.pdf';
          return $pdf->stream($nama_file, 'I');
      }


    // Tambah
    public function tambah($KurikulumID, $ProdiID)
    {
           
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();       
        $data = array(  'title'     => 'TAMBAH MASTER MATATAKULIAH',    
                        'prodi'	    => $prodi,
                        'prodiplh'	=> $ProdiID,
                        'kurikulumplh'	=> $KurikulumID,     
                        'content'   => 'admin/matakuliah/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
        
        // request()->validate([
        // 'judul_download'  => 'required|unique:download',
        // 'gambar'          => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        //                     ]);
        $Wajib = (empty($request['Wajib']))? 'N' : $request['Wajib'];
        DB::table('mk')->insert([
            'KurikulumID'            => $request->KurikulumID,
            //'NoUrut'                 => $request->NoUrut,
            'KodeID'                 => 'SISFO',
            'ProdiID'                => $request->ProdiID,
            'KonsentrasiID'          => $request->KonsentrasiID,
            'MKKode'                 => $request->MKKode,
            'Nama'                   => $request->Nama,
            'Nama_en'                => $request->Nama_en,
            'Singkatan'              => $request->Singkatan,
            'Wajib'                  => $Wajib,
            'JenisMKID'              => $request->JenisMKID,
            'JenisPilihanID'         => $request->JenisPilihanID,
            'JenisKurikulumID'       => $request->JenisKurikulumID,
            'Sesi'                   => $request->Sesi,
            'Deskripsi'              => $request->Deskripsi,
            //'AdaResponsi'            => $request->AdaResponsi,
            'SKS'                    => $request->SKS,
            'SKSTatapMuka'           => $request->SKSTatapMuka,
            'SKSPraktikum'           => $request->SKSPraktikum,
            'SKSPraktekLap'          => $request->SKSPraktekLap,
            'SKSMin'                 => $request->SKSMin,
            'IPKMin'                 => $request->IPKMin,
            'Penanggungjawab'        => $request->Penanggungjawab,
            'Prasyarat'              => $request->Prasyarat,
            'MKSetara'               => $request->MKSetara,
            'NA'                     => 'N',
            'LoginBuat'              => Session()->get('id_user'),
            'TglBuat'                => date('Y-m-d')
        ]);
        return redirect('admin/matakuliah')->with(['sukses' => 'Data telah ditambah']);
        }
    // edit
    public function edit($MKID)
    {
        
        $mk = DB::table('mk')->where('MKID',$MKID)->first();
     
        $kurikulum  = DB::table('kurikulum')->orderBy('kurikulumID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();   
        $matakuliah = DB::table('mk')->orderBy('MKID','ASC')->get();   
        $status     = DB::table('jenismk')->where('ProdiID',$mk->ProdiID)->get();  
        $jn         = DB::table('jenispilihan')->where('ProdiID',$mk->ProdiID)->get(); 
        //dd($mk->ProdiID); 
        $data = array(  'title'     => 'EDIT MATATAKULIAH',  
                        'mk'	    => $mk,
                        'status'	    => $status,
                        'kurikulum'	=> $kurikulum, 
                        'prodi'	    => $prodi,
                        'jn'	    => $jn,
                        'prodiplh'	=> $mk->ProdiID,
                        'kurikulumplh'	=> $mk->KurikulumID,     
                        'content'   => 'admin/matakuliah/edit'
                    );
        return view('admin/layout/wrapper',$data);
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
        $Wajib = (empty($_POST['Wajib']))? 'N' : $_POST['Wajib'];
        DB::table('mk')->where('MKID',$request->MKID)->update([
            'KurikulumID'            => $request->KurikulumID,
            //'NoUrut'                 => $request->NoUrut,
            'KodeID'                 => 'SISFO',
            'ProdiID'                => $request->ProdiID,
            'KonsentrasiID'          => $request->KonsentrasiID,
            'MKKode'                 => $request->MKKode,
            'Nama'                   => $request->Nama,
            'Nama_en'                => $request->Nama_en,
            'Singkatan'              => $request->Singkatan,
            'Wajib'                  => $Wajib,
            'JenisMKID'              => $request->JenisMKID,
            'JenisPilihanID'         => $request->JenisPilihanID,
            'JenisKurikulumID'       => $request->JenisKurikulumID,
            'Sesi'                   => $request->Sesi,
            'Deskripsi'              => $request->Deskripsi,
            //'AdaResponsi'            => $request->AdaResponsi,
            'SKS'                    => $request->SKS,
            'SKSTatapMuka'           => $request->SKSTatapMuka,
            'SKSPraktikum'           => $request->SKSPraktikum,
            'SKSPraktekLap'          => $request->SKSPraktekLap,
            'SKSMin'                 => $request->SKSMin,
            'IPKMin'                 => $request->IPKMin,
            'Penanggungjawab'        => $request->Penanggungjawab,
            'Prasyarat'              => $request->Prasyarat,
            'MKSetara'               => $request->MKSetara,
            'NA'                     => $request->NA,
            'TglEdit'                => date('Y-m-d H:i:s')
        ]);
        
        return redirect('admin/matakuliah')->with(['sukses' => 'Data telah diedit']);
    }

    // Delete
    public function delete($matakuliahID)
    {
        
        DB::table('matakuliah')->where('matakuliahID',$matakuliahID)->delete();
        return redirect('admin/matakuliah')->with(['sukses' => 'Data telah dihapus']);
    }
}
