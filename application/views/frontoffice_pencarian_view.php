															<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Office - Pencarian dan Download</title>

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
						<form action="<?php echo BASE_URL; ?>frontoffice/pencarian/" class="main-search" method="get">
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

							<div class="row search-option-buttons">
								<div class="col-sm-6">
									<ul class="list-inline list-inline-condensed no-margin-bottom">
										<li class="dropdown">
											<a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown">
												<i class="icon-stack2 position-left"></i> All categories <span class="caret"></span>
											</a>

											<ul class="dropdown-menu">
												<li><a href="#"><i class="icon-images2"></i> Foto</a></li>
												<li><a href="#"><i class="icon-clapboard-play"></i> Video</a></li>
											</ul>
										</li>
										<li><a href="<?php echo BASE_URL; ?>frontoffice/pencarian/" class="btn btn-link btn-sm"><i class="icon-reload-alt position-left"></i> Refine your search</a></li>
									</ul>
								</div>

								<div class="col-sm-6 text-right">
									<ul class="list-inline no-margin-bottom">
										<li><a href="#" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i>&nbsp;</a></li>
									</ul>
								</div>
							</div>
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
											<h6 class="no-margin"><a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="text-default"><?php echo $string ?></a> <a href="<?php echo BASE_URL."frontoffice/album_foto/".$idf; ?>" class="text-muted"><i class="icon-three-bars pull-right"></i></a></h6>
			                            	<span class="help-block text-grey text-size-large"><i class="icon-calendar3 pull-left"></i>&nbsp;  <?php echo " ".$m->format_tanggal($value['tanggal'])?></span>
										</div>
									</div>
								</div>
								<?php } ?>			
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

								if($value['tanggal'] != ''){
                                	$tgl = " ".$m->format_tanggal($value['tanggal']);
                                } else {
                                	$tgl = 'Tanggal belum ada';
                                }
                                $idx = $c->base64url_encode($video['autono']);
								?>
								<div class="col-lg-3 col-sm-6">
									<div class="thumbnail">
										<div class="thumb">
											<video width="100%" height="200px" controls controlsList="nodownload" style="outline: none;border: none;background: #090909"><source src="<?php echo $videofile; ?>#t=20" type="video/mp4" preload="metadata"></video>
										</div>

										<div class="caption">
											<h6 class="no-margin"><a href="<?php echo BASE_URL."frontoffice/show_video/".$idx;?>" class="text-default" title="<?php echo $video['nama_kegiatan'];?>"><?php echo $string ?></a> <a href="#" class="text-muted"></a></h6>
                                        	<span class="help-block text-grey text-size-large"><i class="icon-calendar3 pull-left"></i>&nbsp;  <?php echo $tgl; ?></span>
										</div>
									</div>
								</div>
								<?php } ?>					
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
			<!-- <img src="<?php echo BASE_URL; ?>static/images/dispenad.png" alt="Dispen"> --> &copy; 2020 <a href="https://tniad.mil.id/" target="_blank">- Dinas Sejarah Angkatan Darat</a>
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



