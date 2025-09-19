<?php

class Frontoffice extends Controller {

	private $menu = null;
	private $title = null;
	private $curl = null;

	public function __construct()
    {
        // $session = $this->loadHelper('Session_helper');

        // if(!$session->get('username')){

        // 	$this->redirect('auth/login');

        // }
    }

	// Method reusable untuk membuat formatter  
    private function getBase64Formatter($fields) {  
        return function($row) use ($fields) {  
            foreach ($fields as $field) {  
                if (isset($row[$field])) {  
                    $row[$field] = $this->base64url_encode($row[$field]);  
                }  
            }  
            return $row;  
        };  
    }
	
	function index()
	{
		$model               = $this->loadModel('Frontoffice_model');
		$data                = array();	
		$data['breadcrumb1'] = 'Dashboard';
		$data['title']       = 'Main';
    	$data['graf']        = $model->graf();
        $data['subgraf']     = $model->subgraf();
        $data['bulan']       = $model->get_bulan(date('m'));
		$template            = $this->loadView('frontoffice_view');
		$template->set('data', $data);
		$template->render();
	}


	function dashboard()
	{
		$model               = $this->loadModel('Frontoffice_model');
		$data                = array();		
		$data['breadcrumb1'] = 'Gallery';
		$data['title']       = 'Dashboard';
    	$data['graf']        = $model->graf();
    	$data['subgraf']     = $model->subgraf();
   		$data['bulan']       = $model->get_bulan(date('m'));
		$template            = $this->loadView('frontoffice_view');
		$template->set('data', $data);
		$template->render();
	}

	function gallery_foto()
	{
		$model                 = $this->loadModel('Frontoffice_model');
		$data                  = array();
		$data['breadcrumb1']   = 'Gallery';
		$data['title']         = 'Foto';
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 20;
		$query                 = "SELECT autono, nama_kegiatan, mp.`autocode_mp`, mp.`nama_project`, tanggal, kode_parent, dir, subdir, nama_file, tipe_file, structured, ukuran  FROM tbl_dokumen a 
		
		LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON autocode_mp = a.`project`  

		RIGHT JOIN (SELECT parent_id, kode_parent, dir, subdir, nama_file, tipe_file, structured, ukuran FROM vt_files WHERE tipe_file LIKE 'image%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen` a RIGHT JOIN (SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'image%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createPagingFoto($data['q'],$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		$template              = $this->loadView('frontoffice_foto_view');
		$template->set('data', $data);
		$template->render();
	}

	function album_foto($x)
	{
		$model                 = $this->loadModel('Frontoffice_model');
    	$id                    = $this->base64url_decode($x);
		$data                  = array();
		$data['breadcrumb1']   = 'Gallery';
    	$data['breadcrumb2']   = 'Album Foto';
		$data['title']         = 'Foto';
		$data['encode']        = $x;
    	$data['info']          = $model->getinfos($id);
    	$data['pangkat']       = $model->get_pangkat();
		$data['korps']         = $model->get_korps();
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 20;
    	$data['aadata']        = $model->query("SELECT * FROM vt_files WHERE parent_id = $id AND tipe_file LIKE 'image%'");
    	$data['attch']         = $model->get_file_attachment($id);
		$data['number_paging'] = ''; // Pagination jika diperlukan
		$template              = $this->loadView('frontoffice_albumfoto_view');
		$template->set('data', $data);
		$template->render();
	}

	function album_video($x)
	{
		$model                 = $this->loadModel('Frontoffice_model');
    	$id                    = $this->base64url_decode($x);
		$data                  = array();
		$data['breadcrumb1']   = 'Gallery';
    	$data['breadcrumb2']   = 'Album Video';
		$data['title']         = 'Video';
		$data['encode']        = $x;
    	$data['info']          = $model->getinfos($id);
    	$data['pangkat']       = $model->get_pangkat();
		$data['korps']         = $model->get_korps();
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 20;
    	$data['aadata']        = $model->query("SELECT * FROM vt_files WHERE parent_id = $id AND tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%'");
    	$data['attch']         = $model->get_file_attachment($id);
		$data['number_paging'] = ''; // Pagination jika diperlukan
		$template              = $this->loadView('frontoffice_album_video_view');
		$template->set('data', $data);
		$template->render();
	}

	function gallery_video()
	{
		$model                 = $this->loadModel('Frontoffice_model');
		$data                  = array();
		$data['breadcrumb1']   = 'Gallery';
		$data['title']         = 'Video';
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 12;
		$query                 = "SELECT autono, nama_kegiatan, mp.`autocode_mp`, mp.`nama_project`, tanggal, kode_parent, dir, subdir, nama_file, tipe_file, structured, ukuran  FROM tbl_dokumen a 
		
		LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON autocode_mp = a.`project`  

		RIGHT JOIN (SELECT parent_id, structured, dir, subdir, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen` a RIGHT JOIN (SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%'  GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createPagingVideo($data['q'],$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		$template              = $this->loadView('frontoffice_video_view');
		$template->set('data', $data);
		$template->render();
	}

	function show_video($x = null)
	{
		$model                 = $this->loadModel('Frontoffice_model');
		$id                    = $this->base64url_decode($x);
		$data                  = array();
		$data['encode']        = $x;
		$data['pangkat']       = $model->get_pangkat();
		$data['korps']         = $model->get_korps();
		$data['breadcrumb1']   = 'Show';
		$data['title']         = 'Video';
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 12;
		$query                 = "SELECT autono, nama_kegiatan, tanggal, kode_parent, nama_file, tipe_file, ukuran, dir, subdir, structured,narasi  FROM tbl_dokumen a RIGHT JOIN (SELECT parent_id, structured, kode_parent, dir, subdir, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1 AND autono = $id";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen` a RIGHT JOIN (SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%'  GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1  AND autono = $id");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createPagingVideo($data['q'],$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		$data['attch']         = $model->get_file_attachment($id);
		$data['relasi']        = $model->query("SELECT autono, nama_kegiatan, tanggal, kode_parent, dir, subdir, structured,nama_file, tipe_file, ukuran, narasi  FROM tbl_dokumen a RIGHT JOIN (SELECT parent_id, kode_parent, structured, dir, subdir, nama_file, tipe_file, ukuran FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%' GROUP BY parent_id) AS b ON a.`autono` = b.parent_id WHERE a.`file_dokumen` = 1 AND autono IN (SELECT parent_id FROM tbl_dokumen_kategori WHERE kd_kategori IN (SELECT CONCAT(kd_kategori) AS kd_kategori FROM tbl_dokumen_kategori WHERE parent_id = $id)) AND autono <> $id LIMIT 8");
		$template              = $this->loadView('frontoffice_video_show_view');
		$template->set('data', $data);
		$template->render();
	}
	/**
	 * Set project filter in session via AJAX.
	 * Expects POST 'project_id'.
	 * Returns JSON status.
	 */
	function set_project_session() {
		// Start session if not started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;

		if ($project_id !== null) {
			$_SESSION['selected_project_id'] = $project_id;
			error_log("Project session set: " . $project_id);
			echo json_encode([
				'status'     => 'success',
				'project_id' => $project_id
			]);
		} else {
			error_log("set_project_session: No project_id provided");
			echo json_encode([
				'status'  => 'error',
				'message' => 'No project_id provided'
			]);
		}
		exit;
	}

	/**
	 * Clear project filter from session via AJAX.
	 * Returns JSON status.
	 */
	function clear_project_session_ajax() {
		// Start session if not started
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		unset($_SESSION['selected_project_id']);
		error_log("Project session cleared");

		echo json_encode([
			'status'  => 'success',
			'message' => 'Project filter cleared'
		]);
		exit;
	}

	function pencarian()
	{
		$model = $this->loadModel('Frontoffice_model');

		// Start session jika belum dimulai
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Inisialisasi data dasar
		$data = [
			'breadcrumb1' => 'Gallery',
			'title'       => 'Pencarian',
			'q'           => isset($_GET['q']) ? $_GET['q'] : '',
			'tab'         => isset($_GET['tab']) ? $_GET['tab'] : '',
			'page'        => isset($_GET['page']) ? $_GET['page'] : 1,
			'limit'       => 12,
		];

		// Handle project filter: prioritas POST > SESSION
		$project = '';
		if (!empty($_POST['project'])) {
			$project = $_POST['project'];
			$_SESSION['selected_project_id'] = $project;
		} elseif (!empty($_SESSION['selected_project_id'])) {
			$project = $_SESSION['selected_project_id'];
		}
		$data['project'] = $project;

		// Query daftar project untuk filter
		$query_filter_project = "
			SELECT DISTINCT d.project, mp.nama_project
			FROM tbl_dokumen d
			LEFT JOIN m_project mp ON d.project = mp.autocode
			WHERE d.project IS NOT NULL AND mp.nama_project IS NOT NULL
		";
		$data['list_project'] = $model->query($query_filter_project);

		// Encode field project untuk keamanan
		$fieldsToEncode = ['project', '0'];
		$formatter = $this->getBase64Formatter($fieldsToEncode);
		if (is_callable($formatter)) {
			foreach ($data['list_project'] as &$row) {
				$row = $formatter($row);
			}
		}

		// Siapkan filter project untuk query utama
		$filter_project = '';
		if ($project) {
			$filter_project = "AND mp.autocode_mp = '" . $this->base64url_decode($project) . "'";
		}

		// Keyword pencarian
		$keyword = $data['q'];

		// Query Foto
		$queryfoto = "SELECT a.autono, a.nama_kegiatan, mp.autocode_mp, mp.nama_project, a.tanggal, a.lokasi,
				GROUP_CONCAT(
					DISTINCT mps.nm_pegawai
					ORDER BY
						CASE WHEN mps.nm_pegawai IN ('Fernandus beh','Ricco','Andryan Rachman','Siti Maryam','Very Noviandi') THEN 0 ELSE 1 END,
						FIELD(mps.nm_pegawai,'Fernandus beh','Ricco','Andryan Rachman','Siti Maryam','Very Noviandi'),
						mps.id_jabatan,
						mps.nm_pegawai
					SEPARATOR ', '
				) AS team,
				a.keterangan, b.kode_parent, b.nama_file, b.dir, b.subdir, b.tipe_file, b.structured, b.ukuran
			FROM tbl_dokumen a
			LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON mp.autocode_mp = a.project
			RIGHT JOIN (
				SELECT parent_id, structured, kode_parent, dir, subdir, nama_file, tipe_file, ukuran
				FROM vt_files WHERE tipe_file LIKE 'image%' GROUP BY parent_id
			) AS b ON a.autono = b.parent_id
			LEFT JOIN (SELECT parent_id, kd_pegawai FROM tbl_dokumen_team) AS teams ON teams.parent_id = a.autono
			LEFT JOIN (SELECT autocode, nm_pegawai, id_jabatan FROM m_pegawai) AS mps ON mps.autocode = teams.kd_pegawai
			WHERE a.file_dokumen = 1 $filter_project
				AND (a.nama_kegiatan LIKE '%$keyword%' OR a.narasi LIKE '%$keyword%' OR mp.nama_project LIKE '%$keyword%')
			GROUP BY a.autono
			ORDER BY a.tanggal DESC
		";

		error_log($queryfoto);

		// Hitung total foto
		$resTotalLengthFoto = $model->query("SELECT COUNT(*) as total FROM (
				SELECT a.autono
				FROM tbl_dokumen a
				LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON mp.autocode_mp = a.project
				RIGHT JOIN (
					SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran
					FROM vt_files WHERE tipe_file LIKE 'image%' GROUP BY parent_id
				) AS b ON a.autono = b.parent_id
				WHERE a.file_dokumen = 1 $filter_project
					AND (a.nama_kegiatan LIKE '%$keyword%' OR a.narasi LIKE '%$keyword%' OR mp.nama_project LIKE '%$keyword%')
			) as total_query
		");
		$data['total_foto'] = $resTotalLengthFoto[0][0];
		$data['foto'] = $model->pagination($queryfoto, $data['limit'], $data['page']);
		$data['number_paging_foto'] = $model->createPagingSearch(
			$keyword,
			$data['foto']['total'],
			$data['foto']['limit'],
			$data['foto']['page'],
			"tab-image"
		);

		// Query Video
		$queryvideo = "SELECT a.autono, a.nama_kegiatan, mp.autocode_mp, mp.nama_project, a.tanggal, a.lokasi,
				GROUP_CONCAT(
					DISTINCT mps.nm_pegawai
					ORDER BY
						CASE WHEN mps.nm_pegawai IN ('Fernandus beh','Ricco','Andryan Rachman','Siti Maryam','Very Noviandi') THEN 0 ELSE 1 END,
						FIELD(mps.nm_pegawai,'Fernandus beh','Ricco','Andryan Rachman','Siti Maryam','Very Noviandi'),
						mps.id_jabatan,
						mps.nm_pegawai
					SEPARATOR ', '
				) AS team,
				a.keterangan, b.kode_parent, b.dir, b.subdir, b.nama_file, b.tipe_file, b.structured, b.ukuran
			FROM tbl_dokumen a
			LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON mp.autocode_mp = a.project
			RIGHT JOIN (
				SELECT parent_id, structured, kode_parent, dir, subdir, nama_file, tipe_file, ukuran
				FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%' GROUP BY parent_id
			) AS b ON a.autono = b.parent_id
			LEFT JOIN (SELECT parent_id, kd_pegawai FROM tbl_dokumen_team) AS teams ON teams.parent_id = a.autono
			LEFT JOIN (SELECT autocode, nm_pegawai, id_jabatan FROM m_pegawai) AS mps ON mps.autocode = teams.kd_pegawai
			WHERE a.file_dokumen = 1 $filter_project
				AND (a.nama_kegiatan LIKE '%$keyword%' OR a.narasi LIKE '%$keyword%' OR mp.nama_project LIKE '%$keyword%')
			GROUP BY a.autono
			ORDER BY a.tanggal DESC
		";
		// Hitung total video
		$resTotalLengthVideo = $model->query("SELECT COUNT(*) as total FROM (
				SELECT a.autono
				FROM tbl_dokumen a
				LEFT JOIN (SELECT autocode AS autocode_mp, nama_project FROM m_project) AS mp ON mp.autocode_mp = a.project
				RIGHT JOIN (
					SELECT parent_id, kode_parent, nama_file, tipe_file, ukuran
					FROM vt_files WHERE tipe_file LIKE 'video%' AND tipe_file LIKE '%mp4%' GROUP BY parent_id
				) AS b ON a.autono = b.parent_id
				WHERE a.file_dokumen = 1 $filter_project
					AND (a.nama_kegiatan LIKE '%$keyword%' OR a.narasi LIKE '%$keyword%' OR mp.nama_project LIKE '%$keyword%')
			) as total_query
		");
		$data['total_video'] = $resTotalLengthVideo[0][0];
		$data['video'] = $model->pagination($queryvideo, $data['limit'], $data['page']);
		$data['number_paging_video'] = $model->createPagingSearch(
			$keyword,
			$data['video']['total'],
			$data['video']['limit'],
			$data['video']['page'],
			"tab-video"
		);

		// Render view
		$template = $this->loadView('frontoffice_pencarian_view');
		$template->set('data', $data);
		$template->render();
	}

	public function savedownload($x)

	{
		
		$data                    = array();	
		$model                   = $this->loadModel('Frontoffice_model');
		$data['parent_id']       = $this->base64url_decode($x) ;
		$autocode                = $model->getval('tbl_dokumen', 'autocode', 'autono', $data['parent_id']);
		$data['parent_autocode'] = $autocode ;
		$data['nama_lengkap']    = $model->escapeString($_REQUEST['nama_lengkap']) ;
		$data['pangkat']         = $model->escapeString($_REQUEST['pangkat']) ;
		$data['nrp']             = $model->escapeString($_REQUEST['nrp']) ;
		$data['jabatan']         = $model->escapeString($_REQUEST['jabatan']) ;
		$data['telp']            = $model->escapeString($_REQUEST['telp']) ;
		$data['korps']           = $model->escapeString($_REQUEST['korps']) ;
		$data['keperluan']       = $model->escapeString($_REQUEST['keperluan']) ;
		$data['autocode']        = $model->autocode("tbl_download_personel", "DW-");	
		$jfile                   = count($_REQUEST['chkfile']);
		$result                  = $model->msave("tbl_download_personel", $data, "Personel download");
		$lastid                  = $result['id'];
		

		for ($i=0; $i < $jfile ; $i++) { 
			$filedown['parent_id']       = $lastid;
			$filedown['idfile']     	 = $model->escapeString($_REQUEST['chkfile'][$i]);
			$filedown['parent_autocode'] = $data['autocode'];
			$filedownresult              = $model->msave("tbl_download_file", $filedown, "File download");
		}

		$id = $this->base64url_encode($lastid);
		$this->redirect('frontoffice/show_video/'.$x);

	}

// 	public function savedownload($x)

// 	{
		
// 		$data                    = array();	
// 		$model                   = $this->loadModel('Frontoffice_model');
// 		$data['parent_id']       = $this->base64url_decode($x) ;
// 		$autocode                = $model->getval('tbl_dokumen', 'autocode', 'autono', $data['parent_id']);
// 		$data['parent_autocode'] = $autocode ;
// 		$data['nama_lengkap']    = $model->escapeString($_REQUEST['nama_lengkap']) ;
// 		$data['pangkat']         = $model->escapeString($_REQUEST['pangkat']) ;
// 		$data['nrp']             = $model->escapeString($_REQUEST['nrp']) ;
// 		$data['jabatan']         = $model->escapeString($_REQUEST['jabatan']) ;
// 		$data['telp']            = $model->escapeString($_REQUEST['telp']) ;
// 		$data['korps']           = $model->escapeString($_REQUEST['korps']) ;
// 		$data['keperluan']       = $model->escapeString($_REQUEST['keperluan']) ;
// 		$data['autocode']        = $model->autocode("tbl_download_personel", "DW-");	
// 		$jfile                   = count($_REQUEST['chkfile']);
// 		$result                  = $model->msave("tbl_download_personel", $data, "Personel download");
// 		$lastid                  = $result['id'];
		

// 		for ($i=0; $i < $jfile ; $i++) { 
// 			$filedown['parent_id']       = $lastid;
// 			$filedown['idfile']     	 = $model->escapeString($_REQUEST['chkfile'][$i]);
// 			$filedown['parent_autocode'] = $data['autocode'];
// 			$filedownresult              = $model->msave("tbl_download_file", $filedown, "File download");
// 		}

// 		$id = $this->base64url_encode($lastid);
// 		$this->redirect('frontoffice/show_video/'.$x);

// 	}
    
}

?>
