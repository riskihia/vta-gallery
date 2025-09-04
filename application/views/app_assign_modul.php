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
                    <li><a href="<?php echo $data['curl'] ?>">Development Area</a></li>
                    <li><a href="<?php echo $data['curl'].'development/'.$data['encode']; ?>"><?php echo $data['app']['nama']; ?></a></li>
                    <li class="active">Assign Module</li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-list2 position-left"></i><strong>Assign</strong> Module</h5>
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
                        <fieldset class="content-group">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Select Team:  <span class="text-danger">*</span></label>
                                  <div class="multi-select-full">
                                      <select class="multiselect-select-all-filtering" multiple="false" name="team[]" required>
                                          <?php foreach ($data['team'] as $key => $team) { echo "<option value=\"".$team[0]."\">".$team[1]."</option>"."\n";} ?>
                                      </select>
                                  </div>
                              </div>
                          </div>


                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Assign Modul:  <span class="text-danger">*</span></label>
                                  <div class="multi-select-full">
                                      <div class="table-responsive">
                                      <table class="table table-bordered treetable" id="menutable" >
                                        <thead>
                                          <tr>
                                            <th style="width: 46px;"></th>
                                            <th style="width: 80px;">Identifier</th>
                                            <th class="text-center col-lg-6">Menu</th>
                                            <!-- <th>Url</th> -->
                                            <th class="text-center col-lg-3">Description</th>
                                           <!--  <th class="text-center col-lg-2">Actions</th> -->
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
                                  </div>
                              </div>
                          </div>
                        </fieldset>
                         
                      </p>

                    <div class="text-right">
                      <a href="<?php echo $data['curl'] ?>development/<?php echo $data['encode'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a>
                       <a href="#" class="btn btn-success btn-sx"><i class="icon-checkmark position-left"></i> Apply Changes</a> 
                    </div>
                  </div> <!-- panel -->
                  </div>
              </div>   
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
          // var table = $('#menutable').DataTable();
          // table.ajax.reload(null, false);

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
function getree(){
      $(".treetable").fancytree({
        extensions: ["table"],
        checkbox: true,
        table: {
            indentation: 20,      // indent 20px per node level
            nodeColumnIdx: 2,     // render the node title into the 2nd column
            checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: "<?php echo BASE_URL ?>apps/treemenu/<?php echo $data['encode'] ?>/"
        },
        renderColumns: function(event, data) {

            var node = data.node,
            $tdList = $(node.tr).find(">td");
            //alert(node.description);

            $tdList.eq(1).text(node.getIndexHier()).addClass("alignRight");
            // $tdList.eq(3).text(node.extraClasses);
            $tdList.eq(3).text(node.tooltip);
            $tdList.eq(4).addClass('text-center').html("<a href='"+url+"addchild/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx cyan' tooltip='Add Child'><i class=\"icon-folder-plus4\"></i></a>  <a href='"+url+"table_define/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx green' tooltip='Generate'><i class=\"icon-database-menu position-left\"></i></a>  <a href='"+url+"editmenu/<?php echo $data['encode'] ?>/"+node.key+"' class='btn-sx' tooltip='Edit'><i class=\"icon-pencil7\"></i></a>  <a href='#' onClick=\"deletesmenu('"+node.key+"')\" class='btn-sx red' tooltip='Delete'><i class=\"icon-cancel-square2\"></i></a>");

            // $(".styled").uniform({radioClass: 'choice'});
        }
    });
    }

  // $(function() {
    
  //     $(".treetable").fancytree({
  //       extensions: ["table"],
  //       checkbox: true,
  //       table: {
  //           indentation: 20,      // indent 20px per node level
  //           nodeColumnIdx: 2,     // render the node title into the 2nd column
  //           checkboxColumnIdx: 0  // render the checkboxes into the 1st column
  //       },
  //       source: {
  //           url: "<?php echo BASE_URL ?>apps/treemenu/"
  //       },
  //       renderColumns: function(event, data) {

  //           var node = data.node,
  //           $tdList = $(node.tr).find(">td");
  //           //alert(node.description);

  //           $tdList.eq(1).text(node.getIndexHier()).addClass("alignRight");
  //           // $tdList.eq(3).text(node.extraClasses);
  //           $tdList.eq(3).text(node.tooltip);
  //           $tdList.eq(4).addClass('text-center').html("<a href='"+url+"addchild/"+node.key+"' class='btn-sx cyan' tooltip='Add Child'><i class=\"icon-folder-plus4\"></i></a>  <a href='"+url+"generate/"+node.key+"' class='btn-sx green' tooltip='Generate'><i class=\"icon-database-menu position-left\"></i></a>  <a href='"+url+"edit/"+node.key+"' class='btn-sx' tooltip='Edit'><i class=\"icon-pencil7\"></i></a>  <a href='#' onClick=\"deletesmenu('"+node.key+"')\" class='btn-sx red' tooltip='Delete'><i class=\"icon-cancel-square2\"></i></a>");

  //           // $(".styled").uniform({radioClass: 'choice'});
  //       }
  //   });


    // Handle custom checkbox clicks
    // $(".tree-table").delegate("input[name=like]", "click", function (e){
    //     var node = $.ui.fancytree.getNode(e),
    //     $input = $(e.target);
    //     e.stopPropagation(); // prevent fancytree activate for this row
    //     if($input.is(":checked")){
    //         alert("like " + $input.val());
    //     }
    //     else{
    //         alert("dislike " + $input.val());
    //     }
    // });
  // });
</script>