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
                    <li><a href="<?php echo $data['curl'] ?>">Development Area</a></li>
                    <li><a href="<?php echo $data['curl'].'development/'.$data['encode']; ?>"><?php echo $data['app']['nama']; ?></a></li>
                    <li class="active">Menu Designer</li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-list2 position-left"></i><strong>Menu</strong> Designer</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                      <p class="content-group-lg">
                        <a href="<?php echo $data['curl'] ?>development/<?php echo $data['encode'] ?>" class="btn btn-default btn-sx"><i class="icon-circle-left2 position-left"></i> Back</a>
                        <a href="<?php echo BASE_URL ?>apps/addparent/<?php echo $data['encode'] ?>" class="btn btn-primary btn-sx"><i class="icon-folder-plus2 position-left"></i> Add Parent</a>
                        <button onclick="getsel()" class="btn btn-danger" id="button"> <i class="icon-cancel-square2 position-left"></i> Delete</button>
                      </p>
                    <fieldset class="content-group">
                      <form class="form-horizontal" action="#">
                      <div class="table-responsive">
                        <table class="table table-bordered treetable" id="menutable" >
                          <thead>
                            <tr>
                              <th style="width: 46px;" class="text-center col-lg-1"><input type="checkbox" name="chk" id="chk" class="styled"></th>
                              <th style="width: 80px;" class="text-bold text-center col-lg-1">Id</th>
                              <th class="text-center col-lg-6 text-bold">Menu</th>
                              <th class="text-center text-bold col-lg-1">Icon</th>
                              <th class="text-center text-bold col-lg-1">Preview</th>
                              <th class="text-center text-bold col-lg-1">Enabled</th>
                              <th class="text-center text-bold col-lg-1">Generate</th>
                              <th class="text-center text-bold col-lg-1">Import</th>
                              <th class="text-center text-bold col-lg-2">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                        
                      </div>
                    </form>
                  </fieldset>
                  </div> <!-- panel -->
                  </div>
              </div> 


              <!-- Import modal -->
                  <div id="modal_import" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-teal">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-file-spreadsheet2" title="Import Excel"></i>&nbsp; Import Excel</h6>
                        </div>

                        <div class="modal-body">

                           <form class="form-horizontal" action="<?php echo $data['curl']."savetableimport/".$data['encode']; ?>" method="post" enctype="multipart/form-data">

                                <fieldset class="content-group">

                                  <div class="form-group">
                                    <label class="control-label col-lg-2 text-bold">Menu</label>
                                    <div class="col-lg-10">
                                     <input type="text" class="form-control" name="menu_name" id="menu_name" readonly>
                                     <input type="hidden" class="form-control" name="menu_id" id="menu_id" readonly>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-lg-2 text-bold">Autocode</label>
                                    <div class="col-lg-10">
                                     <input type="text" class="form-control" name="autocode" id="autocode" placeholder="CODE-" value="<?php echo $data['table_autocode'] ?>" required>
                                     <span class="help-block">For generate autocode table, example code: <code>CODE-</code></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-lg-2 text-bold">Table Name</label>
                                    <div class="col-lg-10">
                                     <input type="text" class="form-control" name="table_name" id="table_name" placeholder="table_name" value="<?php echo $data['table_name'] ?>" required>
                                     <span class="help-block">Your table name, example table name: <code>tbl_<?php echo str_replace(" ", "_", strtolower($data['modul'][4])) ?></code></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label col-lg-2 text-bold">File Excel</label>
                                    <div class="col-lg-10">
                                      <input type="file" class="file-input" multiple="multiple" name="file_dokumen[]" required="required" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                      <span class="help-block">Download sample format excel <a href="<?php echo BASE_URL.'apps/download/5eb9b355cd9c98c06e3022855ab40edf' ?>">here</a>.</span>
                                    </div>
                                  </div>

                                  <div class="text-right">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2 position-left"></i>Close</button>
                                    <button type="submit" class="btn btn-primary" id="btn-proses">Submit <i class="icon-circle-right2 position-right"></i></button>
                                  </div>

                              </form>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /import modal --> 

              <!-- Report modal -->
                  <div id="modal_report" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-teal">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h6 class="modal-title"><i class="icon-file-spreadsheet" title="Generate Report"></i>&nbsp; Generator Report</h6>
                        </div>

                        <div class="modal-body">

                           <form class="form-horizontal" action="<?php echo $data['curl']."savetablereport/".$data['encode']; ?>" method="post">

                                <fieldset class="content-group">

                                  <div class="form-group">
                                    <label class="control-label col-lg-2 text-bold">Menu</label>
                                    <div class="col-lg-10">
                                     <input type="text" class="form-control text-capitalize" name="menu_name_report" id="menu_name_report" readonly>
                                     <input type="hidden" class="form-control text-capitalize" name="menu_id_report" id="menu_id_report" readonly>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-lg-2 text-bold">From Table</label>
                                      <div class="col-lg-10">
                                        <select name="from_table" id="from_table" data-placeholder="Select table" class="select required">
                                            <option></option>
                                        </select>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-lg-2 text-bold">Select Column</label>
                                      <div class="col-lg-10">
                                        <div class="multi-select-full">
                                            <select class="select" multiple="multiple" name="columns[]" id="columns" required>
                                                <option></option>
                                            </select>
                                        </div>
                                      </div>
                                  </div>

<!--                                   <div class="form-group">
                                      <label class="control-label col-lg-2 text-bold">Select Column</label>
                                      <div class="col-lg-10">
                                        <div class="multi-select-full">
                                            <select class="multiselect-select-all-filtering" multiple="multiple" name="columns[]" id="columns" required>
                                                <option></option>
                                            </select>
                                        </div>
                                      </div>
                                  </div> -->

                                  <div class="text-right">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cancel-circle2 position-left"></i>Close</button>
                                    <button type="submit" class="btn btn-success" id="btn-proses-import">Generate <i class="icon-circle-code position-right"></i></button>
                                  </div>

                              </form>
                          </fieldset>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /report modal -->  

                  
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  getree();
  
  function deletesmenu(i) {
  swal({
      title:"Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#EF5350",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: true
  },
  function(isConfirm){
      if (isConfirm) {
        $.post(url+'deletemenu/'+i, function(data, status){
            if(status == 'success'){
               swal({
                  title:"Deleted!",
                  text: "Your data has been deleted.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });
            }
            $("#menutable").fancytree({ reaload: {url: "<?php echo BASE_URL ?>apps/treemenu/<?php echo $data['encode'] ?>/"} } );
        });
      }
  });
}
function getree(){
      $(".treetable").fancytree({
        extensions: ["table"],
        checkbox: true,
        table: {
            indentation: 20,
            nodeColumnIdx: 2,
            checkboxColumnIdx: 0
        },
        source: {
            url: "<?php echo BASE_URL ?>apps/treemenu/<?php echo $data['encode'] ?>/"
        },
        renderColumns: function(event, data) {
            var node = data.node;
            if(node.data.enabled == 'Y'){ var y = "<i class=\"icon-checkmark position-left text-success\"></i>"; } else { y = "<i class=\" icon-minus-circle2 position-left text-danger\"></i>"}
            $tdList = $(node.tr).find(">td");
            $tdList.eq(1).text(node.getIndexHier()).addClass("text-right");
            $tdList.eq(3).text(node.data.enabled).addClass('text-left text-nowrap').html("<i class=\""+node.data.menu_icon+" text-muted\"></i><span class=\"text-muted\">&nbsp;&nbsp;"+node.data.menu_icon+"</span>");
            $tdList.eq(4).text(node.data.enabled).addClass('text-center').html("<a href='<?php echo BASE_URL ?>"+node.data.linkto+"' class='btn-sx text-slate' title='<?php echo BASE_URL ?>"+node.data.linkto+"' target='_blank'><i class=\"icon-new-tab2 position-left\"></i></a> ");
            $tdList.eq(5).text(node.data.enabled).addClass('text-center').html(y);
            $tdList.eq(6).text(node.data.menuid).addClass('text-center text-nowrap').html("<a href='"+url+"table_define/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx' title='CRUD generator'><i class=\"icon-circle-code position-left text-grey-800\"></i>CRUD</a> || <a href=\"#\" onClick=\"reportgenerator('"+node.key+"')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_report\" title='Report generator'> REPORT</a>");
            $tdList.eq(7).text(node.data.menuid).addClass('text-center').html("<a href=\"#\" onClick=\"importexcel('"+node.key+"')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_import\" title=\"Import Form\"><i class=\"icon-import text-success-800\"></i></a> ");
            $tdList.eq(8).addClass('text-center text-nowrap').html(" <a href='"+url+"addchild/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx text-info-800' title='Add sub menu'><i class=\"icon-folder-plus\"></i></a>  <a href='"+url+"editmenu/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx' title='Edit'><i class=\"icon-pencil7\"></i></a>  <a href='#' onClick=\"deletesmenu('"+node.key+"')\" class='btn-sx red' title='Delete'><i class=\"icon-cancel-square2\"></i></a>");
        }
    });
}

function importexcel(i){
  if (i) {

    $.getJSON(url+'gettableimport/'+i, function (data) {
      
      $("#menu_name").val(data.modul[5]);
      $("#menu_id").val(data.modul[0]);
      $("#table_name").val(data.modul[31]);
      $("#autocode").val(data.modul[32]);

     });

    }
  
}

function reportgenerator(i){
  if (i) {

    $.getJSON(url+'getalltables/'+i, function (data) {
    
      $("#menu_name_report").val(data.modul[5]);
      $("#menu_id_report").val(data.modul[0]);

      $.each(data.table, function(i, tab) {
            var id = tab[0];
            var name = tab[0];
            $("#from_table").append('<option value="'+id+'">'+name+'</option>');
        });

     // console.log(data.table);

     });

  }
  
}

$('[name="from_table"]').change(function(){
  var t = $('#from_table option:selected').val();

  if (t) {

    $("#columns").html("");

    $.getJSON(url+'getallcolumns/'+t, function (data) {

      $.each(data.column, function(i, col) {
            var idcol = col[0];
            var namecol = col[0];
            $("#columns").append('<option value="'+idcol+'">'+namecol+'</option>');
        });

      //console.log(data.column);

     });

  }
});

$('[name="chk"]').change(function(){
  if ($(this).is(':checked')) {
    
    $(".treetable").fancytree("getTree").visit(function(node){
        node.setSelected(true);
    });
      return false;
  } else {
    $(".treetable").fancytree("getTree").visit(function(node){
        node.setSelected(false);
    });
      return false;

  };
});

(function() {

    $('#btn-proses-import').on('click', function() {

        $.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i><span class="help-block text-grey-300">Silahkan tunggu, report sedang di generate...</span>',
            timeout: 360000000,
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
       
    });
});


function getsel() {

    var selNodes =  $('#menutable').fancytree('getTree').getSelectedNodes();
    var selData = $.map(selNodes, function(n){
      return n.toDict();
    });

    swal({
        title:"Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#EF5350",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function(isConfirm){


        if (isConfirm) {
          var data_menu = selData;
          $.ajax({
              type: "POST",
              data: { menuarr: data_menu },
              url: url+"postdata/<?php echo $data['encode'] ?>",
              success: function(data, status){
                    //getree();

                  if(status == 'success'){
                     swal({
                        title:"Deleted!",
                        text: "Your data has been deleted.",
                        confirmButtonColor: "#66BB6A",
                        type: "success",
                        timer: 2000
                    });
                    $("#menutable").fancytree({ reaload: {url: "<?php echo BASE_URL ?>apps/treemenu/<?php echo $data['encode'] ?>/"} } );
                  }

                 }
          });

          


        }



    });

  }
  

</script>