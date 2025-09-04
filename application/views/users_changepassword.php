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
                    <li  class="active"><?php echo $data['title'] ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-key position-left"></i><strong>Change</strong> Password</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">

                      <form class="form-horizontal" action="<?php echo $data['curl']."change_password_info/"; ?>" method="post">
                        <fieldset class="content-group">                 
                         
                          <div class="form-group">
                            <label class="control-label col-lg-2">Current password</label>
                            <div class="col-lg-10">
                              <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" class="form-control"  autofocus="true" name="current_password" autocomplete="on" placeholder="" required="true">
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">New Password</label>
                            <div class="col-lg-10">
                             <input type="password" class="form-control" name="new_password" autocomplete="on" required="true">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Confirm New Password </label>
                            <div class="col-lg-10">
                             <input type="password" class="form-control" name="confirm_password" autocomplete="on" required="true">
                            </div>
                          </div>

                        </fieldset>
                        <div class="text-right">
                           <a href="<?php echo BASE_URL ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button type="submit" class="btn btn-primary">Submit <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                      </form>
                    </div>
          
<?php include('footer.php'); ?>


