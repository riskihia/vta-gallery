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
                      <h5 class="panel-title"><i class="icon-user-tie position-left"></i><strong>Data</strong> <?php echo $data['title'] ?></h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                       <!--  <a href="<?php echo $data['curl'] ?>add" class="btn btn-info btn-sx"><i class="icon-plus-circle2 position-left"></i> Add</a> -->
                    </div>
                    <table class="table datatable table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center text-bold">Foto</th>
                          <th class="text-center text-bold">Nama Personel</th>
                          <th class="text-center text-bold">NRP</th>
                          <th class="text-center text-bold">Pangkat</th>      
                          <th class="text-center text-bold">Korps</th>
                          <th class="text-center text-bold">Jabatan</th>
                          <th class="text-center text-bold">Jkel</th>

                          <th class="text-center text-bold text-teal">Actions</th>
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
        "order": [],
        "ajax": {
            "url": url+'get',
            "type": "POST"
        },
        "columns": [
            {
                "data": null,
                "width": 50,
                "visible": true,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="static/images/users.png"  target="_blank" data-popup="lightbox" rel="gallery"> <img src="static/images/users.png" width="32px" alt="" class="img-rounded img-preview"></a>';
                 }
            },
            {
                "data": 1,
                "width": '30%',
                "visible": true,
                "sortable": false,
                "className": "text-left",
                "render": function ( data, type, row, meta ) {
                     return '<a href="#" class="text-bold text-teal"> '+ row[1]+ ' </a>';
                 }
            },
            {"data": 2,width:'10%',"sortable": false, "className": "center"},
            {"data": 3,width:'10%',"sortable": false, "className": "center"},
            {"data": 5,width:'auto',"sortable": false, "className": "center"},
            {"data": 4,width:'auto',"sortable": false, "className": "text-left"},
            {"data": 6,width:'10',"sortable": false, "className": "center"},
            {
                "data": null,
                "width": 50,
                "visible": false,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="'+url+'edit/'+row[0]+'" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip"><i class="icon-pencil7"></i></a>  <a href="#" onClick="deletes('+"'"+row[0]+"'"+')" class="btn-sx red" title="Delete"><i class="icon-cancel-square2"></i></a> ';
                 }
            }
        ]
    });
  });
</script>