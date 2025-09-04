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
                            <label class="control-label col-lg-2">Username</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="user_id" required="true" value="<?php echo $value['user_id'] ?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama Lengkap</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="user_fullname" required="true" value="<?php echo $value['user_fullname'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Password</label>
                            <div class="col-lg-10">
                             <input type="password" class="form-control" name="user_password" autocomplete="on">
                            </div>
                          </div>

                         <!--  <div class="form-group">
                            <label class="control-label col-lg-2">Tempat Lahir</label>
                              <div class="col-lg-6">
                               <input type="text" class="form-control" name="tempat_lahir" required="true" value="<?php echo $value['tempat_lahir'] ?>">
                              </div>  
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Tanggal Lahir</label>
                              <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $value['tgl_lahir'] ?>">
                                        </div>
                                    </div>
                                </div>
                              </div>  
                          </div> -->

                          <div class="form-group">
                            <label class="control-label col-lg-2">Jabatan</label>
                            <div class="col-lg-10">
                            <select data-placeholder="Pilih position" class="select" required="true" name="position">
                                  <option></option>
                                  <?php foreach ($data['position'] as $key => $pos) { 
                                    if($pos[0] == $value['jabatan']){
                                       echo "<option value=\"".$pos[0]."\" selected>".$pos[1]."</option>"."\n";
                                    } else {
                                       echo "<option value=\"".$pos[0]."\">".$pos[1]."</option>"."\n";
                                    }
                                  } 
                                  ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Group Pengguna</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih group" class="select" required="true" name="user_grup">
                                  <option></option>
                                  <?php foreach ($data['groups'] as $key => $grup) { 
                                    if($grup[0] == $value['user_grup']){
                                       echo "<option value=\"".$grup[0]."\" selected>".$grup[1]."</option>"."\n";
                                    } else {
                                       echo "<option value=\"".$grup[0]."\">".$grup[1]."</option>"."\n";
                                    }
                                  } 
                                  ?>
                              </select>
                            </div>
                          </div>
                        <?php  } ?>
                        </fieldset>
                        <div class="text-right">
                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button type="submit" class="btn btn-primary">Submit <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                      </form>
                    </div>
          
<?php include('footer.php'); ?>