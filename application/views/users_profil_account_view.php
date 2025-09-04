<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header no-margin">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title']; ?></h4>
                  </div>
                  <?php // include('statistic.php'); ?>
                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['breadcrumb1']; ?></a></li>
                    <li class="active"><?php echo $data['title'] ?></li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Cover area -->
              <div class="profile-cover">
                <div class="profile-cover-img" style="background-image: url(<?php echo BASE_URL; ?>static/images/backgrounds/3576410.jpg)"></div>
                <div class="media">
                  <div class="media-left">
                    <a href="#" class="profile-thumb">
                     <?php if(empty($data['photo'][0][0])) { ?>
                        <img src="<?php echo BASE_URL; ?>static/images/users.jpg" class="img-circle" data-toggle="modal" data-target="#modal_foto"  alt="">
                    <?php  } else { ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['photo'][0][0]); ?>" class="img-circle" data-toggle="modal" data-target="#modal_foto"  alt="">
                    <?php } ?>
                    </a>
                  </div>

                  <div class="media-body">
                      <h1><?php echo $_SESSION['username'] ?> <small class="display-block"><?php echo $_SESSION['level_name'] ?></small></h1>
                  </div>

                  <div class="media-right media-middle">
                    <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                      <!-- <li><a href="#" class="btn btn-default"><i class="icon-file-picture position-left"></i> Cover image</a></li>
                      <li><a href="#" class="btn btn-default"><i class="icon-file-stats position-left"></i> Statistics</a></li> -->
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /cover area -->


              <!-- Toolbar -->
              <div class="navbar navbar-default navbar-xs content-group">
                <ul class="nav navbar-nav visible-xs-block">
                  <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-filter">
                  <ul class="nav navbar-nav element-active-slate-400">
                    
                   <!--  <li><a href="#schedule" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Schedule <span class="badge badge-success badge-inline position-right">32</span></a></li> -->
                    <li class="active"><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left "></i><span class="text-bold">Account Settings</span></a></li>
                    <!-- <li><a href="#activity" data-toggle="tab"><i class="icon-menu7 position-left"></i> Activity</a></li> -->
                  </ul>

                  <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      <li><a href="#"><i class="icon-stack-text position-left"></i> Notes</a></li>
                     <!--  <li><a href="#"><i class="icon-images3 position-left"></i> Photos</a></li> -->
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="visible-xs-inline-block position-right"> Options</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <!-- <li><a href="#"><i class="icon-image2"></i> Update cover</a></li> -->
                          <li><a href="#" data-toggle="modal" data-target="#modal_foto" ><i class="icon-users2"></i> Update photo profile</a></li>
                          <li class="divider"></li>
                          <li><a href="#"><i class="icon-three-bars"></i> Activity log</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /toolbar -->

              <!-- Content area -->
              <div class="content">

                <!-- User profile -->
                <div class="row">
                  <div class="col-lg-9">

                          <!-- Account settings -->
                          <div class="panel panel-flat">
                            <div class="panel-heading">
                              <h6 class="panel-title text-bold">Account settings</h6>
                              <div class="heading-elements">
                                <ul class="icons-list">
                                  <li><a data-action="collapse"></a></li>
                                  <li><a data-action="reload"></a></li>
                                  <li><a data-action="close"></a></li>
                                </ul>
                              </div>
                            </div>

                            <div class="panel-body">
                              <form action="<?php echo $data['curl'].'/updateinfo'; ?>" class="form-horizontal" id="form-akun" method="post">
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>Username</label>
                                      <input type="text" value="<?php echo $_SESSION['userid'] ?>" readonly="readonly" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                      <label>Current password</label>
                                      <input type="password" name="current-password" placeholder="Enter current password" id="current-password" autocomplete="false"  class="form-control" required="required">
                                      <span class="help-block" id="label-current"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>New password</label>
                                      <input type="password" name="new-password" id="new-password" placeholder="Enter new password" autocomplete="false" class="form-control" required="required">
                                      <span class="help-block" id="label-new"></span>
                                    </div>

                                    <div class="col-md-6">
                                      <label>Repeat password</label>
                                      <input type="password" name="confirm-password" id="confirm-password" placeholder="Repeat new password" autocomplete="false" class="form-control" required="required">
                                      <span class="help-block" id="label-confirm"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">

                                    <div class="col-md-6">
                                      <label>Notifications</label>

                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" class="styled" checked="checked">
                                          Password expiration notification
                                        </label>
                                      </div>

                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" class="styled" checked="checked">
                                          New message notification
                                        </label>
                                      </div>

                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" class="styled" checked="checked">
                                          New task notification
                                        </label>
                                      </div>

                                    </div>
                                  </div>
                                </div>

                                <div class="text-right">
                                  <button type="button" class="btn bg-teal" id="post-akun">Save <i class="icon-circle-right2 position-right"></i></button>
                                </div>
                              </form>

                            </div>
                          </div>
                          <!-- /account settings -->
                  </div>

                  <div class="col-lg-3">

                    <!-- Navigation -->
                      <div class="panel panel-flat">
                      <div class="panel-heading ">
                        <h6 class="panel-title"><strong>Navigation</strong></h6>

                      </div>

                      <div class="list-group list-group-borderless no-padding-top">
                        <a href="<?php echo $data['curl']; ?>" class="list-group-item"><i class="icon-user"></i> My profile</a>
                        <a href="<?php echo BASE_URL.'messages'; ?>" class="list-group-item"><i class="icon-envelop"></i> Messages </a>
                        <div class="list-group-divider"></div>
                        <a href="<?php echo $data['curl'].'/account_settings'; ?>" class="list-group-item"><i class="icon-cog3"></i> Account settings</a>
                      </div>
                    </div>
                    <!-- /navigation -->

                  </div>
                </div>
                <!-- /user profile -->


                <!-- foto modal -->
                  <div id="modal_foto" class="modal fade" >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title text-bold"><i class="icon-users2" title="Update foto"></i>&nbsp; Update photo</h6>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-group-lg">
                              <input type="file" class="file-input-photo" name="file_photo" data-show-upload="true" data-show-remove="false"  data-remove-class="btn btn-default btn-sx" data-upload-class="btn btn-success btn-sx"  data-show-caption="false" data-show-preview="true" accept="image/jpg, image/jpeg, image/png">
                              <!-- <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary btn-lg" data-remove-class="btn btn-default btn-lg"  accept="image/jpg, image/jpeg, image/png"> -->
                              <span class="help-block">Hanya menerima tipe file <code>jpg</code>, <code>jpeg</code> dan <code>png</code>. Maksimal file yang di upload 1MB.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /foto modal -->    
                
              </div>  <!-- content area  -->
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';

  $('#confirm-password').on('input',function(e){
    var n = $('#new-password').val();
    if(this.value){
      if(this.value != n){
        $("#label-confirm" ).html('<span class="label label-danger text-right">Password not match</span>');
        return false;
      } else {
        $("#label-confirm" ).html('');
      }
    } else {
       $("#label-confirm" ).html('');
    }
   
  });
  
  // #Save
  $('#post-akun').on('click', function() {    
      swal({
          title:"Are you sure?",
          text: "You will update this information!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#EF5350",
          confirmButtonText: "Yes, update it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
              let data = new FormData($("#form-akun")[0]);
              $.ajax({
                url: url+'/updateaccount',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(result) {
                  var result = JSON.parse(result);
                  if(result.status == true){
                    swal({
                        title:"Success!",
                        text: "Your data has been updated.",
                        confirmButtonColor: "#66BB6A",
                        type: "success",
                        timer: 2000
                    });
                  } else{
                    swal({
                        title:"Warning!",
                        text: 'Wrong currrent password',
                        confirmButtonColor: "#FF0000",
                        timer: 5000
                    });
                  }

                },
              });
          }
      });

  });

$(function() {
    $('.file-input-photo').fileinput({   
        uploadUrl: url+"/updatephoto",
        uploadAsync: true,
        maxFileCount: 1,
        maxFileSize: 1024,
        browseLabel: 'Browse',
        browseIcon: '<i class="icon-file-plus"></i>',
        uploadIcon: '<i class="icon-file-upload2"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "No file selected",
        maxFilesNum: 10,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
    });



    // // Initialize
    // var validator = $(".form-validate-akun").validate({
    //     ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
    //     errorClass: 'validation-error-label',
    //     successClass: 'validation-valid-label',
    //     highlight: function(element, errorClass) {
    //         $(element).removeClass(errorClass);
    //     },
    //     unhighlight: function(element, errorClass) {
    //         $(element).removeClass(errorClass);
    //     },

    //     // Different components require proper error label placement
    //     errorPlacement: function(error, element) {

    //         // Styled checkboxes, radios, bootstrap switch
    //         if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
    //             if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
    //                 error.appendTo( element.parent().parent().parent().parent() );
    //             }
    //              else {
    //                 error.appendTo( element.parent().parent().parent().parent().parent() );
    //             }
    //         }

    //         else {
    //             error.insertAfter(element);
    //         }
    //     },
    //     validClass: "validation-valid-label",
    //     success: function(label) {
    //         label.addClass("validation-valid-label").text("Success.")
    //     },
    //     messages: {
    //         custom: {
    //             required: "This is a custom error message",
    //         },
    //         agree: "Please accept our policy"
    //     }
    // });
});

</script>