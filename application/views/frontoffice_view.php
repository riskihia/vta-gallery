<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Front Office - Dashboard</title>

<!-- Global stylesheets -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/dispenad.png">
<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL ?>static/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL ?>static/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL ?>static/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL ?>static/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL ?>static/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/ui/nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/ui/drilldown.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<!-- <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/visualization/echarts/echarts.js"></script> -->

<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/app.js"></script>
<!-- <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/charts/echarts/columns_waterfalls.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/js/charts/echarts/timeline_option.js"></script> -->
<!-- /theme JS files -->

<!-- Highcharts -->
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/highcharts.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/data.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/drilldown.js"></script>
<!-- <script type="text/javascript" src="<?php // echo BASE_URL ?>static/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="<?php // echo BASE_URL ?>static/highcharts/modules/export-data.js"></script>
<script type="text/javascript" src="<?php // echo BASE_URL ?>static/highcharts/modules/accessibility.js"></script> -->
<!-- 
<script src="lib/highcharts/js/highcharts.js"></script>
<script src="lib/highcharts/js/modules/data.js"></script>
<script src="lib/highcharts/js/modules/drilldown.js"></script> -->
<!-- /highcharts -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"> <img src="<?php echo BASE_URL ?>static/images/logo_head.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
				</li>

				<li class="dropdown dropdown-user">
		          <a class="dropdown-toggle" data-toggle="dropdown">
		            <img src="<?php echo BASE_URL ?>static/images/users.jpg" class="img-circle" alt=""> <?php echo $_SESSION['username']." " ?></span>  <i class="caret"> </i>
		            <!-- <img src="data:image/jpeg;base64,<?php echo base64_encode($data['photo'][0][0]); ?>" class="img-circle"  alt="">  -->
		          </a>

		          <ul class="dropdown-menu dropdown-menu-right">
		            <li><a href="<?php echo BASE_URL."users_profil"; ?>"><i class="icon-user-plus"></i> My profile</a></li>
		           
		            <li class="divider"></li>
		            <li><a href="<?php echo BASE_URL ?>auth/logout"><i class="icon-switch2"></i> Logout</a></li>
		          </ul>
		        </li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<li  class="dropdown mega-menu mega-menu-wide active"><a href="<?php echo BASE_URL."frontoffice/dashboard"; ?>"><i class="icon-display4 position-left"></i> Dashboard</a></li>

		<!-- 		<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/gallery_foto"; ?>"><i class="icon-images2 position-left"></i> Gallery Foto </a>
				</li>

				<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/gallery_video"; ?>"><i class="icon-clapboard-play position-left"></i> Gallery Video </a>
				</li> -->

				<li class="dropdown mega-menu mega-menu-wide">
					<a href="<?php echo BASE_URL."frontoffice/pencarian"; ?>"><i class="icon-search4 position-left"></i> Pencarian dan Download </a>
				</li>

				
			</ul>
		</div>
	</div>
	<!-- /second navbar -->


	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-chart position-left"></i> <span class="text-semibold">Dashboard</span></h4>
				<ul class="breadcrumb breadcrumb-caret position-right">
					<li><a href="">Home</a></li>
					<li><a href="">Gallery</a></li>
					<li class="active">Dashboard</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Basic column chart -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Grafik Penginputan Data</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
<!-- 		                		<li><a data-action="reload"></a></li> -->
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<div class="panel-body">
						<div class="chart-container">
						<!--	<div class="chart has-fixed-height" id="temuan_post"></div> -->
                        	<div class="chart" style="height: 60vh" id="container"></div>
						</div>
					</div>
				</div>
				<!-- /basic column chart -->

				<!-- <div id="temuan_post"></div>
				<div id="temuan_current"></div>
				<div id="temuan_anggaran"></div> -->

				<!-- Grafik -->




				<!-- end Grafik -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->


		<!-- Footer -->
		<div class="footer text-muted">
			<img src="static/images/favicons.png" alt="Dispen"> &copy; 2020 <a href="https://tniad.mil.id/" target="_blank">- Dinas Penerangan Angkatan Darat</a>
		</div>
		<!-- /footer -->

	</div>
	<!-- /page container -->

</body>
</html>

<script type="text/javascript">
  var url  = 'http://eaudit.satudata.id/main/';
  var year = '2020';
  var backend_url     = 'http://eaudit.satudata.id/';

  var nomor_pkpt = "PKPT-"+ year;

  var pkpt2 = year + 1;  

// $(function() {
//         $(this).bind("contextmenu", function(e) {
//             e.preventDefault();
//         });
//     }); 

$(function () {   
Highcharts.setOptions({
    lang: {
        thousandsSep: '.'
    }
}); 
var defaultTitle = "GRAFIK JUMLAH DATA VIDEO DAN FOTO";
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


