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
                         
                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama Personel</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="nama_personel" value="<?php echo $value['nama_personel'] ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">NRP</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="nrp" value="<?php echo $value['nrp'] ?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Pangkat</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="pangkat" value="<?php echo $value['pangkat'] ?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Korps</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="korps" value="<?php echo $value['korps'] ?>"  required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Jabatan</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="jabatan" value="<?php echo $value['jabatan'] ?>" required>
                            </div>
                          </div>
                          
                          <div class="form-group">
                             <label class="control-label col-lg-2">Jenis Kelamin</label>
                             <div class="col-lg-10">
                              <label class="radio-inline radio-right">
                                <input type="radio" name="jenis_kelamin"  value="L" <?php if($value['jenis_kelamin'] == 'L') { echo 'checked="checked"'; } ?> >
                                Laki-laki
                              </label>

                              <label class="radio-inline radio-right">
                                <input type="radio" name="jenis_kelamin" value="P" <?php if($value['jenis_kelamin'] == 'P') { echo 'checked="checked"'; } ?> >
                                Perempuan
                              </label>
                            </div>
                          </div>
                         <!--  <div class="form-group">
                            <label class="control-label col-lg-2">Tempat Lahir</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $value['tempat_lahir'] ?>" >
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Tanggal Lahir</label>
                            <div class="col-lg-6">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $value['tanggal_lahir'] ?>" >
                              </div>
                            </div>
                          </div> -->
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