<?php include('header.php'); ?>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/sankey.js"></script>
<script src="https://code.highcharts.com/modules/organization.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
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
                      <h5 class="panel-title"><i class="icon-chart position-left"></i> Grafik Struktur Organisasi Data</h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="panel-body">
                      <figure class="highcharts-figure">
                          <div id="container"></div>
                          <p class="highcharts-description">
                             
                          </p>
                      </figure>
                    </div>
                  </div>
                  <!-- /basic column chart -->

                  <!-- end Grafik -->


              </div> <!-- end div content -->   
         
<?php include('footer.php'); ?>
<script type="text/javascript">
$(function () {   
  Highcharts.chart('container', {
    chart: {
        height: 600,
        inverted: true
    },

    title: {
        text: 'STRUKTUR ORGANISASI DISJARAHAD'
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
        data: [
            ['1', '3'],
            ['3', 'CEO'],
            ['CEO', 'CTO'],
            ['CEO', 'CPO'],
            ['CEO', 'CSO'],
            ['CEO', 'HR'],
            ['CTO', 'Product'],
            ['CTO', 'Web'],
            ['CSO', 'Sales'],
            ['HR', 'Market'],
            ['CSO', 'Market'],
            ['HR', 'Market'],
            ['CTO', 'Market']
        ],
        levels: [{
            level: 0,
            color: 'silver',
            dataLabels: {
                color: 'black'
            },
            height: 25
        }, {
            level: 1,
            color: 'silver',
            dataLabels: {
                color: 'black'
            },
            height: 25
        }, {
            level: 2,
            color: '#980104'
        }, {
            level: 4,
            color: '#359154'
        }],
        nodes: [{
            id: '1',
            title: 'Drs. Rahmat<br> NRP. 12345 Brigjen TNI',
            name: 'KADISJARAHAD',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131126/Highsoft_03862_.jpg'
        }, {
            id: '3',
            title: 'Budi Waseso<br> NRP. 333343 Kolonel Inf',
            name: 'SESDISJARAHAD',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131126/Highsoft_03862_.jpg'
        }, {
            id: 'CEO',
            title: 'CEO',
            name: 'Grethe Hjetland',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131126/Highsoft_03862_.jpg'
        }, {
            id: 'HR',
            title: 'HR/CFO',
            name: 'Anne Jorunn Fjærestad',
            color: '#007ad0',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131210/Highsoft_04045_.jpg'
        }, {
            id: 'CTO',
            title: 'CTO',
            name: 'Christer Vasseng',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131120/Highsoft_04074_.jpg'
        }, {
            id: 'CPO',
            title: 'CPO',
            name: 'Torstein Hønsi',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131213/Highsoft_03998_.jpg'
        }, {
            id: 'CSO',
            title: 'CSO',
            name: 'Anita Nesse',
            image: 'https://wp-assets.highcharts.com/www-highcharts-com/blog/wp-content/uploads/2020/03/17131156/Highsoft_03834_.jpg'
        }, {
            id: 'Product',
            name: 'Product developers'
        }, {
            id: 'Web',
            name: 'Web devs, sys admin'
        }, {
            id: 'Sales',
            name: 'Sales team'
        }, {
            id: 'Market',
            name: 'Marketing team',
            column: 5
        }],
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
        sourceWidth: 800,
        sourceHeight: 600
    }

});
  // Highcharts.setOptions({
  //     lang: {
  //         thousandsSep: '.'
  //     }
  // }); 
  // var defaultTitle = "<strong>GRAFIK JUMLAH DOKUMEN</strong>";
  // var drilldownTitle = "";
  // var chart = new Highcharts.Chart({
  //         chart: {
  //             type: 'column',
  //             renderTo: 'container',
  //             events: {
  //                 drilldown: function(e) {
  //                     chart.setTitle({ text: drilldownTitle + e.point.name });
  //                 },
  //                 drillup: function(e) {
  //                     chart.setTitle({ text: defaultTitle });
  //                 }
  //             }
  //         },
  //         title: {
  //             text: defaultTitle
  //         },
  //         credits: {
  //             enabled: false
  //         },
  //         subtitle: {
  //             text: 'S.D BULAN : <?php echo strtoupper($data['bulan']); ?> <?php echo date('Y') ?>'
  //         },
  //         xAxis: {
  //             type: 'category'
  //         },
  //         yAxis: {
  //             title: 'category'
  //         },
  //         legend: {
  //             enabled: false
  //         },

  //         plotOptions: {
  //             series: {
  //                 borderWidth: 0,
  //                 dataLabels: {
  //                     enabled: true,
  //                     format: '<span style="font-size:11px; font-family: Tahoma;">{point.y:,.0f}</span> ' 
  //                 }
  //             }
  //         },
  //         tooltip: {
  //             headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
  //             pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:,.0f} </b><br/>'
  //         },
  //         series: [{
  //             name: 'Jenis Media',
  //             colorByPoint: true,
  //             data: <?php  echo $data['graf']; ?>
  //         }],
  //         drilldown: {
  //             series: [ <?php echo $data['subgraf']; ?>]
  //         }
  //     })
});

</script>