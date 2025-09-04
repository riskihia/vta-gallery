<?php

class Laporan_pencarian_katakunci extends Controller {

	private $table       = "ref_keywords";
	private $primaryKey  = "autono";
	private $model       = "Laporan_model"; # please write with no space
	private $title       = "Laporan Pencarian kata kunci";
	private $menu        = "Laporan";
	private $curl        = BASE_URL."laporan_pencarian_katakunci";
	private $sQuery      = "SELECT keywords, COUNT(*) AS jumlah FROM ref_keywords ";

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$model   = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']        = $this->curl;
		$template            = $this->loadView('laporan_pencarian_katakunci');
		$template->set('data', $data);
		$template->render();
	}


	function get()

	{
        $x = 'all';
		$request = $_REQUEST;
		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'keywords',  'dt' => 1 ),
			array( 'db' => 'jumlah',  'dt' => 2 )

		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget_keywords($request, $this->table, $this->primaryKey, $columns, $this->sQuery, 'keywords', $x);

		return json_encode($result);
	}

	function print_report()
     {
        $pdf   = $this->loadLibrary('fpdf');
        $model = $this->loadModel($this->model);
        $pdf->AddPage('L','A4');
        $pdf->setX(23);

        $sGroup = "GROUP BY keywords ";

       // $pdf->Image(BASE_URL.'static/images/mabesad.jpg', 140, 3, 10);
        
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(55);

        $pdf->Cell(160,7,'LAPORAN PENCARIAN KEYWORDS ',0,1,'C');
	    $pdf->Cell(55);
	    $pdf->SetFont('Arial','',12);
	    $pdf->Cell(160,10,'DINAS PENERANGAN ANGKATAN DARAT',0,1,'C');
        
        // Garis Bawah Double
        $pdf->Ln(5);
        $pdf->Cell(275,0,'','B',1,'L');
        $pdf->Cell(275,1,'','B',1,'L');
        
        // Line break 5mm
        $pdf->Ln(3);
        $pdf->SetFont('Arial','B',10); 
        $pdf->Cell(195,7,'',0,1,'C');
        $pdf->Ln(2);
        
        //header
        $pdf->Cell(20, 15, 'NO', 'LRT', 0, 'C');
        $pdf->Cell(180, 15, 'KEYWORDS', 'LRT', 0, 'C');
        $pdf->Cell(70, 15, 'JUMLAH', 'LRT', 0, 'C');

        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetY(35);
        $pdf->Ln(30);         

        //body
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetWidths(array(20, 180,  70));
        $pdf->SetAligns(array('C', 'C', 'C'));

        $query = $model->query($this->sQuery.$sGroup. " ORDER BY jumlah DESC");

        $no = 1;
        foreach ($query as $row){
           $pdf->Row(
            array(
	            $no++,
	            $row['keywords'],
	            $row['jumlah']     
        	));

        }

        $pdf->Output();
    }

    
}