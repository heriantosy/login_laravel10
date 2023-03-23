<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use PDF;
use App\Helper;

class Pegawai extends Controller
{
    public function index()
    {
    	
        $tahunaktif = \DB::table('pmbperiod')->where('NA','N')->first();
        $pegawai = DB::table('t_simpegpegawai')->get();
		$data = array(  'title'     => 'Data Pegawai',
                        'pegawai'   =>  $pegawai,
                        'content'   => 'admin/pegawai/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah()
    {
        
        $agama    = DB::table('agama')->orderBy('Nama','ASC')->get();
        $kelamin    = DB::table('kelamin')->orderBy('Nama','ASC')->get();

        $data = array(  'title'             => 'Tambah Pegawai',
                        'agama'             => $agama,
                        'kelamin'           => $kelamin,
                        'content'           => 'admin/pegawai/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function tambah_proses(Request $request)
    {
        
        // request()->validate([
        //                     'Nama'      => 'required|unique:t_simpegpegawai',
        //                     'FotoBro'   => 'required|file|image|mimes:jpeg,png,jpg|max:8024',
        //                     ]);

        $image   = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/staff/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/staff/';
            $image->move($destinationPath, $input['nama_file']);

        DB::table('t_simpegpegawai')->insert([
                'Noreg'         =>$request->Noreg,
                'NIDN'          =>$request->NIDN,
                'Nama'          =>$request->Nama,
                'TMT'           =>$request->TMT,
                'Alamat'        =>$request->Alamat,
                'JenisKelamin'  =>$request->JenisKelamin,
                'TempatLahir'   =>$request->TempatLahir,
                'TanggalLahir'  =>$request->TanggalLahir,
                'Agama'         =>$request->Agama,
                'Gelar'         =>$request->Gelar,
                'Keahlian'      =>$request->Keahlian,
                'Jabatan'       =>$request->Jabatan,
                'Handphone'     =>$request->Handphone,
                'Email'         =>$request->Email,
                'FotoBro'       => $input['nama_file']
            ]);
        }else{
            DB::table('t_simpegpegawai')->insert([
                'Noreg'         =>$request->Noreg,
                'NIDN'          =>$request->NIDN,
                'Nama'          =>$request->Nama,
                'TMT'           =>$request->TMT,
                'Alamat'        =>$request->Alamat,
                'JenisKelamin'  =>$request->JenisKelamin,
                'TempatLahir'   =>$request->TempatLahir,
                'TanggalLahir'  =>$request->TanggalLahir,
                'Agama'         =>$request->Agama,
                'Gelar'         =>$request->Gelar,
                'Keahlian'      =>$request->Keahlian,
                'Jabatan'       =>$request->Jabatan,
                'Handphone'     =>$request->Handphone,
                'Email'         =>$request->Email
            ]);
        }
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah ditambah']);
    }

    public function edit($IDPeg)
    {
        
        $pegawai  = DB::table('t_simpegpegawai')->where('IDPeg',$IDPeg)->first();
        $agama    = DB::table('agama')->orderBy('Nama','ASC')->get();
        $kelamin    = DB::table('kelamin')->orderBy('Nama','ASC')->get();

        $data = array(  'title'             => 'Edit Data',
                        'rows'            => $pegawai,
                        'agama'   => $agama,
                        'kelamin'   => $kelamin,
                        'content'           => 'admin/pegawai/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function edit_proses(Request $request)
    {
        
        request()->validate([
                            'Nama'  => 'required',
                            'FotoBro'        => 'file|image|mimes:jpeg,png,jpg|max:8024',
                            ]);
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/staff/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/staff/';
            $image->move($destinationPath, $input['nama_file']);

            DB::table('t_simpegpegawai')->where('IDPeg',$request->id)->update([
                'Noreg'         =>$request->Noreg,
                'NIDN'          =>$request->NIDN,
                'Nama'          =>$request->Nama,
                'TMT'           =>$request->TMT,
                'Alamat'        =>$request->Alamat,
                'JenisKelamin'  =>$request->JenisKelamin,
                'TempatLahir'   =>$request->TempatLahir,
                'TanggalLahir'  =>$request->TanggalLahir,
                'Agama'         =>$request->Agama,
                'Gelar'         =>$request->Gelar,
                'Keahlian'      =>$request->Keahlian,
                'Jabatan'       =>$request->Jabatan,
                'Handphone'     =>$request->Handphone,
                'Email'         =>$request->Email,
                'FotoBro'       => $input['nama_file']
            ]);
        }else{
            DB::table('t_simpegpegawai')->where('IDPeg',$request->id)->update([
                'Noreg'         =>$request->Noreg,
                'NIDN'          =>$request->NIDN,
                'Nama'          =>$request->Nama,
                'TMT'           =>$request->TMT,
                'Alamat'        =>$request->Alamat,
                'JenisKelamin'  =>$request->JenisKelamin,
                'TempatLahir'   =>$request->TempatLahir,
                'TanggalLahir'  =>$request->TanggalLahir,
                'Agama'         =>$request->Agama,
                'Gelar'         =>$request->Gelar,
                'Keahlian'      =>$request->Keahlian,
                'Jabatan'       =>$request->Jabatan,
                'Handphone'     =>$request->Handphone,
                'Email'         =>$request->Email
            ]);
        }
        return redirect('admin/pegawai');
    }

    public function delete($id)
    {
        
        DB::table('t_simpegpegawai')->where('IDPeg',$id)->delete();
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah dihapus']);
    }
}
