<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title']; ?></h4>
                  </div>
                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>/"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>/"><?php echo $data['breadcrumb1']; ?></a></li>
                    <li class="active"><?php echo $data['title']; ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">

<!-- <div class="content"> -->

          <!-- Search field -->
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class="icon-search4 position-left"></i>Pencarian </h5>
              <div class="heading-elements">
                <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="close"></a></li>
                </ul>
              </div>
            <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

            <div class="panel-body">
              <form action="<?php echo BASE_URL."pencarian/search/" ?>" class="main-search">
                <div class="input-group content-group">
                  <div class="has-feedback has-feedback-left">

                    <input type="text" class="form-control input-xlg" name="q" autofocus="on"  placeholder="Masukkan kata kunci" value="<?php echo $_GET['q']?>"></input>
                    <div class="form-control-feedback">
                      <i class="icon-search4 text-muted position-left"></i>
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
                        <a href="#" class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <i class="icon-stack2 position-left"></i> Semua kategori <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                          <li><a href="#"><input class="styled" type="checkbox"  checked="checked"> Semua kategori</a></li>
                          <?php foreach ($data['kategori'] as $key => $cat) {
                           //echo "<li><a href=\"#\"><input class=\"styled\" type=\"checkbox\"  value=\"".$cat[0]."\" disabled checked> ".$cat[1]."</a></li>";
                          } ?>
                        </ul>
                      </li>
                      <li><a href="<?php echo BASE_URL."pencarian/" ?>" class="btn btn-link btn-sm"><i class="icon-reload-alt position-left"></i> Ulangi pencarian</a></li>
                    </ul>
                  </div>

                  <div class="col-sm-6 text-right">
                    <ul class="list-inline no-margin-bottom">
                      <li><a href="<?php echo BASE_URL."pencarian_lengkap" ?>" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i> Pencarian lengkap</a></li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /search field -->


          <!-- Tabs -->
          <ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
            <li class="active"><a href="<?php BASE_URL."pencarian/video" ?>"><i class="icon-file-play position-left"></i> Show result</a></li>
       <!--     <li><a href="<?php BASE_URL."pencarian/images" ?>"><i class="icon-image2 position-left"></i> Images</a></li>
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="visible-xs-inline-block position-right">Options</span> <span class="caret"></span></a>
               <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else</a></li>
                <li class="divider"></li>
                <li><a href="#">One more line</a></li>
              </ul> 
            </li>-->
          </ul>
          <!-- /tabs -->


          <!-- Search results -->
          <div class="panel panel-body">
            <?php if(!empty($data['q'])) { ?>
              <p class="text-muted text-size-small">Pencarian dengan kata kunci <code><?php echo trim($data['q']) ?></code> <span class="text-normal"> hasil <?php echo number_format($data['pencarian']['total'], 0, '.', ','); ?> dokumen dari total <?php echo number_format($data['total'], 0, '.', ','); ?>.</span> </p>
            <?php } else {?>
              <p class="text-muted text-size-small">Menampilkan <span class="text-normal">seluruh hasil <?php echo number_format($data['total'], 0, '.', ','); ?> dokumen.</span> </p>
            <?php } ?>
            <hr>

            <div class="row">
              <div class="col-lg-8">
                <ul class="media-list search-results-list content-group">

                            <?php $c = new Controller; foreach ($data['pencarian']['aadata'] as $key => $doc) { ?>
                            
                            <li class="media">
                              <div class="media-body">
                                <h6 class="media-heading"><a href="<?php echo BASE_URL."dokumen/info/".$c->base64url_encode($doc['autono']); ?>"><?php echo $doc['nama_kegiatan'] ?></a></h6>
                                <ul class="list-inline list-inline-separate text-muted">
                                  <li>Tanggal <?php $m = new Model; echo $m->format_tanggal($doc['tanggal']) ?></li>
                                  <li><?php echo number_format($doc['total'], 0, '.', ',') ?> view</li>
                                </ul>
                                <?php 
                                  $narasi = str_replace("&nbsp;", '', $doc['narasi']);
                                  $string = strip_tags($narasi);
                                  if (strlen($string) > 300) {
                                      $stringCut = substr($string, 0, 300);
                                      $endPoint  = strrpos($stringCut, ' ');
                                      $string    = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                      $string   .= '... <a href="'.BASE_URL."dokumen/info/".$c->base64url_encode($doc['autono']).'">Read More</a>';
                                  }
                                  echo trim($string);
                                ?>
                              </div>
                            </li>
                            <?php } ?>
                          

                            <li class="media related-searches">
                              <h6 class="no-margin-top">Pencarian terakhir:</h6>
                              <div class="row">
                                <ul class="list list-unstyled">
                                <?php foreach ($data['history'] as $key => $hst) {
                                  echo "<li class=\"col-md-4\"><a href=\"".BASE_URL.'pencarian/search/?q='.str_replace(' ', '+', $hst['keywords'])."\">".$hst['keywords']."</a></li>";
                                } ?>
                                </ul>
                              </div>
                            </li>
                          </ul>

                          <?php 
                            // $total_records = $data['pencarian']['total']['total'];
                            // $total_pages   = ceil($total_records / $data['limit']);  

                            // $pagLink = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 

                            // if($data['page'] == 1){
                            //   $pagLink .= "<li class=\"disabled\"><a href=\"#\">←</a></li>"; 
                            // } else {
                            //   $pagLink .= "<li><a href=\"".BASE_URL."pencarian/search/"."?q=".$data['q']."&page=".($data['page']-1)."\">←</a></li>"; 
                            // }



                            // for ($i=1; $i<=$total_pages; $i++) {
                            //   if($data['page'] == $i){
                            //     $class = ' class="active"';
                            //   } else {
                            //     $class = '';
                            //   }

                            // if($i > ($data['page'] + 1)) {
                            //   $pagLink .= "<li><a href=\"".BASE_URL."pencarian/search/"."?q=".$data['q']."&page=".$i."\"> ".$i." </a></li>";
                            // } else {
                            //   $pagLink .= "<li".$class."><a href=\"".BASE_URL."pencarian/search/"."?q=".$data['q']."&page=".$i."\"> ".$i." </a></li>"; 
                            // }



                                
                            // }

                            // if($data['page'] == $total_pages){
                            //   $pagLink .= "<li class=\"disabled\"><a href=\"#\">→</a></li>"; 
                            // } else {
                            //   $pagLink .= "<li><a href=\"".BASE_URL."pencarian/search/"."?q=".$data['q']."&page=".($data['page']+1)."\">→</a></li>"; 
                            // }
                            
                            // echo $pagLink . "</ul>";   

                            echo $data['number_paging'];
                        ?>

                </div>
            </div>
          </div>

        </div>    
<?php include('footer.php'); ?>

