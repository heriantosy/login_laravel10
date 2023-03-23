<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class MKSetara extends Controller
{
    public function index($kurikulumplh, $prodiplh)
    {
    	
		$mksetara 	= DB::table('mk')->where('KurikulumID',$kurikulumplh)->get();

		$data = array(  'title'        => 'MATAKULIAH SETARA',
                        'mksetara'     => $mksetara,
                        'kurikulumplh' => $kurikulumplh,
                        'prodiplh'     => $prodiplh,
                        'content'      =>'admin/mksetara/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah()
    {
        
        $kategori    = DB::table('kategori')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Tambah setuppmb',
                        'kategori'   => $kategori,
                        'content'           => 'admin/setuppmb/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

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
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah ditambah']);
    }

    public function delete($id_setuppmb)
    {
        
        DB::table('setuppmb')->where('id_setuppmb',$id_setuppmb)->delete();
        return redirect('admin/setuppmb')->with(['sukses' => 'Data telah dihapus']);
    }
}
