<?php include('header.php'); ?>

              <!-- Page header -->

              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Hasil </span>pencarian</h4>
                  </div>
                </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="#"><?php echo $data['title'] ?></a></li>
                    <li class="active"><?php  echo $data['kegiatan']; ?></li>

                  </ul>
                </div>
              </div>
              <!-- /page header -->


              <!-- Content area -->
              <div class="content">
                <div class="panel panel-white">
                      <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-image3"></i> &nbsp;<strong>Dokumen</strong> file </h6>
                        <div class="heading-elements">
                          <a href="<?php echo BASE_URL."dokumen_bahan" ?>" class="btn btn-default btn-xs heading-btn"><i class="icon-arrow-left52 position-left"></i> Back</a>
          
                          <button type="button" class="btn btn-default btn-xs heading-btn" onclick="window.print()"><i class="icon-printer2 position-left"></i> Print</button>
                        </div>
                      <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                      <div class="panel-body no-padding-bottom" id="section-to-print">
                        <div class="row">
                          <div class="col-md-8 content-group">
                            <h3><?php echo $data['kegiatan']; "tesetew" ?></h3>
                            <ul class="list-inline list-inline-separate text-muted">
                                  <li><i class="icon-calendar2"></i> &nbsp;<?php echo $data['tanggal']; ?></li>
                                  <li> <?php echo number_format($data['total'],0, ',','.'); ?> files </li>
                              </ul>
                          </div>

                          
                        </div>
                       

                        <div class="row">
                          <?php 
                            if($data['jdown']!="disabled"){
                            foreach ($data['pencarian']['aadata'] as $key => $attch) { 

                            $dir = str_replace('/var/www/html/static/files/bahan/', '', $attch['dir']);

                            $remoteFile = BASE_URL."static/files/bahan/".$dir;
                            // $ch = curl_init($remoteFile);
                            // curl_setopt($ch, CURLOPT_NOBODY, true);
                            // curl_exec($ch);
                            // $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            // curl_close($ch);

                            if($remoteFile){
                                $fileshow = $remoteFile;
                                $videofile = true;
                            }else{
                                $fileshow = BASE_URL."static/images/placeholder.jpg";
                                $videofile = false;
                            } 

                            //$tipe = explode('/', $attch['tipe_file']);  
                            
                            $ee = explode('/',$dir);
                            $s = count($ee);
                            $u = $s-1;
 
                            $nama_file =  $ee[$u];
                            $tipe = explode('.', $nama_file);
                            
                            
                            
                            if(strtolower($tipe[1])== 'mp4'){ 
                              
                                echo '<div class="col-lg-2 col-sm-6">';
                                echo '<video width="190" controls><source src="'.$fileshow.'#t=0" type="video/mp4" preload="none"></video>';
                            	//echo '<span class="help-block">'.$nama_file.'</span>';    
                            	echo '</div>';
                              
                            }  else if (strtolower($tipe[1])== 'jpg') {
                        ?>
                              <div class="col-lg-2 col-sm-8">
                                <div class="thumbnail" >
                                  <div class="thumb"class="col-lg-4 col-sm-6" >
                                    <img src="<?php echo $fileshow ?>" alt="Media dokumen">  
                                    <div class="caption-overflow">
                                      <span>
                                        <a href="<?php echo $fileshow; ?>" data-popup="lightbox" rel="gallery" target="_blank" alt="Media dokumen" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-zoomin3"></i></a> 
                                      </span>
                                    </div>
                                  <span class="help-block"><?php echo $nama_file ?>
                                   	<div class="text-right" style="margin-top:-30px;">
                                    	<a href="<?php echo $data['curl']."/download/". $attch['autono']; ?>" class="btn text-success-600 btn-flat btn-icon" data-popup="tooltip" data-original-title="Download"><i class="icon-download4"></i></a>
                                   	</div> 
                                  </span>
                                  </div>
                                </div>
                                
                              </div>
                            <?php }  else {  ?>
                            <div class="col-lg-2 col-sm-8">
                                <div class="thumbnail" >
                                  <div class="thumb"class="col-lg-4 col-sm-6" >
                                    <img src="<?php echo BASE_URL."static/images/placeholder.jpg"; ?>"  alt="Media dokumen">  
                                    <div class="caption-overflow">
                                      <span>
                                        <a href="<?php echo $fileshow ?>" target="_blank" alt="Media dokumen" class="btn border-white text-white btn-flat btn-icon btn-rounded"><?php echo $nama_file;?></a> 
                                      </span>
                                    </div>

                                  </div>
                                 <span class="help-block"><?php echo $nama_file ?>
                                   	<div class="text-right" style="margin-top:-30px;">
                                    	<a href="<?php echo $data['curl']."/download/". $attch['autono']; ?>" class="btn text-success-600 btn-flat btn-icon" data-popup="tooltip" data-original-title="Download"><i class="icon-download4"></i></a>
                                   	</div> 
                                  </span>
                                </div>
                              </div>
                              
                            
                            <?php } } } ?>
                        </div>
                      <div class="row text-center">&nbsp;</div>
                      <div class="row text-center"><?php echo $data['number_paging']; ?></div>
                      
                      </div>

                      <div class="panel-body">
                        <div class="row invoice-payment">

                        </div>
                        <h6></h6>
                        <p class="text-muted text-size-mini"><img src="<?php echo BASE_URL.'static/images/dispenad.png'; ?>" alt="Dispen"> <strong>&nbsp; Copyright</strong> @2020 - Dinas Penerangan Angkatan Darat. </p>
                      </div>
                    </div>

              

              <!-- Info modal -->
                  <div id="modal_form" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-teal">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-file-download2" title="Dokumen"></i>&nbsp; Download</h6>
                        </div>

                        <div class="modal-body">
                          <!-- Wizard with validation -->
                          <div class="panel panel-white">          
                              <form class="form-validation" action="<?php echo $data['curl']."/savedownload/".$data['encode']; ?>" method="post">
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
                                            $filename = BASE_URL."static/files/bahan/".$file['dir']."/".$file['kode_parent']."/".$file['subdir']."/".$file['nama_file'];
                                            $chs = curl_init($filename);
                                            curl_setopt($chs, CURLOPT_NOBODY, true);
                                            curl_exec($chs);
                                            $responseCodes = curl_getinfo($chs, CURLINFO_HTTP_CODE);
                                            curl_close($chs);

                                            if($responseCodes == 200){
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

       </div>

              <!-- Content -->   

<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/dokumen/';

$(document).ready(function(){
   $("#checkAll").click(function(){
       $("#chkfile").find(":checkbox").attr("checked",this.checked);
   });
})
</script>