<?php include('header.php'); ?>

              <!-- Page header -->

              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Download </span>request</h4>
                  </div>
                </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="#"><?php echo $data['title'] ?></a></li>
                    <li class="active"><?php echo $data['action'] ?></li>

                  </ul>
                </div>
              </div>
              <!-- /page header -->


              <!-- Content area -->
              <div class="content">
                <div class="panel panel-white">
                      <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-file-download2"></i> &nbsp;<strong>Download</strong> request </h6>
                        <div class="heading-elements">
                          <!-- <a href="javascript:void(0)" onclick="javascript:window.history.back();" class="btn btn-default btn-xs heading-btn"><i class="icon-arrow-left52 position-left"></i> Back</a>
                          <button type="button" class="btn btn-default btn-xs heading-btn" data-toggle="modal" data-target="#modal_form" <?php echo $data['jdown'] ?>><i class="icon-file-download2 position-left"></i> Download</button> -->
                          <button type="button" class="btn btn-default btn-xs heading-btn" onclick="window.print()"><i class="icon-printer2 position-left"></i> Print</button>
                        </div>
                      <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                      <div class="panel-body no-padding-bottom" id="section-to-print">

                      

                      <div class="panel-body">
                        <div class="row invoice-payment">

                          <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <h6 class="alert-heading text-bold">Request berhasil</h6>
                            Silahkan menunggu, permintaan Anda akan segera di proses oleh Admin. Link download akan di kirimkan ke dalam inbox.
                          </div>

                        </div>
                        <h6></h6>
                        <p class="text-muted text-size-mini"><img src="<?php echo BASE_URL.'static/images/dispenad.png'; ?>" alt="Dispen"> <strong>&nbsp; Copyright</strong> @2020 - Dinas Penerangan Angkatan Darat. </p>
                      </div>


                      </div>


                </div>

    

       </div>

              <!-- Content -->   

<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/dokumen/';

$(document).ready(function(){
   $("#checkAll").click(function(){
       $("#chkfile").find(":checkbox").attr("checked",this.checked);
   });
})
</script>