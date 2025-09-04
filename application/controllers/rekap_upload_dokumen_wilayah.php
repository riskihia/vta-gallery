<?php

class Rekap_upload_dokumen_wilayah extends Controller {

	private $table       = "tbl_dokumen";
	private $primaryKey  = "autono";
	private $model       = "Rekap_model"; # please write with no space
	private $title       = "Rekap Upload Dokumen per Wilayah";
	private $menu        = "Rekap";
	private $curl        = BASE_URL."rekap_upload_dokumen_wilayah";
	private $sQuery      = "SELECT COUNT(a.kode) AS jumlah, parent_id, a.kode, nama_wilayah FROM tbl_dokumen_wilayah a 
LEFT JOIN (SELECT kode, kabupaten AS nama_wilayah FROM tbl_wilayah GROUP BY kode) AS b ON a.`kode` = b.kode 
WHERE nama_wilayah IS NOT NULL GROUP BY a.kode  ORDER BY jumlah DESC";


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
		$template            = $this->loadView('rekap_upload_dokumen_wilayah');
		$template->set('data', $data);
		$template->render();
	}


	function get()
	{

		$request    = $_REQUEST;
		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'parent_id',  'dt' => 1 ),
			array( 'db' => 'nama_wilayah',  'dt' => 2 ),
			array( 'db' => 'jumlah',  'dt' => 3 )

		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns, $this->sQuery);

		return json_encode($result);
	}

	function print_report()
     {
        $pdf   = $this->loadLibrary('fpdf');
        $model = $this->loadModel($this->model);
        $pdf->AddPage('P','A4');
        $pdf->setX(23);

       // $pdf->Image(BASE_URL.'static/images/mabesad.jpg', 140, 3, 10);
  
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(55);

        $pdf->Cell(80,7,'REKAPITULASI UPLOAD DOKUMEN PER WILAYAH',0,1,'C');
	    $pdf->Cell(55);
	    $pdf->SetFont('Arial','',12);
	    $pdf->Cell(80,10, 'DINAS PENERANGAN ANGKATAN DARAT',0,1,'C');
        
        // Garis Bawah Double
        $pdf->Ln(5);
        $pdf->Cell(190,0,'','B',1,'L');
        $pdf->Cell(190,1,'','B',1,'L');
        
        // Line break 5mm
        $pdf->Ln(3);
        $pdf->SetFont('Arial','B',10); 
        $pdf->Cell(80,7,'',0,1,'C');
        $pdf->Ln(2);
        
        //header
        $pdf->Cell(20, 15, 'NO', 'LRT', 0, 'C');
        $pdf->Cell(120, 15, 'NAMA WILAYAH', 'LRT', 0, 'C');
        $pdf->Cell(50, 15, 'JUMLAH', 'LRT', 0, 'C');

        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetY(35);
        $pdf->Ln(30);         

        //body
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetWidths(array(20, 120,  50));
        $pdf->SetAligns(array('C', 'L', 'C'));

        $query = $model->query($this->sQuery);

        $no = 1;
        foreach ($query as $row){
           $pdf->Row(
            array(
	            $no++,
	            $row['nama_wilayah'],
	            $row['jumlah']      
        	));

        }

        $pdf->Output();
    }

    
}