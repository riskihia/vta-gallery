<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php global $config; echo "VTA-GALLERY"." - ".$data['title'];?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>static/images/vitechasia2.png">
  <link href="<?php echo BASE_URL ?>static/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL ?>static/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL ?>static/css/core.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL ?>static/css/components.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL ?>static/css/colors.css" rel="stylesheet" type="text/css">
  <link href="<?php echo BASE_URL ?>static/css/jquery.treegrid.css" rel="stylesheet" >
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/loaders/pace.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/loaders/blockui.min.js"></script>
  <!-- /core JS files -->

  <!--   tree -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/core.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/effects.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/interactions.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/extensions/cookie.js"></script>
  <!--   tree -->

  <!-- Theme JS files -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/editors/summernote/summernote.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/visualization/d3/d3.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/visualization/d3/d3_tooltip.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/styling/uniform.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/ui/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/pickers/daterangepicker.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/tables/datatables/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/full.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/selects/select2.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/datatables_basic.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/notifications/pnotify.min.js"></script> 
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/selects/selectboxit.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/notifications/noty.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/components_popups.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/notifications/sweet_alert.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/components_modals.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/styling/switchery.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/ui/fullcalendar/lang/ar.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/styling/switch.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/extensions/session_timeout.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jasny_bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/styling/uniform.min.js"></script> -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/autosize.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/formatter.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/typeahead/handlebars.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/passy.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/inputs/maxlength.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/uploaders/fileinput.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/media/fancybox.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/forms/validation/validate.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/trees/fancytree_all.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/trees/fancytree_childcounter.js"></script>
  <!-- <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/visualization/echarts/echarts.js"></script> -->


  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/interactions.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/widgets.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/effects.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/plugins/extensions/mousewheel.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/globalize/globalize.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/globalize/cultures/globalize.culture.de-DE.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/libraries/jquery_ui/globalize/cultures/globalize.culture.ja-JP.js"></script>


  

<!-- Config Js -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/core/app.js"></script>
  <!-- <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/charts/echarts/combinations.js"></script> -->
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/editor_summernote.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/form_layouts.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/form_controls_extended.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/form_select2.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/uploader_bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/gallery.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/datatables_extension_buttons_html5.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/form_multiselect.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/animations_css3.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/components_notifications_pnotify.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/jquery.treegrid.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/extra_session_timeout.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/wizard_form.js"></script>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/sankey.js"></script>
<script src="https://code.highcharts.com/modules/organization.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<!--   <script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/js/highcharts.js"></script>-->

<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/highcharts.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/sankey.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/organization.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/accessibility.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>static/highcharts/code/modules/drilldown.js"></script> 


  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/extra_fullcalendar_advanced.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL ?>static/js/pages/jqueryui_forms.js"></script>

  <script type="text/javascript">
    var url_session = '<?php echo BASE_URL ?>auth/logout'; 
    setInterval( function () {
        var msgurl = '<?php echo BASE_URL.'messages/'; ?>';
        document.getElementById("list-messages").innerHTML = "";
        // $.ajax({url: msgurl+'checkmsg', success: function(result){
        $.ajax({url: msgurl+'chats', success: function(result){
          var rsl = JSON.parse(result);
          if(rsl.jmlmsg.jml > 0){
             $("#jmlmsg").html(rsl.jmlmsg.jml);
             $("#jmlmsg1").html(" <i class=\"icon-bubbles9\"></i><span class=\"visible-xs-inline-block position-right\">Messages</span><span class=\"badge bg-warning-400\">"+rsl.jmlmsg.jml+"</span>");
             // rsl.aadata.forEach(addlist);
             rsl.aadata.forEach(addchat);
          } else {
          	 $("#jmlmsg1").html("");	
          }
          }});

    }, 3000 );

    $(document).ready(function() {
        $('#btnstahun').click(function(){
        var t = $("#tahunaudit").val() ;
        $.ajax({
            url: "<?php echo BASE_URL.'main/setyear'; ?>",
            data: { "stahun": t},
            dataType:"json",
            type: "post",
            success: function(data){
               swal({
                  title:"Berhasil!",
                  text: "Tahun audit berhasil diubah ke "+t+".",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 10000
              });
               document.getElementById("tahunshow").innerHTML = t;
            }
        });
    });
    });

    

    function addlist(item, index) {
      document.getElementById("list-messages").innerHTML += "<li class=\"media\"><div class=\"media-left\"><img src=\"<?php echo BASE_URL;?>static/images/users.jpg\" class=\"img-circle img-sm\" alt=\"\"></div><div class=\"media-body\"><a href=\"<?php echo BASE_URL."messages";?>\" class=\"media-heading\"><span class=\"text-semibold\">"+item.nama_lengkap+"</span><span class=\"media-annotation pull-right\">"+item.tanggal+"</span></a> <span class=\"text-muted\">"+item.keperluan+"</span></div></li>";
    }

    function addchat(item, index) {
      document.getElementById("list-messages").innerHTML += "<li class=\"media\"><div class=\"media-left\"><img src=\"<?php echo BASE_URL;?>chatsystem/storage/user_image/"+item.picname+"\" class=\"img-circle img-sm\" alt=\"\"><span class=\"badge bg-danger-400 media-badge\">"+item.jml+"</span></div><div class=\"media-body\"><a href=\"<?php echo BASE_URL."chat";?>\" class=\"media-heading\"><span class=\"text-semibold\">"+item.user_fullname+"</span><span class=\"media-annotation pull-right\">"+item.message_date+"</span></a> <span class=\"text-muted\">"+item.message_content+"</span></div></li>";
    }

</script>
</head>
<?php $mn = new Model(); $data['photo']= $mn->getphotos(); // $year = $mn->get_tahunaudit(); ?>
<body class="navbar-top">
  <!-- Main navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo BASE_URL ?>"><i class="icon-shutter text-slate-400 text-teal"></i>&nbsp;<span class="text-white text-size-lg"> <?php echo $config['app_name'] ?></span></a>

      <ul class="nav navbar-nav pull-right visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
      </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
      <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3 text-slate"></i></a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="jmlmsg1"></a>
          
          <div class="dropdown-menu dropdown-content width-350">
            <div class="dropdown-content-heading">
              Chat messages
              <ul class="icons-list">
                <li><a href="<?php echo BASE_URL."chat" ?>"><i class="icon-bubble-lines3"></i></a></li>
              </ul>
            </div>

            <ul class="media-list dropdown-content-body" id="list-messages"></ul>

            <div class="dropdown-content-footer">
              <a href="<?php echo BASE_URL."chat" ?>" data-popup="tooltip" title="" data-original-title="All messages"><i class="icon-menu display-block"></i></a>
            </div>
          </div>
        </li>
        <li class="dropdown dropdown-user">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($data['photo'][0][0]); ?>" class="img-circle"  alt="">&nbsp;&nbsp;<?php echo $_SESSION['userfullname']." " ?></span>  <i class="caret"> </i>
          </a>

          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="<?php echo BASE_URL."users_profil"; ?>"><i class="icon-user-plus"></i> My profile</a></li>
            <li><a href="<?php echo BASE_URL."messages"; ?>"><span class="badge badge-warning pull-right"><div id="jmlmsg">0</div></span> <i class="icon-comment-discussion"></i> Messages</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo BASE_URL; ?>auth/logout"><i class="icon-switch2"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /main navbar -->
  <!-- Page container -->
  <div class="page-container">
    <!-- Page content -->
    <div class="page-content">

      <!-- Main sidebar -->
      <div class="sidebar sidebar-main">
        <div class="sidebar-content">

          <div class="sidebar-user">
            <div class="category-content">
              <div class="media">
                <a href="#" class="media-left"><img src="<?php echo BASE_URL ?>static/images/vitechasia.png" class="img-ad img-thumbnail" alt=""></a>
                <div class="media-body">
                  <span class="media-heading text-semibold text-warning-400"><?php echo $config['divi_name'] ?></span>
                  <div class="text-size-mini text-muted"><?php echo $config['dept_name'] ?></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Main navigation -->
          <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                <?php                  

                    $parts = explode('/', $_SERVER['REQUEST_URI']);

                    $active = $parts[2];

                    $result = $mn->show_menu($_SESSION['groupid'], $active);
                    
                    while ($row = $mn->fetch_object($result)) {

                        $data[$row->parent_id][] = $row;
                    
                    }
                    
                    $menu = $mn->get_menu($data);
                    
                    echo $menu;

                 ?>
               </ul>
            </div>
          </div>
          <!-- /main navigation -->
          

        </div>
      </div>
      <!-- /main sidebar -->

      <!-- Main content -->
      <div class="content-wrapper">
