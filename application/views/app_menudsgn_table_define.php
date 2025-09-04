<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title'] ?></h4>
                  </div>
                  <?php // include('statistic.php'); ?>
                  </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['breadcrumb1'] ?></a></li>
                    <li><a href="<?php echo $data['curl'] ?>">Development Area</a></li>
                    <li><a href="<?php echo $data['curl']."development/".$data['project'] ?>"><?php echo $data['app']['nama'] ?></a></li>
                    <li><a href="<?php echo $data['curl']."menu_designer/".$data['project'] ?>">Menu Designer</a></li> 
                    <li class="active"><?php echo $data['action'] ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-table2 position-left"></i><strong><?php echo $data['action'] ?></strong></h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                      <form class="form-horizontal" action="<?php echo $data['curl']."savetable/".$data['project']."/".$data['encode']; ?>" method="post">
                        <fieldset class="content-group">
                          <legend class="text-bold">Table Info</legend>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Menu</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control text-capitalize" name="menu_name" value="<?php echo $data['modul'][5] ?>" readonly>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Autocode</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="autocode" placeholder="CODE-" value="<?php echo $data['table_autocode'] ?>" required>
                             <span class="help-block">For generate autocode table, example code: <code>CODE-</code></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Table Name</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="table_name" placeholder="table_name" value="<?php echo $data['table_name'] ?>" required>
                             <span class="help-block">Your table name, example table name: <code>tbl_<?php echo str_replace(" ", "_", strtolower($data['modul'][4])) ?></code></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2"></label>
                            <div class="col-lg-10">
                              
                             <button type="submit" class="btn btn-success"><i class="icon-checkmark"></i>  Apply Changes</button>
                            </div>
                          </div>

                        </fieldset>
                        
                        

                        

                        <!-- Basic collapsible -->
                        <!-- <h6 class="content-group text-capitalize no-margin-top"> TABLE STRUCTURED<small class="display-block">&nbsp;</small></h6>-->
                        <fieldset class="content-group"> 
                          <legend class="text-bold">TABLE STRUCTURED</legend>
                        <div class="panel-group content-group-lg">
                          <div class="panel panel-white">
                            <div class="panel-heading">
                              <h6 class="panel-title">
                                <a data-toggle="collapse" href="#collapse-group1" class="text-bold"><i class="icon-circle-right2"></i>&nbsp;&nbsp;Main Table</a>
                              </h6>
                            </div>
                            <div id="collapse-group1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                <!-- Main Table -->
                                <fieldset class="content-group">
                                 <!--  <legend class="text-bold">Table Main</legend> -->
                                  <!-- <p class="form-group"> -->
                                    <div class="panel-body">
                                      <button type="button" class="btn bg-teal btn-sx" data-toggle="modal" data-target="#modal_form"><i class="icon-add-to-list position-left"></i> Add Field</button>
                                  </p>
                                  <table class="table datatable table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th class="text-center text-bold">No</th>
                                        <th class="text-center text-bold">Field Name</th>
                                        <th class="text-center text-bold">Type</th>
                                        <th class="text-center text-bold">Length</th>
                                        <th class="text-center text-bold">Input</th>
                                        <th class="text-center text-bold">Actions</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </fieldset>
                              </div>
                            </div>
                          </div>

                        

                          <div class="panel ">
                            <div class="panel-heading">
                              <h6 class="panel-title">
                                <a class="collapsed text-bold" data-toggle="collapse" href="#collapse-group2"><i class="icon-circle-right2"></i>&nbsp;&nbsp;Detail Table</a>
                              </h6>
                            </div>
                            <div id="collapse-group2" class="panel-collapse collapse">
                              <div class="panel-body">
                                <!-- Detail Table -->
                                <fieldset class="content-group">
                                  <!-- <legend class="text-bold">Table Detail</legend> -->
                                  <!-- <p class="form-group"> -->
                                    <div class="panel-body">
                                      <button type="button" class="btn bg-teal btn-sx" data-toggle="modal" data-target="#modal_form_detail"><i class="icon-add-to-list position-left"></i> Add Detail</button>
                                  </p>
                                  <table class="table datatable-detail table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th class="text-center text-bold">No</th>
                                        <th class="text-center text-bold">Field Name</th>
                                        <th class="text-center text-bold">Type</th>
                                        <th class="text-center text-bold">Length</th>
                                        <th class="text-center text-bold">Input</th>
                                        <th class="text-center text-bold">Actions</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </fieldset>
                              </div>
                            </div>
                          </div>

                        </div>
                        <!-- /basic collapsible -->
                        </fieldset>
                        <div class="text-right">
                          <!-- <a href="<?php echo $data['curl'] ?>menu_designer/<?php echo $data['project'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a>  -->
                          <!-- <button type="submit" class="btn btn-primary"><i class="icon-floppy-disk position-left"></i> Save</button> -->
                          <a href="<?php echo $data['curl'] ?>menu_designer/<?php echo $data['project'] ?>" class="btn btn-default btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <a href="<?php echo BASE_URL.$data['modul'][18]; ?>" class="btn btn-primary" target="_blank"><i class="icon-windows2 position-left"></i> Preview</a> 
                          <a href="#" class="btn btn-success btn-sx" onclick="generate('<?php echo $data['project'] ?>','<?php echo $data['encode'] ?>')"><i class="icon-codepen position-left"></i> Generate CRUD</a> 
                        </div>
                      </form>
                    </div>

                    <!-- Info modal -->
                    <div id="modal_form" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">Add Field</h6>
                          </div>

                          <div class="modal-body">
                            <form class="form-horizontal" action="<?php echo BASE_URL."apps/savecolumn/".$data['project']."/".$data['encode']; ?>" method="post">
                              <fieldset class="content-group">
                                <legend class="text-bold">Table Field</legend>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Name</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="column_name" id="column_name" required="true">
                                    <input type="hidden" class="form-control" name="column_id" id="column_id" readonly="readonly">
                                    <span class="help-block">Write your field name with no space, example: <code>field_name</code></span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Data type</label>
                                  <div class="col-lg-10">
                                    <select data-placeholder="Choose data type" class="select" required="true" name="data_type" id="data_type">
                                        <option></option>
                                        <?php foreach ($data['data_type'] as $key => $value) { echo "<option value=\"".$value[1]."\">".$value[1]."</option>"."\n";} ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Length</label>
                                  <div class="col-lg-10">
                                    <input type="number" class="form-control" name="length_data" id="length_data">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Input type</label>
                                  <div class="col-lg-10">
                                    <select data-placeholder="Choose input type" class="select" required="true" name="input_type" id="input_type">
                                        <option></option>
                                        <?php foreach ($data['input_type'] as $key => $value) { echo "<option value=\"".$value[1]."\">".$value[1]."</option>"."\n";} ?>
                                    </select>
                                  </div>
                                </div>

                              </fieldset>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-info" value="Save">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <!-- /info modal -->

                    <!-- Info modal detail-->
                    <div id="modal_form_detail" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-info">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">Add Field Detail</h6>
                          </div>

                          <div class="modal-body">
                            <form class="form-horizontal" action="<?php echo BASE_URL."apps/savecolumndetail/".$data['project']."/".$data['encode']; ?>" method="post">
                              <fieldset class="content-group">
                                <legend class="text-bold">Table Field</legend>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Name</label>
                                  <div class="col-lg-10">
                                    <input type="text" class="form-control" name="column_name_detail" id="column_name_detail" required="true">
                                    <input type="hidden" class="form-control" name="column_id_detail" id="column_id_detail" readonly="readonly">
                                    <span class="help-block">Write your field name with no space, example: <code>field_name</code></span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Data type</label>
                                  <div class="col-lg-10">
                                    <select data-placeholder="Choose data type" class="select" required="true" name="data_type_detail" id="data_type_detail">
                                        <option></option>
                                        <?php foreach ($data['data_type'] as $key => $value) { echo "<option value=\"".$value[1]."\">".$value[1]."</option>"."\n";} ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Length</label>
                                  <div class="col-lg-10">
                                    <input type="number" class="form-control" name="length_data_detail" id="length_data_detail">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-lg-2">Input type</label>
                                  <div class="col-lg-10">
                                    <select data-placeholder="Choose input type" class="select" required="true" name="input_type_detail" id="input_type_detail">
                                        <option></option>
                                        <?php foreach ($data['input_type'] as $key => $value) { echo "<option value=\"".$value[1]."\">".$value[1]."</option>"."\n";} ?>
                                    </select>
                                  </div>
                                </div>

                              </fieldset>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-info" value="Save">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <!-- /info modal -->
          
<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo BASE_URL ?>apps/';
  $(function() {
  $('.datatable').DataTable({
        "processing": true,
        "serverSide": true, 
        "searching": false,
        "paging": false,
        "order": [4],
        "info": false,
        "ajax": {
            "url": url+'gettable/<?php echo $data['encode'] ?>',
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
            {"data": 1,width:'50%', "sortable": false,},
            {"data": 2,width:'20%', className: 'center', "sortable": false,},
            {"data": 3,width:'20%', className: 'center', "sortable": false,},
            {"data": 5,width:'20%', className: 'center', "sortable": false,},
            {
                "data": null,
                "width": 50,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="#" onClick="editcolumn(('+"'"+row[0]+"'"+'))" class="btn-sx" data-toggle="modal" data-target="#modal_form" title="Edit Form"><i class="icon-pencil7 text-primary-800"> </i></a> <a href="#" onClick="deletescolumn('+"'"+row[0]+"'"+')" class="btn-sx red" title="Delete"><i class="icon-cancel-square2"></i></a> ';
                 }
            }
        ]
    });


  $('.datatable-detail').DataTable({
        "processing": true,
        "serverSide": true, 
        "searching": false,
        "paging": false,
        "order": [0],
        "info": false,
        "ajax": {
            "url": url+'gettabledetail/<?php echo $data['encode'] ?>',
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
            {"data": 1,width:'50%', "sortable": false,},
            {"data": 2,width:'20%', className: 'center', "sortable": false,},
            {"data": 3,width:'20%', className: 'center', "sortable": false,},
            {"data": 5,width:'20%', className: 'center', "sortable": false,},
            {
                "data": null,
                "width": 50,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     return '<a href="#" onClick="editcolumndetail(('+"'"+row[0]+"'"+'))" class="btn-sx" data-toggle="modal" data-target="#modal_form_detail" title="Edit Form"><i class="icon-pencil7 text-primary-800"> </i></a>  <a href="#" onClick="deletescolumndetail('+"'"+row[0]+"'"+')" class="btn-sx red" title="Delete"><i class="icon-cancel-square2"></i></a> ';
                 }
            }
        ]
    });
  });

  function addcolumn(){

      $.getJSON(url+'getcolumn/', function (data) {
        
        $('#input_type').empty();
        data.input_type.forEach(addinputtype);

        $('#data_type').empty();
        data.data_type.forEach(adddatatype);

       });
    
  }

  function editcolumn(i){
    if (i) {

      $.getJSON(url+'getcolumnedit/'+i, function (data) {
        
        $("#column_name").val(data.modul[1]);
        $("#column_id").val(data.modul[0]);
        $("#length_data").val(data.modul[3]);
        // $('#input_type').empty(); 
        // $('#data_type').empty();
        $("#input_type").html("<option></option>");
        $("#data_type").html("<option></option>");
        data.input_type.forEach(addinputtype);
        data.data_type.forEach(adddatatype);

       });

      }
    
  }

  function editcolumndetail(i){
    if (i) {

      $.getJSON(url+'getcolumneditdetail/'+i, function (data) {
        
        $("#column_name_detail").val(data.modul[1]);
        $("#column_id_detail").val(data.modul[0]);
        $("#length_data_detail").val(data.modul[3]);
        $('#input_type_detail').empty();
        $('#data_type_detail').empty();
        data.input_type.forEach(addinputtypedetail);
        data.data_type.forEach(adddatatypedetail);

       });

      }
    
  }

  function addinputtype(item, index) {
      document.getElementById("input_type").innerHTML += "<option value=\""+item[1]+"\" "+item[2]+">"+item[1]+"</option>";
  }

  function adddatatype(item, index) {
      document.getElementById("data_type").innerHTML += "<option value=\""+item[1]+"\" "+item[2]+">"+item[1]+"</option>";
  }

  function addinputtypedetail(item, index) {
      document.getElementById("input_type_detail").innerHTML += "<option value=\""+item[1]+"\" "+item[2]+">"+item[1]+"</option>";
  }

  function adddatatypedetail(item, index) {
      document.getElementById("data_type_detail").innerHTML += "<option value=\""+item[1]+"\" "+item[2]+">"+item[1]+"</option>";
  }

  function deletescolumn(i) {
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
        $.post(url+'deletecolumn/'+i, function(data, status){
          var table = $('.datatable').DataTable();
          table.ajax.reload(null, false);

            if(status == 'success'){
               swal({
                  title:"Deleted!",
                  text: "Your data has been deleted.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });
            }
            getree();
        });
      }
  });
}

  function deletescolumndetail(i) {
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
        $.post(url+'deletecolumndetail/'+i, function(data, status){
          var table = $('.datatable-detail').DataTable();
          table.ajax.reload(null, false);

            if(status == 'success'){
               swal({
                  title:"Deleted!",
                  text: "Your data has been deleted.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });
            }
            getree();
        });
      }
  });
}

function generate(p, i) {
  swal({
      title:"Are you sure generate CRUD?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#EF5350",
      confirmButtonText: "Yes, generate it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: true
  },
  function(isConfirm){
      if (isConfirm) {
        $.post(url+'generate/'+p+'/'+i, function(data, status){
          var table = $('.datatable').DataTable();
          table.ajax.reload(null, false);

            if(status == 'success'){
               swal({
                  title:"Success!",
                  text: "Your data has been generate.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });
            } else {
                swal({
                  title:"Error!",
                  text: "Something wrong when generate CRUD.",
                  confirmButtonColor: "#66BB6A",
                  type: "warning",
                  timer: 2000
              });
            }
            
        });
      }
  });
}
</script>