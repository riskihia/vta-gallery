<?php  include_once('header_report.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1'] ?></span> - <?php echo $data['title'] ?></h4>
                  </div>

                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo BASE_URL ?>"><?php echo $data['breadcrumb1'] ?></a></li>
                    <li class="active"><?php echo $data['title'] ?></li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">

                      <!-- Basic initialization -->
                        <div class="panel panel-flat">
                          <div class="panel-heading">
                            <h5 class="panel-title"><i class="icon-file-spreadsheet2 position-left"></i><?php echo $data['title'] ?></h5>
                            <div class="heading-elements">
                              <ul class="icons-list">
                                <li>
                                   <div class="form-group">
                                    <label class="control-label col-lg-2"></label>
                                    <div class="col-lg-6">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal"  >
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li><a href="<?php echo $data['curl']."/print_report"; ?>" target="_blank" id="printbtn" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</a></li>
                              </ul>
                            </div>
                          </div>

                          <table class="table datatable-laporan table-striped">
                            <thead>
                              <tr>
                                <th class="center text-bold">Nama Kegiatan</th>
                                <th class="center text-bold">Lokasi</th>
                                <th class="center text-bold">Tanggal</th>
                                <th class="center text-bold">Jenis Media</th>
                                <th class="center text-bold">Kondisi</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                        <!-- /basic initialization -->
                      
                </div> <!-- end div content -->                
<?php  include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>';

  //getdata('MED-1');

  function getdata(i){
    $('.datatable-laporan').DataTable({
        
        "processing": true,
        "serverSide": true, 
        "destroy":true,
        "order": [],

        "ajax": {
            "url": url+'/get/'+i,
            "type": "POST"
        },
        "columns": [
            {"data": 1,width:'auto', sortable: false,},
            {"data": 5,width:'auto', sortable: false,},
            {"data": 4,width:'auto', sortable: false, className: 'text-center text-nowrap'},
            {"data": 2,width:'auto', sortable: false, className: 'text-center text-nowrap'},
            {"data": 3,width:'auto', sortable: false, className: 'text-center'}
        ],
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5'
            ]
        }
    });
  }
  $(function() {

    $('#tanggal').change(function() {
        var t = $(this).val();
        var newurl = '<?php echo $data['curl']."/print_report"; ?>';
        $('#printbtn').attr("href", newurl+'/'+t);
        getdata(t);
    });
    
  });

</script>
