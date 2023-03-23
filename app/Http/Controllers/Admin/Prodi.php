<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Image;
// use Fpdf;

class Prodi extends Controller
{
    // protected $fpdf;
    // public function __construct()
    // {
    //     $this->fpdf = new Fpdf;
    // }


    public function index()
    {
    	return('ABC');
		// $prodi 	= DB::table('prodi')->orderBy('Nama','ASC')->get();

		// $data = array(  'title'     => 'Data Prodi',
		// 				'prodi'	=> $prodi,
        //                 'content'           => 'admin/prodi/index'
        //             );
        // return view('admin/layout/wrapper',$data);
    }

    public function edit($ProdiID)
    {
        
        $prodi   = DB::table('prodi')->where('ProdiID',$ProdiID)->orderBy('Nama','ASC')->first();

        $data = array(  'title'     => 'Edit Data Prodi',
                        'prodi'  => $prodi,
                        'content'   => 'admin/prodi/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    public function proses(Request $request)
    {
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $prodinya       = $request->ProdiID;
            for($i=0; $i < sizeof($prodinya);$i++) {
                DB::table('prodi')->where('ProdiID',$prodinya[$i])->delete();
            }
            return redirect('admin/prodi')->with(['sukses' => 'Data telah dihapus x']);
        // PROSES SETTING DRAFT
        }
    }

    public function tambah(Request $request)
    {
    	
    	request()->validate([
                            'ProdiID' => 'required|unique:prodi',
					        'Nama' => 'required',
                            'Pejabat'  => 'required',
					        ]);

            DB::table('prodi')->insert([
                'ProdiID'   => $request->ProdiID,
                'Nama'      => $request->Nama,
                'Pejabat'   => $request->Pejabat
            ]);
        
        return redirect('admin/prodi')->with(['sukses' => 'Data telah ditambah']);
    }

    public function proses_edit(Request $request)
    {
    	
    	request()->validate([
					       'Nama' => 'required',
                           'Pejabat'    => 'required',
					        ]);
            DB::table('prodi')->where('ProdiID',$request->ProdiID)->update([
                'Nama'         => $request->Nama,
                'Pejabat'    => $request->Pejabat,
            ]);
        return redirect('admin/prodi')->with(['sukses' => 'Data telah diupdate']);
    }

    public function delete($ProdiID)
    {
    	
    	DB::table('prodi')->where('ProdiID',$ProdiID)->delete();
    	return redirect('admin/prodi')->with(['sukses' => 'Data telah dihapus']);
    }

    public function cetak()
    {
    	
        // $pdf = new FPDF('l','mm','A5');
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial','B',16);
        $this->fpdf->Cell(190,7,'UNIVERSITAS TEKNOKRAT INDONESIA',0,1,'C');
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->Cell(190,7,'DATA PROGRAM STUDI',0,1,'C');
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $this->fpdf->Cell(10,7,'',0,1);
        
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(10,6,'No',1,0);
        $this->fpdf->Cell(65,6,'NAMA PRODI',1,0);
        $this->fpdf->Cell(75,6,'PEJABAT',1,1); //close at the end


        $no = 1;
        $prodi = DB::table('prodi')->get();
        foreach($prodi as $p)
        {
            // $this->fpdf->SetFont('Arial','B',10);
            $this->fpdf->Cell(10,6,$no++,1,0);
            $this->fpdf->Cell(65,6,$p->Nama,1,0);
            $this->fpdf->Cell(75,6,$p->Pejabat,1,1);             
        }
        
        $this->fpdf->Output();
        exit;


        //Cara 2 (aktifkan use Fpdf; dan non aktifkan use Codedge\Fpdf\Fpdf\Fpdf  protected $fpdf;  public function __construct())
        //--------------------------------------------------------------------------------------------------------------------
        // Fpdf::AddPage('L','A5');
        // Fpdf::SetTitle("Daftar Program Studi");
        // Fpdf::SetAutoPageBreak(true, 5);
        // Fpdf::SetFillColor(200, 200, 200);
        // Fpdf::SetFont('Arial', 'B', 14);
        // Fpdf::Cell(190, 7, 'DATA PROGRAM STUDI',1,1,'C'); // cell make table
        // Fpdf::Cell(190, 5, '',1,1,'C');
        // Fpdf::SetFont('Arial', 'B', 8);

        // $t = 35;
        // $prodi = DB::table('prodi')->get();
        // foreach($prodi as $p)
        // {
        //     Fpdf::SetFont('Helvetica', '', 8);
        //     Fpdf::text(12, $t, $p->ProdiID);
        //     Fpdf::text(24, $t, $p->Nama); 
           
        //     // Fpdf::Cell(10, $t, $n, 'LB', 0);
        //     Fpdf::Cell(35, $t, $p->Nama, 'B', 0);
        //     Fpdf::Cell(20, $t, $p->Nama, 'B', 0, 'R');
        //     $t = $t+5;
        // }
        // Fpdf::Output();
        // exit;
    }
}
