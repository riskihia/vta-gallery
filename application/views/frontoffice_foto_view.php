<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Office - Gallery Foto</title>

	<!-- Global stylesheets -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/dispenad.png">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/media/fancybox.min.js"></script>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/pages/gallery.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"> <img src="<?php echo BASE_URL ?>static/images/logo_head.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
				</li>

				<li class="dropdown dropdown-user">
		          <a class="dropdown-toggle" data-toggle="dropdown">
		            <img src="<?php echo BASE_URL ?>static/images/users.jpg" class="img-circle" alt=""> <?php echo $_SESSION['username']." " ?></span>  <i class="caret"> </i>
		            <!-- <img src="data:image/jpeg;base64,<?php echo base64_encode($data['photo'][0][0]); ?>" class="img-circle"  alt="">  -->
		          </a>

		          <ul class="dropdown-menu dropdown-menu-right">
		            <li><a href="<?php echo BASE_URL."users_profil"; ?>"><i class="icon-user-plus"></i> My profile</a></li>
		           
		            <li class="divider"></li>
		            <li><a href="<?php echo BASE_URL ?>auth/logout"><i class="icon-switch2"></i> Logout</a></li>
		          </ul>
		        </li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo BASE_URL."frontoffice/dashboard"; ?>"><i class="icon-display4 position-left"></i> Dashboard</a></li>

				<li class="dropdown mega-menu mega-menu-wide active">
					<a href="<?php echo BASE_URL."frontoffice/gallery_foto"; ?>"><i class="icon-images2 position-left"></i> Gallery Foto </a>
				</li>

				<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/gallery_video"; ?>"><i class="icon-clapboard-play position-left"></i> Gallery Video </a>
				</li>

				<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/pencarian"; ?>"><i class="icon-search4 position-left"></i> Pencarian dan Download </a>
				</li>

				
			</ul>
		</div>
	</div>
	<!-- /second navbar -->


	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Gallery</span> - Foto</h4>

				<ul class="breadcrumb breadcrumb-caret position-right">
					<li><a href="<?php BASE_URL."frontoffice/"; ?>">Home</a></li>
					<li><a href="<?php BASE_URL."frontoffice/gallery_foto"; ?>">Gallery</a></li>
					<li class="active">Foto</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Image grid -->
				<?php $c = new Controller(); $m = new Model(); foreach ($data['pencarian']['aadata'] as $key => $value) { 
					$string = $value['nama_kegiatan']; 
					if (strlen($string) > 30) {
                          $stringCut = substr($string, 0, 30);
                          $endPoint  = strrpos($stringCut, ' ');
                          $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                          $string   .= "...";
                      }
					// $filedir = ROOT_DIR."static/files/bahan/dokumen/".$value['kode_parent']."/Image/".$value['nama_file'];
					// $filename = BASE_URL."static/files/bahan/dokumen/".$value['kode_parent']."/Image/".$value['nama_file'];

					if($value['structured'] == 0){     
						$filedir = ROOT_DIR."static/files/bahan/dokumen/".$value['kode_parent']."/Image/".$value['nama_file'];   	
						$filename = BASE_URL."static/files/bahan/".$value['dir']."/".$value['kode_parent']."/".$value['subdir']."/".$value['nama_file'];
                    } else {
                    	$filedir = ROOT_DIR."static/files/bahan/".$value['dir']."/".$value['subdir']."/".$value['nama_file'];
                    	$filename = BASE_URL."static/files/bahan/".$value['dir']."/".$value['subdir']."/".$value['nama_file'];
                    }

					if(file_exists($filedir)){
                    	$fileshow = $filename;
                    } else {
                    	$fileshow = BASE_URL."static/images/placeholder.jpg";
                    }
                    $idx = $c->base64url_encode($value['autono']);
					?>
					<div class="col-lg-3 col-sm-6">
						<div class="thumbnail">
							<div class="thumb">
								<img src="<?php echo $fileshow; ?>"   style="height: 200px;" alt="">
								<div class="caption-overflow">
									<span>
										<a href="<?php echo $fileshow; ?>" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-zoomin3"></i></a>
										<a href="<?php echo BASE_URL."frontoffice/album_foto/".$idx; ?>" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5" title="Lihat album"><i class="icon-images3"></i></a>
									</span>
								</div>
							</div>

							<div class="caption">
								<h6 class="no-margin"><a href="<?php echo BASE_URL."frontoffice/album_foto/".$idx; ?>" class="text-default"><?php echo $string ?></a> <a href="<?php echo BASE_URL."frontoffice/album_foto/".$idx; ?>" class="text-muted"><i class="icon-three-bars pull-right"></i></a></h6>
                            	<span class="help-block text-grey text-size-large"><i class="icon-calendar3 pull-left"></i>&nbsp;  <?php echo " ".$m->format_tanggal($value['tanggal'])?></span>
							</div>
						</div>
					</div>
					<?php } ?>			
				<!-- /image grid -->

				<div class="row">
	              <div class="col-lg-12 text-center">
					<?php echo $data['number_paging'] ?>
	              </div>
		        </div>

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

		<!-- Footer -->
		<div class="footer text-muted">
			<img src="<?php echo BASE_URL; ?>static/images/dispenad.png" alt="Dispen"> &copy; 2020 <a href="https://tniad.mil.id/" target="_blank">- Dinas Penerangan Angkatan Darat</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /page container -->

</body>
</html>
<script type="text/javascript">
$(function() {
        $(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });
    }); 
</script>


