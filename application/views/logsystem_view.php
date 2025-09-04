<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title']; ?></h4>
                  </div>
                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['breadcrumb1']; ?></a></li>
                    <li class="active"><?php echo $data['title']; ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <!-- Basic datatable -->
                  <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-database-arrow position-left"></i><strong>Log</strong> System</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                    </div>
                    <table class="table datatable table-striped">
                      <thead>
                        <tr>
                          <th class="text-center text-bold text-teal">Menu</th>
                          <th class="text-center text-bold text-teal">Action</th>
                          <th class="text-center text-bold text-teal">Date</th>
                          <th class="text-center text-bold text-teal">User</th>
                          <th class="text-center text-bold text-teal">IP Address</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <!-- /basic datatable -->      
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  $(function() {
  $('.datatable').DataTable({
        "processing": true,
        "serverSide": true, 
        "order": [2, 'desc'],
        "ajax": {
            "url": url+'get',
            "type": "POST"
        },
        "columns": [
            {"data": 1,width:'auto'},
            {"data": 2,width:'auto', className: 'center'},
            {"data": 3,width:'auto', className: 'center'},
            {"data": 4,width:'auto', className: 'center'},
            {"data": 5,width:'auto', className: 'center'}
        ]
    });
  });
</script>