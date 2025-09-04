<?php

class Report_pussenarhanud extends Controller {

	private $table      = "rambo_tbl";
	private $primaryKey = "autono";
	private $model      = "Report_pussenarhanud_model";
	private $menu       = "PUSSENARHANUD";
	private $title      = "Report pussenarhanud";
	private $curl       = BASE_URL."report_pussenarhanud";
	private $sQuery      = "SELECT * FROM `rambo_tbl`";


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
		$template            = $this->loadView('report_pussenarhanud_view');
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
			array( 'db' => 'nama',  'dt' => 1 ),array( 'db' => 'alamat',  'dt' => 2 ),array( 'db' => 'jeniskelamin',  'dt' => 3 ),array( 'db' => 'keterangan',  'dt' => 4 ),array( 'db' => 'tanggal',  'dt' => 5 ),array( 'db' => 'tahun',  'dt' => 6 ),array( 'db' => 'kegiatan',  'dt' => 7 ),
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

	    //$pdf->Image(BASE_URL.'static/images/mabes_ad1.png', 140, 3, 10);
		
		$pdf->Ln(1);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(55);

		$pdf->Cell(210,7,'LAPORAN Report pussenarhanud ',0,1,'C');
		$pdf->Cell(55);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(210,10,'DINAS KESEJARAHAN ANGKATAN DARAT',0,1,'C');
		
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
		$pdf->Cell(42.857142857143,15,'NAMA','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'ALAMAT','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'JENISKELAMIN','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'KETERANGAN','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'TANGGAL','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'TAHUN','LRT',0,'C'); 
		$pdf->Cell(42.857142857143,15,'KEGIATAN','LRT',0,'C'); 

		$pdf->Cell(30, 5, '', 0, 0);
		$pdf->SetY(35);
		$pdf->Ln(30);         

		//body
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetWidths(array(20,42.857142857143,42.857142857143,42.857142857143,42.857142857143,42.857142857143,42.857142857143,42.857142857143,)); 

		$pdf->SetAligns(array('C', 'L', 'L', 'C','C', 'C'));
		$query = $model->query($this->sQuery);

		$no = 1;
		foreach ($query as $row){
		   $pdf->Row(
		    array(
			    $no++,
			    				$row['nama'], 
				$row['alamat'], 
				$row['jeniskelamin'], 
				$row['keterangan'], 
				$row['tanggal'], 
				$row['tahun'], 
				$row['kegiatan'], 
       
			));

		}

		$pdf->Output();
	}
    
}