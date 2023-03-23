<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tahun_model;
use Image;


class Tahun extends Controller
{
    public function index()
    {
        
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;
        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh   = $prodix->ProdiID;
        $programx    = DB::table('program')->orderBy('ProgramID','DESC')->limit(1)->first(); 
        $programplh   = $programx->ProgramID;

        $prodi 	    = DB::table('prodi')->orderBy('Nama','ASC')->get();
        $program 	= DB::table('program')->orderBy('Nama','DESC')->get();
        // $tahun 	= DB::table('tahun')->where('ProdiID',$prodiplh)->where('ProgramID',$programplh)->orderBy('TahunID','DESC')->get();
        $mytahun    = new Tahun_model();
        $tahun      = $mytahun->tahun($programplh, $prodiplh);
        $data = array(  'title'      => 'TAHUN AKADEMIK',
                        'tahun'      => $tahun,
                        'prodi'      => $prodi,
                        'program'    => $program,
                        'programplh' => $programplh,
                        'prodiplh'   => $prodiplh,
                        'content'    => 'admin/tahun/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function proses(Request $request)
    {
        if(isset($_POST['filter'])) {
            if($request->prodi==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
            }else{
                return redirect('admin/tahun/filter/'.$request->prodi.'/'.$request->program);
            }   
        }
    }
    
   public function filter($prodix, $programx)
   {
       
       $prodi 	    = DB::table('prodi')->orderBy('Nama','ASC')->get();
       $program 	= DB::table('program')->orderBy('Nama','DESC')->get();
       $mytahun     = new Tahun_model();
       $tahun       = $mytahun->tahun($prodix, $programx);
       $data = array(  'title'     => 'TAHUN AKADEMIK',
                        'tahun'      => $tahun,
                        'prodi'      => $prodi,
                        'program'    => $program,
                        'programplh' => $programx,
                        'prodiplh'   => $prodix,
                        'content'   => 'admin/tahun/index'
                   );
       return view('admin/layout/wrapper',$data);
   }

    public function tambah($prodix, $programx)
    {
        
        $data = array(  'title'         => 'TAMBAH TAHUN AKADEMIK',
                        'prodiplh'      => $prodix,
                        'programplh'    => $programx,
                        'content'       => 'admin/tahun/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
        request()->validate([
                            'TahunID'  => 'required|unique:tahun',
                            'Nama'     => 'required',
                            ]);
        $NA = (empty($request['NA']))? 'N' : $request['NA'];
        DB::table('tahun')->insert([
            'TahunID'               => $request->TahunID,
            'KodeID'                => 'SISFO',
            'Nama'                  => $request->Nama,
            'ProdiID'               => $request->ProdiID,
            'ProgramID'             => $request->ProgramID,
            'TglKRSMulai'           => date('Y-m-d',strtotime($request->TglKRSMulai)),
            'TglKRSSelesai'         => date('Y-m-d',strtotime($request->TglKRSSelesai)),
            'TglKRSOnlineMulai'     => date('Y-m-d',strtotime($request->TglKRSOnlineMulai)),
            'TglKRSOnlineSelesai'   => date('Y-m-d',strtotime($request->TglKRSOnlineSelesai)),
            'TglBayarMulai'         => date('Y-m-d',strtotime($request->TglBayarMulai)),
            'TglBayarSelesai'       => date('Y-m-d',strtotime($request->TglBayarSelesai)),
            'TglUbahKRSMulai'       => date('Y-m-d',strtotime($request->TglUbahKRSMulai)),
            'TglUbahKRSSelesai'     => date('Y-m-d',strtotime($request->TglUbahKRSSelesai)),
            'TglCetakKSS1'          => date('Y-m-d',strtotime($request->TglCetakKSS1)),
            'TglCetakKSS2'          => date('Y-m-d',strtotime($request->TglCetakKSS2)),
            'TglCuti'               => date('Y-m-d',strtotime($request->TglCuti)),
            'TglMundur'             => date('Y-m-d',strtotime($request->TglMundur)),
            'TglBayarMulai'         => date('Y-m-d',strtotime($request->TglBayarMulai)),
            'TglBayarSelesai'       => date('Y-m-d',strtotime($request->TglBayarSelesai)),
            'TglAutodebetSelesai'   => date('Y-m-d',strtotime($request->TglAutodebetSelesai)),
            'TglAutodebetSelesai2'  => date('Y-m-d',strtotime($request->TglAutodebetSelesai2)),
            'TglKembaliUangKuliah'  => date('Y-m-d',strtotime($request->TglKembaliUangKuliah)),
            'TglKuliahMulai'        => date('Y-m-d',strtotime($request->TglKuliahMulai)),
            'TglKuliahSelesai'      => date('Y-m-d',strtotime($request->TglKuliahSelesai)),
            'TglUTSMulai'           => date('Y-m-d',strtotime($request->TglUTSMulai)),
            'TglUTSSelesai'         => date('Y-m-d',strtotime($request->TglUTSSelesai)),
            'TglUASMulai'           => date('Y-m-d',strtotime($request->TglUASMulai)),
            'TglUASSelesai'         => date('Y-m-d',strtotime($request->TglUASSelesai)),
            'TglNilai'              => date('Y-m-d',strtotime($request->TglNilai)),
            'TglAkhirKSS'              => date('Y-m-d',strtotime($request->TglAkhirKSS)),
            'Catatan'               => $request->Catatan,
            'TglBuat'               => date('Y-m-d'),
            'LoginBuat'             => Session()->get('username'),
            'NA'                    => $NA
        ]);
        return redirect('admin/tahun')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit($tahunx, $prodix, $programx)
    {
        
        $tahun    = DB::table('tahun')->where('TahunID',$tahunx)->first();

        $data = array(  'title'            => 'EDIT TAHUN AKADEMIK',
                        'tahun'            => $tahun,
                        'prodiplh'         => $prodix,
                        'programplh'       => $programx,
                        'content'          => 'admin/tahun/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }
    // edit
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                            'TahunID'   => 'required',
                            'Nama'           => 'required',
                            ]);
            $NA = (empty($request['NA']))? 'N' : $request['NA'];   
                         
            DB::table('tahun')->where('TahunID',$request->TahunID)->update([
                'TglKRSMulai'           => date('Y-m-d',strtotime($request->TglKRSMulai)),
                'TglKRSSelesai'         => date('Y-m-d',strtotime($request->TglKRSSelesai)),
                'TglKRSOnlineMulai'     => date('Y-m-d',strtotime($request->TglKRSOnlineMulai)),
                'TglKRSOnlineSelesai'   => date('Y-m-d',strtotime($request->TglKRSOnlineSelesai)),
                'TglBayarMulai'         => date('Y-m-d',strtotime($request->TglBayarMulai)),
                'TglBayarSelesai'       => date('Y-m-d',strtotime($request->TglBayarSelesai)),
                'TglUbahKRSMulai'       => date('Y-m-d',strtotime($request->TglUbahKRSMulai)),
                'TglUbahKRSSelesai'     => date('Y-m-d',strtotime($request->TglUbahKRSSelesai)),
                'TglCetakKSS1'          => date('Y-m-d',strtotime($request->TglCetakKSS1)),
                'TglCetakKSS2'          => date('Y-m-d',strtotime($request->TglCetakKSS2)),
                'TglCuti'               => date('Y-m-d',strtotime($request->TglCuti)),
                'TglMundur'             => date('Y-m-d',strtotime($request->TglMundur)),
                'TglBayarMulai'         => date('Y-m-d',strtotime($request->TglBayarMulai)),
                'TglBayarSelesai'       => date('Y-m-d',strtotime($request->TglBayarSelesai)),
                'TglAutodebetSelesai'   => date('Y-m-d',strtotime($request->TglAutodebetSelesai)),
                'TglAutodebetSelesai2'  => date('Y-m-d',strtotime($request->TglAutodebetSelesai2)),
                'TglKembaliUangKuliah'  => date('Y-m-d',strtotime($request->TglKembaliUangKuliah)),
                'TglKuliahMulai'        => date('Y-m-d',strtotime($request->TglKuliahMulai)),
                'TglKuliahSelesai'      => date('Y-m-d',strtotime($request->TglKuliahSelesai)),
                'TglUTSMulai'           => date('Y-m-d',strtotime($request->TglUTSMulai)),
                'TglUTSSelesai'         => date('Y-m-d',strtotime($request->TglUTSSelesai)),
                'TglUASMulai'           => date('Y-m-d',strtotime($request->TglUASMulai)),
                'TglUASSelesai'         => date('Y-m-d',strtotime($request->TglUASSelesai)),
                'TglNilai'              => date('Y-m-d',strtotime($request->TglNilai)),
                'TglAkhirKSS'           => date('Y-m-d',strtotime($request->TglAkhirKSS)),
                'Catatan'               => $request->Catatan,
                'TglEdit'               => date('Y-m-d'),
                'LoginEdit'             => Session()->get('username'),
                'NA'                    => $NA
            ]);
        return redirect('admin/tahun')->with(['sukses' => 'Data telah diubah']);
    }


    public function buka($tahunx, $prodix, $programx)
    {
        
       
        $khs = [];
        $mhs = \DB::table('mhsw')
                    ->where('ProdiID',$prodix)
                    ->where('ProgramID',$programx)
                    ->where('NA','N')
                    ->get();         
        foreach ($mhs as $key => $value) { 
            if(!empty($value->MhswID)){
                $sdh = \DB::table('khs')->where('MhswID',$value->MhswID)->where('TahunID',$tahunx)->row();//->where('ProdiID',$prodix)->where('ProgramID',$programx)  
                //dd($sdh);
                if (empty($sdh)) {
                        $khs[] = [
                        'TahunID'       =>  $tahunx,
                        'KodeID'        =>  'SISFO',
                        'ProgramID'     =>  $programx,
                        'ProdiID'       =>  $prodix,
                        'MhswID'        =>  $value->MhswID];
                          
                }     
                \DB::table('khs')->insert($khs); 
            }
        }
        return redirect('admin/tahun/filter/'.$prodix.'/'.$programx);
    }

    public function delete($id_setuppmb)
    {
        
        DB::table('setuppmb')->where('id_setuppmb',$id_setuppmb)->delete();
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah dihapus']);
    }
}
