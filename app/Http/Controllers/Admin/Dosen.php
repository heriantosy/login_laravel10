<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen_model;
use App\Models\Prodi_model;
use Illuminate\Support\Str;
use Image;

class Dosen extends Controller
{
    public function index()
    {
    	
        $prodix       = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh     = $prodix->ProdiID;

        //menggunakan Query Builder 
        //$mydosen= new Dosen_model();
        //$dosen  = $mydosen->dosen_all();
        
        //menggunakan Eloquent
		//$dosen = Dosen_model::latest()->limit(10)->get();	
		//$dosen = Dosen_model::all()->limit(10)->get();	
        //$dosen = Dosen_model::get();	
		$dosen = Dosen_model::where('NA','N')->where('Homebase', '311')->orderBy('Login', 'desc')->get();

        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'DATA DOSEN',
                        'dosen'	    => $dosen,
                        'prodi'	    => $prodi,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/dosen/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah()
    {
        
        
        $agama = DB::table('agama')->orderBy('Agama','ASC')->get();   
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();       
        $data = array(  'title'     => 'TAMBAH MASTER DOSEN', 
                        'agama'     => $agama,     
                        'prodi'	    => $prodi,     
                        'content'   => 'admin/dosen/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
        
        // request()->validate([
        //                     'judul_download'  => 'required|unique:download',
        //                     'gambar'          => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
        //                     ]);
        DB::table('dosen')->insert([
            'Login'         => $request->Login,
            'NIDN'          => $request->NIDN,
            'Homebase'      => $request->Homebase,
            'Nama'          => $request->Nama,
            'TempatLahir'   => $request->TempatLahir,
            'TanggalLahir'  => $request->TanggalLahir,
            'KelaminID'     => $request->KelaminID,
            'Negara'        => $request->Negara,
            'AgamaID'       => $request->AgamaID,
            'Alamat'        => $request->Alamat,
            'Kota'          => $request->Kota,
            'Propinsi'      => $request->Propinsi,
            'Negara'        => $request->Negara,
            'Telephone'     => $request->Telephone,
            'Email'         => $request->Email,
            'LoginBuat'     => Session()->get('id_user'),
            'TanggalBuat'   => date('Y-m-d')
        ]);
        return redirect('admin/dosen')->with(['sukses' => 'Data telah ditambah']);
    }
    

    public function editfotodosen($Login)
    {
        
        
        $detaildosen = DB::table('dosen')->where('Login',$Login)->first();          
        $data = array(  'title'     => 'Login. '.$Login.' - '.$detaildosen->Nama.' - '.$detaildosen->Homebase,
                        'detaildosen'    => $detaildosen, 
                        'loginplh'      => $Login,            
                        'content'   => 'admin/dosen/dosen_edit_foto'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function editfotodosensimpan(Request $request)
    {
        
        request()->validate([
            'FotoBro'   => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);

        $image                  = $request->file('FotoBro');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('FotoBro')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/dosen/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/dosen/';
            $image->move($destinationPath, $input['nama_file']);

        DB::table('dosen')->where('Login',$request->Login)->update([
            'FotoBro'        => $input['nama_file'],
            'LoginEdit'   => Session()->get('id_user')
        ]);

        $detaildosen = DB::table('dosen')
        ->select('dosen.*')->where('Login',$request->Login)->first();          
  
        $data = array(  'title'     => 'Login. '.$request->Login.' - '.$detaildosen->Nama.','.$detaildosen->Gelar,
                        'detaildosen'    => $detaildosen,             
                        'loginplh'      => $request->Login,
                        'content'   => 'admin/dosen/dosen_edit_foto'
                    );
        return view('admin/layout/wrapper',$data);
    }
    }

 // Proses
 public function proses(Request $request)
 {
     if(isset($_POST['filter'])) {
         if($request->prodi==''){
             return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
         }else{
             return redirect('admin/dosen/filter/'.$request->prodi);
         }   
     }
 }
 
public function filter($prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
    
    $prodiplh   = $prodi;
    
    //dengan Query Builder
    //$mydosen= new Dosen_model();
    //$dosen  = $mydosen->dosen_prodi($prodi);
    //$prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    //dengan Eloquent
    $dosen = Dosen_model::where('NA','N')->where('Homebase', $prodi)->orderBy('Login', 'desc')->get();
    $prodi = Prodi_model::where('NA', 'N')->get();
    $data = array(  'title'     => 'Data dosen',
                    'dosen'	    => $dosen,
                    'prodi'	    => $prodi,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/dosen/index'
                );
    return view('admin/layout/wrapper',$data);
}

 public function detailakademik($Login)
 {
     
     
     $mydosen= new Dosen_model();
     $detaildosen  = $mydosen->detail_dosen($Login);    
     $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
     $statusdosen     = DB::table('statusdosen')->orderBy('StatusDosenID','ASC')->get();
     $statuskerja     = DB::table('statuskerja')->orderBy('StatusKerjaID','ASC')->get();
     $jenjang     = DB::table('jenjang')->orderBy('JenjangID','ASC')->get();
     $data = array(  'title'        => 'Login. '.$Login.' - '.$detaildosen->Nama.' - '.$detaildosen->Homebase,
                     'detaildosen'  => $detaildosen,             
                     'dosen'        => $dosen,
                     'statusdosen'	    => $statusdosen,
                     'statuskerja'	    => $statuskerja,
                     'prodi'	    => $prodi,
                     'jenjang'	    => $jenjang,
                     'loginplh'     => $Login,
                     'content'      => 'admin/dosen/dosen_edit_akademik'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function simpaneditakademik(Request $request)
 {
     
     DB::table('mhsw')->where('Login',$request->id)->update([
        'BatasStudi'    => $request->BatasStudi,
        'StatusAwalID'  => $request->StatusAwalID,
        'StatusMhswID'  => $request->StatusMhswID,
        'PenasehatAkademik'  => $request->PenasehatAkademik,
        'LoginEdit'     => Session()->get('id_user')
    ]);

    $detaildosen = DB::table('mhsw')
    ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
    ->select('mhsw.*', 'prodi.Nama as NamaProdi')
    ->where('mhsw.Login',$request->id)
    ->first();  

    $program   = DB::table('program')->orderBy('ProgramID','ASC')->get();
    $prodi     = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $statusawal= DB::table('statusawal')->orderBy('StatusAwalID','ASC')->get();
    $statusmhs = DB::table('statusmhsw')->orderBy('StatusMhswID','ASC')->get();
    $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
    

    $data = array(  'title'     => 'NIM. '.$request->id.' - '.$detaildosen->Nama.'- ('.$detaildosen->ProgramID.') '.$detaildosen->NamaProdi,
                    'detaildosen'    => $detaildosen,             
                    'program'      => $program,
                    'prodi'      => $prodi,
                    'statusawal'      => $statusawal,
                    'statusmhs'      => $statusmhs,
                    'dosen'      => $dosen,
                    'nimplh'     => $request->id,
                     'content'   => 'admin/dosen/mahasiswa_edit_akademik'
                 );
     return view('admin/layout/wrapper',$data);
 }


 public function detailalamat($Login)
 {
     
     
     $mydosen= new Dosen_model();
     $detaildosen  = $mydosen->detail_dosen($Login);   
     $agama     = DB::table('agama')->orderBy('Agama','ASC')->get();
     $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
     $data = array(  'title'        => 'Login. '.$Login.' - '.$detaildosen->Nama.'-'.$detaildosen->Gelar,
                     'detaildosen'  => $detaildosen,
                     'kelamin'  => $kelamin,
                     'agama'  => $agama,
                     'loginplh'     => $Login,
                     'content'      => 'admin/dosen/dosen_edit_alamat'
                 );
     return view('admin/layout/wrapper',$data);
 }


 public function detailalamatsimpan(Request $request)
 {
     
     DB::table('dosen')->where('Login',$request->Login)->update([
        'Alamat'            => $request->Alamat,     
        'Kota'              => $request->Kota,
        'Propinsi'          => $request->Propinsi,
        'Negara'            => $request->Negara,
        'Telephone'           => $request->Telephone,
        'KTP'               => $request->KTP,
        'LoginEdit'          => Session()->get('id_user')
    ]);
    $detaildosen = DB::table('dosen')->where('Login',$request->Login)->first();  
    $agama     = DB::table('agama')->orderBy('Agama','ASC')->get();
    $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
    $data = array(  'title'        => 'Login. '.$request->Login.' - '.$detaildosen->Nama.'-'.$detaildosen->Gelar,
                    'detaildosen'  => $detaildosen,
                    'kelamin'  => $kelamin,
                    'agama'  => $agama,
                    'loginplh'     => $request->Login,
                    'content'      => 'admin/dosen/dosen_edit_alamat'
                );
     return view('admin/layout/wrapper',$data);
 }


 //bisa gunakan variabel $id atau $Login untuk menampung nilai dari route
 public function detailpribadi($id)
 {
     
     
     $mydosen= new Dosen_model();
     $detaildosen  = $mydosen->detail_dosen($id);   
     $agama     = DB::table('agama')->orderBy('Agama','ASC')->get();
     $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
     $data = array(  'title'        => 'Login. '.$id.' - '.$detaildosen->Nama.'-'.$detaildosen->Gelar,
                     'detaildosen'  => $detaildosen,
                     'kelamin'  => $kelamin,
                     'agama'  => $agama,
                     'loginplh'     => $id,
                     'content'      => 'admin/dosen/dosen_edit_pribadi'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailpribadisimpan(Request $request)
 {
     
     DB::table('dosen')->where('Login',$request->id)->update([
        'Nama'    => $request->Nama,
        'TempatLahir'  => $request->TempatLahir,
        'TanggalLahir'  => $request->TanggalLahir,
        'KelaminID'  => $request->KelaminID,
        'Negara'  => $request->Negara,
        'AgamaID'  => $request->AgamaID,
        'Alamat'  => $request->Alamat,
        'Kota'  => $request->Kota,
        'Propinsi'  => $request->Propinsi,
        'Negara'  => $request->Negara,
        'Telephone'  => $request->Telephone,
        'Email'  => $request->Email,
        'LoginEdit'     => Session()->get('id_user')
    ]); 

    $detaildosen = DB::table('dosen')->where('Login',$request->id)->first();  
    $kelamin     = DB::table('kelamin')->orderBy('Kelamin','ASC')->get();
    $warganegara = DB::table('warganegara')->orderBy('WargaNegara','ASC')->get();
    $agama       = DB::table('agama')->orderBy('Agama','ASC')->get();
    
    $data = array(  'title'     => 'Login. '.$request->id.' - '.$detaildosen->Nama.'-'.$detaildosen->Gelar,
                    'detaildosen'  => $detaildosen,                            
                    'kelamin'      => $kelamin,
                    'warganegara'  => $warganegara,
                    'agama'        => $agama,                 
                    'loginplh'     => $request->id,
                     'content'   => 'admin/dosen/dosen_edit_pribadi'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailjabatan($Login)
 {
     
     
     $mydosen      = new Dosen_model();
     $detaildosen  = $mydosen->detail_dosen($Login);       
     $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
     $dosen     = DB::table('dosen')->orderBy('Login','ASC')->get();
     $statusdosen     = DB::table('statusdosen')->orderBy('StatusDosenID','ASC')->get();
     $statuskerja     = DB::table('statuskerja')->orderBy('StatusKerjaID','ASC')->get();
     $jenjang     = DB::table('jenjang')->orderBy('JenjangID','ASC')->get();
     $jabatan     = DB::table('jabatan')->orderBy('JabatanID','ASC')->get();
     $golongan     = DB::table('golongan')->orderBy('GolonganID','ASC')->get();
     $ikatan     = DB::table('ikatan')->orderBy('IkatanID','ASC')->get();
     $jabatandikti     = DB::table('jabatandikti')->orderBy('JabatanDiktiID','ASC')->get();
     $data = array(  'title'        => 'Login. '.$Login.' - '.$detaildosen->Nama.' - '.$detaildosen->Homebase,
                     'detaildosen'  => $detaildosen,             
                     'dosen'        => $dosen,
                     'statusdosen'	    => $statusdosen,
                     'statuskerja'	    => $statuskerja,
                     'prodi'	    => $prodi,
                     'ikatan'	    => $ikatan,
                     'golongan'	    => $golongan,
                     'jabatan'	    => $jabatan,
                     'jenjang'	    => $jenjang,
                     'jabatandikti'	    => $jabatandikti,
                     'loginplh'     => $Login,
                     'content'      => 'admin/dosen/dosen_edit_jabatan'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailpengajaran($Login)
 {
            
     $mydosen= new Dosen_model();
     $detaildosen  = $mydosen->detail_dosen($Login);   
     $data = array(  'title'        => 'Login. '.$Login.' - '.$detaildosen->Nama.'-'.$detaildosen->Gelar,
                     'detaildosen'  => $detaildosen,
                     'loginplh'     => $Login,
                     'content'      => 'admin/dosen/dosen_pengajaran'
                 );
     return view('admin/layout/wrapper',$data);
 }

 public function detailbank(Request $request, $Login)
 {
     
     //dd($Login);
     if (isset($_POST['submit'])){
        DB::table('mhsw')->where('Login',$request->id)->update([
            'NomerRekening'   => $request->NomerRekening,
            'NamaBank'        => $request->NamaBank,
            'LoginEdit'       => Session()->get('id_user')
        ]);
        $detaildosen = DB::table('mhsw')
        ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
        ->select('mhsw.*', 'prodi.Nama as NamaProdi')
        ->where('mhsw.Login',$Login)
        ->first();          
    
        $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
      
        $data = array(  'title'     => 'NIM. '.$Login.' - '.$detaildosen->Nama.'- ('.$detaildosen->ProgramID.') '.$detaildosen->NamaProdi,
                        'detaildosen'    => $detaildosen,
                        'program'      => $program,
                        'prodi'        => $prodi,                              
                        'loginplh'       => $Login,
                        'content'      => 'admin/dosen/mahasiswa_edit_bank'
                    );
        return view('admin/layout/wrapper',$data);
     }else{  
        $detaildosen = DB::table('mhsw')
        ->join('prodi', 'prodi.ProdiID', '=', 'mhsw.ProdiID')
        ->select('mhsw.*', 'prodi.Nama as NamaProdi')
        ->where('mhsw.Login',$Login)
        ->first();          
    
        $program           = DB::table('program')->orderBy('ProgramID','ASC')->get();
        $prodi             = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $site              = DB::table('identitas')->first();

        $data = array(  'title'     => 'NIM. '.$Login.' - '.$detaildosen->Nama.'- ('.$detaildosen->ProgramID.') '.$detaildosen->NamaProdi,
                        'detaildosen'    => $detaildosen,
                        'program'      => $program,
                        'prodi'        => $prodi,                              
                        'nimplh'       => $Login,
                        'content'      => 'admin/dosen/mahasiswa_edit_bank'
                    );
        return view('admin/layout/wrapper',$data);
    }    
 }

    // Delete
    public function delete($Login)
    {
    	
    	DB::table('mhsw')->where('Login',$Login)->delete();
    	return redirect('admin/dosen')->with(['sukses' => 'Data telah dihapus']);
    }

    //Angka dosen
    public function angkamahasiswa()
    {
        
        $prodi="SI";
        $data = array('title'     => 'dosen DALAM ANGKA',
                      'prodi'        => $prodi,                               
                      'content'      => 'admin/dosen/angkamahasiswa'
                     );
        return view('admin/layout/wrapper',$data);
    }

    // Proses Angka dosen
    public function prosesangkamhs(Request $request)
    {
        if(isset($_POST['filter'])) {
            if($request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/dosen/filterangkamhs/'.$request->prodi);
            }   
        }
    }
    
    public function filterangkamhs($prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
         
        $prodi   = $prodi;
        $data = array(  'title'     => 'ANGKA dosen BARU',
                        'prodi'	    => $prodi,
                        'content'   => 'admin/dosen/angkamahasiswa'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //Angka Lulusan
    public function angkalulusan()
    {
        
        $prodi="SI";
        $data = array('title'     => 'dosen DALAM ANGKA',
                      'prodi'        => $prodi,                               
                      'content'      => 'admin/dosen/angkalulusan'
                     );
        return view('admin/layout/wrapper',$data);
    }

    // Proses Angka dosen
    public function prosesangkalulusan(Request $request)
    {
        if(isset($_POST['filter'])) {
            if($request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/dosen/filterangkalulusan/'.$request->prodi);
            }   
        }
    }
    
    public function filterangkalulusan($prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
         
        $prodi   = $prodi;
        $data = array(  'title'     => 'ANGKA dosen BARU',
                        'prodi'	    => $prodi,
                        'content'   => 'admin/dosen/angkalulusan'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
