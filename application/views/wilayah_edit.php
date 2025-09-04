<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title'] ?></h4>
                  </div>
                  <?php // include('statistic.php'); ?>
                  </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['breadcrumb1'] ?></a></li>
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['title'] ?></a></li>
                    <li class="active"><?php echo $data['action'] ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><strong><?php echo $data['action'] ?></strong> <?php echo $data['title'] ?></h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                      <form class="form-horizontal" action="<?php echo $data['curl']."update/".$data['encode']; ?>" method="post">
                        <fieldset class="content-group">
                          <?php foreach ($data['aadata'] as $key => $value) { ?>
                         
                         <!--  <div class="form-group">
                            <label class="control-label col-lg-2">Nama Satker</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="nama_satker" value="<?php //echo $value['nama_satker'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="keterangan"><?php //echo $value['keterangan'] ?></textarea>
                            </div>
                          </div> -->



                          <div class="form-group">
                            <label class="control-label col-lg-2">Kode Provinsi</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kd_prov" value="<?php echo $value['kd_prov'] ?>">
                            </div>
                          </div>

                             <div class="form-group">
                            <label class="control-label col-lg-2">Kode Kabupaten</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kd_kab" value="<?php echo $value['kd_kab'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Kode Kecamatan</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kd_kec" value="<?php echo $value['kd_kec'] ?>">
                            </div>
                          </div>

                         
                             <div class="form-group">
                            <label class="control-label col-lg-2">Nama Provinsi</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="provinsi" value="<?php echo $value['provinsi'] ?>">
                            </div>
                          </div>

                             <div class="form-group">
                            <label class="control-label col-lg-2">Nama Kabupaten</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kabupaten" value="<?php echo $value['kabupaten'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama Kecamatan</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kecamatan" value="<?php echo $value['kecamatan'] ?>">
                            </div>
                          </div>

                            <div class="form-group">
                            <label class="control-label col-lg-2">Nama Desa</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="desa" value="<?php echo $value['desa'] ?>">
                            </div>
                          </div>

                             <div class="form-group">
                            <label class="control-label col-lg-2">Kordinat Long</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kor_long" value="<?php echo $value['kor_long'] ?>">
                            </div>
                          </div>

                             <div class="form-group">
                            <label class="control-label col-lg-2">Kordinat Lat</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="kor_lat" value="<?php echo $value['kor_lat'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="keterangan"><?php echo $value['keterangan'] ?></textarea>
                            </div>
                          </div>
                             
                         <?php } ?>
                        </fieldset>
                        <div class="text-right">
                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button type="submit" class="btn btn-primary">Submit <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                      </form>
                    </div>
          
<?php include('footer.php'); ?>