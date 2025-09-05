<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php global $config; echo $config['app_name']?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/favicons.png">
  <!-- Global stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL; ?>static/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL; ?>static/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL; ?>static/css/core.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL; ?>static/css/components.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL; ?>static/css/colors.css" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->
  <!-- Core JS files -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/plugins/loaders/pace.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/core/libraries/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/core/libraries/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/plugins/loaders/blockui.min.js"></script>
  <!-- /core JS files -->
  <!-- Theme JS files -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>static/js/core/app.js"></script>
  <!-- /theme JS files -->
</head>
<body>

  <!-- Page container -->
  <div class="page-container login-container">
    <!-- Page content -->
    <div class="page-content" style="background: url('<?php echo BASE_URL ?>static/images/backgrounds/bge1.jpg'); background-size: cover;">
      <!-- Main content -->
      <div class="content-wrapper">
        <!-- Content area -->
        <div class="content" style="background-image: linear-gradient(to bottom right, #1859347d, #ffffff38);">
          <form action="<?php echo BASE_URL ?>auth/signin" method="post">
            <div class="panel panel-body login-form">
              <div class="text-center">
                <div>
                  <img src="<?php echo BASE_URL."static/images/LOGO VTAH GROUP - putih.png"?>" class ="img-thumbnail border-grey-300 no-border text-slate-300"></div>   
                    
                    <h5 class="content-group text-slate-900 text-bold"><?php echo "VTA-GALLERY <br> FOTO & VIDEO" ?> </h5>   
                    <small class="display-block">
                        <h5 class="text-size-sm text-slate-600 text-bold"><?php // echo $config['divi_name']?></h5>
                    </small>
              </div>

              <div class="form-group has-feedback has-feedback-left">
                <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                <div class="form-control-feedback">
                  <i class="icon-user text-muted"></i>
                </div>
              </div>

              <div class="form-group has-feedback has-feedback-left">
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="on">
                <div class="form-control-feedback">
                  <i class="icon-lock2 text-muted"></i>
                </div>
              </div>
              <?php if(!empty($messages)) { ?>
              <div class="alert alert-danger no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Maaf, username/password salah!
              </div>
              <?php } ?>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
              </div>

              <!-- <div class="text-center">
                <a href="#">Silahkan registrasi disini.</a>
              </div> -->
            </div>
          </form>
          <div class="footer text-white">
            Copyright &copy;2025 - <a href="http://vitech.asia//" class="text-warning-300">Vitech Asia </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

