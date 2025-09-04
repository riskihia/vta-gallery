<?php

class Pussenif extends Controller {

	private $table      = "tbl_dokumen_museum";
	private $primaryKey = "autono";
	private $model      = "Pussenif_model";
	private $menu       = "";
	private $title      = "PUSSENIF";
	private $curl       = BASE_URL."pussenif";
	private $sQuery      = "SELECT * FROM `tbl_dokumen_museum`";


	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']	     = $this->curl;
		$template            = $this->loadView('pussenif_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$model      = $this->loadModel($this->model);
		$id         = $this->base64url_decode($x);
		$columns    = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),array( 'db' => 'lokasi',  'dt' => 2 ),array( 'db' => 'jenis_media',  'dt' => 3 ),array( 'db' => 'kondisi_media',  'dt' => 4 ),array( 'db' => 'kategori_video',  'dt' => 5 ),
		);

		
		$result     = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);
	}

	function print_report()
	{
		$pdf   = $this->loadLibrary('fpdf');
		$model = $this->loadModel($this->model);
		$pdf->AddPage('L','A4');
		$pdf->setX(23);

	    // $pdf->Image(BASE_URL.'static/images/mabesad.jpg', 140, 3, 10);
		
		$pdf->Ln(1);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(55);

			$pdf->Cell(210,7,'LAPORAN SISTEM BINFUNG ',0,1,'C');
		    $pdf->Cell(55);
		    $pdf->SetFont('Arial','',12);
		    $pdf->Cell(210,10,'DINAS PENERANGAN ANGKATAN DARAT',0,1,'C');
		
		// Garis Bawah Double
		$pdf->Ln(5);
		$pdf->Cell(320,0,'','B',1,'L');
		$pdf->Cell(320,1,'','B',1,'L');
		
		// Line break 5mm
		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10); 
		$pdf->Cell(195,7,'',0,1,'C');
		$pdf->Ln(2);
		
		//header
		$pdf->Cell(20, 15, 'NO', 'LRT', 0, 'C');
		$pdf->Cell(165, 15, 'NAMA KEGIATAN', 'LRT', 0, 'C');
		$pdf->Cell(40, 15, 'LOKASI', 'LRT', 0, 'C');
		$pdf->Cell(25, 15, 'TANGGAL', 'LRT', 0, 'C');
		$pdf->Cell(35, 15, 'JENIS MEDIA', 'LRT', 0, 'C');
		$pdf->Cell(35, 15, 'OPERATOR', 'LRT', 0, 'C');
						$pdf->Cell(60,15,'NAMA_KEGIATAN','LRT',0,'C'); 
				$pdf->Cell(60,15,'LOKASI','LRT',0,'C'); 
				$pdf->Cell(60,15,'JENIS_MEDIA','LRT',0,'C'); 
				$pdf->Cell(60,15,'KONDISI_MEDIA','LRT',0,'C'); 
				$pdf->Cell(60,15,'KATEGORI_VIDEO','LRT',0,'C'); 


		$pdf->Cell(30, 5, '', 0, 0);
		$pdf->SetY(35);
		$pdf->Ln(30);         

		//body
		$pdf->SetFont('Arial', '', 10);
		// $pdf->SetWidths(array(20, 165,  40,25,35,35));
						$pdf->SetWidths(array(20,60,60,60,60,60,)); 

		$pdf->SetAligns(array('C', 'L', 'L', 'C','C', 'C'));

		$query = $model->query($this->sQuery);

		$no = 1;
		foreach ($query as $row){
		   $pdf->Row(
		    array(
			    $no++,
			    				$row['nama_kegiatan'], 
				$row['lokasi'], 
				$row['jenis_media'], 
				$row['kondisi_media'], 
				$row['kategori_video'], 
       
			));

		}

		$pdf->Output();
	}
    
}