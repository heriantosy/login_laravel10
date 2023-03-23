<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\setuppmb_model;

class Setuppmb extends Controller
{
    // Main page
    public function index()
    {
    	
    	// $mysetuppmb 			= new setuppmb_model();
		// $setuppmb 			= $mysetuppmb->semua();
		$setuppmb 	= DB::table('pmbperiod')->orderBy('PMBPeriodID','DESC')->get();

		$data = array(  'title'       => 'SETUP PMB',
						'setuppmb'      => $setuppmb,
                        'content'     => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }


    public function komponen(){
        $komponen 	= DB::table('pmbusm')->orderBy('Nama','ASC')->get();
		$data = array(  'title'       => 'DATA KOMPONEN USM',
						'komponen'      => $komponen,
                        'content'     => 'admin/setuppmb/komponen'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function formulir(){
        $formulir 	= DB::table('pmbformulir')->orderBy('Nama','ASC')->get();
		$data = array(  'title'       => 'DATA HARGA FORMULIR',
						'formulir'      => $formulir,
                        'content'     => 'admin/setuppmb/formulir'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function persyaratan(){
        $persyaratan 	= DB::table('pmbsyarat')->orderBy('Nama','ASC')->get();
		$data = array(  'title'       => 'DATA PERSYARATAN',
						'persyaratan'      => $persyaratan,
                        'content'     => 'admin/setuppmb/persyaratan'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $keywords           = $request->keywords;
        $setuppmb             = $mysetuppmb->cari($keywords);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Data setuppmb',
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_setuppmbnya       = $request->id_setuppmb;
            for($i=0; $i < sizeof($id_setuppmbnya);$i++) {
                DB::table('setuppmb')->where('id_setuppmb',$id_setuppmbnya[$i])->delete();
            }
            return redirect('admin/setuppmb')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }elseif(isset($_POST['draft'])) {
            $id_setuppmbnya       = $request->id_setuppmb;
            for($i=0; $i < sizeof($id_setuppmbnya);$i++) {
                DB::table('setuppmb')->where('id_setuppmb',$id_setuppmbnya[$i])->update([
                        'id_user'       => Session()->get('id_user'),
                        'status_setuppmb' => 'Draft'
                    ]);
            }
            return redirect('admin/setuppmb')->with(['sukses' => 'Data telah diubah menjadi Draft']);
        // PROSES SETTING PUBLISH
        }elseif(isset($_POST['publish'])) {
            $id_setuppmbnya       = $request->id_setuppmb;
            for($i=0; $i < sizeof($id_setuppmbnya);$i++) {
                DB::table('setuppmb')->where('id_setuppmb',$id_setuppmbnya[$i])->update([
                        'id_user'       => Session()->get('id_user'),
                        'status_setuppmb' => 'Publish'
                    ]);
            }
            return redirect('admin/setuppmb')->with(['sukses' => 'Data telah diubah menjadi Publish']);
        }elseif(isset($_POST['update'])) {
            $id_setuppmbnya       = $request->id_setuppmb;
            for($i=0; $i < sizeof($id_setuppmbnya);$i++) {
                DB::table('setuppmb')->where('id_setuppmb',$id_setuppmbnya[$i])->update([
                        'id_user'               => Session()->get('id_user'),
                        'id_kategori'    => $request->id_kategori
                    ]);
            }
            return redirect('admin/setuppmb')->with(['sukses' => 'Data kategori telah diubah']);
        }
    }

    //Status
    public function status_setuppmb($status_setuppmb)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $setuppmb             = $mysetuppmb->status_setuppmb($status_setuppmb);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Status setuppmb: '.$status_setuppmb,
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //Status
    public function jenis_setuppmb($jenis_setuppmb)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $setuppmb             = $mysetuppmb->jenis_setuppmb($jenis_setuppmb);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Jenis setuppmb: '.$jenis_setuppmb,
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //Status
    public function author($id_user)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $setuppmb             = $mysetuppmb->author($id_user);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();
        $author    = DB::table('users')->where('id_user',$id_user)->orderBy('id_user','ASC')->first();

        $data = array(  'title'             => 'Data setuppmb dengan Penulis: '.$author->nama,
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    //Kategori
    public function kategori($id_kategori)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $setuppmb             = $mysetuppmb->all_kategori($id_kategori);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();
        $detail      = DB::table('kategori')->where('id_kategori',$id_kategori)->first();
        $data = array(  'title'             => 'Kategori: '.$detail->nama_kategori,
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah()
    {
        
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Tambah setuppmb',
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_setuppmb)
    {
        
        $mysetuppmb           = new setuppmb_model();
        $setuppmb             = $mysetuppmb->detail($id_setuppmb);
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Edit setuppmb',
                        'setuppmb'            => $setuppmb,
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        
        request()->validate([
                            'judul_setuppmb'  => 'required|unique:setuppmb',
                            'isi'           => 'required',
                            'gambar'        => 'file|image|mimes:jpeg,png,jpg|max:2048',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = public_path('upload/image/thumbs/');
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = public_path('upload/image/');
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD
            $slug_setuppmb = str_slug($request->judul_setuppmb, '-');
            DB::table('setuppmb')->insert([
                'id_kategori'       => $request->id_kategori,
                'id_user'           => Session()->get('id_user'),
                'slug_setuppmb'       => $slug_setuppmb,
                'judul_setuppmb'      => $request->judul_setuppmb,
                'isi'               => $request->isi,
                'jenis_setuppmb'      => $request->jenis_setuppmb,
                'status_setuppmb'     => $request->status_setuppmb,
                'gambar'            => $input['nama_file'],
                'icon'              => $request->icon,
                'keywords'          => $request->keywords,
                'tanggal_publish'   => date('Y-m-d',strtotime($request->tanggal_publish)).' '.$request->jam_publish,
                'urutan'            => $request->urutan,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]);
        }else{
            $slug_setuppmb = str_slug($request->judul_setuppmb, '-');
            DB::table('setuppmb')->insert([
                'id_kategori'       => $request->id_kategori,
                'id_user'           => Session()->get('id_user'),
                'slug_setuppmb'       => $slug_setuppmb,
                'judul_setuppmb'      => $request->judul_setuppmb,
                'isi'               => $request->isi,
                'jenis_setuppmb'      => $request->jenis_setuppmb,
                'status_setuppmb'     => $request->status_setuppmb,
                'icon'              => $request->icon,
                'keywords'          => $request->keywords,
                'tanggal_publish'   => date('Y-m-d',strtotime($request->tanggal_publish)).' '.$request->jam_publish,
                'urutan'            => $request->urutan,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit_proses(Request $request)
    {
        
        request()->validate([
                            'judul_setuppmb'   => 'required',
                            'isi'           => 'required',
                            'gambar'        => 'file|image|mimes:jpeg,png,jpg|max:2048',
                            ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = str_slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = public_path('upload/image/thumbs/');
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = public_path('upload/image/');
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD
            $slug_setuppmb = str_slug($request->judul_setuppmb, '-');
            DB::table('setuppmb')->where('id_setuppmb',$request->id_setuppmb)->update([
                'id_kategori'       => $request->id_kategori,
                'id_user'           => Session()->get('id_user'),
                'slug_setuppmb'       => $slug_setuppmb,
                'judul_setuppmb'      => $request->judul_setuppmb,
                'isi'               => $request->isi,
                'jenis_setuppmb'      => $request->jenis_setuppmb,
                'status_setuppmb'     => $request->status_setuppmb,
                'gambar'            => $input['nama_file'],
                'icon'              => $request->icon,
                'keywords'          => $request->keywords,
                'tanggal_publish'   => date('Y-m-d',strtotime($request->tanggal_publish)).' '.$request->jam_publish,
                'urutan'            => $request->urutan
            ]);
        }else{
            $slug_setuppmb = str_slug($request->judul_setuppmb, '-');
            DB::table('setuppmb')->where('id_setuppmb',$request->id_setuppmb)->update([
                'id_kategori'       => $request->id_kategori,
                'id_user'           => Session()->get('id_user'),
                'slug_setuppmb'       => $slug_setuppmb,
                'judul_setuppmb'      => $request->judul_setuppmb,
                'isi'               => $request->isi,
                'jenis_setuppmb'      => $request->jenis_setuppmb,
                'status_setuppmb'     => $request->status_setuppmb,
                'icon'              => $request->icon,
                'keywords'          => $request->keywords,
                'tanggal_publish'   => date('Y-m-d',strtotime($request->tanggal_publish)).' '.$request->jam_publish,
                'urutan'            => $request->urutan
            ]);
        }
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah ditambah']);
    }

    // Delete
    public function delete($id_setuppmb)
    {
        
        DB::table('setuppmb')->where('id_setuppmb',$id_setuppmb)->delete();
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah dihapus']);
    }
}
