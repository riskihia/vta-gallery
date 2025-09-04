<?php include('header.php'); ?>

              <!-- Page header -->

              <div class="page-header">

                <div class="page-header-content">

                  <div class="page-title">

                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title'] ?></h4>

                  </div>

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

                      <h5 class="panel-title"><strong><?php echo $data['action'] ?></strong> <?php echo $data['title'] ?></h5>

                      <div class="heading-elements">

                        <ul class="icons-list">

                          <li><a data-action="collapse"></a></li>

                          <li><a data-action="reload"></a></li>

                          <li><a data-action="close"></a></li>

                        </ul>

                      </div>

                    </div>

                    <div class="panel-body">

                      <form class="form-horizontal" action="<?php echo $data['curl']."/save/".$data['encode']; ?>" method="post" enctype="multipart/form-data">

                        <fieldset class="content-group">

						              <div class="form-group">
                            <label class="control-label col-lg-2">Nama kegiatan</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="nama_kegiatan" required>
                             <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Klasifikasi Video/Foto</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih Klasifikasi" class="select"  name="kategori_video" required="required"><i class="icon-arrow-left52 position-left"></i>
                                  <option></option>
                                  <?php foreach ($data['kategori_video'] as $key => $klas) { echo "<option value=\"".$klas[0]."\">".$klas[1]."</option>"."\n";} ?>
                              </select>
                              <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Jenis Media</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih media" class="select"  name="jenis_media" required="required"><i class="icon-arrow-left52 position-left"></i>
                                  <option></option>
                                  <?php foreach ($data['media'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                              <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Kategori kegiatan</label>
                            <div class="col-lg-10">
                              <select  class="select" data-placeholder="Pilih kategori" multiple="multiple" name="kategori[]" >
                                  <?php foreach ($data['kategori'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Provinsi / Kota</label>
                            <div class="col-lg-10">
                              <select  class="select" data-placeholder="Pilih provinsi / kota" multiple="multiple" name="provinsi[]" >
                                  <?php
                                    $jp = count($data['provinsi']);
                                    for ($i=0; $i < $jp; $i++) { 
                                      $jk = count($data['provinsi'][$i]['kabupaten']);
                                      echo "<optgroup label=\"".$data['provinsi'][$i]['provinsi']."\">";
                                        for ($n=0; $n < $jk; $n++) { 
                                          echo "<option value=\"".$data['provinsi'][$i]['kabupaten'][$n]['kode']."\">".ucfirst($data['provinsi'][$i]['kabupaten'][$n]['kabupaten'])."</option>"."\n";
                                        }
                                      echo "</optgroup>"."\n";
                                    }
                                  ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Lokasi</label>
                            <div class="col-lg-10">
                             <input type="text" placeholder="Masukkan nama lokasi kegiatan" class="form-control" name="lokasi">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Kondisi Media</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih kondisi media" class="select"  name="kondisi_media" >
                                  <option></option>
                                  <?php foreach ($data['kondisi'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">No Card Memory</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="no_card">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Pejabat</label>
                            <div class="col-lg-10">
                             <select  class="select" data-placeholder="Pilih pejabat" multiple="multiple"   name="personel[]" >
                                  <?php foreach ($data['personel'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Kotama / satker</label>
                            <div class="col-lg-10">
                             <select  class="select" data-placeholder="Pilih kotama / satker" multiple="multiple"   name="kotama_satker[]" >
                                  <?php foreach ($data['satker'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Tanggal</label>
                            <div class="col-lg-6">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                <input type="date" class="form-control" name="tanggal" value="" >
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Fotografer</label>
                            <div class="col-lg-10">
                             <select  class="select" data-placeholder="Pilih fotografer" multiple="multiple"   name="fotografer[]" >
                                  <?php foreach ($data['fotografer'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="form-group">
                            <label class="control-label col-lg-2">Fotografer / Videografer</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="fotografer">
                            </div>
                          </div> -->
                          <div class="form-group">
                            <label class="control-label col-lg-2">Jenis Kamera</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih jenis kamera" class="select"  name="kamera" >
                                  <option></option>
                                  <?php foreach ($data['kamera'] as $key => $cam) { echo "<option value=\"".$cam[0]."\">".$cam[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Narasi</label>
                            <div class="col-lg-10">
                             <textarea class="summernote" name="narasi"></textarea>
                            </div>
                          </div>
                                                
                          <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="keterangan"></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">File Dokumen</label>
                            <div class="col-lg-10">
                              <input type="file" class="file-input" multiple="multiple" name="file_dokumen[]" required="required" data-show-upload="false" data-show-caption="true" data-show-preview="false" accept="video/mpg, video/mpeg, video/mp4, video/avi">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Selesai</label>
                            <div class="col-lg-10 checkbox checkbox-switchery">
                                <input type="checkbox" class="switchery" data-switchery="true" name="complete"> 
                             </div>
                          </div>

                        </fieldset>

                        <div class="text-right">

                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 

                          <button type="submit" class="btn btn-primary" id="btn-proses">Submit <i class="icon-circle-right2 position-right"></i></button>

                        </div>

                      </form>

                    </div>

          

<?php include('footer.php'); ?>
<script type="text/javascript">
$(function() {

    $('#btn-proses').on('click', function() {

        $.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i><span class="help-block text-grey-300">Silahkan tunggu, data sedang di upload...</span>',
            timeout: 360000000,
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
       
    });
});
</script>