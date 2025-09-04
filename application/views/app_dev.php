<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo "Utilitas"; ?></span> - <?php echo "Development Area"; ?></h4>
                  </div>
                  <?php // include('statistic.php'); ?>
                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo BASE_URL."apps/" ?>">Utilitas</a></li>
                    <li class="active">Development Area</li>
                  </ul>
                  <ul class="breadcrumb-elements">
                    <li><a href="http://localhost/<?php echo $data['app']['appsdir']?>" class="text-normal" target="_blank"><i class="icon-codepen position-left"></i> Go to apps</a></li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-circle-css position-left"></i><strong>Development</strong> Area</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">

                      <?php if($data['success'] == 1) { 

                        echo "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>&times;</span><span class=\"sr-only\">Close</span></button>
                        <h6 class=\"alert-heading text-normal\"><strong>Done..</strong>application <a href=\"http://localhost/".$data['app']['appsdir']."\" title=\"http://localhost/".$data['app']['appsdir']."\" target=\"_blank\"><code>".$data['app']['nama']."</code> </a>successfully created.</h6>
                        This page automatically redirect after you create an application.
                        </div>"; 

                      } ?>
                    
                    <fieldset class="content-group">
                      <form class="form-horizontal" action="#">
                      <!-- Info blocks -->
                      <div class="row">
                        <div class="col-md-4">
                          <div class="panel">
                            <div class="panel-body text-center">
                              <div class="icon-object border-success-400 text-success"><i class="icon-list2"></i></div>
                              <h5 class="text-bold">Menu Design</h5>
                              <p class="mb-15">Create menu and generate CRUD form.</p>
                              <a href="<?php echo BASE_URL."apps/menu_designer/".$data['encode']; ?>" class="btn bg-success-400">Open</a>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="panel">
                            <div class="panel-body text-center">
                              <div class="icon-object border-warning-400 text-warning"><i class="icon-codepen"></i></div>
                              <h5 class="text-bold">Ice Coder</h5>
                              <p class="mb-15">Browse and edit your source code everywhere.</p>
                              <a href="<?php echo BASE_URL."application/icecoder"; ?>" class="btn bg-warning-400" target="_blank">Open</a>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="panel">
                            <div class="panel-body text-center">
                              <div class="icon-object border-slate text-slate"><i class="icon-database"></i></div>
                              <h5 class="text-bold">MySQL Management</h5>
                              <p class="mb-15">Manage your MySQL database.</p>
                              <a href="<?php echo BASE_URL."application/phpmyadmin/"; ?>" class="btn bg-slate" target="_blank">Open</a>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-md-4">
                          <div class="panel">
                            <div class="panel-body text-center">
                              <div class="icon-object border-teal text-teal"><i class="icon-puzzle4"></i></div>
                              <h5 class="text-semibold">Assign Modul</h5>
                              <p class="mb-15">Who is get involved in the project, assign jobs to programmer.</p>
                              <a href="<?php echo BASE_URL."apps/assign_modul/".$data['encode']; ?>" class="btn bg-teal">Open</a>
                            </div>
                          </div>
                        </div> -->
                    </div>
                    <!-- /info blocks -->
                    </form>
                  </fieldset>
                    <div class="text-right">
                       <!-- <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a>  -->
                    </div>
                  </div> <!-- panel -->
                  </div>
              </div>   
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  $(function() {
  $('.datatable').DataTable({
        "processing": true,
        "serverSide": true, 
        "order": [0],
        "ajax": {
            "url": url+'get',
            "type": "POST"
        },
        "columns": [
            {"data": 1,width:'20%'},
            {"data": 2,width:'30%'},
            {"data": 3,width:'20%'},
            {"data": 4,width:'20%'},
            {
                "data": 0,
                "width": 50,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="'+url+'development/'+row[0]+'" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip" title="Go to development area"><i class="icon-enter"></i></a>';
                 }
            }
        ]
    });
  });
</script>