<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title'] ?></h4>
                  </div>
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
                      <h5 class="panel-title"><i class="icon-key position-left"></i><strong>Utility</strong> <?php echo $data['title'] ?></h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">

                      <?php if($data['messages']) { ?>
                      <div class="alert alert-<?php echo $data['tipe'] ?> alert-styled-left">
                      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                      <span class="text-semibold"><?php echo $data['messages']; ?></span>
                      </div>
                      <?php } ?>


                        <div class="text-center">
                          <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Back</a> 
                        </div>
                      
                    </div>
          
<?php include('footer.php'); ?>


