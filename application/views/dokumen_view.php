<style>
#modal_form .img-preview {
  object-fit: cover !important;
  max-height: 120px;
  width: 100%;
  display: block;
}
</style>

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

                      <h5 class="panel-title"><i class="icon-file-picture position-left"></i><strong>Manajemen</strong> <?php echo "Data"; ?></h5>

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
        									<th class="text-center text-bold text-teal">Nama Project</th>
        									<th class="text-center text-bold text-teal">Nama kegiatan</th>
                          <th class="text-center text-bold text-teal">Operator</th>
        									<th class="text-center text-bold text-teal">Photo</th>
                          <th class="text-center text-bold text-teal">Upload</th>
                          <th class="text-center text-bold text-teal">Selesai</th>
                          <th class="text-center text-bold text-teal">Tanggal</th>
        									<th class="text-center text-bold text-teal">Actions</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <!-- /basic datatable --> 


                  <!-- Info modal -->
                  <div id="modal_form" class="modal fade">
                    <div class="modal-dialog modal-full">
                      <div class="modal-content">
                        <div class="modal-header bg-teal">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-image3" title="Dokumen images"></i>&nbsp; Foto & Video</h6>
                        </div>

                        <div class="modal-body">
                          <div class="form-group">
                              <button type="submit" class="btn bg-purple-400 text-right" disabled="disabled" id="submit"><i class=" icon-file-download2 position-left"></i>Download Selected </button>
                          </div>
                          <form action="#" method="post" id="fileform">
                          <table class="table table-striped" id="datafile1">
                              <thead>
                                <tr>
                                  <th class="text-bold"><input type="checkbox" id="checkAll" class="control-success"></th>
                                  <th class="text-bold">Preview</th>
                                  <th class="text-bold">Nama File</th>
                                  <th class="text-bold">Tipe</th>
                                  <th class="text-bold">Ukuran</th>
                                  <th class="text-bold">Uploadby</th>
                                  <th class="text-bold text-center">Actions</th>
                                </tr>
                              </thead>
                            </table>
                          </form>
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
                          <h6 class="modal-title text-bold"><i class="icon-file-upload2" title="Upload video"></i>&nbsp; Upload foto & video</h6>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-group-lg">
                              <input type="file" class="file-input-video" name="file_video[]" data-show-upload="true" data-show-remove="false" multiple="true" data-remove-class="btn btn-default btn-sx" data-upload-class="btn btn-success btn-sx"  data-show-caption="false" data-show-preview="true" accept="image/jpg, image/jpeg, image/png, video/mp4,video/mv4">
                              <span class="help-block">Hanya menerima tipe file <code>jpg</code>, <code>jpeg</code>, <code>png</code> dan <code>mp4</code>. Maksimal file yang di upload 2048MB.</span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                  <!-- /foto modal -->

<?php include('footer.php'); ?>



<script type="text/javascript">

  var url      = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/';

  $('#submit').prop("disabled", true);
  $("#checkAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      $('#submit').prop("disabled", false);
      if ($('.chk').filter(':checked').length < 1){
        $('#submit').attr('disabled',true);
        
      }
  });

  $('input:checkbox').click(function() {
      if ($(this).is(':checked')) {
        $('#submit').prop("disabled", false);
          } else {
      if ($('.chk').filter(':checked').length < 1){
        $('#submit').attr('disabled',true);}
      }
  });

  $('#submit').on('click', function() {
    let data = new FormData($("#fileform")[0]);
    $.ajax({
      url: url+'zipdown',
      type: 'POST',
      data: data,
      processData: false,
      contentType: false,
      success: function(r) {

      if(r){

          new PNotify({
              title: 'Downloaded',
              text: 'Your request prepare to downloaded.',
              addclass: 'bg-success alert-styled-left'
          });
          var t = JSON.parse(r);

         // url+'zipdownx/'+r.te;
          window.location=url+'zipdownx/'+t[0].te;
          console.log(t.te);
      }
        
      },
      error: function(r) {
        console.log('error', r);
      }
    });
  });

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
        allowedFileExtensions: ["jpg", "jpeg", "png", "mp4"],

    });
    }

  $(function() {

  $('.datatable').DataTable({

        "processing": true,

        "serverSide": true, 

        "destroy": true,

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
              "data": 11,
              "width": 'auto',
              "render": function (data, type, row, meta) {
              return (data === null || data === "" || typeof data === "undefined")
                ? '<i>silakan input nama project</i>'
                : data;
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
                "data": null,
                "width": 50,
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       
                        return "<a href=\"#\" onClick=\"tes('"+row[0]+"')\"  class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_video\" title=\"Upload video\"><i class=\"icon-file-upload2 text-grey-600\"></i></a> ";
                          
                       
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
        	
            {"data": 5,width: 200, className: 'center'},
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

</script>
