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
                    <li class="active">User Groups</li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-people position-left"></i><strong>User</strong> Groups</h5>
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
                        <a href="<?php echo BASE_URL ?>user_groups/add/<?php echo $data['encode'] ?>" class="btn btn-info btn-sx bg-teal"><i class="icon-user-plus position-left"></i> Add Groups</a>
                      </p>
                    <fieldset class="content-group">
                      <form class="form-horizontal" action="#">
                      <div class="table-responsive">
                        <table class="table table-bordered treetable table-striped" id="grouptabel">
                          <thead>
                            <tr >
                              <th class="col-lg-1 text-bold text-teal">Identifier</th>
                              <th class="text-center  text-bold text-teal col-lg-6">Menu</th>
                              <th class="text-center  text-bold text-teal col-lg-3">Description</th>
                              <th class="text-center  text-bold text-teal col-lg-2">Actions</th>
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
<?php include('footer.php'); ?>

<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  getree();
  
  function deletesgroups(i) {
  swal({
      title:"Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#EF5350",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: true
  },
  function(isConfirm){
      if (isConfirm) {
        $.post(url+'delete/'+i, function(data, status){
            if(status == 'success'){
               swal({
                  title:"Deleted!",
                  text: "Your data has been deleted.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });
            }
            $("#grouptabel").fancytree({ reaload: {url: url+"tree/"} } );
        });
      }
  });
}

function getree(){
      $(".treetable").fancytree({
        extensions: ["table"],
        checkbox: false,
        table: {
            indentation: 20,
            nodeColumnIdx: 1,
            checkboxColumnIdx: 'none'
        },
        source: {
            url: url+"tree/"
        },
        renderColumns: function(event, data) {
            var node = data.node;
            $tdList  = $(node.tr).find(">td");
            $tdList.eq(0).text(node.getIndexHier()).addClass("alignRight");
            $tdList.eq(2).text(node.tooltip);
            $tdList.eq(3).addClass('text-center').html("<a href='"+url+"addchild/"+node.key+"' class='btn-sx cyan' title='Add child groups'><i class=\"icon-add\"></i></a>  <a href='"+url+"menu_privilege/"+node.key+"/' class='btn-sx green' title='Menu privilege'><i class=\" icon-menu2 position-left\"></i></a> <a href='"+url+"edit/"+node.key+"' class='btn-sx' title='Edit'><i class=\"icon-pencil7\"></i></a>  <a href='#' onClick=\"deletesgroups('"+node.key+"')\" class='btn-sx red' title='Delete'><i class=\"icon-cancel-square2\"></i></a>");
        }
    });
}

</script>