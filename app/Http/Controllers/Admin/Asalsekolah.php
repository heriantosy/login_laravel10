<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asalsekolah_Model;

class Asalsekolah extends Controller
{  
    public function index(){
        $asalsekolahx = new Asalsekolah_Model();
        $asalsekolah  = $asalsekolahx->semua();
        //dd($asalsekolah);
        $data = array('title' => 'Master Asal Sekolah', 
                      'asalsekolah' => $asalsekolah,
                      'content' => 'admin/asalsekolah/index'
        );
        return view ('admin/layout/wrapper', $data);
    }

    public function edit($id){
        $asalsekolahx = new Asalsekolah_Model();
        $asalsekolah  = $asalsekolahx->detail($id);
        //dd($asalsekolah);
        $data = array('title' => 'Master Asal Sekolah', 
        'rows' => $asalsekolah,
        'content' => 'admin/asalsekolah/edit'
        );
        return view ('admin/layout/wrapper', $data);
    }

    public function edit_proses(Request $request){
        DB::table('asalsekolah')->where('SekolahID', $request->id)->update([
            'Nama'          => $request->Nama,
            'Alamat1'       => $request->Alamat1,
            'Kota'          => $request->Kota,
            'Telephone'     => $request->Telephone,
            'Website'       => $request->Website,
            'Email'         => $request->Email
        ]);
        return redirect('admin/asalsekolah');
    }

    public function tambah(){
        $data = DB::table('asalsekolah')->where('Ket','X')->orderBy('SekolahID','DESC')->first();
        $kode = $data->SekolahID;
        $urutan = (int) substr($kode, 0, 8); //00000001
        $urutan++; 
        $huruf = "";
        $kodeUrut = $huruf . sprintf("%08s", $urutan);

        $data =array('title'    => 'Tambah Data',
                    'content'   => 'admin/asalsekolah/tambah',
                    'kodeUrut'  => $kodeUrut);
        return view('admin/layout/wrapper', $data);
    }

    public function tambah_proses(Request $request){
        DB::table('asalsekolah')->insert([
            'SekolahID'     => $request->id,
            'Nama'          => $request->Nama,
            'Alamat1'       => $request->Alamat1,
            'Kota'          => $request->Kota,
            'Telephone'     => $request->Telephone,
            'Website'       => $request->Website,
            'Email'         => $request->Email,
            'Ket'           => 'X'
        ]);
        return redirect('admin/asalsekolah');
    }

    public function delete($id){
        DB::table('asalsekolah')->where('SekolahID', $id)->delete();
        return redirect('admin/asalsekolah');
    }


}    