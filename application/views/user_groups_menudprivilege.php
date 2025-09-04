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
                    <li><a href="<?php echo $data['curl'] ?>"><?php echo $data['title'] ?></a></li>
                    <li class="active"><?php echo $data['action'] ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><strong>GROUPS</strong> <?php echo $data['groups'][0]['group_name'] ?> </h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
                      <form class="form-horizontal" action="#" >
                        <fieldset class="content-group">
                          <div class="alert alert-info alert-styled-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-bold">Informasi!</span>  Silahkan <em>checklist</em> menu yang akan ditampilkan.
                          </div>

                          <fieldset class="content-group">
                          
                            <div id="answer"></div>
                            <div class="table-responsive">
                              <table class="table table-bordered treetable" id="menutable" >
                                <thead>
                                  <tr>
                                    <th><input type="checkbox" name="chk" id="chk" class="styled"></th>
                                    <th class="text-center text-bold">Id</th>
                                    <th class="text-center text-bold col-lg-8">Menu</th>
                                    <th class="text-center text-bold col-lg-3">Description</th>
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

                          </fieldset>
                             
                         
                        </fieldset>
                         </form>
                        <div class="text-right">
                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
                          <button onclick="getsel()" class="btn btn-success" id="button">Apply Changes <i class="icon-checkmark4 position-right"></i></button>
                        </div>
                     
                    </div>
          
<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';
  getree();

function getsel() {
  var selNodes =  $('#menutable').fancytree('getTree').getSelectedNodes();
  var selData = $.map(selNodes, function(n){
    return n.toDict();
  });

  var data_menu = selData;
  $.ajax({
      type: "POST",
      data: { menuarr: data_menu },
      url: url+"postdata/<?php echo $data['encode'] ?>",
      success: function(data){
           $("#treetable").fancytree({ reload: { url: url+"treemenu/<?php echo $data['encode'] ?>/" } } );

           new PNotify({
              title: 'Success !!!',
              text: 'Privilege has been saved',
              addclass: 'alert-styled-left alert-arrow-left text-sky-royal',
              type: 'info'
          });

         }
  });
}


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
 

function getree(){
    $(".treetable").fancytree({
        extensions: ["table"],
        checkbox: true,
        table: {
            indentation: 10,
            nodeColumnIdx: 2,
            checkboxColumnIdx: 0
        },
        source: {
            url: url+"treemenu/<?php echo $data['encode'] ?>/"
        },
        select: function(event, data) {
            var node = data.node;

            if (node.isSelected()) {
                if (node.isUndefined()) {
                    // Load and select all child nodes
                    node.load().done(function() {
                        node.visit(function(childNode) {
                            childNode.setSelected(true);
                        });
                    });
                } else {
                    // Select all child nodes
                    node.visit(function(childNode) {
                        childNode.setSelected(true);
                    });
                }
            } else {
                if (node.isUndefined()) {
                    // Load and select all child nodes
                    node.load().done(function() {
                        node.visit(function(childNode) {
                            childNode.setSelected(false);
                        });
                    });
                } else {
                    // Select all child nodes
                    node.visit(function(childNode) {
                        childNode.setSelected(false);
                    });
                }
            }
        },
        renderColumns: function(event, data) {
            var node = data.node,
            $tdList = $(node.tr).find(">td");
            $tdList.eq(1).text(node.getIndexHier()).addClass("text-center");
            $tdList.eq(3).text(node.tooltip);
        }
    });
}

</script>