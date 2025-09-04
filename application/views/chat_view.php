<?php include('header.php'); ?>
<style type="text/css">
  .h_iframe iframe {
    width:100%;
    height:80vh;
}
.h_iframe {
    height: 80vh;
    width:100%;
}
</style>
<!-- Page header -->
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1'] ?></span> - <?php echo $data['title'] ?></h4>
    </div>

  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
      <li><a href="<?php echo BASE_URL."manajemen_file"; ?>"><?php echo $data['breadcrumb1'] ?></a></li>
      <li class="active"><?php echo $data['title'] ?></li>
    </ul>

  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">


  <div class="row">
    <div class="col-lg-12">

      <!-- Marketing campaigns -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="icon-bubbles6 position-left"></i><strong><?php echo $data['title'] ?></strong></h5>
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
              <li><a data-action="reload"></a></li>
              <li><a data-action="close"></a></li>
            </ul>
          </div>
        </div>
        <div class="h_iframe">
          <iframe src="<?php echo BASE_URL."chatsystem/"; ?>" frameborder="0" allowfullscreen></iframe>
      </div>
      </div>
      <!-- /marketing campaigns -->
    </div>

    
  </div>


</div> <!-- end div content -->   

<?php include('footer.php'); ?>
