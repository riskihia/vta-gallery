<?php

class Laporan_upload_dokumen_kategori extends Controller {

	private $table       = "tbl_dokumen";
	private $primaryKey  = "autono";
	private $model       = "Laporan_model"; # please write with no space
	private $title       = "Laporan Upload Dokumen per Jenis Kategori";
	private $menu        = "Laporan";
	private $curl        = BASE_URL."laporan_upload_dokumen_kategori";
	private $sQuery      = "SELECT a.autono, nama_kegiatan, lokasi,tanggal, t91.`nama_kategori` FROM tbl_dokumen a 
LEFT JOIN (SELECT parent_id, kd_kategori FROM tbl_dokumen_kategori) AS t90 ON a.`autono` = t90.parent_id
LEFT JOIN (SELECT autono, autocode, nama_kategori FROM  ref_kategori) AS t91 ON t90.kd_kategori = t91.autocode ";

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
        $data['jenis']       = $model->getkategori();
		$template            = $this->loadView('laporan_upload_dokumen_kategori');
		$template->set('data', $data);
		$template->render();
	}


	function get($x)

	{

		$request    = $_REQUEST;
		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),
			array( 'db' => 'nama_kategori',  'dt' => 2 ),
			array( 'db' => 'tanggal',  'dt' => 3 ),
			array( 'db' => 'lokasi',  'dt' => 4 ),

		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget_kategori($request, $this->table, $this->primaryKey, $columns, $this->sQuery, 't90.kd_kategori', $x);

		return json_encode($result);
	}

	function print_report($x)
     {
        $pdf   = $this->loadLibrary('fpdf');
        $model = $this->loadModel($this->model);
        $pdf->AddPage('L','A4');
        $pdf->setX(23);
        if($x == 'all'){
            $sWhere   = "WHERE t90.kd_kategori != '' ";
            $nama_kategori[0] = " PER JENIS KATEGORI";
        } else {
            $sWhere   = "WHERE t90.kd_kategori = '".$x."'";
            $nama_kategori = $model->getvalue("SELECT nama_kategori FROM ref_kategori WHERE autocode='$x'");
        }

       // $pdf->Image(BASE_URL.'static/images/mabesad.jpg', 140, 3, 10);
        
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(55);

        $pdf->Cell(160,7,'LAPORAN UPLOAD DOKUMEN KATEGORI '.strtoupper($nama_kategori[0]).'',0,1,'C');
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
        $pdf->Cell(120, 15, 'NAMA KEGIATAN', 'LRT', 0, 'C');
        $pdf->Cell(75, 15, 'LOKASI', 'LRT', 0, 'C');
        $pdf->Cell(25, 15, 'TANGGAL', 'LRT', 0, 'C');
        $pdf->Cell(35, 15, 'KATEGORI', 'LRT', 0, 'C');

        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetY(35);
        $pdf->Ln(30);         

        //body
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetWidths(array(20, 120,  75,25,35));
        $pdf->SetAligns(array('C', 'L', 'L', 'C','C', 'C'));

        $query = $model->query($this->sQuery.$sWhere);

        $no = 1;
        foreach ($query as $row){
           $pdf->Row(
            array(
	            $no++,
	            $row['nama_kegiatan'],
	            $row['lokasi'],
	            $row['tanggal'],
	            $row['nama_kategori']      
        	));

        }

        $pdf->Output();
    }

    
}