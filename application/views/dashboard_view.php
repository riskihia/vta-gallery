<?php include('header.php'); ?>

              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1'] ?></span> - <?php echo $data['title'] ?></h4>
                  </div>
                <div class="heading-elements">
							<div class="heading-btn-group">
								<a href="<?php echo BASE_URL."frontoffice"; ?>" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon" target="_blank"><i class="icon-chart text-success-300"></i><span>&nbsp;&nbsp;Front Office</span></a>
<!-- 								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> -->
							</div>
						</div>

                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active"><?php echo $data['breadcrumb1'] ?></li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">

               

                  <!-- Basic column chart -->
                  <div class="panel panel-flat ">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-chart position-left"></i> Grafik Penginputan Data</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="panel-body">
                      <div class="chart-container ">
                            <div class="chart has-fixed-height" id="container"></div>
                      </div>
                    </div>
                  </div>
                  <!-- /basic column chart -->

                  <!-- end Grafik -->


              </div> <!-- end div content -->   
         
<?php include('footer.php'); ?>
<script type="text/javascript">
$(function () {   
  Highcharts.setOptions({
      lang: {
          thousandsSep: '.'
      }
  }); 
  var defaultTitle = "<strong>GRAFIK JUMLAH DOKUMEN</strong>";
  var drilldownTitle = "";
  var chart = new Highcharts.Chart({
          chart: {
              type: 'column',
              renderTo: 'container',
              events: {
                  drilldown: function(e) {
                      chart.setTitle({ text: drilldownTitle + e.point.name });
                  },
                  drillup: function(e) {
                      chart.setTitle({ text: defaultTitle });
                  }
              }
          },
          title: {
              text: defaultTitle
          },
          credits: {
              enabled: false
          },
          subtitle: {
              text: 'S.D BULAN : <?php echo strtoupper($data['bulan']); ?> <?php echo date('Y') ?>'
          },
          xAxis: {
              type: 'category'
          },
          yAxis: {
              title: 'category'
          },
          legend: {
              enabled: false
          },

          plotOptions: {
              series: {
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true,
                      format: '<span style="font-size:11px; font-family: Tahoma;">{point.y:,.0f}</span> ' 
                  }
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f} </b><br/>'
          },
          series: [{
              name: 'Jenis Media',
              colorByPoint: true,
              data: <?php  echo $data['graf']; ?>
          }],
          drilldown: {
              series: [ <?php echo $data['subgraf']; ?>]
          }
      })
});

</script>