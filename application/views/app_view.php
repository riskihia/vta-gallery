<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
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
                    <li class="active">Development Area</li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <!-- Basic datatable -->
                  <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><strong>Developer</strong> Applications</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                        <!-- <a href="<?php echo $data['curl'] ?>create_app" class="btn btn-info btn-sx"><i class="icon-plus-circle2 position-left"></i> Create App</a> -->
                    </div>
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th class="text-center text-bold">No</th>
                          <th class="text-center text-bold">App Name</th>
                          <th class="text-center text-bold">Project</th>
                          <th class="text-center text-bold">Client</th>
                          <th class="text-center text-bold">Description</th>
                          <th class="text-center text-bold">Created On</th>
                          <th class="text-center text-bold">Manage</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
              </div>
                  <!-- /basic datatable -->      
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  $(function() {
  $('.datatable').DataTable({
        "processing": true,
        "serverSide": true, 
        "order": [],
        "ajax": {
            "url": url+'get',
            "type": "POST"
        },
        "columns": [
            {
                "data": null,
                "width": 30,
                "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": 1,
                "width": 'auto',
                "sortable": false,
                    render: function (data, type, row, meta) {
                    return '<a href="'+url+'development/'+row[0]+'" class="text-bold">'+row[1]+'</a>';
                }
            },
            {"data": 2,width:'auto'},
            {"data": 3,width:'auto'},
            {"data": 4,width:'auto'},
            {"data": 5,width:'auto',"className": "text-center"},
            {
                "data": 0,
                "width": 50,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="'+url+'development/'+row[0]+'" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip" title="Go to development area"><i class=" icon-equalizer"></i></a>';
                 }
            }
        ]
    });

  });
</script>