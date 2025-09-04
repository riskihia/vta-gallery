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
                      <form class="form-horizontal" action="<?php echo $data['curl']."save"; ?>" method="post">
                        <fieldset class="content-group">

                          <div class="form-group">
                            <label class="control-label col-lg-2">Username</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="user_id" id="user_id"required="true">
                             <p></p>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama Lengkap</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="user_fullname" required="true">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Password</label>
                            <div class="col-lg-10">
                             <input type="password" class="form-control" name="user_password" required="true" autocomplete="on">
                            </div>
                          </div>

                          <!-- <div class="form-group">
                            <label class="control-label col-lg-2">Tempat Lahir</label>
                              <div class="col-lg-6">
                               <input type="text" class="form-control" name="tempat_lahir" required="true">
                              </div>  
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Tanggal Lahir</label>
                              <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="date" class="form-control" name="tgl_lahir">
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
                                  <?php foreach ($data['position'] as $key => $pos) { echo "<option value=\"".$pos[0]."\">".$pos[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Group Pengguna</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih group" class="select" required="true" name="user_grup">
                                  <option></option>
                                  <?php foreach ($data['groups'] as $key => $groups) { echo "<option value=\"".$groups[0]."\">".$groups[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>

                        </fieldset>
                        <div class="text-right">
                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button type="submit" class="btn btn-primary" id="btnsubmit">Submit <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                      </form>
                    </div>
          
<?php include('footer.php'); ?>

<script type="text/javascript">
  $(function() {
  // Remote data
    $("#user_id").autocomplete({
        minLength: 3,
        source: function(request, response) {
            $.getJSON("<?php echo BASE_URL; ?>users/check/", request, function(data, status, xhr) {
                if(data.j == 1){
                  $("p").html("<span class=\"help-block text-danger\"><i class=\"icon-blocked position-left\"></i> Username sudah ada, silahkan gunakan username yang lain!!!</span>");
                  $(":submit").attr("disabled", true);
                } else {
                  $("p").html("<span class=\"help-block text-success\"><i class=\"icon-checkmark4 position-left\"></i> Username ini tersedia, silahkan lanjutkan.</span>");
                  $(":submit").removeAttr("disabled");
                }

            });
        },
        search: function(event, ui) {
           $(this).parent().addClass('ui-autocomplete-processing');
        },
        open: function() {
            $(this).parent().removeClass('ui-autocomplete-processing');
        }
    });
  });
</script>