<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa_model;
use Illuminate\Support\Str;
use Image;



class Mahasiswa extends Controller
{
    public function index()
    {
    	
    	     if(empty($request->prodi)){
                $mhsx    = DB::table('mhsw')->orderBy('MhswID','DESC')->limit(1)->first(); 
                $nimplh  = $mhsx->MhswID;

                $programx     = DB::table('program')->orderBy('ProgramID','DESC')->limit(1)->first(); 
                $programplh   = $programx->ProgramID;

                $prodix       = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
                $prodiplh     = $prodix->ProdiID;

                $statusmhsx       = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->limit(1)->first(); 
                $statusmhsplh     = $statusmhsx->StatusMhswID;
                
                // $mymhs = new Mahasiswa_model();
                // $mahasiswa = $mymhs->view_mahasiswa($programplh, $prodiplh, $statusmhsplh);

                $mahasiswa = Mahasiswa_model::where('NA','N')->where('ProgramID', $programplh)->where('ProdiID', $prodiplh)->where('StatusMhswID', $statusmhsplh)->orderBy('MhswID', 'desc')->get();
                
    	     }    
                $program 	= DB::table('program')->orderBy('ProgramID','ASC')->get();
                $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
                $statusmhs  = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
        		$data = array(  'title'     => 'DATA MAHASISWA',
                                'mahasiswa'	=> $mahasiswa,
                                'program'	=> $program,
                                'prodi'	    => $prodi,
                                'statusmhs'	    => $statusmhs,
                                'programplh'=> $programplh,
                                'prodiplh'  => $prodiplh,
                                'statusmhsplh'	    => $statusmhsplh,
                                'nimplh'	=> $nimplh,                             
                                'content'   => 'admin/mahasiswa/index'
                            );
                return view('admin/layout/wrapper',$data);
    }

    public function editfotomhs($MhswID)
    {
        
        
        $mymhs      = new Mahasiswa_model();
        $detailmhs  = $mymhs->detail_mahasiswa($MhswID);       

        $site       = DB::table('konfigurasi')->first();
        $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                        'detailmhs'    => $detailmhs,             
                        'site'      => $site,
                        'nimplh'      => $MhswID,
                        'content'   => 'admin/mahasiswa/mahasiswa_edit_foto'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function editfotomhssimpan(Request $request)
    {
        
        request()->validate([
            'Foto'   => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);

        $image                  = $request->file('Foto');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('Foto')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/mahasiswa/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/mahasiswa/';
            $image->move($destinationPath, $input['nama_file']);

        DB::table('mhsw')->where('MhswID',$request->id)->update([
            'Foto'        => $input['nama_file'],
            'LoginEdit'   => Session()->get('id_user')
        ]);

        $detailmhs = DB::table('mhsw')
        ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
        ->select('mhsw.*', 'prodi.Nama as NamaProdi')
        ->where('mhsw.MhswID',$request->id)
        ->first();          
  
        $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                        'detailmhs'    => $detailmhs,             
                        'nimplh'      => $request->id,
                        'content'   => 'admin/mahasiswa/mahasiswa_edit_foto'
                    );
        return view('admin/layout/wrapper',$data);
    }
    }

 public function filtermhs(Request $request)
 {
     
        if(!empty($request->prodi)){
          
            $programplh = $request->program;
            $prodiplh   = $request->prodi;
            $statusmhsplh   = $request->statusmhs;
            $mhsx    = DB::table('mhsw')->orderBy('MhswID','DESC')->limit(1)->first(); 
            $nimplh  = $mhsx->MhswID;

            //$mymhs = new Mahasiswa_model();
            //$mahasiswa = $mymhs->view_mahasiswa($programplh, $prodiplh, $statusmhsplh);

            $mahasiswa = Mahasiswa_model::where('NA','N')->where('ProgramID', $programplh)->where('ProdiID', $prodiplh)->where('StatusMhswID', $statusmhsplh)->orderBy('MhswID', 'desc')->get();
        }    
            $program 	= DB::table('program')->orderBy('ProgramID','ASC')->get();
            $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
            $statusmhs  = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
            $data = array(  'title'     => 'Data Mahasiswa',
                            'mahasiswa'	=> $mahasiswa,
                            'program'	=> $program,
                            'prodi'	    => $prodi,
                            'statusmhs'	=> $statusmhs,
                            'programplh'=> $programplh,
                            'prodiplh'	=> $prodiplh,
                            'statusmhsplh'	=> $statusmhsplh,
                            'nimplh'	=> $nimplh,
                            'content'   => 'admin/mahasiswa/index'
                        );
            return view('admin/layout/wrapper',$data);
 }
 
public function filter($program,$prodi, $statusmhs) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
    
    $mhsx    = DB::table('mhsw')->orderBy('MhswID','DESC')->limit(1)->first(); 
    $nimplh  = $mhsx->MhswID;

    $programplh = $program;
    $prodiplh   = $prodi;
    $statusmhsplh   = $statusmhs;

    $mymhs      = new Mahasiswa_model();
    $mahasiswa  = $mymhs->view_mahasiswa($programplh,$prodiplh,$statusmhsplh);
    $program 	= DB::table('program')->orderBy('ProgramID','ASC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $statusmhs  = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
    $data = array(  'title'     => 'Data Mahasiswa',
                    'mahasiswa'	=> $mahasiswa,
                    'program'	=> $program,
                    'prodi'	    => $prodi,
                    'statusmhs'	    => $statusmhs,
                    'programplh'=> $programplh,
                    'prodiplh'	=> $prodiplh,
                    'statusmhsplh'	=> $statusmhsplh,
                    'nimplh'	=> $nimplh,
                    'content'   => 'admin/mahasiswa/index'
                );
    return view('admin/layout/wrapper',$data);
}

 public function detailakademik($MhswID)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($MhswID);          

    //$mahasiswa = Mahasiswa_model::where('NA','N')->where('ProgramID', $programplh)->where('ProdiID', $prodiplh)->where('StatusMhswID', $statusmhsplh)->orderBy('MhswID', 'desc')->get();
     $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $statusawal= DB::table('statusawal')->orderBy('StatusAwalID','ASC')->get();
     $statusmhs = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
     $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
     
     $data = array(  'title'        => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,             
                     'program'      => $program,
                     'prodi'        => $prodi,
                     'statusawal'   => $statusawal,
                     'statusmhs'    => $statusmhs,
                     'dosen'        => $dosen,
                     'nimplh'       => $MhswID,
                     'content'      => 'admin/mahasiswa/mahasiswa_edit_akademik'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function simpaneditakademik(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'BatasStudi'    => $request->BatasStudi,
        'StatusAwalID'  => $request->StatusAwalID,
        'StatusMhswID'  => $request->StatusMhswID,
        'PenasehatAkademik'  => $request->PenasehatAkademik,
        'LoginEdit'     => Session()->get('id_user')
    ]);

    $detailmhs = DB::table('mhsw')
    ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
    ->select('mhsw.*', 'prodi.Nama as NamaProdi')
    ->where('mhsw.MhswID',$request->id)
    ->first();  

    $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
    $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $statusawal= DB::table('statusawal')->orderBy('StatusAwalID','ASC')->get();
    $statusmhs = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
    $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
    

    $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                    'detailmhs'    => $detailmhs,             
                    'program'      => $program,
                    'prodi'      => $prodi,
                    'statusawal'      => $statusawal,
                    'statusmhs'      => $statusmhs,
                    'dosen'      => $dosen,
                    'nimplh'     => $request->id,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_akademik'
                 );
     return view('admin/layout/wrapper',$data);
 }


 public function detailalamat($MhswID)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($MhswID);         
     
     $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,              
                     'program'      => $program,
                     'prodi'      => $prodi,
                     'nimplh'      => $MhswID,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_alamat'
                 );
     return view('admin/layout/wrapper',$data);
 }


 public function detailalamatsimpan(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'Alamat'            => $request->Alamat,
        'RT'                => $request->RT,
        'RW'                => $request->RW,
        'Kota'              => $request->Kota,
        'Propinsi'          => $request->Propinsi,
        'Negara'            => $request->Negara,
        'Telepon'           => $request->Telepon,
        'NIK'               => $request->NIK,
        'IDKK'              => $request->IDKK,
        'Kecamatan'         => $request->Kecamatan,
        'Kelurahan'         => $request->Kelurahan,
        'LoginEdit'          => Session()->get('id_user')
    ]);
     $detailmhs = DB::table('mhsw')
     ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
     ->select('mhsw.*', 'prodi.Nama as NamaProdi')
     ->where('mhsw.MhswID',$request->id)
     ->first();          
     
     $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,              
                     'program'      => $program,
                     'prodi'      => $prodi,
                     'nimplh'      => $request->id,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_alamat'
                 );
     return view('admin/layout/wrapper',$data);
 }


 //bisa gunakan variabel $id atau $MhswID untuk menampung nilai dari route
 public function detailpribadi($id)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($id);         

     $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $statusawal= DB::table('statusawal')->orderBy('StatusAwalID','ASC')->get();
     $statusmhs = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
     $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
     $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
     $warganegara     = DB::table('warganegara')->orderBy('WargaNegara','ASC')->get();
     $agama           = DB::table('agama')->orderBy('Agama','ASC')->get();
     $statussipil     = DB::table('statussipil')->orderBy('StatusSipil','ASC')->get();
     
     
     $data = array(  'title'        => 'NIM. '.$id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,               
                     'program'      => $program,
                     'prodi'        => $prodi,
                     'statusawal'   => $statusawal,
                     'statusmhs'    => $statusmhs,
                     'dosen'        => $dosen,
                     'kelamin'      => $kelamin,
                     'warganegara'  => $warganegara,
                     'agama'        => $agama,
                     'statussipil'  => $statussipil,
                     'nimplh'       => $id,
                     'content'      => 'admin/mahasiswa/mahasiswa_edit_pribadi'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailpribadisimpan(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'Nama'    => $request->Nama,
        'TempatLahir'  => $request->TempatLahir,
        'TanggalLahir'  => date('Y-m-d', strtotime($request->TanggalLahir)),
        'Kelamin'  => $request->Kelamin,
        'WargaNegara'  => $request->WargaNegara,
        'Agama'  => $request->Agama,
        'StatusSipil'  => $request->StatusSipil,
        'Alamat'  => $request->Alamat,
        'RT'  => $request->RT,
        'RW'  => $request->RW,
        'Kota'  => $request->Kota,
        'Propinsi'  => $request->Propinsi,
        'Negara'  => $request->Negara,
        'Telepon'  => $request->Telepon,
        'Email'  => $request->Email,
        'LoginEdit'     => Session()->get('id_user')
    ]);

    $detailmhs = DB::table('mhsw')
    ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
    ->select('mhsw.*', 'prodi.Nama as NamaProdi')
    ->where('mhsw.MhswID',$request->id)
    ->first();  

    $program     = DB::table('program')->orderBy('ProgramID','ASC')->get();
    $prodi       = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $statusawal  = DB::table('statusawal')->orderBy('StatusAwalID','ASC')->get();
    $statusmhs   = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
    $dosen       = DB::table('dosen')->orderBy('Login','ASC')->get();
    $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
    $warganegara = DB::table('warganegara')->orderBy('WargaNegara','ASC')->get();
    $agama       = DB::table('agama')->orderBy('Agama','ASC')->get();
    $statussipil = DB::table('statussipil')->orderBy('StatusSipil','ASC')->get();
    
    $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                    'detailmhs'  => $detailmhs,             
                    'program'      => $program,
                    'prodi'        => $prodi,
                    'statusawal'   => $statusawal,
                    'statusmhs'    => $statusmhs,
                    'dosen'        => $dosen,
                    'kelamin'      => $kelamin,
                    'warganegara'  => $warganegara,
                    'agama'        => $agama,
                    'statussipil'  => $statussipil,
                    'nimplh'     => $request->id,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_pribadi'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailortu($MhswID)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($MhswID); 
     //dd($detailmhs->MhswID);

     $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     
     $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
     $warganegara       = DB::table('warganegara')->orderBy('WargaNegara','ASC')->get();
     $agama             = DB::table('agama')->orderBy('Agama','ASC')->get();
     $hidup             = DB::table('hidup')->orderBy('Hidup','ASC')->get();
     $statussipil       = DB::table('statussipil')->orderBy('StatusSipil','ASC')->get();
     $pendidikanortu    = DB::table('pendidikanortu')->orderBy('Pendidikan','ASC')->get();
     $pekerjaanortu     = DB::table('pekerjaanortu')->orderBy('Pekerjaan','ASC')->get();

     $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,                    
                     'program'      => $program,
                     'prodi'        => $prodi,                
                     'warganegara'  => $warganegara,
                     'agama'        => $agama,
                     'statussipil'  => $statussipil,
                     'pendidikanortu'  => $pendidikanortu,
                     'pekerjaanortu'   => $pekerjaanortu,
                     'hidup'        => $hidup,                   
                     'nimplh'        => $MhswID,
                     'content'      => 'admin/mahasiswa/mahasiswa_edit_orangtua'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailortusimpan(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'NamaAyah'    => $request->NamaAyah,
        'AgamaAyah'  => $request->AgamaAyah,
        'PendidikanAyah'  => $request->PendidikanAyah,
        'PekerjaanAyah'  => $request->PekerjaanAyah,
        'HidupAyah'  => $request->HidupAyah,
        'NamaIbu'  => $request->NamaIbu,
        'AgamaIbu'  => $request->AgamaIbu,
        'PendidikanIbu'  => $request->PendidikanIbu,
        'PekerjaanIbu'  => $request->PekerjaanIbu,
        'HidupIbu'  => $request->HidupIbu,
        'AlamatOrtu'  => $request->AlamatOrtu,
        'RTOrtu'  => $request->RTOrtu,
        'RWOrtu'  => $request->RWOrtu,
        'KotaOrtu'  => $request->KotaOrtu,
        'PropinsiOrtu'  => $request->PropinsiOrtu,
        'NegaraOrtu'  => $request->NegaraOrtu,
        'TeleponOrtu'  => $request->TeleponOrtu,
        'HandphoneOrtu'  => $request->HandphoneOrtu,
        'EmailOrtu'  => $request->EmailOrtu,
        'LoginEdit'     => Session()->get('id_user')
    ]);

    $detailmhs = DB::table('mhsw')
    ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
    ->select('mhsw.*', 'prodi.Nama as NamaProdi')
    ->where('mhsw.MhswID',$request->id)
    ->first();  

    $program     = DB::table('program')->orderBy('ProgramID','ASC')->get();
    $prodi       = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
   
    $hidup       = DB::table('hidup')->orderBy('Hidup','ASC')->get();
    $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
    $warganegara = DB::table('warganegara')->orderBy('WargaNegara','ASC')->get();
    $agama       = DB::table('agama')->orderBy('Agama','ASC')->get();
    $pendidikanortu    = DB::table('pendidikanortu')->orderBy('Pendidikan','ASC')->get();
    $pekerjaanortu     = DB::table('pekerjaanortu')->orderBy('Pekerjaan','ASC')->get();
    
    $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                    'detailmhs'     => $detailmhs,             
                    'program'       => $program,
                    'prodi'         => $prodi,
                    'hidup'         => $hidup,
                    'pekerjaanortu' => $pekerjaanortu,
                    'pendidikanortu' => $pendidikanortu,
                    'kelamin'      => $kelamin,
                    'warganegara'  => $warganegara,
                    'agama'        => $agama,
                    'nimplh'       => $request->id,
                    'content'      => 'admin/mahasiswa/mahasiswa_edit_orangtua'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailasalsekolah($MhswID)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($MhswID);         
 
     $asalsekolah       = DB::table('asalsekolah')->orderBy('SekolahID','ASC')->get();
     $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    

     $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,                
                     'program'      => $program,
                     'prodi'        => $prodi,               
                     'asalsekolah'  => $asalsekolah,                 
                     'nimplh'       => $MhswID,
                     'content'      => 'admin/mahasiswa/mahasiswa_edit_asalsekolah'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailasalsekolahsimpan(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'AsalSekolah'     => $request->AsalSekolah,
        'JenisSekolahID'  => $request->JenisSekolahID,
        'JurusanSekolah'  => $request->JurusanSekolah,
        'TahunLulus'      => $request->TahunLulus,
        'LoginEdit'       => Session()->get('id_user')
    ]);
     $detailmhs = DB::table('mhsw')
     ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
     ->select('mhsw.*', 'prodi.Nama as NamaProdi')
     ->where('mhsw.MhswID',$request->id)
     ->first();          
     
     $asalsekolah       = DB::table('asalsekolah')->orderBy('SekolahID','ASC')->get();
     $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs' => $detailmhs,              
                     'program'   => $program,
                     'prodi'     => $prodi,
                     'asalsekolah' => $asalsekolah,
                     'nimplh'    => $request->id,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_asalsekolah'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailasalpt($MhswID)
 {
     
     
     $mymhs      = new Mahasiswa_model();
     $detailmhs  = $mymhs->detail_mahasiswa($MhswID);        
     //dd($detailmhs->MhswID);
     $asalsekolah       = DB::table('asalsekolah')->orderBy('SekolahID','ASC')->get();
     $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    
     $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs'    => $detailmhs,              
                     'program'      => $program,
                     'prodi'        => $prodi,               
                     'asalsekolah'  => $asalsekolah,                 
                     'nimplh'       => $MhswID,
                     'content'      => 'admin/mahasiswa/mahasiswa_edit_asalpt'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailasalptsimpan(Request $request)
 {
     
     DB::table('mhsw')->where('MhswID',$request->id)->update([
        'AsalPT'      => $request->AsalPT,
        'ProdiAsalPT' => $request->ProdiAsalPT,
        'LulusUjian'  => $request->LulusUjian,
        'IPKAsalPT'   => $request->IPKAsalPT,
        'LoginEdit'   => Session()->get('id_user')
    ]);
     $detailmhs = DB::table('mhsw')
     ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
     ->select('mhsw.*', 'prodi.Nama as NamaProdi')
     ->where('mhsw.MhswID',$request->id)
     ->first();          
     
     $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
     $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                     'detailmhs' => $detailmhs,              
                     'program'   => $program,
                     'prodi'     => $prodi,
                     'nimplh'    => $request->id,
                     'content'   => 'admin/mahasiswa/mahasiswa_edit_asalpt'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailbank(Request $request, $MhswID)
 {
     
     //dd($MhswID);
     if (isset($_POST['submit'])){
        DB::table('mhsw')->where('MhswID',$request->id)->update([
            'NomerRekening'   => $request->NomerRekening,
            'NamaBank'        => $request->NamaBank,
            'LoginEdit'       => Session()->get('id_user')
        ]);
        $mymhs      = new Mahasiswa_model();
        $detailmhs  = $mymhs->detail_mahasiswa($MhswID);         
    
        $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
      
        $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                        'detailmhs'    => $detailmhs,
                        'program'      => $program,
                        'prodi'        => $prodi,                              
                        'nimplh'       => $MhswID,
                        'content'      => 'admin/mahasiswa/mahasiswa_edit_bank'
                    );
        return view('admin/layout/wrapper',$data);
     }else{  
        $mymhs      = new Mahasiswa_model();
        $detailmhs  = $mymhs->detail_mahasiswa($MhswID);          
    
        $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $site              = DB::table('identitas')->first();

        $data = array(  'title'     => 'NIM. '.$MhswID.' - '.$detailmhs->Nama.'- ('.$detailmhs->ProgramID.') '.$detailmhs->NamaProdi,
                        'detailmhs'    => $detailmhs,
                        'program'      => $program,
                        'prodi'        => $prodi,                              
                        'nimplh'       => $MhswID,
                        'content'      => 'admin/mahasiswa/mahasiswa_edit_bank'
                    );
        return view('admin/layout/wrapper',$data);
    }    
 }

    // Delete
    public function delete($MhswID)
    {
    	
    	DB::table('mhsw')->where('MhswID',$MhswID)->delete();
    	return redirect('admin/mahasiswa')->with(['sukses' => 'Data telah dihapus']);
    }

    //Angka Mahasiswa
    public function angkamahasiswa()
    {
        
        $prodi="SI";
        $tahun="20201";
        $data = array('title'     => 'MAHASISWA DALAM ANGKA',
                      'prodi'        => $prodi,    
                      'tahunx'        => '2020',                               
                      'content'      => 'admin/mahasiswa/angkamahasiswa'
                     );
        return view('admin/layout/wrapper',$data);
    }

    // Proses Angka Mahasiswa
    public function prosesangkamhs(Request $request)
    {
        if(isset($_POST['filter'])) {
            if($request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/mahasiswa/filterangkamhs/'.$request->prodi);
            }   
        }
    }
    
    public function filterangkamhs(Request $request) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
         
        $prodi   = $request->prodi;
        $tahun   ="2021";
        $data = array(  'title'     => 'ANGKA MAHASISWA BARU',
                        'prodi'	    => $prodi,
                        'tahunx'	=> $tahun,
                        'content'   => 'admin/mahasiswa/angkamahasiswa'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //Angka Lulusan
    public function angkalulusan()
    {
        
        $prodi="SI";
        $data = array('title'     => 'MAHASISWA DALAM ANGKA',
                      'prodi'        => $prodi,                               
                      'content'      => 'admin/mahasiswa/angkalulusan'
                     );
        return view('admin/layout/wrapper',$data);
    }
    
    public function filterangkalulusan(Request $request) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
         
        $prodi   = $request->prodi;
        $data = array(  'title'     => 'ANGKA MAHASISWA BARU',
                        'prodi'	    => $prodi,
                        'content'   => 'admin/mahasiswa/angkalulusan'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
