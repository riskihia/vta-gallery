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
                    <li><a href="<?php echo $data['curl'] ?>">Development Area</a></li>
                    <li><a href="<?php echo $data['curl']."development/".$data['project'] ?>"><?php echo $data['app']['nama'] ?></a></li>
                    <li><a href="<?php echo $data['curl']."menu_designer/".$data['project'] ?>">Menu Designer</a></li>  
                    <li class="active"><?php echo $data['action'] ?> Child</li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><strong><?php echo $data['action'] ?></strong> Child</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                      <form class="form-horizontal" action="<?php echo $data['curl']."updatemenu/".$data['project']."/".$data['encode']; ?>" method="post">
                        <fieldset class="content-group">
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Parent Menu</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control text-capitalize" name="parent_menu" value="<?php echo $data['parent'][5] ?>" readonly>
                             <input type="hidden" class="form-control text-capitalize" name="parent_id" value="<?php echo $data['parent'][0] ?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Menu Name</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control text-capitalize" name="menu_name" value="<?php echo $data['modul']['menu_name'] ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Linkto Url</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="linkto" value="<?php echo $data['modul']['linkto'] ?>">
                            </div>
                          </div>

                           <div class="form-group">
                            <label class="control-label col-lg-2">Menu Icon</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih icon" class="select-search" name="menu_icon" >
                                  <option></option>
                                  <?php foreach ($data['icons'] as $key => $icon) { echo "<option value=\"".$icon[0]."\" ".$icon[2]." data-icon=\"".$icon[0]."\"><div><i class=\"icon-home2 position-left\"></i></div>".$icon[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Description</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="menu_desc"><?php echo $data['modul']['menu_desc'] ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Enabled</label>
                            <div class="col-lg-10 checkbox checkbox-switchery">
                                <input type="checkbox" class="switchery" data-switchery="true" <?php if($data['modul']['enabled'] == 'Y') { echo 'checked="checked"'; }  ?> name="enabled"> 
                             </div>
                          </div>

                        </fieldset>
                        <div class="text-right">
                           <a href="<?php echo $data['curl'] ?>menu_designer/<?php echo $data['project'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button type="submit" class="btn btn-primary">Submit <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                      </form>
                    </div>
          
<?php include('footer.php'); ?>