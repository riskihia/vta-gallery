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
                          <?php foreach ($data['aadata'] as $key => $value) { 
                            if($value['parent_id'] <> 0){
                          ?>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Parent Group</label>
                            <div class="col-lg-10">
                              <select  class="select" data-placeholder="Pilih parent"  name="parent_id" >
                                  <?php foreach ($data['groups'] as $key => $groups) { echo "<option value=\"".$groups[0]."\" ".$groups[2].">".$groups[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama Group</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="group_name" value="<?php echo $value['group_name'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="description"><?php echo $value['description'] ?></textarea>
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