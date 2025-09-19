															<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Office - Pencarian dan Download</title>

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



		/* #######################3 */
		/* ####### SUTYLE Filter by product */
		/* #######################3 */
		#project-list-wrapper .project-select.active {
			background: #e3f2fd;
			color: #1976d2;
		}
		#project-list-wrapper .project-select:hover {
			background: #f0f0f0;
			transition: background 0.15s;
		}
		#project-list-wrapper {
			scrollbar-width: thin;
			scrollbar-color: #bdbdbd #f5f5f5;
		}
		#project-list-wrapper::-webkit-scrollbar {
			width: 6px;
		}
		#project-list-wrapper::-webkit-scrollbar-thumb {
			background: #bdbdbd;
			border-radius: 3px;
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

				<!-- <li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/gallery_foto"; ?>"><i class="icon-images2 position-left"></i> Gallery Foto </a>
				</li>

				<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/gallery_video"; ?>"><i class="icon-clapboard-play position-left"></i> Gallery Video </a>
				</li>
 -->
				<li class="active">
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
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Pencarian</span></h4>

				<ul class="breadcrumb breadcrumb-caret position-right">
					<li><a href="<?php BASE_URL."frontoffice/"; ?>">Home</a></li>
					<li><a href="<?php BASE_URL."frontoffice/pencarian"; ?>">Gallery</a></li>
					<li class="active">Pencarian</li>
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

				<!-- Search field -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><i class="icon-search4 text-muted text-size-base"></i> Pencarian</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<div class="panel-body">
						<form action="<?php echo BASE_URL; ?>frontoffice/pencarian/" class="main-search" method="get" id="main-search-form">
							<div class="input-group content-group">
								<div class="has-feedback has-feedback-left">
									<input type="text" class="form-control input-xlg" name="q" value="<?php echo $data['q']; ?>" placeholder="Masukkan kata kunci..">
									<div class="form-control-feedback">
										<i class="icon-search4 text-muted text-size-base"></i>
									</div>
								</div>

								<div class="input-group-btn">
									<button type="submit" class="btn btn-primary btn-xlg">Search</button>
								</div>
							</div>
						</form>
						<form action="<?php echo BASE_URL; ?>frontoffice/pencarian/" method="post" id="form-filter-project">
							<div class="row search-option-buttons">
								<div class="col-sm-6">
									<ul class="list-inline list-inline-condensed no-margin-bottom">
										<li class="dropdown">
											<a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown">
												<i class="icon-stack2 position-left"></i> All categories <span class="caret"></span>
											</a>

											<ul class="dropdown-menu">
												<li><a href="#" class="category-select" data-category="foto"><i class="icon-images2"></i> Images</a></li>
												<li><a href="#" class="category-select" data-category="video"><i class="icon-clapboard-play"></i> Videos</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="icon-stack3 position-left"></i> Pilih Project <span class="caret"></span>
											</a>
											<ul class="dropdown-menu" id="project-dropdown-menu" style="min-width: 250px; max-height: 300px; overflow-y: auto;">
												<li style="padding: 8px 15px;">
													<input type="text" class="form-control input-sm" id="project-search-input" placeholder="Cari project...">
												</li>
												<li role="separator" class="divider"></li>
												<li>
													<ul id="project-list-wrapper" style="max-height: 220px; overflow-y: auto; padding: 0; margin: 0;">
														<!-- All Project option untuk clear filter -->
														<li style="padding: 0; border-bottom: 1px solid #eee;">
															<a href="#" class="project-select-all" data-project="" style="display: block; padding: 8px 15px; color: #2e7d32; font-weight: bold; background-color: #f8f9fa;">
																<i class="icon-stack3"></i> All Project
															</a>
														</li>
														<?php
														$projects = $data["list_project"];
														$projectNames = [];
														foreach ($projects as $project) {
															if (!empty($project['nama_project']) && !in_array($project['nama_project'], $projectNames)) {
																$projectNames[] = $project['nama_project'];
																?>
																<li style="padding: 0;">
																	<a href="#" class="project-select" data-project="<?php echo htmlspecialchars($project['project']); ?>" style="display: block; padding: 8px 15px; color: #333;">
																		<i class="icon-office"></i> <?php echo htmlspecialchars($project['nama_project']); ?>
																	</a>
																</li>
																<?php
															}
														}
														?>
													</ul>
												</li>
											</ul>
										</li>
										<li><a href="<?php echo BASE_URL; ?>frontoffice/pencarian/" class="btn btn-link btn-sm"><i class="icon-reload-alt position-left"></i> Refine your search</a></li>
									</ul>
								</div>

								<div class="col-sm-6 text-right">
									<ul class="list-inline no-margin-bottom">
										<li><a href="#" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i></a></li>
									</ul>
								</div>
							</div>
							<!-- Hidden input for project -->
							<input type="hidden" name="project" id="selected-project-input" value="">
						</form>
					</div>
				</div>
				<!-- /search field -->

				<?php 
					if($data['tab'] == 'tab-video'){
						$livideo = " class=\"active\"";
						$divideo = "active";
						// $total   = $data['total_video'];
					} else {
						$liimage = " class=\"active\"";
						$diimage = "active";
						//$total   = $data['total_foto'];
					}
				 ?>
				<!-- Tabs -->
				<ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
					<li<?php echo $liimage;?>><a href="#tab-image" data-toggle="tab"><i class="icon-image2 position-left"></i> Images</a></li>
					<li<?php echo $livideo;?>><a href="#tab-video" data-toggle="tab"><i class="icon-file-play position-left"></i> Videos</a></li>
				</ul>
				<!-- /tabs -->


				<!-- Search results -->
				<div class="content-group">
					

					<div class="search-results-list content-group">
						<div class="tab-content">
							<div class="tab-pane <?php echo $diimage;?>" id="tab-image">
							<p class="text-muted text-size-small content-group">About <?php echo $data['total_foto']; ?> results foto (0.34 seconds) </p>																	
							<!-- Image grid -->
							<div class="gallery-grid">
							<?php $c = new Controller(); $m = new Model(); foreach ($data['foto']['aadata'] as $key => $value) { 
								$string = $value['nama_kegiatan']; 
								if (strlen($string) > 30) {
			                          $stringCut = substr($string, 0, 30);
			                          $endPoint  = strrpos($stringCut, ' ');
			                          $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			                          $string   .= "...";
			                      }

			                      //echo "<p>dd</p>".$value['structured'];

			                    if($value['structured'] == 0){
			                    	$filedir = ROOT_DIR."static/files/bahan/".$value['dir']."/".$value['kode_parent']."/".$value['subdir']."/".$value['nama_file'];
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
			                    $idf = $c->base64url_encode($value['autono']);
								?>
								<div class="col-lg-3 col-sm-6">
									<div class="thumbnail">
										<div class="thumb">
											<img src="<?php echo $fileshow; ?>"   style="height: 200px;" alt="">
											<div class="caption-overflow">
												<span>
													<a href="<?php echo $fileshow; ?>" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-zoomin3"></i></a>
													<a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5" title="Lihat album"><i class="icon-images3"></i></a>
												</span>
											</div>
										</div>

										<div class="caption">
											<?php if(!empty($value['nama_project'])): ?>
												<div class="project-name">
													<h6 class="no-margin text-primary text-size-small">
														<strong>
															<a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="text-primary" title="<?php echo $value['nama_project']; ?>">
																<?php echo $value['nama_project']; ?>
															</a>
														</strong>
													</h6>
												</div>
											<?php endif; ?>
											<div class="kegiatan-name">
												<h6 class="no-margin">
													<a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="text-default"><?php echo $string ?></a>
													<a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="text-muted"><i class="icon-three-bars pull-right"></i></a>
												</h6>
											</div>
											
											<!-- <div class="kategori-name">
												<span class="label label-warning">Kategori</span>
												<span class="label label-warning">Kategori</span>
												<span class="label label-warning">Kategori</span>
											</div>
											<div class="sub_kategori-name">
												<span class="label label-primary label-rounded">Sub kategori</span>
												<span class="label label-primary label-rounded">Sub kategori</span>
												<span class="label label-primary label-rounded">Sub kategori</span>
											</div> -->
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
							<!-- /image grid -->

							<div class="row">
				              <div class="col-lg-12 text-center">
								<?php echo $data['number_paging_foto'] ?>
				              </div>
					        </div>
							</div>

							<div class="tab-pane <?php echo $divideo;?>" id="tab-video" >																	
							<!-- Video grid -->
							<p class="text-muted text-size-small content-group">About <?php echo $data['total_video']; ?> results video (0.34 seconds) </p>	
							<div class="gallery-grid">
							<?php foreach ($data['video']['aadata'] as $key => $video) { 
								$string = $video['nama_kegiatan']; 
								if (strlen($string) > 32) {
			                          $stringCut = substr($string, 0, 32);
			                          $endPoint  = strrpos($stringCut, ' ');
			                          $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			                          $string   .= "...";
			                      }

			                      if($video['structured'] == 0){
			                    	
									$videofile = BASE_URL."static/files/bahan/".$video['dir']."/".$video['kode_parent']."/".$video['subdir']."/".$video['nama_file'];
			                    } else {
			                    	$videofile = BASE_URL."static/files/bahan/".$video['dir']."/".$video['subdir']."/".$video['nama_file'];
			                    }

								if($video['tanggal'] != ''){
                                	$tgl = " ".$m->format_tanggal($video['tanggal']);
                                } else {
                                	$tgl = 'Tanggal belum ada';
                                }
                                $idx = $c->base64url_encode($video['autono']);
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
											<?php if(!empty($video['nama_project'])): ?>
												<div class="project-name">
													<h6 class="no-margin text-primary text-size-small">
														<strong>
															<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="text-primary" title="<?php echo $video['nama_project']; ?>">
																<?php echo $video['nama_project']; ?>
															</a>
														</strong>
													</h6>
												</div>
											<?php endif; ?>
											<div class="kegiatan-name">
												<h6 class="no-margin">
													<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx;?>" class="text-default" title="<?php echo $video['nama_kegiatan'];?>"><?php echo $string ?></a>
													<a href="<?php echo BASE_URL."frontoffice/album_video/".$idx; ?>" class="text-muted"><i class="icon-three-bars pull-right"></i></a>
												</h6>
											</div>
											<div class="caption-info">
												<?php if (!empty($video['tanggal'])): ?>
													<span class="help-block text-grey text-size-small">
														<i class="icon-calendar3 pull-left"></i> <?php echo " ".$m->format_tanggal($video['tanggal'])?>
													</span>
												<?php endif; ?>

												<?php if (!empty($video['lokasi'])): ?>
													<span class="help-block text-grey text-size-small">
														<i class="icon-location3 pull-left"></i> 
														<?php echo htmlspecialchars($video['lokasi']); ?>
													</span>
												<?php endif; ?>

												<?php if (!empty($video['team'])): ?>
													<span class="help-block text-grey text-size-small">
														<i class="icon-users4 pull-left"></i> 
														<?php echo htmlspecialchars($video['team']); ?>
													</span>
												<?php endif; ?>

												<?php if (!empty($video['keterangan'])): ?>
													<span class="help-block text-grey text-size-small">
														<i class="icon-info22 pull-left"></i> 
														<?php echo htmlspecialchars($video['keterangan']); ?>
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
								<?php echo $data['number_paging_video'] ?>
				              </div>
					        </div>
							</div>
						</div>
                    </div>

                    
					</div>
				<!-- /search results -->

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
		// Get active project from server
		var activeProject = '<?php echo isset($data["project"]) ? $data["project"] : ""; ?>';
		
		// Update dropdown text to show selected project
		function updateDropdownText() {
			// Reset all selections
			$('.project-select, .project-select-all').removeClass('selected').find('.checkmark').remove();
			
			if (activeProject) {
				$('.project-select[data-project="' + activeProject + '"]').each(function() {
					var projectName = $(this).text().trim().replace(/^\s*✓\s*/, ''); // Remove existing checkmark
					$(this).html('<i class="icon-checkmark-circle text-success" style="margin-right: 5px;"></i><i class="icon-office"></i> ' + projectName);
					
					// Update dropdown button text
					$('.dropdown-toggle:contains("Pilih Project")').html('<i class="icon-stack3 position-left text-success"></i> ' + projectName + ' <span class="caret"></span>');
				});
			} else {
				// Show "All Project" as selected
				$('.project-select-all').html('<i class="icon-checkmark-circle text-success" style="margin-right: 5px;"></i><i class="icon-stack3"></i> All Project');
				$('.dropdown-toggle:contains("Pilih Project")').html('<i class="icon-stack3 position-left text-success"></i> All Project <span class="caret"></span>');
			}
		}
		
		// Initialize on page load
		updateDropdownText();
		
		// Handle "All Project" selection (clear filter)
		$('#project-dropdown-menu').on('click', '.project-select-all', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			console.log('Clearing project filter...');
			
			// Update active project
			activeProject = '';
			$('#selected-project-input').val('');
			
			// Clear session via AJAX
			$.ajax({
				url: '<?php echo BASE_URL; ?>frontoffice/clear_project_session_ajax',
				type: 'POST',
				dataType: 'json',
				success: function(response) {
					console.log('AJAX Clear Response:', response);
					if (response.status === 'success') {
						console.log('Project filter cleared successfully');
						// Update UI
						updateDropdownText();
						// Reload page to show all results
						window.location.href = '<?php echo BASE_URL; ?>frontoffice/pencarian/?q=<?php echo urlencode($data["q"]); ?>';
					} else {
						console.error('Failed to clear filter:', response.message);
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Clear Error:', error);
					console.error('Response Text:', xhr.responseText);
					// Fallback - reload page anyway
					window.location.href = '<?php echo BASE_URL; ?>frontoffice/pencarian/?q=<?php echo urlencode($data["q"]); ?>';
				}
			});
		});
		
		// Submit form when a project is selected
		$('#project-dropdown-menu').on('click', '.project-select', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var projectId = $(this).data('project');
			var projectName = $(this).text().trim();
			$('#selected-project-input').val(projectId);

			console.log('Setting project to session:', projectId);
			
			// Update active project
			activeProject = projectId;
			
			// Simpan project id ke session via AJAX
			$.ajax({
				url: '<?php echo BASE_URL; ?>frontoffice/set_project_session',
				type: 'POST',
				data: { project_id: projectId },
				dataType: 'json',
				success: function(response) {
					console.log('AJAX Response:', response);
					if (response.status === 'success') {
						console.log('Project saved to session successfully');
						// Setelah berhasil, submit form filter
						$('#form-filter-project').submit();
					} else {
						console.error('Failed to save project:', response.message);
						// Tetap submit form meskipun session gagal
						$('#form-filter-project').submit();
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error:', error);
					console.error('Response Text:', xhr.responseText);
					// Tetap submit form meskipun ada error
					$('#form-filter-project').submit();
				}
			});
		});
	});
	
	$(document).ready(function() {
		// Improved project dropdown functionality
		$('#project-dropdown-menu').on('click', '.project-select, .project-select-all', function(e) {
			e.preventDefault();
			e.stopPropagation(); // Prevent event bubbling
			
			var projectId = $(this).data('project');
			var projectName = $(this).text().trim();
			
			console.log("Selected project:", projectName);
			console.log("Project ID:", projectId);
			
			// Update the dropdown button text to show selected project
			$(this).closest('.dropdown').find('.dropdown-toggle').html(
				'<i class="icon-stack3 position-left"></i> ' + projectName + ' <span class="caret"></span>'
			);
			
			// Close the dropdown after selection
			$(this).closest('.dropdown-menu').parent().removeClass('open');
		});

		// Prevent dropdown from closing when clicking inside the dropdown menu
		$('#project-dropdown-menu').on('click', function(e) {
			e.stopPropagation();
		});

		// Handle search input in project dropdown
		$('#project-search-input').on('keyup', function(e) {
			e.stopPropagation(); // Prevent dropdown from closing
			var filter = $(this).val().toLowerCase();
			$('#project-list-wrapper li').each(function() {
				var text = $(this).text().toLowerCase();
				$(this).toggle(text.indexOf(filter) > -1);
			});
		});

		// Category filter functionality - switch tabs based on selected category
		$('.category-select').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation(); // Prevent event bubbling
			
			var category = $(this).data('category');
			console.log('Selected category:', category);
			
			// Update dropdown button text
			var categoryText = $(this).text().trim();
			$(this).closest('.dropdown').find('.dropdown-toggle').html(
				'<i class="icon-stack2 position-left"></i> ' + categoryText + ' <span class="caret"></span>'
			);
			
			// Switch to corresponding tab
			if (category === 'foto') {
				// Activate Images tab
				$('.nav-tabs li').removeClass('active');
				$('a[href="#tab-image"]').parent().addClass('active');
				$('.tab-pane').removeClass('active');
				$('#tab-image').addClass('active');
			} else if (category === 'video') {
				// Activate Videos tab
				$('.nav-tabs li').removeClass('active');
				$('a[href="#tab-video"]').parent().addClass('active');
				$('.tab-pane').removeClass('active');
				$('#tab-video').addClass('active');
			}
			
			// Close the dropdown after selection
			$(this).closest('.dropdown-menu').parent().removeClass('open');
		});
	});


	$(function() {
		$(this).bind("contextmenu", function(e) {
			e.preventDefault();
		});
	}); 

	// Gallery Grid Enhancement
	$(document).ready(function() {
		// Ensure images are loaded before calculating layout
		function initGalleryGrid() {
			var $gallery = $('.gallery-grid');
			var $items = $gallery.find('.thumbnail');
			
			// Add loading state
			$items.addClass('loading');
			
			// Counter for loaded images
			var totalImages = $gallery.find('img, video').length;
			var loadedCount = 0;
			
			function checkAllLoaded() {
				loadedCount++;
				if (loadedCount >= totalImages) {
					$items.removeClass('loading');
					// Add staggered animation
					$items.each(function(index) {
						var $this = $(this);
						setTimeout(function() {
							$this.addClass('loaded');
						}, index * 50);
					});
				}
			}
			
			// Handle image load
			$gallery.find('img').on('load error', checkAllLoaded);
			
			// Handle video load
			$gallery.find('video').on('loadeddata error', checkAllLoaded);
			
			// Fallback if no images/videos
			if (totalImages === 0) {
				$items.removeClass('loading').addClass('loaded');
			}
		}
		
		// Initialize grid
		initGalleryGrid();
		
		// Reinitialize on tab change
		$('a[data-toggle="tab"]').on('shown.bs.tab', function() {
			setTimeout(initGalleryGrid, 100);
		});
		
		// Handle window resize
		var resizeTimer;
		$(window).on('resize', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {
				initGalleryGrid();
			}, 250);
		});
	});
</script>



