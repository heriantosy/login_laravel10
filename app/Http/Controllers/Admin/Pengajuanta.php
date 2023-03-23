<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class Pengajuanta extends Controller
{
    public function index()
    {
    	
        $tahunak    = DB::table('tahun')->orderBy('TahunID','DESC')->limit(1)->first(); 
        $tahunplh   =$tahunak->TahunID;

        $prodix    = DB::table('prodi')->orderBy('ProdiID','DESC')->limit(1)->first(); 
        $prodiplh  = $prodix->ProdiID;   
        $pengajuanta = DB::table('t_penelitian')
        ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
        ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('t_penelitian.TahunID',$tahunplh)
        ->where('t_penelitian.ProdiID',$prodiplh)
        ->orderBy('t_penelitian.IDPenelitian','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
		$data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                        'pengajuanta'	=> $pengajuanta,
                        'tahun'	=> $tahun,
                        'prodi'	=> $prodi,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,
                        'content'   => 'admin/pengajuanta/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

 public function proses(Request $request)
 {
     if(isset($_POST['filter'])) {
         if($request->tahun=='' || $request->prodi==''){
             return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
         }
         elseif(isset($_POST['terima'])) {
            $id_pemesanannya       = $request->id_pemesanan;
            for($i=0; $i < sizeof($id_pemesanannya);$i++) {
                DB::table('pemesanan')->where('id_pemesanan',$id_pemesanannya[$i])->update([
                        'id_user'           => Session()->get('id_user'),
                        'status_pemesanan'  => $request->status_pemesanan
                    ]);
            }
            return redirect($pengalihan)->with(['sukses' => 'Data kategori telah diubah']);
        }else{
             return redirect('admin/pengajuanta/filter/'.$request->tahun.'/'.$request->prodi);
         }   
     }
 }
 
public function filter($tahun,$prodi) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
{
      
    $tahunplh   = $tahun;
    $prodiplh   = $prodi;
    //$dosenplh     = "1008068202";
    $pengajuanta = DB::table('t_penelitian')
        ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
        ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
        ->where('t_penelitian.TahunID',$tahunplh)
        ->where('t_penelitian.ProdiID',$prodiplh)
        ->orderBy('t_penelitian.IDPenelitian','DESC')
        ->get();
        $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
        $prodi 	= DB::table('prodi')->orderBy('ProdiID','ASC')->get();
       
        $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                        'pengajuanta'=> $pengajuanta,
                        'tahun'	    => $tahun,
                        'prodi'	    => $prodi,
                        //'dosen'	    => $dosen,
                        'tahunplh'	=> $tahunplh,
                        'prodiplh'	=> $prodiplh,                  
                        'content'   => 'admin/pengajuanta/index'
                     );
    return view('admin/layout/wrapper',$data);
}

public function diterima($tahunplh, $prodiplh)
{
    
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$tahunplh)
    ->where('t_penelitian.ProdiID',$prodiplh)
    ->where('t_penelitian.Status','DITERIMA')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	=> $tahun,
                    'prodi'	=> $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/pengajuanta/index'
                );
    return view('admin/layout/wrapper',$data);
}

public function terimax($IDX,$tahunplh,$prodiplh)
{
    
    DB::table('t_penelitian')->where('IDPenelitian',$IDX)->update([
        'Status'           => 'DITERIMA'
    ]);
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$tahunplh)
    ->where('t_penelitian.ProdiID',$prodiplh)
    ->where('t_penelitian.Status','DITOLAK')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	=> $tahun,
                    'prodi'	=> $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/pengajuanta/index'
                );
                return redirect('admin/pengajuanta/diterima/'.$tahunplh.'/'.$prodiplh);
}

public function ditolak($tahunplh, $prodiplh)
{
    
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$tahunplh)
    ->where('t_penelitian.ProdiID',$prodiplh)
    ->where('t_penelitian.Status','DITOLAK')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'         => 'PENGAJUAN JUDUL SKRIPSI',
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	        => $tahun,
                    'prodi'	        => $prodi,
                    'tahunplh'	    => $tahunplh,
                    'prodiplh'	    => $prodiplh,
                    'content'       => 'admin/pengajuanta/index'
                );
    return view('admin/layout/wrapper',$data);
}

public function tolakx($IDX,$tahunplh,$prodiplh)
{
    
    DB::table('t_penelitian')->where('IDPenelitian',$IDX)->update([
        'Status'           => 'DITOLAK'
    ]);
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$tahunplh)
    ->where('t_penelitian.ProdiID',$prodiplh)
    ->where('t_penelitian.Status','DITOLAK')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	=> $tahun,
                    'prodi'	=> $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/pengajuanta/index'
                );
    return redirect('admin/pengajuanta/diterima/'.$tahunplh.'/'.$prodiplh);
}


public function simpankomentar(Request $request)
{
    
    DB::table('t_penelitian')->where('IDPenelitian',$request->id)->update([
        'Komentar'              => $request->Komentar,
        'Judul'                 => $request->Judul,
        'TempatPenelitian'      => $request->TempatPenelitian,
        'Pembimbing1'           => $request->Pembimbing1,
        'Pembimbing2'           => $request->Pembimbing2
    ]);
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$request->tahun)
    ->where('t_penelitian.ProdiID', $request->prodi)
    ->where('t_penelitian.Status','DITOLAK')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI', 
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	        => $tahun,
                    'prodi'	        => $prodi,
                    'tahunplh'	    => $request->tahun,
                    'prodiplh'	    => $request->prodi,
                    'content'       => 'admin/pengajuanta/index'
                );
    return redirect('admin/pengajuanta/diterima/'.$request->tahun.'/'.$request->prodi);
}

public function tambah($tahunx, $prodix)
{
    
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $dosen      = DB::table('dosen')->where('NA','N')->orderBy('Nama','ASC')->get();
    $data = array(  'title'         => 'PENGAJUAN JUDUL SKRIPSI : '.$prodix,                       
                    'tahun'         => $tahun,
                    'prodi'         => $prodi,
                    'dosen'         => $dosen,
                    'tahunplh'      => $tahunx, 
                    'prodiplh'      => $prodix,  
                    'content'       => 'admin/pengajuanta/tambah'
                );
    return view('admin/layout/wrapper',$data);
}

public function tambah_proses(Request $request)
{

request()->validate([
    'Judul'     => 'required',
     ]);
        DB::table('t_penelitian')->insert([
            'TahunID'           => $request->TahunID,
            'ProdiID'           => $request->ProdiID,
            'MhswID'            => $request->MhswID,
            'Judul'             => $request->Judul,
            'TempatPenelitian'  => $request->TempatPenelitian,
            'Abstrak'           => $request->Abstrak,
            'URLX'              => $request->URLX,
            'Pembimbing1'       => $request->Pembimbing1,
            'Pembimbing2'       => $request->Pembimbing2,
            'Kota'              => $request->Kota,
            'Ke'                => $request->Ke,
            'TglPengajuan'      => date('Y-m-d')
        ]);
return redirect('admin/pengajuanta/filter/'.$request->TahunID.'/'.$request->ProdiID);
}

public function edit($id)
{
    
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.IDPenelitian',$id)
    ->first();
    $dosen = DB::table('dosen')->where('NA','N')->get();  
    $data  = array(  'title'       => 'Edit Pengajuan',
                    'pengajuanta' => $pengajuanta,
                    'dosen'       => $dosen,
                    'content'     => 'admin/pengajuanta/edit'
                );
    return view('admin/layout/wrapper',$data);
}

public function edit_proses(Request $request)
{
    
    request()->validate([
            'Judul'               => 'required',
            'TempatPenelitian'    => 'required',
            ]);
         
    DB::table('t_penelitian')->where('IDPenelitian',$request->id)->update([
        'TahunID'           => $request->TahunID,
        'ProdiID'           => $request->ProdiID,
        'MhswID'            => $request->MhswID,
        'Judul'             => $request->Judul,
        'TempatPenelitian'  => $request->TempatPenelitian,
        'Abstrak'           => $request->Abstrak,
        'URLX'              => $request->URLX,
        'Pembimbing1'       => $request->Pembimbing1,
        'Pembimbing2'       => $request->Pembimbing2,
        'Kota'              => $request->Kota,
        'Ke'                => $request->Ke
    ]);
    return redirect('admin/pengajuanta/filter/'.$request->TahunID.'/'.$request->ProdiID);
}

public function prosesnilaita($IDX,$tahunplh,$prodiplh)
{
    
    DB::table('t_penelitian')->where('IDPenelitian',$IDX)->update([
        'Status'           => 'DITOLAK'
    ]);
    $pengajuanta = DB::table('t_penelitian')
    ->join('mhsw', 'mhsw.MhswID', '=', 't_penelitian.MhswID')
    ->select('t_penelitian.*','mhsw.Nama as NamaMhs','mhsw.Handphone')
    ->where('t_penelitian.TahunID',$tahunplh)
    ->where('t_penelitian.ProdiID',$prodiplh)
    ->where('t_penelitian.Status','DITOLAK')
    ->orderBy('t_penelitian.MhswID','DESC')
    ->get();
    $tahun      = DB::table('tahun')->orderBy('TahunID','DESC')->get();
    $prodi 	    = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
    $data = array(  'title'     => 'PENGAJUAN JUDUL SKRIPSI',
                    'pengajuanta'	=> $pengajuanta,
                    'tahun'	=> $tahun,
                    'prodi'	=> $prodi,
                    'tahunplh'	=> $tahunplh,
                    'prodiplh'	=> $prodiplh,
                    'content'   => 'admin/pengajuanta/index'
                );
    return redirect('admin/pengajuanta/diterima/'.$tahunplh.'/'.$prodiplh);
}

    public function delete($IDX,$tahunplh,$prodiplh)
    {
        
        DB::table('t_penelitian')->where('IDPenelitian',$IDX)->delete();
        return redirect('admin/pengajuanta/ditolak/'.$tahunplh.'/'.$prodiplh);
    }
}
