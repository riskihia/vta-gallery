<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Office - Gallery Video</title>

	<!-- Global stylesheets -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/vitechasia2.png">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE_URL; ?>/static/css/frontoffice/colors.css" rel="stylesheet" type="text/css">
	
	<!-- /global stylesheets -->

	<!-- Custom CSS for grid layout -->
	<style>
		/* Modern Flexible Grid Layout */
		.gallery-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
			gap: 20px;
			padding: 0 15px;
			align-items: start; /* Ensures items align to top */
			margin: 0; /* Reset any Bootstrap margin */
		}
		
		/* Ensure first child doesn't have extra space */
		.gallery-grid::before {
			display: none !important;
		}
		
		/* Reset Bootstrap columns untuk grid items */
		.gallery-grid .col-lg-3, 
		.gallery-grid .col-sm-6 {
			width: auto !important;
			padding: 0 !important;
			margin-bottom: 0 !important;
			float: none !important;
			position: relative !important;
			min-height: auto !important;
		}
		
		/* Card styling dengan flexbox */
		.gallery-grid .thumbnail {
			height: 100%;
			display: flex;
			flex-direction: column;
			border: 1px solid #ddd;
			border-radius: 8px;
			overflow: hidden;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
			background: #fff;
		}
		
		.gallery-grid .thumbnail:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
		}
		
		/* Thumb container dengan aspect ratio konsisten */
		.gallery-grid .thumb {
			flex-shrink: 0;
			position: relative;
			width: 100%;
			height: 200px;
			overflow: hidden;
		}
		
		.gallery-grid .thumb img,
		.gallery-grid .thumb video {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
			background-color: #f5f5f5;
		}
		
		/* Video specific styling */
		.gallery-grid .thumb video {
			background-color: #000;
		}
		
		.gallery-grid .thumb video::-webkit-media-controls-panel {
			background-color: rgba(0,0,0,0.8);
		}
		
		/* Caption area yang fleksibel */
		.gallery-grid .caption {
			flex-grow: 1;
			display: flex;
			flex-direction: column;
			padding: 15px;
			min-height: 120px;
		}
		
		/* Project name styling */
		.project-name {
			margin-bottom: 8px;
		}
		
		.project-name h6 {
			margin-bottom: 0;
			line-height: 1.3;
			font-size: 12px;
			max-height: 20px;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
		
		/* Kegiatan name with flexible height */
		.kegiatan-name {
			flex-grow: 1;
			margin-bottom: 10px;
		}
		
		.kegiatan-name h6 {
			margin-bottom: 0;
			line-height: 1.4;
			font-size: 14px;
			max-height: 56px; /* 4 lines max */
			overflow: hidden;
			display: -webkit-box;
			-webkit-line-clamp: 3;
			-webkit-box-orient: vertical;
			line-clamp: 3; /* Standard property */
		}
		
		/* Info section at bottom */
		.caption-info {
			margin-top: auto;
		}
		
		   .gallery-grid .caption .help-block {
			   margin-bottom: 5px;
			   font-size: 11px;
			   line-height: 1.3;
			   display: flex;
			   align-items: center;
			   gap: 2px;
		   }

		   .gallery-grid .caption .help-block:last-child {
			   margin-bottom: 0;
		   }

		   .gallery-grid .caption .help-block i[class^="icon-"] {
			   margin-right: 4px;
			   min-width: 16px;
			   text-align: center;
			   font-size: 13px;
			   line-height: 1;
			   align-self: center;
		   }
		
		/* Caption overlay improvements */
		.caption-overflow {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0,0,0,0.7);
			display: flex;
			align-items: center;
			justify-content: center;
			opacity: 0;
			transition: opacity 0.3s ease;
		}
		
		.thumb:hover .caption-overflow {
			opacity: 1;
		}
		
		/* Responsive adjustments */
		@media (max-width: 767px) {
			.gallery-grid {
				grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
				gap: 15px;
			}
			
			.gallery-grid .thumb {
				height: 180px;
			}
		}
		
		@media (max-width: 480px) {
			.gallery-grid {
				grid-template-columns: 1fr;
				gap: 15px;
			}
			
			.gallery-grid .thumb {
				height: 200px;
			}
		}
		
		/* Large screens optimization */
		@media (min-width: 1200px) {
			.gallery-grid {
				grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			}
		}
		
		/* Fallback untuk browser lama yang tidak support CSS Grid */
		@supports not (display: grid) {
			.gallery-grid {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px; /* Negative margin untuk spacing */
			}
			
			.gallery-grid .col-lg-3, 
			.gallery-grid .col-sm-6 {
				width: calc(25% - 20px) !important;
				margin: 0 10px 20px 10px !important;
				padding: 0 !important;
				float: none !important;
			}
			
			@media (max-width: 991px) {
				.gallery-grid .col-lg-3, 
				.gallery-grid .col-sm-6 {
					width: calc(50% - 20px) !important;
				}
			}
			
			@media (max-width: 767px) {
				.gallery-grid .col-lg-3, 
				.gallery-grid .col-sm-6 {
					width: calc(100% - 20px) !important;
				}
			}
		}
		
		/* Smooth loading animation */
		.gallery-grid .thumbnail {
			animation: fadeInUp 0.3s ease-out;
		}
		
		.gallery-grid .thumbnail.loading {
			opacity: 0.7;
		}
		
		.gallery-grid .thumbnail.loaded {
			opacity: 1;
			transform: translateY(0);
		}
		
		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>

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
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/afterglow.min.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header" style="display: flex; align-items: center;">
			<a class="navbar-brand" style="padding: 0px 0px 0px 20px !important;" href="#">
				<img style="height: 100%; margin-top: 0 !important;" src="<?php echo BASE_URL ?>static/images/LOGO VTAH GROUP - putih.png" alt="">
			</a>
			<span style="display: flex; align-items: center;">FRONTOFFICE - VTA GALLERY</span>
			<ul class="nav navbar-nav pull-right visible-xs-block" style="margin-left: auto;">
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

				<li>
					<a href="<?php echo BASE_URL."frontoffice/gallery_foto"; ?>"><i class="icon-images2 position-left"></i> Gallery Foto </a>
				</li>

				<li class="active">
					<a href="<?php echo BASE_URL."frontoffice/gallery_video"; ?>"><i class="icon-clapboard-play position-left"></i> Gallery Video </a>
				</li>

				<li>
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
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Gallery</span> - Video</h4>

				<ul class="breadcrumb breadcrumb-caret position-right">
					<li><a href="<?php BASE_URL."frontoffice/"; ?>">Home</a></li>
					<li><a href="<?php BASE_URL."frontoffice/gallery_video"; ?>">Gallery</a></li>
					<li class="active">Video</li>
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

				<!-- Video grid -->
				<div class="gallery-grid">
				<?php $c = new Controller(); $m = new Model(); foreach ($data['pencarian']['aadata'] as $key => $value) { 
					$string = $value['nama_kegiatan']; 
					if (strlen($string) > 32) {
                          $stringCut = substr($string, 0, 32);
                          $endPoint  = strrpos($stringCut, ' ');
                          $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                          $string   .= "...";
                      }

					if($value['structured'] == 0){
						$videofile = BASE_URL."static/files/bahan/".$value['dir']."/".$value['kode_parent']."/".$value['subdir']."/".$value['nama_file'];
					} else {
						$videofile = BASE_URL."static/files/bahan/".$value['dir']."/".$value['subdir']."/".$value['nama_file'];
					}

					if($value['tanggal'] != ''){
						$tgl = " ".$m->format_tanggal($value['tanggal']);
					} else {
						$tgl = 'Tanggal belum ada';
					}
					$idx = $c->base64url_encode($value['autono']);
					?>
					<div class="col-lg-3 col-sm-6">
						<div class="thumbnail">
							<div class="thumb">
								<video width="100%" height="200px" controls controlsList="nodownload" style="outline: none;border: none;background: #090909"><source src="<?php echo $videofile; ?>#t=20" type="video/mp4" preload="metadata"></video>
								<div class="caption-overflow">
									<span>
										<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="btn border-white text-white btn-flat btn-icon btn-rounded" title="Lihat semua video"><i class="icon-play3"></i></a>
										<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5" title="Lihat album video"><i class="icon-clapboard-play"></i></a>
									</span>
								</div>
							</div>

							<div class="caption">
								<?php if(!empty($value['nama_project'])): ?>
									<div class="project-name">
										<h6 class="no-margin text-primary text-size-small">
											<strong>
												<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="text-primary" title="<?php echo $value['nama_project']; ?>">
													<?php echo $value['nama_project']; ?>
												</a>
											</strong>
										</h6>
									</div>
								<?php endif; ?>
								<div class="kegiatan-name">
									<h6 class="no-margin">
										<a href="<?php echo BASE_URL."frontoffice/show_video/".$idx;?>" class="text-default" title="<?php echo $value['nama_kegiatan'];?>"><?php echo $string ?></a>
										<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="text-muted"><i class="icon-three-bars pull-right"></i></a>
									</h6>
								</div>
								
								<div class="caption-info">
									<?php if (!empty($value['tanggal'])): ?>
										<span class="help-block text-grey text-size-small">
											<i class="icon-calendar3 pull-left"></i> <?php echo " ".$m->format_tanggal($value['tanggal'])?>
										</span>
									<?php endif; ?>

									<?php if (!empty($value['lokasi'])): ?>
										<span class="help-block text-grey text-size-small">
											<i class="icon-location3 pull-left"></i> 
											<?php echo htmlspecialchars($value['lokasi']); ?>
										</span>
									<?php endif; ?>

									<?php if (!empty($value['team'])): ?>
										<span class="help-block text-grey text-size-small">
											<i class="icon-users4 pull-left"></i> 
											<?php echo htmlspecialchars($value['team']); ?>
										</span>
									<?php endif; ?>

									<?php if (!empty($value['keterangan'])): ?>
										<span class="help-block text-grey text-size-small">
											<i class="icon-info22 pull-left"></i> 
											<?php echo htmlspecialchars($value['keterangan']); ?>
										</span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<!-- /video grid -->

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
			<span style="padding-left: 20px">
				&copy; 	2025 <span href="#" target="#">- VTA GALLERY</a>
			</span>
		</div>
		<!-- /footer -->

	</div>
	<!-- /page container -->

</body>
</html>


<script type="text/javascript">
$(function() {
	// Disable right click
	$(document).on("contextmenu", function(e) {
		e.preventDefault();
	});
	
	// Gallery Animation
	function initGalleryGrid() {
		const $items = $('.gallery-grid').find('.thumbnail');
		$items.addClass('loading');
		const totalMedia = $('.gallery-grid').find('img, video').length;
		let loaded = 0;

		function markLoaded() {
			loaded++;
			if (loaded >= totalMedia) {
				$items.removeClass('loading');
				$items.each(function (i) {
					const $el = $(this);
					setTimeout(function () {
						$el.addClass('loaded');
					}, i * 50);
				});
			}
		}

		$('.gallery-grid').find('img').on('load error', markLoaded);
		$('.gallery-grid').find('video').on('loadeddata error', markLoaded);

		if (totalMedia === 0) {
			$items.removeClass('loading').addClass('loaded');
		}
	}
	
	// Initialize gallery animation
	initGalleryGrid();
	
	// Re-initialize on resize
	let resizeTimer;
	$(window).on('resize', function () {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(initGalleryGrid, 250);
	});
});
</script>


