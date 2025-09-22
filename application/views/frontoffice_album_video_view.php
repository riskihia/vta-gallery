<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Office - Album Video</title>

	<!-- Global stylesheets -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/vitechasia2.png">
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
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/libraries/jquery_ui/core.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/plugins/notifications/sweet_alert.min.js"></script>

	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/pages/gallery.js"></script>
	
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/static/js/pages/wizard_form.js"></script>
	<!-- /theme JS files -->
	
	<!-- Custom styles for album info -->
	<style>
		/* Compact 3-column album info layout */
		.album-info-compact {
			background: #f8f9fa;
			border: 1px solid #dee2e6;
			border-radius: 6px;
			padding: 15px;
			margin-bottom: 20px;
		}
		
		.info-columns {
			display: flex;
			gap: 20px;
			margin-bottom: 15px;
		}
		
		.info-col {
			flex: 1;
			min-width: 0; /* Prevent flex item from growing beyond container */
		}
		
		.info-item-compact {
			margin-bottom: 8px;
			padding: 6px 0;
		}
		
		.info-label {
			font-size: 14px;
			color: #6c757d;
			text-transform: uppercase;
			font-weight: 600;
			margin-bottom: 2px;
			display: flex;
			align-items: center;
			gap: 4px;
		}
		
		.info-value {
			font-size: 16px;
			color: #343a40;
			font-weight: 500;
			line-height: 1.3;
			word-wrap: break-word;
		}
		
		.info-icon {
			font-size: 16px;
			width: 18px;
		}
		
		.team-badges {
			display: flex;
			flex-wrap: wrap;
			gap: 3px;
			margin-top: 2px;
		}
		
		.team-badge {
			display: inline-block;
			background: #e3f2fd;
			color: #1976d2;
			padding: 2px 6px;
			border-radius: 10px;
			font-size: 14px;
			line-height: 1.2;
		}
		
		.keterangan-section {
			border-top: 1px solid #e9ecef;
			padding-top: 12px;
			margin-top: 5px;
		}
		
		.keterangan-content {
			background: #fff;
			padding: 10px;
			border-radius: 4px;
			border: 1px solid #e9ecef;
			font-size: 14px;
			line-height: 1.4;
			color: #495057;
		}
		
		/* Responsive adjustments */
		@media (max-width: 768px) {
			.info-columns {
				flex-direction: column;
				gap: 10px;
			}
		}
		
		@media (max-width: 480px) {
			.album-info-compact {
				padding: 12px;
			}
			
			.info-columns {
				gap: 8px;
			}
		}
	</style>

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

				<li class="dropdown mega-menu mega-menu-wide active">
					<a href="<?php echo BASE_URL."frontoffice/gallery_video"; ?>"><i class="icon-clapboard-play position-left"></i> Gallery Video </a>
				</li> -->

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
				<h4>
					<a href="#" onclick="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Gallery Video</span> - <?php echo $data['info']['nama_kegiatan']?> 
					
					<!-- <div class="text-right" style="margin-top:-35px"><button type="button" class="btn btn-default btn-xs heading-btn" data-toggle="modal" data-target="#modal_form"><i class="icon-file-download2 position-left"></i> Download</button></div> -->
				</h4>

				<ul class="breadcrumb breadcrumb-caret position-right">
					<li><a href="<?php echo BASE_URL."frontoffice/"; ?>">Home</a></li>
					<li><a href="<?php echo BASE_URL."frontoffice/pencarian/"; ?>">Gallery Video</a></li>
                	<li class="active"><?php $m = new Model(); echo $m->format_tanggal($data['info']['tanggal']);?></li>
					<li class="active"><?php echo $data['info']['nama_kegiatan']?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			<!-- Album Information Section -->
			<div class="content-wrapper">
				<!-- Album Details Card -->
				<div class="panel panel-flat" style="margin-bottom: 20px;">
					<div class="panel-heading">
						<h5 class="panel-title"><i class="icon-info22 position-left"></i> Informasi Album</h5>
					</div>
					<div class="panel-body">
						<!-- Compact 3-Column Album Info -->
						<div class="album-info-compact">
							<div class="info-columns">
								<!-- Kolom 1: Tanggal & Lokasi -->
								<div class="info-col">
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-calendar22 info-icon text-primary"></i>
											Tanggal
										</div>
										<div class="info-value">
											<?php $m = new Model(); echo $m->format_tanggal($data['info']['tanggal']);?>
										</div>
									</div>
									
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-location4 info-icon text-success"></i>
											Lokasi
										</div>
										<div class="info-value">
											<?php echo !empty($data['info']['lokasi']) ? $data['info']['lokasi'] : '<span class="text-muted">Tidak tersedia</span>'; ?>
										</div>
									</div>
								</div>
								
								<!-- Kolom 2: Project & Total Video -->
								<div class="info-col">
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-folder-open info-icon text-warning"></i>
											Project
										</div>
										<div class="info-value">
											<?php echo !empty($data['info']['nama_project']) ? $data['info']['nama_project'] : '<span class="text-muted">Tidak tersedia</span>'; ?>
										</div>
									</div>
									
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-clapboard-play info-icon text-info"></i>
											Total Video
										</div>
										<div class="info-value">
											<span class="label label-success label-sm"><?php echo count($data['aadata']); ?> Video</span>
										</div>
									</div>
								</div>
								
								<!-- Kolom 3: Tim -->
								<div class="info-col">
									<?php if(!empty($data['info']['team'])): ?>
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-users info-icon text-info"></i>
											Tim Terlibat
										</div>
										<div class="info-value">
											<div class="team-badges">
												<?php 
												$team_members = explode(', ', $data['info']['team']);
												foreach($team_members as $member): ?>
													<span class="team-badge"><?php echo trim($member); ?></span>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
									<?php else: ?>
									<div class="info-item-compact">
										<div class="info-label">
											<i class="icon-users info-icon text-muted"></i>
											Tim Terlibat
										</div>
										<div class="info-value">
											<span class="text-muted">Tidak tersedia</span>
										</div>
									</div>
									<?php endif; ?>
								</div>
							</div>
							
							<!-- Keterangan (Full Width di bawah) -->
							<?php if(!empty($data['info']['keterangan'])): ?>
							<div class="keterangan-section">
								<div class="info-label" style="margin-bottom: 8px;">
									<i class="icon-file-text info-icon text-slate"></i>
									Keterangan
								</div>
								<div class="keterangan-content">
									<?php echo nl2br(htmlspecialchars($data['info']['keterangan'])); ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<!-- Video Gallery Section -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">
							<i class="icon-clapboard-play position-left"></i> 
							Galeri Video
							<span class="label label-success pull-right"><?php echo count($data['aadata']); ?> Video</span>
						</h5>
					</div>
					<div class="panel-body">

			<!-- Main content -->

				<!-- Video grid -->
				<?php foreach ($data['aadata'] as $key => $value) { 
					$string = $value['nama_file']; 
					if (strlen($string) > 40) {
                          $stringCut = substr($string, 0, 40);
                          $endPoint  = strrpos($stringCut, ' ');
                          $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                          $string   .= "...";
                      }

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
					?>
					<div class="col-lg-3 col-sm-6">
						<div class="thumbnail">
							<div class="thumb">
								<video width="100%" height="200px" muted style="outline: none;border: none;background: #090909">
									<source src="<?php echo $fileshow; ?>#t=20" type="video/mp4" preload="metadata">
								</video>
								<div class="caption-overflow">
									<span>
										<a href="<?php echo $fileshow; ?>" data-popup="video-lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-play3"></i></a>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>			
				<!-- /video grid -->

				<div class="row">
	              <div class="col-lg-12 text-center">
					<?php echo $data['number_paging'] ?>
	              </div>
		        </div>
		        
		        </div>
				</div>
				<!-- /video gallery panel -->

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

	<!-- Video Modal -->
	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: 90%; max-width: 1200px;">
			<div class="modal-content" style="background: #000; border: none;">
				<div class="modal-header" style="border: none; padding: 10px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.8;position:static;font-size: 24px;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="padding: 0;">
					<video id="modalVideo" width="100%" style="max-height: 600px;" controls style="background: #000;">
						<source id="modalVideoSource" src="" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>
	</div>

	<!-- Info modal -->
	  <div id="modal_form" class="modal fade">
	    <div class="modal-dialog modal-full">
	      <div class="modal-content">
	        <div class="modal-header bg-teal">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h6 class="modal-title"><i class="icon-file-download2" title="Dokumen"></i>&nbsp; Download</h6>
	        </div>

	        <div class="modal-body">
	          <!-- Wizard with validation -->
	          <div class="panel panel-white">          
	              <form class="form-validation" action="<?php echo BASE_URL."frontoffice/savedownload/".$data['encode']; ?>" method="post">
	                <fieldset class="step" id="validation-step1">
	                  <h6 class="form-wizard-title text-semibold">
	                    <span class="form-wizard-count">1</span>
	                    Personel info
	                    <small class="display-block">Masukkan data personel untuk mendownload file ini.</small>
	                  </h6>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Nama Lengkap: <span class="text-danger">*</span></label>
	                        <input type="text" name="nama_lengkap" class="form-control required" placeholder="Nama lengkap">
	                      </div>
	                    </div>

	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Pangkat: <span class="text-danger">*</span></label>
	                        <select  class="select required" data-placeholder="Pilih pangkat" name="pangkat" >
	                          <option></option>
	                            <?php
	                              $jp = count($data['pangkat']);
	                              for ($i=0; $i < $jp; $i++) { 
	                                $jk = count($data['pangkat'][$i]['pangkat']);
	                                echo "<optgroup class=\"bg-teal\" label=\"".$data['pangkat'][$i]['milpnsval']."\">";
	                                  for ($n=0; $n < $jk; $n++) { 
	                                    echo "<option class=\"text-size-mini\" value=\"".$data['pangkat'][$i]['pangkat'][$n]['kd_pangkat']."\">".$data['pangkat'][$i]['pangkat'][$n]['nm_pangkat']."</option>"."\n";
	                                  }
	                                echo "</optgroup>"."\n";
	                              }
	                            ?>
	                        </select>
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>NRP: <span class="text-danger">*</span></label>
	                        <input type="text" name="nrp" class="form-control required" placeholder="NRP">
	                      </div>
	                    </div>

	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Jabatan: <span class="text-danger">*</span></label>
	                        <input type="text" name="jabatan" class="form-control required" placeholder="Jabatan">
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group">
	                        <label>Handphone:<span class="text-danger">*</span></label>
	                        <input type="text" name="telp" class="form-control required" placeholder="+62-999-9999-9999" data-mask="+62-999-9999-9999">
	                      </div>
	                    </div>

	                    <div class="col-md-6">
	                      <label>Korps:<span class="text-danger">*</span></label>
	                      <div class="row">
	                        <div class="col-md-12">
	                          <div class="form-group">
	                            <select data-placeholder="Pilih korps" class="select required"  name="korps" >
	                            <option></option>
	                                <?php foreach ($data['korps'] as $key => $korps) { echo "<option value=\"".$korps[0]."\">".$korps[1]."</option>"."\n";} ?>
	                            </select>
	                          </div>
	                        </div>

	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <label>Keperluan: <span class="text-danger">*</span></label>
	                        <textarea rows="5" cols="5" class="form-control required" placeholder="" name="keperluan"></textarea>
	                        <span class="text-size-mini text-warning-300"><em>* Tulis keperluan penggunaan dokumen ini.</em></span>
	                      </div>
	                    </div> 
	                  </div>
	                </fieldset>

	                <fieldset class="step" id="validation-step2">
	                  <h6 class="form-wizard-title text-semibold">
	                    <span class="form-wizard-count">2</span>
	                    Choose file
	                    <small class="display-block">Pilih file yang akan di download.</small>
	                  </h6>

	                  <div class="row">
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <table class="table table-striped media-library table-lg">
	                          <thead>
	                              <tr>
	                                  <th class=""><!-- <input type="checkbox" name="checkAll" id="checkAll" class="styled"> --></th>
	                                  <th class="text-bold text-teal">Preview</th>
	                                  <th class="text-bold text-teal">File Name</th>
	                                  <th class="text-bold text-teal">File info</th>
	                              </tr>
	                          </thead>
	                          <tbody>

	                            <?php foreach ($data['attch'] as $key => $file) { 
	                            $nama_file =  explode(".", $file['nama_file']); 
	                            $tipes = explode('/', $file['tipe_file']); 
	                            if($file['structured'] == 0){  	
									$filename = BASE_URL."static/files/bahan/".$file['dir']."/".$file['kode_parent']."/".$file['subdir']."/".$file['nama_file'];
			                    } else {
			                    	$filename = BASE_URL."static/files/bahan/".$file['dir']."/".$file['subdir']."/".$file['nama_file'];
			                    }
	                            
	                            if($filename){
	                                $fileattch = $filename;
	                            }else{
	                                $fileattch = BASE_URL."static/images/placeholder.jpg";
	                            }
	                            

	                            ?>
	                              
	                              <tr>
	                                <td><input type="checkbox" name="chkfile[]" value="<?php echo $file['autono'] ?>" class="styled"></td>
	                                <td>
	                                  <a href="<?php echo $fileattch; ?>" data-popup="lightbox">

	                                    <?php if($tipes[0] == 'video') {
	                                      echo '<video width="190" controls controlsList="nodownload"><source src="'.$fileattch.'" type="video/mp4" ></video>';
	                                    } else {
	                                      echo '<img src="'.$fileattch.'" alt="" class="img-rounded img-preview">';
	                                    }
	                                    ?>
	                                    
	                                  </a>
	                                </td>
	                                <td><a href="#"><?php echo $nama_file[0]; ?></a></td>
	                                <td>
	                                  <ul class="list-condensed list-unstyled no-margin">                                     
	                                    <li><span class="text-semibold">Size:</span> <code><?php echo number_format($file['ukuran']/1024). ' KB'; ?></code></li>
	                                    <li><span class="text-semibold">Format:</span> <code><?php echo $file['tipe_file']; ?></code></li>
	                                  </ul>
	                                </td>
	                              </tr>
	                             <?php  } ?>                        
	                              
	                          </tbody>
	                      </table>
	                      </div>
	                    </div>
	                    
	                  </div> 
	                    
	                </fieldset>

	                <div class="form-wizard-actions text-right">
	                  <button type="reset" id="validation-back" class="btn btn-default"><i class="icon-circle-left2 position-left"></i> Back</button>
	                  <button type="submit" id="validation-next" class="btn bg-teal">Next <i class="icon-circle-right2 position-right"></i></button>
	                </div>
	              </form>
	          </div>
	          <!-- /wizard with validation -->

	      </div>
	    </div>
	  </div>
	  <!-- /info modal -->  

</body>
</html>
<script type="text/javascript">
$(function() {
    // Disable right click
    $(this).bind("contextmenu", function(e) {
        e.preventDefault();
    }); 

    // Video modal popup
    $('[data-popup="video-lightbox"]').click(function(e) {
        e.preventDefault();
        var videoSrc = $(this).attr('href');
        
        // Set video source
        $('#modalVideoSource').attr('src', videoSrc);
        $('#modalVideo')[0].load(); // Reload video element
        
        // Show modal
        $('#videoModal').modal('show');
        
        // Auto play when modal is shown
        $('#videoModal').on('shown.bs.modal', function() {
            $('#modalVideo')[0].play();
        });
    });

    // Stop video when modal is closed
    $('#videoModal').on('hidden.bs.modal', function() {
        var video = $('#modalVideo')[0];
        video.pause();
        video.currentTime = 0;
        $('#modalVideoSource').attr('src', '');
    });
}); 
</script>
