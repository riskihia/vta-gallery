<?php include('header.php'); ?>

              <!-- Page header -->

              <div class="page-header">

                <div class="page-header-content">

                  <div class="page-title">

                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span></h4>

                  </div>

                </div>

                <div class="breadcrumb-line">

                  <ul class="breadcrumb">

                    <li><a href="<?php echo BASE_URL ?>/"><i class="icon-home2 position-left"></i> Home</a></li>

                    <li class="active"><?php echo $data['breadcrumb1']; ?></li>

                  </ul>



                </div>

              </div>

              <!-- /page header -->



              <!-- Content area -->

              <div class="content">

                <!-- Basic datatable -->

                  <div class="panel panel-flat">

                    <div class="panel-heading">

                      <h5 class="panel-title"><strong>Messages</strong></h5>

                      <div class="heading-elements">

                        <ul class="icons-list">

                          <li><a data-action="collapse"></a></li>

                          <li><a data-action="reload"></a></li>

                          <li><a data-action="close"></a></li>

                        </ul>

                      </div>

                    </div>

                    <div class="panel-body">


                   

                    <table class="table datatable">

                      <thead>

                        <tr>
                          <th class="text-center text-bold text-teal">No</th>
                          <th class="text-center text-bold text-teal">Personel</th>
        									<th class="text-center text-bold text-teal">Keperluan</th>
                          <th class="text-center text-bold text-teal">Tanggal</th>
                          <th class="text-center text-bold text-teal">Status</th>
                          <?php if($_SESSION['groupid'] == 1){ ?>
                          <th class="text-center text-bold text-teal">File</th>
        									<th class="text-center text-bold text-teal">Approve?</th>
                          <?php } else {  ?>
                          <th class="text-center text-bold text-teal">Download</th>
                          <?php } ?>
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
                          <h6 class="modal-title"><i class="icon-file-download" title="Download"></i>&nbsp; Download</h6>
                        </div>

                        <div class="modal-body">
                          <table class="table" id="datafile">
                              <thead>
                                <tr>
                                  <th class="text-bold">Preview</th>
                                  <th class="text-bold">Nama File</th>
                                  <th class="text-bold">Tipe</th>
                                  <th class="text-bold">Ukuran</th>
                                  <th class="text-bold text-center">Download</th>
                                </tr>
                              </thead>
                            </table>
                      </div>
                    </div>
                  </div>
                  <!-- /info modal -->  

                  </div>  
                  </div>    
                </div>

<?php include('footer.php'); ?>



<script type="text/javascript">

  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/';

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
                "data": 1,
                "width": 30,
                "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { 
                "data": 2,
                "width": 'auto',
                "sortable": false,
                  "className": "text-nowrap text-left",
                  "render": function ( data, type, row, meta ) {
                    return "<h6 class=\"no-margin\"><a href=\"#\">"+row[1]+"</a><small class=\"display-block text-muted\">"+row[4]+"</small></h6>";
                   }
            },
						{"data": 7,width:'auto', sortable: false},
            { 
                "data": 8,
                "width": 100,
                "sortable": false,
                  "className": "text-nowrap text-center",
                  "render": function ( data, type, row, meta ) {
                    return "<code>"+row[8]+"</code>";
                   }
            },
            { 
                "data": 5,
                "width": 'auto',
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[5] == 1 ){
                        return "<span class=\"label label-success\">Approved</span>";
                          
                       } else {
                          return '<span class=\"label label-warning\">Pending</span>';
                       }  
                   }
            }
            <?php if($_SESSION['groupid'] == 1){ ?>
            ,{

                "data": null,

                "width": 50,

                "sortable": false,

                "className": "center",

                "render": function ( data, type, row, meta ) {
                                    
                    return '<a href="#" onclick="showfile('+"'"+row[0]+"'"+')" class="btn-sx" data-toggle=\"modal\" data-target=\"#modal_form\" ><i class="icon-folder-search text-slate-600"></i></a>';

                }
          },
            
            {

                "data": null,

                "width": 50,

                "sortable": false,

                "className": "center",

                "render": function ( data, type, row, meta ) {
                                    
                
                   return '<a href="#" onclick="approvecall('+"'"+row[0]+"'"+')" class="btn-sx" data-popup="tooltip" data-original-title="Top tooltip"><i class="icon-pencil5 text-teal"></i></a>';  

            }  

          }

          <?php  } else {  ?>
            ,{

                "data": null,

                "width": 50,

                "sortable": false,

                "className": "center",

                "render": function ( data, type, row, meta ) {

                    if(row[5] == 1){
                      return '<a href="#" onclick="showfile('+"'"+row[0]+"'"+')" class="btn-sx" data-toggle=\"modal\" data-target=\"#modal_form\" ><i class="icon-file-download2 text-teal"></i></a>';
                    } else {
                      return '<a href="#" class="btn-sx"><i class="icon-file-download2 text-muted"></i></a>';
                    }
                   
            }  

          }

         
         <?php } ?>
             
        ],

    });
  
  //   setInterval( function () {
  //     var table = $('.datatable').DataTable();
  //     table.ajax.reload( null, false );

  //     $.ajax({url: url+'checkmsg', success: function(result){
  //       var rsl = JSON.parse(result);
  //      $("#jmlmsg").html(rsl.jmlmsg);
  //      console.log(rsl);
  //       new PNotify({
  //           title: 'New messages',
  //           text: 'Check me out! I\'m a notice.'+rsl.jmlmsg,
  //           addclass: 'alert-styled-left alert-arrow-left text-sky-royal',
  //           type: 'info'
  //       });
  //     }});

        

  // }, 10000 );

  });

  function approvecall(i) {
      swal({
          title:"Are you sure approve this request?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#EF5350",
          confirmButtonText: "Yes, approve it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
            $.post(url+'approved/'+i, function(data, status){
              var table = $('.datatable').DataTable();
              table.ajax.reload(null, false);
                if(status == 'success'){
                   swal({
                      title:"Approved!",
                      text: "Request data has been approved.",
                      confirmButtonColor: "#66BB6A",
                      type: "success",
                      timer: 2000
                  });
                }
            });
          }
      });
    }

    function showfile(a){
        // Show file
     $('#datafile').DataTable({
          "destroy": true,
          "processing": true,
          "serverSide": true, 
          "paging": false,
          "searching": false,
          "info": false,
          "order": [0],
          "ajax": {
              "url": url+'getfile/'+a,
              "type": "POST"
          },
          "columns": [
              {
                "data": null,
                "width": 'auto',
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                  var id = btoa(row[0]);
                     var v = row[2].split('/');
                     if(row[8] == 0){
                        var file = url_file+'dokumen/'+row[5]+'/'+row[6]+'/'+row[1];
                      } else {
                        var file = url_file+row[9]+'/'+row[6]+'/'+row[1];
                      }
                     
                     //var f = imageExists(file);
                     // if(f){
                     //  file = file;
                     // } else {
                     //  file = 'no image';
                     // }
                     if(v[0] == "video"){
                        return '<video width="220" controls><source src="'+file+'" type="'+row[2]+'"></video>';
                     } else if (v[0] == "image") {
                        return '<a href="'+file+'" target="_blank" data-popup="lightbox" rel="gallery"> <img src="'+file+'" alt="" class="img-rounded img-preview"></a>';
                     } else {
                        return '<a href="static/images/check-file-type.png" target="_blank" data-popup="lightbox" rel="gallery"> <img src="static/images/check-file-type.png" alt="" class="img-rounded img-preview"></a>';
                     }
                     
                 }
              },
              {"data": 1,width:'auto'},
              {"data": 2,width:'auto'},
              {
                  "data": null,
                  "width": 50,
                  "sortable": false,
                  "className": "text-center text-nowrap",
                  "render": function ( data, type, row, meta ) {
                       return '<code>'+row[3]+'</code> ';
                   }
              },
              {
                  "data": null,
                  "width": 50,
                  "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                     var id = btoa(row[0]);
                     var v = row[2].split('/');
                     var file = url_file+row[5]+'/'+row[6]+'/'+row[1];
                     //return '<a href="'+file+'" target="_blank" class="btn-sx cyan" data-popup="tooltip" data-original-title="Download"><i class="icon-file-download" title="Download"></i></a>  ';
                       // var id = btoa(row[0]);
                       return '<a href="'+url+'download/'+row[0]+'" target="_blank"  class="btn-sx cyan" data-popup="tooltip" data-original-title="Download"><i class="icon-file-download" title="Download"></i></a>  ';
                   }
              }
              
          ]
      });
}


</script>