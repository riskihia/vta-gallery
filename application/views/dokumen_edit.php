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

                      <h5 class="panel-title"><i class="icon-file-picture position-left"></i><strong><?php echo $data['action'] ?></strong> Data</h5>

                      <div class="heading-elements">

                        <ul class="icons-list">

                          <li><a data-action="collapse"></a></li>

                          <li><a data-action="reload"></a></li>

                          <li><a data-action="close"></a></li>

                        </ul>

                      </div>

                    </div>

                    <div class="panel-body">

                      <form class="form-horizontal" action="<?php echo $data['curl']."/update/".$data['encode']."/".$data['child']; ?>" method="post" enctype="multipart/form-data">

                        <fieldset class="content-group">

                          <?php foreach ($data['aadata'] as $key => $val) { ?>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Project</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih Project" class="select"  name="project" required="required">
                                  <option></option>
                                  <?php var_dump($data['project']); foreach ($data['project'] as $key => $project) { echo "<option value=\"".$project[0]."\" ".$project[2].">".$project[1]."</option>"."\n";} ?>
                              </select>
                              <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama kegiatan</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="nama_kegiatan" value="<?php echo $val['nama_kegiatan'] ?>" required>
                             <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Jenis Media</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih Media" class="select"  name="jenis_media" required="required">
                                  <option></option>
                                  <?php var_dump($data['media']); foreach ($data['media'] as $key => $media) { echo "<option value=\"".$media[0]."\" ".$media[2].">".$media[1]."</option>"."\n";} ?>
                              </select>
                              <span class="help-block red"><code>* Wajib diisi</code></span>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Team</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih Team" class="select"  multiple="multiple" name="team[]" >
                                  <option></option>
                                  <?php foreach ($data['team'] as $key => $team) { echo "<option value=\"".$team[0]."\" ".$team[2].">".$team[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Kategori kegiatan</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih kategori" class="select"  multiple="multiple" name="kategori[]" >
                                  <option></option>
                                  <?php foreach ($data['kategori'] as $key => $category) { echo "<option value=\"".$category[0]."\" ".$category[2].">".$category[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">Lokasi</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="lokasi" value="<?php echo $val['lokasi'] ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Kondisi Media</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih kondisi media" class="select"  name="kondisi_media" >
                                  <option></option>
                                  <?php foreach ($data['kondisi'] as $key => $value) { echo "<option value=\"".$value[0]."\" ".$value[2].">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="form-group">
                            <label class="control-label col-lg-2">No Card Memory</label>
                            <div class="col-lg-10">
                             <input type="text" class="form-control" name="no_card" value="<?php echo $val['no_card'] ?>">
                            </div>
                          </div> -->
                          <div class="form-group">
                            <label class="control-label col-lg-2">Pejabat</label>
                            <div class="col-lg-10">
                             <select data-placeholder="Pilih Pejabat" class="select" multiple="multiple"  name="personel[]" >
                                  <option></option>
                                  <?php foreach ($data['personel'] as $key => $pers) { echo "<option value=\"".$pers[0]."\" ".$pers[2].">".$pers[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div><div class="form-group">
                            <label class="control-label col-lg-2">Kotama / satker</label>
                            <div class="col-lg-10">
                             <select data-placeholder="Pilih Satker" class="select" multiple="multiple" name="kotama_satker[]">
                                  <option></option>
                                  <?php foreach ($data['kotama_satker'] as $key => $value) { echo "<option value=\"".$value[0]."\" ".$value[2].">".$value[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-lg-2">Tanggal</label>
                              <div class="col-lg-6">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                  <input type="date" class="form-control" name="tanggal" value="<?php echo $val['tanggal'] ?>" >
                                </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-lg-2">Fotografer</label>
                            <div class="col-lg-10">
                             <select  class="select" data-placeholder="Pilih fotografer" multiple="multiple" name="fotografer[]">
                                  <?php foreach ($data['fotografer'] as $key => $fot) { echo "<option value=\"".$fot[0]."\" ".$fot[2].">".$fot[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div>
                          <!-- <div class="form-group">
                            <label class="control-label col-lg-2">Jenis Kamera</label>
                            <div class="col-lg-10">
                              <select data-placeholder="Pilih jenis kamera" class="select"  name="kamera" >
                                  <option></option>
                                  <?php foreach ($data['kamera'] as $key => $cam) { echo "<option value=\"".$cam[0]."\" ".$cam[2].">".$cam[1]."</option>"."\n";} ?>
                              </select>
                            </div>
                          </div> -->
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Narasi</label>
                            <div class="col-lg-10">
                             <textarea class="summernote" name="narasi"><?php echo $val['narasi'] ?></textarea>
                            </div>
                          </div> 

                          <div class="form-group">
                            <label class="control-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                             <textarea rows="5" cols="5" class="form-control" placeholder="" name="keterangan"><?php echo $val['keterangan'] ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-lg-2">File Dokumen</label>
                            <div class="col-lg-10">
                              <input type="file" class="file-input" multiple="multiple" name="file_dokumen[]" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept="image/jpg, image/jpeg, image/png, video/mp4">
                            </div>
                          </div> 

                          <div class="form-group">

                            <label class="control-label col-lg-2"></label>

                            <?php foreach ($data['attch'] as $key => $attch) { ?>

                             <div class="col-lg-2 col-sm-6">
                                <div class="thumbnail">
                                  <div class="thumb">

                                    <?php 
                                      $tipe = explode('/', $attch['tipe_file']);  

                                      if($attch['structured'] == 0){
                                        $remoteFile = BASE_URL."static/files/bahan/".$attch['dir']."/".$attch['kode_parent']."/".$attch['subdir']."/".$attch['nama_file'];
                                      } else {
                                        $remoteFile = BASE_URL."static/files/bahan/".$attch['dir']."/".$attch['subdir']."/".$attch['nama_file'];
                                      }

                                      if($remoteFile){
                                          $fileshow = $remoteFile;
                                      }else{
                                          $fileshow = BASE_URL."static/images/placeholder.jpg";
                                      }

                                      if($tipe[0] == 'video'){
                                        //echo '<video width="220" controls><source src="'.$fileshow.'" type="mp4"></video>'; 
                                        echo '<img src="'.BASE_URL."static/images/placeholder.jpg".'" class=\"col-lg-2 col-sm-6\" heigth=\"100px\" alt="">'; 
                                      } else {
                                        echo '<img src="'.$fileshow.'" class=\"col-lg-2 col-sm-6\" heigth=\"100px\" alt="">'; 
                                      }

                                      

                                    ?>

                                    <div class="caption-overflow">
                                      <span>
                                        <?php 
                                        if($tipe['0']== 'video'){
                                          echo '<a href="'.$fileshow.'" data-popup="lightbox" target="_blank" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-zoomin3"></i></a>';  
                                        }  else { 
                                          echo '<a href="'.$fileshow.'" data-popup="lightbox" rel="gallery" target="_blank" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-zoomin3"></i></a>';  
                                        }  
                                        ?>
                                        <a href="#" onClick="delete_filexx(1, '<?php echo $attch['autono'] ?>')" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 red" title="Delete file"><i class="icon-trash"></i></a>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <?php } ?>
                            
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label col-lg-2">Selesai</label>
                            <div class="col-lg-10 checkbox checkbox-switchery">
                                <input type="checkbox" class="switchery" data-switchery="true" name="complete" <?php if($val['complete'] == 'on') { echo 'checked="checked"'; }  ?>> 
                             </div>
                          </div>        

                         <?php } ?>

                        </fieldset>

                        <div class="text-right">

                           <a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 

                          <button type="submit" class="btn btn-primary" id="btn-proses">Submit <i class="icon-circle-right2 position-right"></i></button>

                        </div>

                      </form>

                    </div>

          

<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/bahan/dokumen/';

  function delete_filexx(a, b) {
  swal({
      title:"Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#EF5350",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: true
  },
  function(isConfirm){
      if (isConfirm) {
        $.post(url+'deletefile/'+ btoa(b), function(data, status){
          $('#datafile'+a).DataTable().ajax.reload();
          $('.datatable').DataTable().ajax.reload(null, false);

            if(status == 'success'){
               swal({
                  title:"Deleted!",
                  text: "Your data has been deleted.",
                  confirmButtonColor: "#66BB6A",
                  type: "success",
                  timer: 2000
              });

              location.reload();
            }
        });

      }
  });
}

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