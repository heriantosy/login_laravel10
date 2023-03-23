<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pmb_model;
use Illuminate\Support\Str;
use Image;
use PDF;
use App\Helper;

class Pmb extends Controller
{
    public function index()
    {
    	
        $tahunak      = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh     = $tahunak->TahunID;
        $programx     = DB::table('program')->orderBy('ProgramID','DESC')->limit(1)->first(); 
        $programplh   = $programx->ProgramID;
        $prodix       = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh     = $prodix->ProdiID;
       
        $mypmb      = new Pmb_model();
        $pmb        = $mypmb->pmb($tahunplh);
        $tahun      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'DATA PMB PERIODE: '.$tahunplh. ' PRODI: '.$prodiplh,
                        'pmb'       => $pmb,
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunplh,
                        'prodiplh'  => $prodiplh,
                        'content'   => 'admin/pmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses akan melanjutkan ke function filter dgn redirect
    public function proses(Request $request)
    {
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['hapus'])) {
            $id_pmbnya       = $request->pmbID;
            for($i=0; $i < sizeof($id_pmbnya);$i++) {
                DB::table('pmb')->where('pmbID',$id_pmbnya[$i])->delete();
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah dihapus']);

        }elseif(isset($_POST['filter'])) {
            if($request->prodi=='' || $request->tahun==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/pmb/filter/'.$request->tahun.'/'.$request->prodi);
            }
        }
    }

    // Main page
    public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $tahunx      = $tahun;
        $prodix      = $prodi;
       
        $mypmb      = new Pmb_model();
        $pmb        = $mypmb->pmb($tahunplh);
    
        //untuk menampilkan kembali pada combo
        $tahun      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        
        $data = array(  'title'     => 'DATA PMB PERIODE: '.$tahunx. ' PRODI: '.$prodix,
                        'pmb'       => $pmb,
                        'tahun'     => $tahun,
                        'prodi'     => $prodi,
                        'tahunplh'  => $tahunx,
                        'prodiplh'  => $prodix,
                        'content'   => 'admin/pmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    
   //Angka Penerimaan PMB
   public function angkapmb()
   {
       
       $data = array(  'title'       => 'ANGKA PMB',
                       'content'     => 'admin/pmb/angkapmb'
                   );
       return view('admin/layout/wrapper',$data);
   }
   
   public function pmbtahun()
   {
       
       $tahun   = date('Y');
       $tahunx  = $tahun;
     
       $pmbtahun = DB::table('pmb')
               ->join('prodi', 'prodi.ProdiID', '=', 'pmb.ProdiID')
               ->join('program', 'program.ProgramID', '=', 'pmb.ProgramID','LEFT')
               ->select('pmb.*', 'prodi.Nama as NamaProdi', 'program.Nama as NamaProgram')
               ->where('pmb.PMBPeriodID',$tahunx)
               ->orderBy('pmb.PMBID','DESC')
               ->get(); //->whereBetween('pmb.TglBuat', [$tgl_mulai, $tgl_selesai])
   
       //untuk menampilkan kembali pada combo
       $tahun      = DB::table('t_tahunnormal')->orderBy('Tahun','DESC')->get();
     
       
       $data = array(  'title'     => 'Data Tahun: '.$tahunx,
                       'pmbtahun'       => $pmbtahun,
                       'tahun'     => $tahun,
                       'tahunplh'  => $tahunx,
                       'content'   => 'admin/pmb/pmbtahun'
                   );
       return view('admin/layout/wrapper',$data);
   }


   public function prosestahun(Request $request)
   {
       $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
           if($request->tahun==''){
               return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
           }else{
               return redirect('admin/pmb/filtertahun/'.$request->tahun);
           }
       }
   }

   // Main page
   public function filtertahun($tahun) 
   {
       
       $tahunplh      = $tahun;
       $mypmb      = new Pmb_model();
       $pmb        = $mypmb->pmb($tahunplh);

       $tahun      = DB::table('t_tahunnormal')->orderBy('Tahun','DESC')->get();
       
       $data = array(  'title'     => 'Data Tahun: '.$tahunplh,
                       'pmb'       => $pmb,
                       'tahun'     => $tahun,
                       'tahunplh'  => $tahunplh,
                       'content'   => 'admin/pmb/pmbtahun'
                   );
       return view('admin/layout/wrapper',$data);
   }


   public function pmbjualform()
   {
       
       $pmbperiodaktif  = \DB::table('pmbperiod')->where('NA','N')->first();
       $pmbperiodplh    = $pmbperiodaktif->PMBPeriodID;

       $formulirplh     = "21";
       $frm             = DB::table('pmbformulir')->where('PMBFormulirID',$formulirplh)->first();
       $pmbjualform     = DB::table('pmbformjual')
       ->join('pmbformulir','pmbformulir.PMBFormulirID','=','pmbformjual.PMBFormulirID')
       ->select('pmbformjual.*','pmbformulir.Nama as NamaFormulir','pmbformulir.Harga','pmbformulir.JumlahPilihan')
       ->where('pmbformjual.PMBPeriodID',$pmbperiodplh)
       ->where('pmbformjual.PMBFormulirID',$formulirplh)
       ->orderBy('pmbformjual.PMBFormJualID','DESC')
       ->get();
   
       //untuk menampilkan kembali pada combo
       $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
       $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();
       $data = array(  'title'          => 'PENJUALAN FORMULIR: '.$pmbperiodplh,
                       'pmbjualform'    => $pmbjualform,
                       'pmbperiod'      => $pmbperiod,
                       'pmbperiodplh'   => $pmbperiodplh,
                       'formulir'       => $formulir,
                       'formulirplh'    => $formulirplh,
                       'frm'            => $frm,
                       'content'        => 'admin/pmb/pmbjualform'
                   );
       return view('admin/layout/wrapper',$data);
   }

   public function prosesjual(Request $request)
   {
       $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
           if($request->pmbperiod=='' || $request->formulir==''){
               return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
           }else{
               return redirect('admin/pmb/filterjual/'.$request->pmbperiod.'/'.$request->formulir);
           }
       }
   }

   public function filterjual($pmbperiod,$formulir) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $pmbperiodx  = $pmbperiod;
        $formulirx   = $formulir;
        $frm             = DB::table('pmbformulir')->where('PMBFormulirID',$formulirx)->first();
        
        $pmbjualform = DB::table('pmbformjual')
        ->join('pmbformulir','pmbformulir.PMBFormulirID','=','pmbformjual.PMBFormulirID')
        ->select('pmbformjual.*','pmbformulir.Nama as NamaFormulir','pmbformulir.Harga','pmbformulir.JumlahPilihan')
        ->where('pmbformjual.PMBPeriodID',$pmbperiodx)
        ->where('pmbformjual.PMBFormulirID',$formulirx)
        ->get();
   
       $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
       $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();

       $data = array(  'title'          => 'PENJUALAN FORMULIR: '.$pmbperiodx,
                       'pmbjualform'    => $pmbjualform,
                       'pmbperiod'      => $pmbperiod,
                       'formulir'       => $formulir,
                       'pmbperiodplh'   => $pmbperiodx,
                       'formulirplh'    => $formulirx,
                       'frm'            => $frm,
                       'content'        => 'admin/pmb/pmbjualform'
                   );
       return view('admin/layout/wrapper',$data);
    }


    public function jualformulir($pmbperiod,$formulir)
    {
        
        $pmbperiodx     = $pmbperiod;
        $formulirx      = $formulir;
      
        $frm       = DB::table('pmbformulir')->where('PMBFormulirID',$formulir)->first();
        $PeriodAktif 	= DB::table('pmbperiod')->where('NA','N')->first();
        $pmbaktif 		= substr($PeriodAktif->PMBPeriodID,0,4);
     
        $data 	= DB::table('pmbformjual')->orderBy('PMBFormJualID','DESC')->first();
        $idMax 	= $data->PMBFormJualID; //20200294
        $NoUrut = (int) substr($idMax, 5, 4);
        $NoUrut++; 
        $NewID 	= substr($pmbaktif,0,4) .sprintf('%04s', $NoUrut);

        $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();
        $data = array(  'title'     => 'PENJUALAN FORMULIR: '.$pmbperiodx,
                        'formulir'      => $formulir,
                        'frm'      => $frm,
                        'pmbperiod'      => $pmbperiod,                 
                        'formulirplh'   => $formulirx,
                        'NewID'         => $NewID,
                        'pmbperiodplh'  => $pmbperiodx,
                        'content'       => 'admin/pmb/jualformulir'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function jualformulirsimpan(Request $request)
    {
        
        $cek =DB::table('pmbformjual')->where('PMBFormJualID',$request->PMBFormJualID)->count();
        //dd($cek);
        if ($cek>0){
            return redirect('admin/pmb/jualformulir/'.$request->PMBPeriodID.'/'.$request->PMBFormulirID);
        }
        $PeriodAktif 	= DB::table('pmbperiod')->where('NA','N')->first();
        $frm       = DB::table('pmbformulir')->where('PMBFormulirID',$request->PMBFormulirID)->first();
        $pmbaktif 		= substr($PeriodAktif->PMBPeriodID,0,4);
        DB::table('pmbformjual')->insert([  
            'PMBFormJualID'    => $request->PMBFormJualID,
            'PMBFormulirID'    => $request->PMBFormulirID,
            'PMBPeriodID'      => $request->PMBPeriodID,
            'BuktiSetoran'     => $request->BuktiSetoran,
            'Nama'             => $request->Pembeli,
            'Keterangan'       => $request->Keterangan,
            ]);
        $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();

        $pmbjualform = DB::table('pmbformjual')
        ->join('pmbformulir','pmbformulir.PMBFormulirID','=','pmbformjual.PMBFormulirID')
        ->select('pmbformjual.*','pmbformulir.Nama as NamaFormulir','pmbformulir.Harga','pmbformulir.JumlahPilihan')
        ->where('pmbformjual.PMBPeriodID',$request->PMBPeriodID)
        ->where('pmbformjual.PMBFormulirID',$request->PMBFormulirID)
        ->get();

        $data = array(  'title'     => 'PENJUALAN FORMULIR: '.$request->PMBPeriodID,
                        'pmbjualform'   => $pmbjualform,
                        'formulirplh'   => $request->PMBFormulirID,
                        'pmbperiodplh'  => $request->PMBPeriodID,
                        'pmbperiod'     => $pmbperiod,                 
                        'formulir'      => $formulir,
                        'frm'           => $frm,
                        'content'       => 'admin/pmb/pmbjualform '
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function pmbformdaftar($PMBFormJualID)
    {
        

        $pmbformjual   = DB::table('pmbformjual')->where('PMBFormJualID',$PMBFormJualID)->first();
        $formulirx     = DB::table('pmbformulir')->where('PMBFormulirID',$pmbformjual->PMBFormulirID)->first();
        $prodist       = DB::table('prodi')->where('ProdiID',$formulirx->Keterangan)->first();
       
        $PeriodAktif 	= DB::table('pmbperiod')->where('NA','N')->first();
        $pmbaktif 		= substr($PeriodAktif->PMBPeriodID,0,5);
        $data 	= DB::table('pmb')->orderBy('PMBID','DESC')->first();
        $idMax 	= $data->PMBID; //202040002
        $NoUrut =  (int) substr($idMax, 5, 4);
        $NoUrut++; 
        $NewID 	= substr($pmbaktif,0,5) .sprintf('%04s', $NoUrut);

        $pmbperiod       = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $formulir        = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();
        $statusawal      = DB::table('statusawal')->orderBy('Nama','ASC')->get();
        $kelamin         = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
        $agama           = DB::table('agama')->orderBy('Agama','ASC')->get();
        $statussipil     = DB::table('statussipil')->orderBy('StatusSipil','ASC')->get();
        $asalsekolah     = DB::table('asalsekolah')->orderBy('SekolahID','ASC')->get();
        $jurusansekolah  = DB::table('jurusansekolah')->orderBy('JurusanSekolahID','ASC')->get();
        $pendidikanortu  = DB::table('pendidikanortu')->orderBy('Pendidikan','ASC')->get();
        $pekerjaanortu   = DB::table('pekerjaanortu')->orderBy('Pekerjaan','ASC')->get();
        $hidup           = DB::table('hidup')->orderBy('Hidup','ASC')->get();
        
        $data = array(  'title'     => 'FORMULIR PMB: '.$pmbformjual->PMBPeriodID,
                        'pmbformjual'      => $pmbformjual,                   
                        'pmbperiod'     => $pmbperiod,
                        'statusawal'     => $statusawal, 
                        'prodist'       => $prodist,
                        'formulirx'     => $formulirx, 
                        'kelamin'     => $kelamin,      
                        'agama'        => $agama,
                        'statussipil'  => $statussipil, 
                        'asalsekolah'  => $asalsekolah,
                        'jurusansekolah'  => $jurusansekolah, 
                        'pendidikanortu'  => $pendidikanortu,
                        'pekerjaanortu'   => $pekerjaanortu,   
                        'hidup'         => $hidup, 
                        'NewID'         => $NewID,     
                        'content'       => 'admin/pmb/pmbformdaftar'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function pmbformdaftarsimpan(Request $request)
    {
        
        $cek    =DB::table('pmbformjual')->where('PMBFormJualID',$request->PMBFormJualID)->count();
        $cek2   =DB::table('pmb')->where('PMBFormJualID',$request->PMBFormJualID)->count();
        if ($cek<=0){
            return redirect('admin/pmb/pmbformdaftar/'.$request->PMBFormJualID)->with(['warning' => 'No Kwitansi Tidak Terdaftar!']);
        }
        // elseif ($cek2>0){
        //     return redirect('admin/pmb/pmbformdaftar/'.$request->PMBFormJualID)->with(['warning' => 'No Kwitansi Sudah Terdaftar!']);
        // }
        else{
        DB::table('pmb')->insert([    
                'PMBID'             => $request->PMBID, 
				'PMBRef'            => $request->PMBRef,
				'PMBFormulirID'     => $request->PMBFormulirID,
				'PMBPeriodID'       => $request->PMBPeriodID,
				'PMBFormJualID'     => $request->PMBFormJualID,
				//'PSSBID'            => $request->PSSBID,
				'BuktiSetoran'      => $request->BuktiSetoran,
				'NIM'               => $request->NIM,
				'KodeID'            => 'SISFO',
				'BIPOTID'           => $request->BIPOTID,
				'Nama'              => $request->Nama,
				'StatusAwalID'      => $request->StatusAwalID,
				//'StatusMundur'      => $request->StatusMundur,
				//'MhswPindahanID'    => $request->MhswPindahanID,
				'ProgramID'         => $request->ProgramID,
				'ProdiID'           => $request->ProdiID,
				'Kelamin'           => $request->Kelamin,
				'WargaNegara'       => $request->WargaNegara,
				'Kebangsaan'        => $request->Kebangsaan,
				'TempatLahir'       => $request->TempatLahir,
				'TanggalLahir'      => $request->TanggalLahir,
				'Agama'             => $request->Agama,
				'StatusSipil'       => $request->StatusSipil,
				'Alamat'            => $request->Alamat,
				'Kota'              => $request->Kota,
				'RT'                => $request->RT,
				'RW'                => $request->RW,
				'KodePos'           => $request->KodePos,
				'Propinsi'          => $request->Propinsi,
				'Negara'            => $request->Negara,
				'Telepon'           => $request->Telepon,
				'Handphone'         => $request->Handphone,
				'Email'             => $request->Email,
				'AlamatAsal'        => $request->AlamatAsal,
				'KotaAsal'          => $request->KotaAsal,
				'RTAsal'            => $request->RTAsal,
				'RWAsal'            => $request->RWAsal,
				'KodePosAsal'       => $request->KodePosAsal,
				'PropinsiAsal'      => $request->PropinsiAsal,
				'NegaraAsal'        => $request->NegaraAsal,
				'TeleponAsal'       => $request->TeleponAsal,
				'NamaAyah'          => $request->NamaAyah,
				'AgamaAyah'         => $request->AgamaAyah,
				'PendidikanAyah'    => $request->PendidikanAyah,
				'PekerjaanAyah'     => $request->PekerjaanAyah,
				'HidupAyah'         => $request->HidupAyah,
				'NamaIbu'           => $request->NamaIbu,
				'AgamaIbu'          => $request->AgamaIbu,
				'PendidikanIbu'     => $request->PendidikanIbu,
				'PekerjaanIbu'      => $request->PekerjaanIbu,
				'HidupIbu'          => $request->HidupIbu,
				'AlamatOrtu'        => $request->AlamatOrtu,
				'KotaOrtu'          => $request->KotaOrtu,
				'RTOrtu'            => $request->RTOrtu,
				'RWOrtu'            => $request->RWOrtu,
				'KodePosOrtu'       => $request->KodePosOrtu,
				'PropinsiOrtu'      => $request->PropinsiOrtu,
				'NegaraOrtu'        => $request->NegaraOrtu,
				'TeleponOrtu'       => $request->TeleponOrtu,
				'HandphoneOrtu'     => $request->HandphoneOrtu,
				'EmailOrtu'         => $request->EmailOrtu,
				'AsalSekolah'       => $request->AsalSekolah,
				'JenisSekolahID'    => $request->JenisSekolahID,
				'AlamatSekolah'     => $request->AlamatSekolah,
				'KotaSekolah'       => $request->KotaSekolah,
				'JurusanSekolah'    => $request->JurusanSekolah,
				'NilaiSekolah'      => $request->NilaiSekolah,
				'TahunLulus'        => $request->TahunLulus,
				'AsalPT'            => $request->AsalPT,
				'ProdiAsalPT'       => $request->ProdiAsalPT,
				'LulusAsalPT'       => $request->LulusAsalPT,
				'TglLulusAsalPT'    => $request->TglLulusAsalPT,
				'Pilihan1'          => $request->Pilihan1,
				'Pilihan2'          => $request->Pilihan2,
				'Pilihan3'          => $request->Pilihan3,
				//'Harga'             => $request->Harga,
				'SudahBayar'        => $request->SudahBayar,
				'NA'                => 'N',
				'TanggalUjian'      => $request->TanggalUjian,
				//'LulusUjian'        => $request->LulusUjian,
				'RuangID'           => $request->RuangID,
				'NomerUjian'        => $request->NomerUjian,
				//'NilaiUjian'        => $request->NilaiUjian,
				'DetailNilai'       => $request->DetailNilai,
				'GradeNilai'        => $request->GradeNilai,
				'Catatan'           => $request->Catatan,
				'NomerSurat'        => $request->NomerSurat,
				'Syarat'            => $request->Syarat,
				//'SyaratLengkap'     => $request->SyaratLengkap,
				'BuktiSetoranMhsw'  => $request->BuktiSetoranMhsw,
				'TanggalSetoranMhsw'=> $request->TanggalSetoranMhsw,
				//'TotalBiayaMhsw'    => $request->TotalBiayaMhsw,
				//'TotalSetoranMhsw'  => $request->TotalSetoranMhsw,
				//'Dispensasi'        => $request->Dispensasi,
				'DispensasiID'      => $request->DispensasiID,
				'JudulDispensasi'   => $request->JudulDispensasi,
				'CatatanDispensasi' => $request->CatatanDispensasi,
				'LoginBuat'         => $request->LoginBuat,
				'TanggalBuat'       => $request->TanggalBuat,
				'LoginEdit'         => $request->LoginEdit,
				'TanggalEdit'       => $request->TanggalEdit,
				'NIK'               => $request->NIK,
				'IDKK'              => $request->IDKK,
				'Kelurahan'         => $request->Kelurahan,
				'Kecamatan'         => $request->Kecamatan
            ]);
        }    
        $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $prodi          = DB::table('prodi')->orderBy('Nama','ASC')->get();
        return redirect('admin/pmb/filter/'.$request->PMBPeriodID.'/'.$request->ProdiID);
    }

    public function formulirterjual($pmbperiod,$formulir)
    {
        
        $pmbperiodx     = $pmbperiod;
        $formulirx      = $formulir;
        
        $formulir       = DB::table('pmbformulir')->where('PMBFormulirID',$formulir)->first();
        $PeriodAktif 	= DB::table('pmbperiod')->where('NA','N')->first();
        $pmbaktif 		= substr($PeriodAktif->PMBPeriodID,0,4);
     

        $thn    = substr($pmbperiodx,0,4);
        //$formulirterjual       	= DB::table('pmbformjual')->where(DB::raw('substr(PMBPeriodID, 0, 4)'), '=' ,$thn)->count(); //20201
        $formulirterjual       	= DB::table('pmbformjual')->where(DB::raw('substr(PMBPeriodID, 0, 4)'), '=' ,$thn)->get(); //20201
        $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();
        $data = array(  'title'     => 'FORMULIR TERJUAL: '.$thn,
                        'formulirterjual'  => $formulirterjual,
                        'formulir'      => $formulir,
                        'pmbperiod'      => $pmbperiod,                 
                        'formulirplh'   => $formulirx,
                        'pmbperiodplh'  => $pmbperiodx,
                        'thn'  => $thn,
                        'content'       => 'admin/pmb/formulirterjual'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_kwitansi(Request $request)
    {
        
        DB::table('pmbformjual')->where('PMBFormJualID',$request->PMBFormJualID)->update([
            'PMBPeriodID'       => $request->PMBPeriodID,
            'BuktiSetoran'      => $request->BuktiSetoran,
            'Nama'              => $request->Nama,
            'Keterangan'        => $request->Keterangan,
            'PMBFormulirID'     => $request->PMBFormulirID,
            'LoginEdit'         => Session()->get('username'),
            'TanggalEdit'       => date('Y-m-d')
        ]);
        $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();

        $pmbjualform = DB::table('pmbformjual')
        ->join('pmbformulir','pmbformulir.PMBFormulirID','=','pmbformjual.PMBFormulirID')
        ->select('pmbformjual.*','pmbformulir.Nama as NamaFormulir','pmbformulir.Harga','pmbformulir.JumlahPilihan')
        ->where('pmbformjual.PMBPeriodID',$request->PMBPeriodID)
        ->where('pmbformjual.PMBFormulirID',$request->PMBFormulirID)
        ->get();

        $frm       = DB::table('pmbformulir')->where('PMBFormulirID',$request->PMBFormulirID)->first();

        $data = array(  'title'     => 'PENJUALAN FORMULIR: '.$request->PMBPeriodID,
                        'pmbjualform'   => $pmbjualform,
                        'formulirplh'   => $request->PMBFormulirID,
                        'pmbperiodplh'  => $request->PMBPeriodID,
                        'pmbperiod'     => $pmbperiod,                 
                        'formulir'      => $formulir,
                        'frm'           => $frm,
                        'content'       => 'admin/pmb/pmbjualform '
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function setawal_nim($PMBID)
    {
        
        $tahun_akademik = get_tahunak('TahunID');
        //dd($tahun_akademik);
        $pmb = DB::table('pmb')->where('PMBID',$PMBID)->first();
        $nimterakhir = DB::table('mhsw')
                    ->where('ProgramID',$pmb->ProgramID)
                    ->where('ProdiID',$pmb->ProdiID)
                    ->orderBy('MhswID','DESC')
                    ->limit(1)
                    ->first();           
        $nimgen  = $nimterakhir->MhswID+1; 
        $program = $nimterakhir->ProgramID;
         	      
        $data = array( 'title'          => 'PENJUALAN FORMULIR: '.$PMBID,
                       'pmb'            => $pmb,
                       'nimterakhir'    => $nimterakhir->MhswID,
                       'nimgen'         => $nimgen,
                       'content'        => 'admin/pmb/setawal_nim'
                   );
       return view('admin/layout/wrapper',$data);
    }

    public function setawal_nim_proses(Request $request)
    {
       
       //dd($request->PMBFormJualID);
       $cek    =DB::table('mhsw')->where('MhswID',$request->NIM)->count();
       $cek2   =DB::table('mhsw')->where('PMBFormJualID',$request->PMBFormJualID)->count();
       if ($cek>0){
        return redirect('admin/pmb/filter/'.$request->PMBPeriodID.'/'.$request->ProdiID)->with(['warning' => 'NIM Sudah Terdaftar!']);
       }
      
    //    elseif ($cek2>0){
    //     return redirect('admin/pmb/filter/'.$request->PMBPeriodID.'/'.$request->ProdiID)->with(['warning' => 'Data PMB tersebut Sudah Terdaftar!']);
    //    }
       
       else{
      
        DB::table('pmb')->where('PMBID',$request->PMBID)->update([
            'NIM'           => $request->NIM,
            'RegUlang'      => 'Y',
            'LulusUjian'    => 'Y',
            'NilaiUjian'    => '80',
            'LoginEdit'     => Session()->get('username'),
            'TanggalEdit'   => date('Y-m-d')
        ]);

       $pmb = DB::table('pmb')->where('PMBID',$request->PMBID)->first();
       $tahun_akademik = get_tahunak('TahunID');
       DB::table('mhsw')->insert([    
        'PMBID'             => $pmb->PMBID, 
        'PMBFormJualID'     => $pmb->PMBFormJualID,
        'BuktiSetoran'      => $pmb->BuktiSetoran,
        'TahunID'           => $tahun_akademik,
        'MhswID'            => $request->NIM,
        'Login'             => $request->NIM,
        'Password'          => '*6BB4837EB',
        'KodeID'            => 'SISFO',
        'BIPOTID'           => '0',
        'Nama'              => $pmb->Nama,
        'StatusAwalID'      => $pmb->StatusAwalID,
        'StatusMhswID'      => 'A',
        'ProgramID'         => $pmb->ProgramID,
        'ProdiID'           => $pmb->ProdiID,
        'Kelamin'           => $pmb->Kelamin,
        'WargaNegara'       => $pmb->WargaNegara,
        'Kebangsaan'        => $pmb->Kebangsaan,
        'TempatLahir'       => $pmb->TempatLahir,
        'TanggalLahir'      => $pmb->TanggalLahir,
        'Agama'             => $pmb->Agama,
        'StatusSipil'       => $pmb->StatusSipil,
        'Alamat'            => $pmb->Alamat,
        'Kota'              => $pmb->Kota,
        'RT'                => $pmb->RT,
        'RW'                => $pmb->RW,
        'KodePos'           => $pmb->KodePos,
        'Propinsi'          => $pmb->Propinsi,
        'Negara'            => $pmb->Negara,
        'Telepon'           => $pmb->Telepon,
        'Handphone'         => $pmb->Handphone,
        'Email'             => $pmb->Email,
        'AlamatAsal'        => $pmb->AlamatAsal,
        'KotaAsal'          => $pmb->KotaAsal,
        'RTAsal'            => $pmb->RTAsal,
        'RWAsal'            => $pmb->RWAsal,
        'KodePosAsal'       => $pmb->KodePosAsal,
        'PropinsiAsal'      => $pmb->PropinsiAsal,
        'NegaraAsal'        => $pmb->NegaraAsal,
        'TeleponAsal'       => $pmb->TeleponAsal,
        'NamaAyah'          => $pmb->NamaAyah,
        'AgamaAyah'         => $pmb->AgamaAyah,
        'PendidikanAyah'    => $pmb->PendidikanAyah,
        'PekerjaanAyah'     => $pmb->PekerjaanAyah,
        'HidupAyah'         => $pmb->HidupAyah,
        'NamaIbu'           => $pmb->NamaIbu,
        'AgamaIbu'          => $pmb->AgamaIbu,
        'PendidikanIbu'     => $pmb->PendidikanIbu,
        'PekerjaanIbu'      => $pmb->PekerjaanIbu,
        'HidupIbu'          => $pmb->HidupIbu,
        'AlamatOrtu'        => $pmb->AlamatOrtu,
        'KotaOrtu'          => $pmb->KotaOrtu,
        'RTOrtu'            => $pmb->RTOrtu,
        'RWOrtu'            => $pmb->RWOrtu,
        'KodePosOrtu'       => $pmb->KodePosOrtu,
        'PropinsiOrtu'      => $pmb->PropinsiOrtu,
        'NegaraOrtu'        => $pmb->NegaraOrtu,
        'TeleponOrtu'       => $pmb->TeleponOrtu,
        'HandphoneOrtu'     => $pmb->HandphoneOrtu,
        'EmailOrtu'         => $pmb->EmailOrtu,
        'AsalSekolah'       => $pmb->AsalSekolah,
        'JenisSekolahID'    => $pmb->JenisSekolahID,
        'AlamatSekolah'     => $pmb->AlamatSekolah,
        'KotaSekolah'       => $pmb->KotaSekolah,
        'JurusanSekolah'    => $pmb->JurusanSekolah,
        'NilaiSekolah'      => $pmb->NilaiSekolah,
        'TahunLulus'        => $pmb->TahunLulus,
        'AsalPT'            => $pmb->AsalPT,
        'ProdiAsalPT'       => $pmb->ProdiAsalPT,
        'LulusAsalPT'       => $pmb->LulusAsalPT,
        'TglLulusAsalPT'    => $pmb->TglLulusAsalPT,
        'Pilihan1'          => $pmb->Pilihan1,
        'Pilihan2'          => $pmb->Pilihan2,
        'Pilihan3'          => $pmb->Pilihan3,
        'SudahBayar'        => $pmb->SudahBayar,
        'NA'                => 'N',
        'TanggalUjian'      => $pmb->TanggalUjian,
        'RuangID'           => $pmb->RuangID,
        'NomerUjian'        => $pmb->NomerUjian,
        'GradeNilai'        => $pmb->GradeNilai,
        'Syarat'            => $pmb->Syarat,
        'BuktiSetoranMhsw'  => $pmb->BuktiSetoranMhsw,
        'TanggalSetoranMhsw'=> $pmb->TanggalSetoranMhsw,
        'DispensasiID'      => $pmb->DispensasiID,
        'JudulDispensasi'   => $pmb->JudulDispensasi,
        'CatatanDispensasi' => $pmb->CatatanDispensasi,
        'LoginBuat'         => Session()->get('username'),
        'TanggalBuat'       => date('Y-m-d'),
        //'LoginEdit'         => $pmb->LoginEdit,
        //'TanggalEdit'       => $pmb->TanggalEdit,
        'NIK'               => $pmb->NIK,
        'IDKK'              => $pmb->IDKK,
        'Kelurahan'         => $pmb->Kelurahan,
        'Kecamatan'         => $pmb->Kecamatan
        ]);
       }

       $frm         = DB::table('pmbformulir')->where('PMBFormulirID',$pmb->PMBFormulirID)->first();
       $pmbjualform = DB::table('pmbformjual')
       ->join('pmbformulir','pmbformulir.PMBFormulirID','=','pmbformjual.PMBFormulirID')
       ->select('pmbformjual.*','pmbformulir.Nama as NamaFormulir','pmbformulir.Harga','pmbformulir.JumlahPilihan')
       ->where('pmbformjual.PMBPeriodID',$request->PMBPeriodID)
       ->where('pmbformjual.PMBFormulirID',$request->PMBFormulirID)
       ->get();
       $pmbperiod      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
       $formulir      = DB::table('pmbformulir')->orderBy('Nama','ASC')->get();

       $data = array(  'title'          => 'PENJUALAN FORMULIR: '.$pmb->PMBPeriodID,
                       'pmbjualform'    => $pmbjualform,
                       'pmbperiod'      => $pmbperiod,
                       'formulir'       => $formulir,
                       'pmbperiodplh'   => $pmb->PMBPeriodID,
                       'formulirplh'    => $request->PMBFormulirID,
                       'prodiplh'       => $request->ProdiID,
                       'frm'            => $frm,
                       'content'        => 'admin/pmb/pmbjualform'
                   );
       //return view('admin/layout/wrapper',$data);
       return redirect('admin/pmb/filter/'.$request->PMBPeriodID.'/'.$request->ProdiID);
    }


    public function cetakpmbcard($PMBID)
    {
           
        $pmbdata = DB::table('pmb')->where('PMBID',$PMBID)->first();

        $tahun      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        //dd($pmbdata->PMBID);
        $data = array(  'title'     => 'DATA PMB PERIODE: '.$pmbdata->PMBPeriodID. ' PRODI: '.$pmbdata->ProdiID,
                    'pmbdata'   => $pmbdata,
                    'tahun'     => $tahun,
                    'prodi'     => $prodi,
                    'tahunplh'  => $pmbdata->PMBPeriodID,
                    'prodiplh'  => $pmbdata->ProdiID
                );                                    
        $config = [ 'format' => 'A4-P', // Landscape
                    'margin_top' => 10,
                    'margin_right' => 10,
                    'margin_bottom' => 10,
                    'margin_left' => 10                 
                ];
        $pdf = PDF::loadview('admin/pmb/print-pmbcard',$data,[],$config);
        ob_get_clean();
        $nama_file = 'PMB_'.$pmbdata->PMBID.' NAMA '.$pmbdata->Nama.'.pdf';
        return $pdf->stream($nama_file, 'I');
    }

    public function cetakpmbcard_v($PMBID)
    {
           
        $pmbdata    = DB::table('pmb')->where('PMBID',$PMBID)->first();
        $pmbperiod  = DB::table('pmbperiod')->where('NA','N')->first();
        $prodix     = DB::table('prodi')->where('ProdiID',$pmbdata->ProdiID)->first();

        $tahun      = DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();
        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        //dd($pmbdata->PMBID);
        $data = array(  'title'     => 'DATA PMB PERIODE: '.$pmbdata->PMBPeriodID. ' PRODI: '.$pmbdata->ProdiID,
                    'pmb'   => $pmbdata,
                    'pmbperiod' => $pmbperiod,
                    'tahun'     => $tahun,
                    'prodi'     => $prodi,
                    'prodix'    => $prodix,
                    'tahunplh'  => $pmbdata->PMBPeriodID,
                    'prodiplh'  => $pmbdata->ProdiID
                );                                    
        return view('admin/pmb/cetak_pmbcard_v',$data);
    }

    public function delete($pmbID)
    {
        
        DB::table('pmb')->where('pmbID',$pmbID)->delete();
        return redirect('admin/pmb')->with(['sukses' => 'Data telah dihapus']);
    }
}
