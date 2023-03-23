<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konfigurasi_model;
use Image;
use PDF;

class Dasbor extends Controller
{
    public function index()
    {
        // return('Testing');
        // if(Session()->get('username')=="") {
        //     $last_page = url()->full();
        //     return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        // }
    	$mysite = new Konfigurasi_model();
		$site 	= $mysite->listing();
       
		$data = array(  'title'     => $site->namaweb.' - '.$site->tagline,
                        'content'   => 'admin/dasbor/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function dasbordsn(){
        $mysite = new Konfigurasi_model();
		$site 	= $mysite->listing();
       
		$data = array(  'title'     => $site->namaweb.' - '.$site->tagline,
                        'content'   => 'admin/dasbor/dasbordsn'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function dasbormhs(){
        $mysite = new Konfigurasi_model();
		$site 	= $mysite->listing();
       
		$data = array(  'title'     => $site->namaweb.' - '.$site->tagline,
                        'content'   => 'admin/dasbor/dasbormhs'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
