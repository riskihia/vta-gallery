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

                      <h5 class="panel-title"><strong>Table</strong> <?php echo $data['title'] ?></h5>

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
                          <th class="text-center text-bold text-teal">Operator</th>
                         
        									<th class="text-center text-bold text-teal">Photo</th>
                           <th class="text-center text-bold text-teal">Selesai</th>
                          <th class="text-center text-bold text-teal">Upload</th>
        									<th class="text-center text-bold text-teal">Actions</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <!-- /basic datatable --> 


                  <!-- Info modal -->
                  <div id="modal_form" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-teal">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-image3" title="Dokumen images"></i>&nbsp; Photos</h6>
                        </div>

                        <div class="modal-body">
                          <table class="table table-striped" id="datafile1">
                              <thead>
                                <tr>
                                  <th>Preview</th>
                                  <th>Nama File</th>
                                  <th>Tipe</th>
                                  <th>Ukuran</th>
                                  <th>Uploadby</th>
                                  <th class="text-center">Actions</th>
                                </tr>
                              </thead>
                            </table>
                      </div>
                    </div>
                  </div>
              </div>
                  <!-- /info modal -->       
                  
                   <!-- foto modal -->
                  <div id="modal_video" class="modal fade" >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title text-bold"><i class="icon-clapboard" title="Upload video"></i>&nbsp; Upload foto</h6>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-group-lg">
                              <input type="file" class="file-input-video" name="file_video[]" data-show-upload="true" data-show-remove="false" multiple="true" data-remove-class="btn btn-default btn-sx" data-upload-class="btn btn-success btn-sx"  data-show-caption="false" data-show-preview="true" accept="image/jpg, image/jpeg, image/png">
                              <span class="help-block">Hanya menerima tipe file <code>jpg</code>, <code>jpeg</code> dan <code>png</code>. Maksimal file yang di upload 2048MB.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                  <!-- /foto modal -->

<?php include('footer.php'); ?>



<script type="text/javascript">

  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/dokumen/';
  
	function tes(i){
    $('.file-input-video').fileinput({   
        uploadUrl: url+"uploadfoto/"+i,
        uploadAsync: true,
        maxFileCount: 100000,
        maxFileSize: 102400000,
        browseLabel: 'Browse',
        browseIcon: '<i class="icon-file-plus"></i>',
        uploadIcon: '<i class="icon-file-upload2"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "No file selected",
        maxFilesNum: 1000,
        allowedFileExtensions: ["jpg", "jpeg", "png"],

    });
    }

  $(function() {
    // $('.datatable').DataTable().ajax.reload(null, false);
  $('.datatable').DataTable({

        "processing": true,

        "serverSide": true, 

        "order": [],

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
						{
                "data": 1,
                "width": 'auto',
                "sortable": true,
                    render: function (data, type, row, meta) {
                    return "<code>"+row[10]+"</code> "+row[1];
                }
            },
						{"data": 5,width: 200, className: 'center'},
            {"data": 8,width:'auto'},
            { 
                "data": null,
                "width": 50,
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[4] == 1 ){
                        return "<a href=\"#\" onClick=\"showfiles(1,'"+row[0]+"','"+row[3]+"')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_form\" title=\"View Dokumen\"><i class=\"icon-images2 grey\"></i></a> ";
                          
                       } else {
                          return '';
                       }  
                   }
            },
            
            { 
                "data": 7,
                "width": 50,
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[7] == 'on' ){
                        return "<i class=\" icon-checkmark-circle green\"></i>";
                       } else {
                          return '';
                       }  
                   }
            },
        	{ 
                "data": null,
                "width": 50,
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       
                        return "<a href=\"#\" onClick=\"tes('"+row[0]+"')\"  class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_video\" title=\"Upload video\"><i class=\"icon-file-upload2 text-grey-600\"></i></a> ";
                          
                       
                   }
            },
            {

                "data": null,

                "width": 50,

                "sortable": false,

                "className": "center",

                "render": function ( data, type, row, meta ) {

                     return '<a href="'+url+'edit/'+row[0]+'/<?php echo $data['encode'] ?>" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip"><i class="icon-pencil7"></i></a>  <a href="#" onClick="deletes('+"'"+row[0]+"'"+')" class="btn-sx red" title="Delete"><i class="icon-cancel-square2"></i></a> ';

                 }

            } 
        ]

    });

  });

  //});

</script>