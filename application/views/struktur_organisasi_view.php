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
      <li class="active">Struktur Organisasi</li>
    </ul>

  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h5 class="panel-title"><i class="icon-tree7"></i><strong> Struktur</strong> Organisasi</h5>
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
        <a href="<?php echo BASE_URL ?>struktur_organisasi/addParent/" class="btn btn-info btn-sx bg-teal"><i class="icon-user-plus position-left"></i> Add Organisasi</a>
      </p>
      <fieldset class="content-group">
        <form class="form-horizontal" action="#">
          <div class="table-responsive">
            <table class="table table-bordered treetable" id="grouptabel">
              <thead>
                <tr >
                  <th class="text-center text-bold">Id</th>
                  <th class="text-center text-bold col-lg-3">Nama Organisasi</th>
                  <th class="text-center text-bold col-lg-2">Nama Lengkap</th>
                  <th class="text-center text-bold col-lg-2">NRP/NIP</th>
                  <th class="text-center text-bold col-lg-2">Pangkat/Gol</th>
                  <th class="text-center text-bold">Korps</th>
                  <th class="text-center text-bold">Preview</th>
                  <th class="text-center text-bold col-lg-1">Actions</th>
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

<!-- Info modal -->
<div id="modal_form" class="modal fade">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header bg-teal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h6 class="modal-title"><i class=" icon-share4"></i>&nbsp; Preview  </h6>
      </div>

      <div class="modal-body">

              <style type="text/css">
                .highcharts-figure, .highcharts-data-table table {
                  min-width: 360px; 
                  max-width: 90%;
                  margin: auto;
              }

              .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #EBEBEB;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
              }
              .highcharts-data-table caption {
                  padding: 1em 0;
                  font-size: 1.2em;
                  color: #555;
              }
              .highcharts-data-table th {
                font-weight: 600;
                  padding: 0.5em;
              }
              .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                  padding: 0.5em;
              }
              .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                  background: #f8f8f8;
              }
              .highcharts-data-table tr:hover {
                  background: #f1f7ff;
              }

              #container h4 {
                  text-transform: none;
                  font-size: 14px;
                  font-weight: normal;
              }
              #container p {
                  font-size: 13px;
                  line-height: 16px;
              }

              @media screen and (max-width: 100%) {
                  #container h4 {
                      font-size: 2.3vw;
                      line-height: 3vw;
                  }
                  #container p {
                      font-size: 2.3vw;
                      line-height: 3vw;
                  }
              }

              </style>
              
              <!-- Content area -->
              <div class="content">

                  <div class="panel panel-flat ">
                    <div class="panel-heading">
                      <h5 class="panel-title text-bold"><i class="icon-tree5">&nbsp;</i> Struktur Organisasi</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="panel-body">
                      <figure class="highcharts-figure" id="pastehtml">
                          <div id="container"></div>
                      </figure>
                    </div>
                  </div>

              </div> <!-- end div content -->         
    </div>
  </div>
</div>
<!-- /info modal -->  

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
        checkboxColumnIdx: 'none',
        expanded: true
      },
      source: {
        url: url+"tree/"
      },
      renderColumns: function(event, data) {
        var node = data.node;
        node.setExpanded(true);
        $tdList  = $(node.tr).find(">td");
        $tdList.eq(0).text(node.getIndexHier()).addClass('text-left');
        $tdList.eq(2).text(node.data.nama_lengkap);
        $tdList.eq(3).text(node.data.nrp_nip).addClass('text-center');
        $tdList.eq(4).text(node.data.pangkat).addClass('text-center');
        $tdList.eq(5).text(node.data.korps).addClass('text-center');
        if(node.data.parent_id == 0){
          $tdList.eq(6).addClass('text-center').html("<a href=\"#\" class=\"btn-sx\" onClick=\"chartUpdate('"+node.data.id+"')\" data-toggle=\"modal\" data-target=\"#modal_form\" title=\"Lihat Organisasi\"><i class=\"icon-tree7 text-slate\"></i> </a>");
        } else {
          $tdList.eq(6).text('');
        }
        
        $tdList.eq(7).addClass('text-center text-nowrap').html("<a href='"+url+"addchild/"+node.key+"' class='btn-sx cyan' title='Add child groups'><i class=\"icon-add\"></i></a> <a href='"+url+"edit/"+node.key+"' class='btn-sx' title='Edit'><i class=\"icon-pencil7\"></i></a>  <a href='#' onClick=\"deletesgroups('"+node.key+"')\" class='btn-sx red' title='Delete'><i class=\"icon-cancel-square2\"></i></a>");
      }
    });
  }

function chartUpdate(i) {
    $.getJSON(url+'showtreeorg/'+i, function (dataset) {
        chart.update({
            series: [{
                data: dataset.dtseries,
                nodes: dataset.dtnodes
            }]
        });
    });
} 


var chart = new Highcharts.chart('container', {
              chart: {
                  height: '600px',
                  inverted: true
              },

              title: {
                  text: 'STRUKTUR ORGANISASI'
              },

              accessibility: {
                  point: {
                      descriptionFormatter: function (point) {
                          var nodeName     = point.toNode.name,
                              nodeId       = point.toNode.id,
                              nodeDesc     = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                              parentDesc   = point.fromNode.id;
                          return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
                      }
                  }
              },

              series: [{
                  type: 'organization',
                  name: 'DISJARAHAD',
                  keys: ['from', 'to'],
                  data: '',
                  levels: [{
                      level: 0,
                      color: '#2d5f5b',
                      dataLabels: {
                          color: '#eee'
                      },
                      height: 25
                  }, {
                      level: 1,
                      color: '#980104',
                      dataLabels: {
                          color: '#eee',
                      },
                      height: 25
                  }, {
                      level: 2,
                      color: '#1a760f'
                  }, {
                      level: 3,
                      color: '#2196f3'
                  }, {
                      level: 4,
                      color: '#607d8b'
                  }],
                  nodes: '',
                  colorByPoint: false,
                  color: '#007ad0',
                  dataLabels: {
                      color: 'white'
                  },
                  borderColor: 'white',
                  nodeWidth: 65
              }],
              tooltip: {
                  outside: true
              },
              exporting: {
                  allowHTML: true,
                  sourceWidth: 2100,
                  sourceHeight: 800
              }

          });

</script>
