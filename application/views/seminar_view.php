<?php include('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title']; ?></h4>
                  </div>
                </div>
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>/"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo $data['curl'] ?>/"><?php echo $data['breadcrumb1']; ?></a></li>
                    <li class="active"><?php echo $data['title']; ?></li>
                  </ul>
                </div>
              </div>
              <!-- /page header -->

              <!-- Content area -->
              <div class="content">
                <!-- Basic datatable -->
                  <div class="panel panel-flat">
                    <div class="panel-heading">
                      <h5 class="panel-title"><i class="icon-calendar2 position-left"></i> <strong>Seminar </strong> <?php echo "dan Pelatihan"; ?></h5>
                      <div class="heading-elements">
                        <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body">
             <!--  <p class="content-group">Add extended dragging functionality with <code>droppable</code> option. Data can be attached to the element in order to specify its duration when dropped. A Duration-ish value can be provided. This can either be done via jQuery or via an <code>data-duration</code> attribute. Please note: since droppable option operates with jQuery UI draggables, you must download the appropriate jQuery UI files and initialize a draggable element.</p>
 -->
              <div class="row">
                <div class="col-md-2">
                  <div class="content-group" id="external-events">
                    <!-- <h6>Pindahkan kegiatan dibawah ini</h6> -->
                    <div class="fc-events-container content-group">
                      <div class="fc-event" data-color="#546E7A">Rapat koordinasi</div>
                      <div class="fc-event" data-color="#26A69A">Bimtek</div>
                      <div class="fc-event" data-color="#546E7A">Acara penyambutan</div>
                      <div class="fc-event" data-color="#FF7043">Sertijab</div>
                      <div class="fc-event" data-color="#5C6BC0">Upacara Kenaikan Pangkat</div>
                      <div class="fc-event">Rapat pimpinan</div>
                      <div class="fc-event">Lain-lain</div>
                    </div>

                    <div class="checkbox checkbox-right checkbox-switchery switchery-xs text-center">
                      <label>
                        <input type="checkbox" class="switch" checked="checked" id="drop-remove">
                        Hapus setelah dipindah
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-10">
                  <div class="fullcalendar-external"></div>
                </div>
              </div>
            </div>
                  </div>
                  <!-- /basic datatable -->      
<?php include('footer.php'); ?>