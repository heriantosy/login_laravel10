<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Image;


class Ruang extends Controller
{
    public function index()
    {
    	
        //$ruang 	= DB::table('ruang')->orderBy('Nama','ASC')->get();
        $myruang    = new Master_model();
        $ruang      = $myruang->ruang_all();
        $kampus 	= DB::table('kampus')->orderBy('Nama','ASC')->get();
        $kampusplh="Kamp03";
		$data = array(  'title'      => 'DATA RUANGAN KAMPUS: '.$kampusplh,
                        'ruang'      => $ruang,
                        'kampus'     => $kampus,
                        'kampusplh'   => $kampusplh,
                        'content'    => 'admin/ruang/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

   public function proses(Request $request)
   {
       $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
           if($request->kampus==''){
               return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filter']);
           }else{
               return redirect('admin/ruang/filter/'.$request->kampus);
           }
       }
   }

   public function filter($kampus) 
   {
       
       $kampusx      = $kampus;
       $ruang = DB::table('ruang')->where('KampusID',$kampusx)->get(); //->whereBetween('pmb.TglBuat', [$tgl_mulai, $tgl_selesai])
       $kampus 	= DB::table('kampus')->orderBy('Nama','ASC')->get();
       $data = array(  'title'     => 'DATA RUANGAN KAMPUS: '.$kampusx,
                        'ruang'      => $ruang,
                        'kampus'     => $kampus,
                        'kampusplh'   => $kampusx,
                        'content'   => 'admin/ruang/index'
                    );
       return view('admin/layout/wrapper',$data);
   }

   public function tambah()
   {
       
       $kampus 	= DB::table('kampus')->orderBy('Nama','ASC')->get(); 

       $data = array(  'title'             => 'Tambah Data',
                       'kampus'            => $kampus,
                       'content'           => 'admin/ruang/tambah'
                   );
       return view('admin/layout/wrapper',$data);
   }

   public function tambah_proses(Request $request)
   {
       
          request()->validate([
                           'RuangID' => 'required|unique:ruang',
                           'Nama' => 'required',
                           'Kapasitas'  => 'required',
                           ]);
           $kampus 	= DB::table('kampus')->orderBy('Nama','ASC')->get(); 
           DB::table('ruang')->insert([
               'KampusID'        => $request->KampusID,
               'RuangID'         => $request->RuangID,
               'Nama'            => $request->Nama,
               'Lantai'          => $request->Lantai,
               'ProdiID'          => '.SI.TI.',
               'RuangKuliah'     => $request->RuangKuliah,
               'Kapasitas'       => $request->Kapasitas,
               'KapasitasUjian'  => $request->KapasitasUjian,
               'KolomUjian'      => $request->KolomUjian,
               'UntukUSM'        => $request->UntukUSM,
               'Keterangan'      => $request->Keterangan,
               'NA'              => $request->NA
           ]);
       
       return redirect('admin/ruang')->with(['sukses' => 'Data telah ditambah']);
   }

       public function edit($idx)
       {
           
           $myruang   = new Master_model();
           $ruang     = $myruang->ruang_detail($idx);
           $kampus    = DB::table('kampus')->orderBy('KampusID','ASC')->get();
           $data = array(  'title'     => 'Edit Ruang',
                           'kampus'    => $kampus,
                           'ruang'     => $ruang,
                           'content'   => 'admin/ruang/edit'
                       );
           return view('admin/layout/wrapper',$data);
       }
   
    public function proses_edit(Request $request)
    {
        
            request()->validate([
                            'RuangID'   => 'required',
                            'Nama'      => 'required',
                            'Kapasitas' => 'required',
                            ]);

            $RuangKuliah = (empty($_POST['RuangKuliah']))? 'N' : $_POST['RuangKuliah']; 
            $UntukUSM    = (empty($_POST['UntukUSM']))? 'N' : $_POST['UntukUSM'];                
            $NA          = (empty($_POST['NA']))? 'N' : $_POST['NA'];
            DB::table('ruang')->where('RuangID',$request->id)->update([
                'KampusID'        => $request->KampusID,
                'RuangID'         => $request->RuangID,
                'Nama'            => $request->Nama,
                'Lantai'          => $request->Lantai,
                'RuangKuliah'     => $RuangKuliah,
                'Kapasitas'       => $request->Kapasitas,
                'KapasitasUjian'  => $request->KapasitasUjian,
                'KolomUjian'      => $request->KolomUjian,
                'UntukUSM'        => $UntukUSM,
                'Keterangan'      => $request->Keterangan,
                'NA'              => $NA
            ]);

        return redirect('admin/ruang');
    }
    
   


    // Delete
    public function delete($id_setuppmb)
    {
        
        DB::table('setuppmb')->where('id_setuppmb',$id_setuppmb)->delete();
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah dihapus']);
    }
}
