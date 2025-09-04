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



                        <a href="<?php echo $data['curl'] ?>/add/<?php echo $data['encode']; ?>" class="btn btn-info btn-sx"><i class="icon-plus-circle2 position-left"></i> Add</a>

                    </div>

                    <table class="table datatable">

                      <thead>

                        <tr>
                          <th class="text-center">No</th>
        				  <th class="text-center">Nama kegiatan</th>
                          <th class="text-center">Tanggal</th>
                          <th class="text-center">Selesai</th>
        				  <th class="text-center">Dokumen</th>
                          <th class="text-center">Operator</th>
        				  <th class="text-center">Actions</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <!-- /basic datatable --> 


                  <!-- Info modal -->
                  <div id="modal_form" class="modal fade" style="max-height: 500px">
                    <div class="modal-dialog modal-full">
                      <div class="modal-content">
                        <div class="modal-header bg-info">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-windows8" title="Dokumen"></i>&nbsp; Dokumen Media</h6>
                        </div>

                        <div class="modal-body">
                        <div class="form-group">
                              <button type="submit" class="btn bg-purple-400 text-right" disabled="disabled" id="submit"><i class=" icon-file-download2 position-left"></i>Download Selected </button>
                          </div>
                          <form action="#" method="post" id="fileform">
                          <table class="table" id="datafile1">
                              <thead>
                                <tr>
                                  <th class="text-bold"><span class="checked"><input type="checkbox" id="checkAll" class="control-success"></span></th>
                                  <th class="text-center">Preview</th>
                                  <th>Nama File</th>
                                  <th>Tipe</th>
                                  <th>Ukuran</th>
                                  <th>Uploadby</th>
                                  <th class="text-center">Actions</th>
                                </tr>
                              </thead>
                            </table>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /info modal -->        

<?php include('footer.php'); ?>



<script type="text/javascript">

  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/';
$('#submit').prop("disabled", true);
  $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
      $('#submit').prop("disabled", false);
      if ($('.chk').filter(':checked').length < 1){
        $('#submit').attr('disabled',true);}
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
    //var h = $("#encode").val();
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

  $(function() {

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
						{"data": 1,width:'auto'},
						{"data": 5,width: 200, className: 'center'},
            { 
                "data": 7,
                "width": 50,
                "sortable": true,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[7] == 'on' ){
                        return "<i class=\"icon-check green\"></i>";
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
                       if(row[4] == 1 ){
                        return "<a href=\"#\" onClick=\"showfiles(1,'"+row[0]+"','"+row[3]+"')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_form\" title=\"View Dokumen\"><i class=\"icon-file-pdf text-danger\"></i></a> ";
                          
                       } else {
                          return '';
                       }  
                   }
            },
            {"data": 8,width:'auto'},
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

    // $('.datatable').DataTable().on( 'order.dt search.dt', function () {
    //     $('.datatable').DataTable().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1+'.';
    //     } );
    // } ).draw();
  });

  //});

</script>