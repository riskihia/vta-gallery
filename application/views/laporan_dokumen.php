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
                            <h5 class="panel-title"><i class="icon-file-stats position-left"></i><strong>Laporan</strong> Dokumen</h5>
                            <div class="heading-elements">
                              <ul class="icons-list">
                                <li><span class="btn heading-btn">Tanggal :</span><input type="date" class="btn btn-default btn-xs heading-btn" name="tanggal" id="tanggal" ></li>
                                <li><button type="button" class="btn btn-default btn-xs heading-btn" onclick="window.print()"><i class="icon-printer position-left"></i> Print</button></li>
                              </ul>
                            </div>
                          </div>

                          <table class="table dts datatable-button-html5-basic table-striped" id="section-to-print">
                            <thead>
                              <tr>
                                <th class="center">No.</th>
                                <th class="center">Nama Kegiatan</th>
                                <th class="center">Lokasi</th>
                                <th class="center">Tanggal</th>
                                <th class="center">Jenis Media</th>
                                <th class="center">Kondisi</th>
                                <th class="center">Status</th>
                                <th class="center">Created On</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php 
                            $i = 1;
                            foreach ($data['aadata'] as $key => $value) { 
                              echo "<tr>";
                              echo "<td>".$i++."</td>";
                              echo "<td>".$value['nama_kegiatan']."</td>";
                              echo "<td>".$value['lokasi']."</td>";
                              echo "<td>".$value['tanggal']."</td>";
                              echo "<td>".$value['nama_media']."</td>";
                              echo "<td>".$value['nama_kondisi']."</td>";
                              echo "<td>".$value['complete']."</td>"; 
                              echo "<td>".$value['createdate']."</td>";
                              echo "</tr>";

                            }
                            ?>
                              
                             
                            </tbody>
                          </table>
                        </div>
                        <!-- /basic initialization -->
                      
                </div> <!-- end div content -->                
<?php  include('footer.php'); ?>
<script type="text/javascript">
var url = '<?php echo $data['curl']; ?>';
$(document).ready(function(){

    $("#tanggal").change(function(){
        var tanggal = $(this).val();
        $.ajax({
            url: url+'/get',
            type: 'post',
            data: {tgl:tanggal},
            dataType: 'json',
            success:function(response){

                        // var trHTML = '';
                        // $.each(response, function (i, item) {
                        //     trHTML += '<tr><td>' + item.nama_kegiatan + '</td><td>' + item.lokasi + '</td><td>' + item.autocode + '</td><td>' + item.nama_kegiatan + '</td><td>' + item.lokasi + '</td><td>' + item.autocode + '</td><td>' + item.nama_kegiatan + '</td><td>' + item.lokasi + '</td></tr>';
                        // });
                        // $('#dts').append(trHTML);
            }
        });


    });
   
});


</script>
