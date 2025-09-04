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

                    <li><a href="<?php echo BASE_URL ?>/"><i class="icon-home2 position-left"></i> Home</a></li>

                    <li><a href="<?php echo $data['curl'] ?>/"><?php echo $data['breadcrumb1']; ?></a></li>

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
					
                      <h5 class="panel-title"><strong><i class="icon-drive position-left"></i> Data</strong> Storage</h5>

                      <div class="heading-elements">

                        <ul class="icons-list">

                          <li><a data-action="collapse"></a></li>

                          <li><a data-action="reload"></a></li>

                          <li><a data-action="close"></a></li>

                        </ul>

                      </div>

                    </div>

                    <div class="panel-body">



                      <!--   <a href="<?php echo $data['curl'] ?>/add/<?php echo $data['encode']; ?>" class="btn btn-info btn-sx"><i class="icon-plus-circle2 position-left"></i> Add</a> -->

                    </div>

                    <table class="table datatable table-striped">

                      <thead>

                        <tr>
                          <th class="text-center text-bold text-teal">No</th>
        									<th class="text-center text-bold text-teal">Nama kegiatan</th>
                          <th class="text-center text-bold text-teal">Tanggal</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <!-- /basic datatable --> 


                  <!-- Info modal -->
                  <div id="modal_form" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-info">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-windows8" title="Dokumen"></i>&nbsp; Dokumen Media</h6>
                        </div>

                        <div class="modal-body">
                          <table class="table table-striped" id="datafile1">
                              <thead>
                                <tr>
                                  <th>Preview</th>
                                  <th>Nama File</th>
                                  <th>Tipe</th>
                                  <th>Ukuran</th>
                                  <th class="text-center">Actions</th>
                                </tr>
                              </thead>
                            </table>
                      </div>
                    </div>
                  </div>
                  <!-- /info modal -->        

<?php include('footer.php'); ?>



<script type="text/javascript">

  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/dokumen/';

  $(function() {
    // $('.datatable').DataTable().ajax.reload(null, false);
  $('.datatable').DataTable({

        "processing": true,

        "serverSide": true, 

        "order": [],
  
  		 "searchable": true,
  
  "targets": 2,

        "ajax": {

            "url": url+'get/<?php echo $data['encode'] ?>',

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
						{"data": 1,width:'auto'},
            {

                "data": 2,

                "width": 300,

                "sortable": true,

                "className": "text-center text-nowrap",
            
            	"searchable": true,

                "render": function ( data, type, row, meta ) {

                  var str = row[2];
                  var res = str.replace(/ /g, "+");

                  var tex = row[1];
                  var keg = tex.replace(/ /g, "+");

                     return '<a href="'+url+'info/'+res+'/'+keg+'" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip">'+row[2]+'</a> ';

                 }

            } 
        ]

    });

  });

  //});

</script>