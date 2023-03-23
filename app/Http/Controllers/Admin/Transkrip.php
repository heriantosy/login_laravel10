<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transkrip_model;
use App\Models\Mahasiswa_model;
use Illuminate\Support\Str;
use Codedge\Fpdf\Fpdf\Fpdf;
use Image;
// use PDF;


class Transkrip extends Controller
{
    protected $fpdf;
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index()
    {
    	
      
        try{
            $mhsx = DB::table('mhsw')->select('MhswID')->orderBy('MhswID','DESC')->limit(1)->first(); 
                if($mhsx->MhswID != '101'){
                    $MhswIDplh = 'Inputkan NPM';
                }else{
                    $MhswIDplh = $mhsx->MhswID;
                }
            }catch(Exception $e){
                $MhswIDplh = 'Inputkan NPM';
            }

        // $datamhs = \DB::table('mhsw')
        // ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
        // ->where('mhsw.MhswID',$MhswIDplh)
        // ->first();

        $datamhs      = Mahasiswa_model::select('MhswID','Nama')->where('MhswID', $MhswIDplh)->first();
      
        $mytranskrip  = new Transkrip_model();
        $transkrip    = $mytranskrip->transkrip_detail($MhswIDplh);
 
		$data = array(  'title'    => 'Transkrip Nilai: ',
                        'transkrip' => $transkrip,
                        'datamhs'  => $datamhs,
                        'MhswIDplh' => $MhswIDplh,                      
                        'content'     => 'admin/transkrip/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
  
      // cetak page
      public function cetaktranskrip($MhswID)
      {
          
          $MhswIDplh   = $MhswID;
          $datamhs = \DB::table('mhsw')
          ->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
          ->where('mhsw.MhswID',$MhswIDplh)
          ->first();
  
          //untuk ditampilkan sebagai detail
          $krs = \DB::table('krs')
          ->select('krs.*','mk.Nama as NamaMK','mk.SKS')
          ->join('mk','mk.MKID','=','krs.MKID')
          ->where('krs.MhswID',$MhswIDplh)
          ->orderBy('krs.MKID','ASC')
          ->get();                  
          $site      = DB::table('identitas')->first();
          $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->sum('SKS'); 
          //dd($site->namaweb);  
          $data = array(  'title'     => 'Tahun Akademik',
                          'datamhs'   => $datamhs,
                          'krs'       => $krs, 
                          'totsks'    => $totsks, 
                          'MhswIDplh' => $MhswIDplh,            
                          'site'      => $site
                      );
               
          $config = [ 'format' => 'A4-P', // L=Landscape
                      'margin_top' => 25
                      
                    ];
          $pdf = PDF::loadview('admin/transkrip/cetaktranskrip',$data,[],$config);
          // OR :: $pdf = PDF::loadview('pdf_data_member',$data,[],['format' => 'A4-L']);
          $nama_file = 'Mahasiswa '.$MhswIDplh.'.pdf';
          return $pdf->stream($nama_file, 'I');
      }

      public function cetaktranskrip_v($MhswID)
      {
          
          $MhswIDplh   = $MhswID;
          //$datamhs = \DB::table('mhsw')
          //->select('mhsw.MhswID','mhsw.Nama as NamaMhs','mhsw.TempatLahir','mhsw.TanggalLahir','mhsw.ProgramID','mhsw.ProdiID')
          //->where('mhsw.MhswID',$MhswIDplh)
          //->first();
          $datamhs      = Mahasiswa_model::select('MhswID','Nama', 'ProgramID', 'ProdiID')->where('MhswID', $MhswIDplh)->first();
          $prd          = DB::table('prodi')->select('ProdiID','Nama','Pejabat','Gelar', 'FakultasID')->where('ProdiID', $datamhs->ProdiID)->first();
          $fakultas     = DB::table('fakultas')->select('FakultasID','Nama','Pejabat')->where('FakultasID', $prd->FakultasID)->first();
          $mytranskrip  = new Transkrip_model();
          $transkrip    = $mytranskrip->transkrip_detail($MhswIDplh);              
          $site         = DB::table('identitas')->first();
          $totsks       = DB::table('krs')->where('MhswID',$MhswIDplh)->sum('SKS'); 
          $data = array(  'title'     => 'Tahun Akademik',
                          'datamhs'   => $datamhs,
                          'prd'       => $prd, 
                          'fakultas' => $fakultas, 
                          'transkrip' => $transkrip, 
                          'totsks'    => $totsks, 
                          'MhswIDplh' => $MhswIDplh,            
                          'site'      => $site 
                        );
          return view('admin/transkrip/cetaktranskrip_v',$data);
        }   

    public function proses(Request $request)
    {
        //$site           = DB::table('konfigurasi')->first();
        $pengalihan     = $request->pengalihan;
        if(isset($_POST['filter'])) {
            if($request->MhswID==''){
                return redirect($pengalihan)->with(['warning' => 'Anda belum memilih filterx']);
            }else{
                return redirect('admin/transkrip/filter/'.$request->MhswID);
            }
        }
    }

    public function filter($MhswID) //posisi tahun dan prodi jangan terbalik diambil dari return redirect function proses
    {
        
        $MhswIDplh    = $MhswID;
        $mytranskrip  = new Transkrip_model();
        $transkrip    = $mytranskrip->transkrip_detail($MhswIDplh);
        $datamhs      = Mahasiswa_model::select('MhswID','Nama')->where('MhswID', $MhswIDplh)->first();

        $prodi      = DB::table('prodi')->orderBy('ProdiID','ASC')->get();
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->sum('SKS');
        $totsks     = DB::table('krs')->where('MhswID',$MhswIDplh)->sum('SKS');
        $data = array(  'title'     => 'Mahasiswa: '.$MhswIDplh. ' - ' .$datamhs->Nama,
                        'transkrip' => $transkrip,
                        'MhswID'    => $MhswID,
                        'MhswIDplh' => $MhswIDplh,
                        'totsks'    => $totsks,
                        'content'   => 'admin/transkrip/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function delete($JadwalID)
    {
        
        DB::table('jadwal')->where('JadwalID',$JadwalID)->delete();
        return redirect('admin/jadwal')->with(['sukses' => 'Data telah dihapus']);
    }

    public function cetaktranskrip_p($id)
    {
    	
        // $pdf = new FPDF('l','mm','A5');
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial','B',10);
        $t = 6;
        $this->fpdf->Cell(190,$t,'YAYASAN TEKNOKRAT INDONESIA',0,1,'C');
        $this->fpdf->SetFont('Arial','B',16);
        $this->fpdf->Cell(190,$t,'UNIVERSITAS TEKNOKRAT INDONESIA',0,1,'C');
        $this->fpdf->SetFont('Arial','B',6);
        $this->fpdf->Cell(190,4,'Jl. ZA. Pagar Alam No.9 -11, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35132',0,1,'C');
        $this->fpdf->Cell(190,4,'Email: filkom@uti.ac.id, Website: http://www.teknokrat.ac.id',0,1,'C');
        $this->fpdf->Cell(0, 6, '', 'T', 1);

        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(190,$t,'TRANSKRIP NILAI',0,1,'C');
        $this->fpdf->SetFont('Arial','B',8);
        $this->fpdf->Cell(190,$t,'ACADEMIC TRANSCRIPT',0,1,'C');
        $this->fpdf->Ln(4);

        $mhsw  = DB::table('mhsw')->select('mhsw.MhswID', 'mhsw.Nama as NamaMhs', 'mhsw.ProdiID', 'mhsw.ProgramID', 
                                    'dosen.Nama as NamaDosen','dosen.Gelar','prodi.Nama as NamaProdi')
                                    ->join('prodi' ,'prodi.ProdiID', '=', 'mhsw.ProdiID')
                                    ->join('dosen' ,'dosen.Login', '=', 'mhsw.PenasehatAkademik')
                                    ->where('mhsw.MhswID', $id)->first();
        $NamaMhsx = strtolower($mhsw->NamaMhs);
        $NamaMhs  = ucwords($NamaMhsx);
        $t = 5;
           // Kolom 1
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(30, $t, 'NPM', 0, 0);
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(65, $t, ': ' .$id, 0, 0);
          
          // Kolom 2
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(35, $t, 'Program/Prodi', 0, 0);
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(55, $t, ': ' .$mhsw->ProgramID. ' - '  .$mhsw->NamaProdi, 0, 1);

          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(30, $t, 'Mahasiswa', 0, 0);
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(65, $t, ': ' .$NamaMhs, 0, 0);
          
          // Kolom 2
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(35, $t, 'Penasehat Akd', 0, 0);
          $this->fpdf->SetFont('Helvetica', 'I', 10);
          $this->fpdf->Cell(35, $t, ': ' .$mhsw->NamaDosen. ', ' .$mhsw->Gelar, 0, 1);
        
      
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->fpdf->Cell(10,2,'',0,1); //2 space below     
        $this->fpdf->SetFont('Helvetica', 'B', 9);
        $this->fpdf->Cell(10,6,'No', 1, 0, 'C');
        $this->fpdf->Cell(25,6,'Kode MK', 1, 0, 'C');
        $this->fpdf->Cell(75,6,'Mata Kuliah',1,0);
        $this->fpdf->Cell(10,6,'Krd', 1, 0, 'C');
        $this->fpdf->Cell(20,6,'Huruf Mutu', 1, 0, 'C');
        $this->fpdf->Cell(10,6,'NA',1,0, 'C');
        $this->fpdf->Cell(35,6,'Keterangan',1,1); //close at the end     
        $no = 1;
        $krs = DB::table('krs')->where('MhswID', $id)->get();
        foreach($krs as $p)
        {
            $this->fpdf->SetFont('Helvetica', '', 8);
            $this->fpdf->Cell(10,6,$no++, 1, 0, 'C');
            $this->fpdf->Cell(25,6,$p->MKKode, 1, 0, 'C');
            $this->fpdf->Cell(75,6,$p->Nama,1,0);
            $this->fpdf->Cell(10,6,$p->SKS, 1, 0, 'C');
            $this->fpdf->Cell(20,6,$p->GradeNilai, 1, 0, 'C');
            $this->fpdf->Cell(10,6,$p->BobotNilai, 1, 0, 'C');
            $this->fpdf->Cell(35,6, '',1,1);             
        }

        $t = 6;
        $this->fpdf->Cell(93, $t, "Jumlah SKS yang diambil:", 'LB', 0, 'R');
        $this->fpdf->Cell(10, $t, '25 SKS', 'B', 0, 'C');
        $this->fpdf->Cell(82, $t, ' ', 'BR', 1);
        $this->fpdf->Cell(83, $t, "Jumlah SKS yang telah ditempuh:", 'LB', 0, 'R');
        $this->fpdf->Cell(10, $t, '20 SKS', 'B', 0, 'C');
        $this->fpdf->Cell(10, $t, ' ', 'B', 0, 'C');
        $this->fpdf->Cell(82, $t, ' ', 'BR', 1);

        $this->fpdf->Ln(4);
        $this->fpdf->Cell(10);
        $this->fpdf->Cell(100, $t, 'Nama Kota' . ", " . date('d M Y'), 0, 1);
       
        $this->fpdf->Cell(10);
        $this->fpdf->Cell(50, $t, "Mengetahui,", 0, 0);
        $this->fpdf->Cell(15);
        $this->fpdf->Cell(50, $t, "Pembimbing Akademik," , 0, 0);
        $this->fpdf->Cell(30);
        $this->fpdf->Cell(50, $t, "Mahasiswa," , 0, 1);  
        $this->fpdf->ln(15);
        

        $this->fpdf->Cell(10);
        $this->fpdf->SetFont('Helvetica', 'B', 9);
        $this->fpdf->Cell(50, $t, 'SSS', 0, 0);
        
        $this->fpdf->Cell(15);
        $this->fpdf->SetFont('Helvetica', '', 9);
        $this->fpdf->Cell(50, $t, '(                                                    )', 0, 0);
        
        $this->fpdf->Cell(30);
        $this->fpdf->SetFont('Helvetica', '', 9);
        $this->fpdf->Cell(50, $t, $NamaMhs, 0, 1);
        
        $this->fpdf->Cell(10);
        $this->fpdf->SetFont('Helvetica', 'B', 9);
        $this->fpdf->Cell(50, $t, 'test', 0 , 0);
        
        $this->fpdf->ln(20);
        $this->fpdf->Cell(1 ,7, '');$this->fpdf->Cell(0 ,0, '1. KRS diprint empat rangkap dan diserahkan ke Prodi, BAAK, dan Pembimbing Akademik', 0,0,"L");
        $this->fpdf->ln(5);
        $this->fpdf->Cell(1 ,7, '');$this->fpdf->Cell(0 ,0, '2. KRS dianggap sah setelah ditanda tangani oleh Mahasiswa, Pembimbing Akademik, dan Ketua Prodi', 0,0,"L");
        $this->fpdf->ln(5);
        $this->fpdf->Cell(1 ,7, '');$this->fpdf->Cell(0 ,0, '3. Bagi mahasiswa yang tidak menyerahkan KRS ke Prodi, BAAK, dan Pembimbing Akademik dianggap', 0,0,"L");
        $this->fpdf->ln(5);
        $this->fpdf->Cell(3 ,7, '');$this->fpdf->Cell(0 ,0, ' PASIF/ALFA STUDI pada semester berjalan', 0,0,"L");
        
        $this->fpdf->Output();
        exit;
    }    
}
