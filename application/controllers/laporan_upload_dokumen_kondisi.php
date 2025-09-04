<?php

class Laporan_upload_dokumen_kondisi extends Controller {

	private $table       = "tbl_dokumen";
	private $primaryKey  = "autono";
	private $model       = "Laporan_model"; # please write with no space
	private $title       = "Laporan Upload Dokumen per Kondisi Media";
	private $menu        = "Laporan";
	private $curl        = BASE_URL."laporan_upload_dokumen_kondisi";
	private $sQuery      = "SELECT a.autono, nama_kegiatan, lokasi, jenis_media, kondisi_media, b.`nama_media`, c.`nama_kondisi`, tanggal FROM tbl_dokumen a LEFT JOIN ref_media b ON a.`jenis_media` = b.`autocode` LEFT JOIN ref_kondisi c ON a.`kondisi_media` = c.`autocode`";

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
        $data['jenis']       = $model->getkondisi();
		$template            = $this->loadView('laporan_upload_dokumen_kondisi');
		$template->set('data', $data);
		$template->render();
	}


	function get($x)
	{

		$request    = $_REQUEST;
		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),
			array( 'db' => 'nama_media',  'dt' => 2 ),
			array( 'db' => 'nama_kondisi',  'dt' => 3 ),
			array( 'db' => 'tanggal',  'dt' => 4 ),
			array( 'db' => 'lokasi',  'dt' => 5 ),

		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget_kondisi($request, $this->table, $this->primaryKey, $columns, $this->sQuery, 'kondisi_media', $x);

		return json_encode($result);
	}

	function print_report($x)
     {
        $pdf   = $this->loadLibrary('fpdf');
        $model = $this->loadModel($this->model);
        $pdf->AddPage('L','A4');
        $pdf->setX(23);
        if($x == 'all'){
            $sWhere   = "WHERE 1 ";
            $nama_media[0] = " PER JENIS MEDIA";
        } else {
            $sWhere   = "WHERE a.kondisi_media = '".$x."'";
            $nama_media = $model->getvalue("SELECT nama_kondisi FROM ref_kondisi WHERE autocode='$x'");
        }

       // $pdf->Image(BASE_URL.'static/images/mabesad.jpg', 140, 3, 10);
        
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(55);

        $pdf->Cell(160,7,'LAPORAN UPLOAD DOKUMEN KONDISI '.strtoupper($nama_media[0]).'',0,1,'C');
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
        $pdf->Cell(40, 15, 'LOKASI', 'LRT', 0, 'C');
        $pdf->Cell(25, 15, 'TANGGAL', 'LRT', 0, 'C');
        $pdf->Cell(35, 15, 'JENIS MEDIA', 'LRT', 0, 'C');
      	$pdf->Cell(35, 15, 'KONDISI MEDIA', 'LRT', 0, 'C');

        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetY(35);
        $pdf->Ln(30);         

        //body
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetWidths(array(20, 120,  40,25,35,35));
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
	            $row['nama_media'],
	            $row['nama_kondisi']       
        	));

        }

        $pdf->Output();
    }

    
}