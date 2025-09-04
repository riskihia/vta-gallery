<?php include('header.php'); ?>

              <!-- Page header -->

              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Hasil </span>pencarian</h4>
                  </div>
                </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Form Pengajuan Download</li>

                  </ul>
                </div>
              </div>
              <!-- /page header -->


              <!-- Content area -->
              <div class="content">
                <div class="panel panel-white">
                      <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-magazine"></i> &nbsp;<strong>Form</strong> Kebutuhan Dokumen </h6>
                        
                      <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                      <div class="panel-body no-padding-bottom">
                        <div class="row">
                          
                          <!-- Wizard with validation -->
                          <div class="panel panel-white">          
                              <form class="form-validation" action="<?php echo $data['curl']."/savedownload/".$data['encode']; ?>" method="post">
                                <fieldset class="step" id="validation-step1">
                                  <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">1</span>
                                    Personel info
                                    <small class="display-block">Masukkan data personel untuk mendownload file ini.</small>
                                  </h6>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Nama Lengkap: <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control required" placeholder="Nama lengkap">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Pangkat: <span class="text-danger">*</span></label>
                                        <select  class="select required" data-placeholder="Pilih pangkat" name="pangkat" >
                                          <option></option>
                                            <?php
                                              $jp = count($data['pangkat']);
                                              for ($i=0; $i < $jp; $i++) { 
                                                $jk = count($data['pangkat'][$i]['pangkat']);
                                                echo "<optgroup class=\"bg-teal\" label=\"".$data['pangkat'][$i]['milpnsval']."\">";
                                                  for ($n=0; $n < $jk; $n++) { 
                                                    echo "<option class=\"text-size-mini\" value=\"".$data['pangkat'][$i]['pangkat'][$n]['kd_pangkat']."\">".$data['pangkat'][$i]['pangkat'][$n]['nm_pangkat']."</option>"."\n";
                                                  }
                                                echo "</optgroup>"."\n";
                                              }
                                            ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>NRP: <span class="text-danger">*</span></label>
                                        <input type="text" name="nrp" class="form-control required" placeholder="NRP">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Jabatan: <span class="text-danger">*</span></label>
                                        <input type="text" name="jabatan" class="form-control required" placeholder="Jabatan">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Handphone:<span class="text-danger">*</span></label>
                                        <input type="text" name="telp" class="form-control required" placeholder="+62-999-9999-9999" data-mask="+62-999-9999-9999">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <label>Korps:<span class="text-danger">*</span></label>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <select data-placeholder="Pilih korps" class="select required"  name="korps" >
                                            <option></option>
                                                <?php foreach ($data['korps'] as $key => $korps) { echo "<option value=\"".$korps[0]."\">".$korps[1]."</option>"."\n";} ?>
                                            </select>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Keperluan: <span class="text-danger">*</span></label>
                                        <textarea rows="5" cols="5" class="form-control required" placeholder="" name="keperluan"></textarea>
                                        <span class="text-size-mini text-warning-300"><em>* Tulis keperluan penggunaan dokumen ini.</em></span>
                                      </div>
                                    </div> 
                                  </div>
                                </fieldset>

                                <fieldset class="step" id="validation-step2">
                                  <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">2</span>
                                    Pilih Judul Dokumen
                                    <small class="display-block">Pilih judul dokumen dari file yang dibutuhkan.</small>
                                  </h6>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <table class="table datatable">

                                        <thead>

                                          <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama kegiatan</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Selesai</th>
                                            <th class="text-center">Dokumen</th>
                                            <th class="text-center">Operator</th>
                                            <th class="text-center">Pilih</th>
                                          </tr>

                                        </thead>

                                      </table>
                                      </div>
                                    </div>
                                    
                                  </div> 
                                    
                                </fieldset>

                                <fieldset class="step" id="validation-step3">
                                  <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">3</span>
                                    Choose file
                                    <small class="display-block">Pilih file yang dibutuhkan.</small>
                                  </h6>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <table class="table datatablepilih table-striped media-library table-lg">
                                          <thead>
                                              <tr>
                                                  <th class=""><!-- <input type="checkbox" name="checkAll" id="checkAll" class="styled"> --></th>
                                                  <th class="text-bold text-teal">Preview</th>
                                                  <th class="text-bold text-teal">File Name</th>
                                                  <th class="text-bold text-teal">File info</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                            <?php foreach ($data['attch'] as $key => $file) { 
                                            $nama_file =  explode(".", $file['nama_file']); 
                                            $tipes = explode('/', $file['tipe_file']); 
                                            $filename = BASE_URL."static/files/bahan/".$file['dir']."/".$file['subdir']."/".$file['nama_file'];
                                            $chs = curl_init($filename);
                                            curl_setopt($chs, CURLOPT_NOBODY, true);
                                            curl_exec($chs);
                                            $responseCodes = curl_getinfo($chs, CURLINFO_HTTP_CODE);
                                            curl_close($chs);

                                            if($responseCodes == 200){
                                                $fileattch = $filename;
                                            }else{
                                                $fileattch = BASE_URL."static/images/placeholder.jpg";
                                            }
                                            

                                            ?>
                                              
                                              <tr>
                                                <td><input type="checkbox" name="chkfile[]" value="<?php echo $file['autono'] ?>" class="styled"></td>
                                                <td>
                                                  <a href="<?php echo $fileattch; ?>" data-popup="lightbox">

                                                    <?php if($tipes[0] == 'video') {
                                                      echo '<video width="190" controls controlsList="nodownload"><source src="'.$fileattch.'" type="video/mp4" ></video>';
                                                    } else {
                                                      echo '<img src="'.$fileattch.'" alt="" class="img-rounded img-preview">';
                                                    }
                                                    ?>
                                                    
                                                  </a>
                                                </td>
                                                <td><a href="#"><?php echo $nama_file[0]; ?></a></td>
                                                <td>
                                                  <ul class="list-condensed list-unstyled no-margin">                                     
                                                    <li><span class="text-semibold">Size:</span> <code><?php echo number_format($file['ukuran']/1024). ' KB'; ?></code></li>
                                                    <li><span class="text-semibold">Format:</span> <code><?php echo $file['tipe_file']; ?></code></li>
                                                  </ul>
                                                </td>
                                              </tr>
                                             <?php  } ?>                        
                                              
                                          </tbody>
                                      </table>
                                      </div>
                                    </div>
                                    
                                  </div> 
                                    
                                </fieldset>

                                <div class="form-wizard-actions text-right" style="padding: 20px;">
                                  <button type="reset" id="validation-back" class="btn btn-default"><i class="icon-circle-left2 position-left"></i> Back</button>
                                  <button type="submit" id="validation-next" class="btn bg-teal">Next <i class="icon-circle-right2 position-right"></i></button>
                                </div>
                              </form>
                          </div>
                          <!-- /wizard with validation -->


                        </div>
                       
                        
                  </div>
                </div>

                      <div class="panel-body">
                        <div class="row invoice-payment">

                        </div>
                        <h6></h6>
                        <p class="text-muted text-size-mini"><img src="<?php echo BASE_URL.'static/images/logo.png'; ?>" height="24px" alt="Dispen"> &nbsp; Copyright @2021 - <strong>Dinas Kesejarahan Angkatan Darat</strong> </p>
                      </div>
                    </div>
<input type="hidden" name="idsimpan" id="idsimpan">
              

<!-- Info modal -->
      <div id="modal_form" class="modal fade">
        <div class="modal-dialog modal-full">
          <div class="modal-content">
            <div class="modal-header bg-teal">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h6 class="modal-title"><i class="icon-image3" title="Dokumen images"></i>&nbsp; Photos</h6>
            </div>

            <div class="modal-body">
              <div class="form-group">
                  <button type="submit" class="btn bg-purple-400 text-right" disabled="disabled" id="submit"><i class=" icon-file-download2 position-left"></i>Download Selected </button>
              </div>
              <form action="#" method="post" id="fileform">
              <table class="table table-striped" id="datafile1">
                  <thead>
                    <tr>
                      <th class="text-bold"><input type="checkbox" id="checkAll" class="control-success"></th>
                      <th class="text-bold">Preview</th>
                      <th class="text-bold">Nama File</th>
                      <th class="text-bold">Tipe</th>
                      <th class="text-bold">Ukuran</th>
                      <th class="text-bold">Uploadby</th>
                      <th class="text-bold text-center">Actions</th>
                    </tr>
                  </thead>
                </table>
              </form>
          </div>
        </div>
      </div>
  </div>
      <!-- /info modal -->       

              <!-- Content -->   

<?php include('footer.php'); ?>
<script type="text/javascript">
  var url = '<?php echo $data['curl'] ?>/';
  var url_file = '<?php echo BASE_URL; ?>static/files/';

$(document).ready(function(){
   $("#checkAll").click(function(){
       $("#chkfile").find(":checkbox").attr("checked",this.checked);
   });
})

function saveselect(i){
    $("#idsimpan").val(i);
    $("#btnsimpan").attr('disabled', false);
  }

  function showdoc(a, b, c){
        // Show file
     $('#datafile'+a).DataTable({
          "destroy": true,
          "processing": true,
          "serverSide": true,
          "paging": true,
          "searching": true,
          "info": true,
          "order": [3],
          "ajax": {
              "url": url+'getfile/'+b+'/'+c,
              "type": "POST"
          },
          
          "columns": [
              {
                  "data": 0,
                  "width": 50,
                  "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       return '<input type="checkbox" class="chk" name="files[]" onClick="countChecked()" value="' + row[0] + '">';
                   }
              },
              {
                "data": null,
                "width": 150,
                "sortable": false,
                "className": "center",
                "render": function ( data, type, row, meta ) {
                     var id = btoa(row[0]);
                     var v = row[2].split('/');

                      if(row[8] == 0){
                        var file = url_file+'dokumen/'+row[5]+'/'+row[6]+'/'+row[1];
                      } else {
                        var file = url_file+row[9]+'/'+row[6]+'/'+row[1];
                      }
                     
                     if(v[0] == "video"){
                        return '<video width="220" controls><source src="'+file+'" type="'+row[2]+'"></video>';
                     } else if (v[0] == "image") {
                        return '<a href="'+file+'" target="_blank" data-popup="lightbox" rel="gallery"> <img src="'+file+'" alt="" class="img-rounded img-preview"></a>';
                     } else {
                        return '<a href="static/images/check-file-type.png" target="_blank" data-popup="lightbox" rel="gallery"> <img src="static/images/check-file-type.png" alt="" class="img-rounded img-preview"></a>';
                     }
                     
                 }
              },
              {
                  "data": 1,
                  "width": 'auto',
                  "className": "text-nowrap",
                  "render": function ( data, type, row, meta ) {
                       return '<strong>'+row[1]+'</strong> ';
                   }
              },
              {"data": 2,width:140},
              {
                  "data": 3,
                  "width": 140,
                  "className": "text-center text-nowrap",
                  "render": function ( data, type, row, meta ) {
                       return '<code>'+row[3]+'</code> ';
                   }
              },
              {"data": 7,width:140},
              {
                  "data": null,
                  "width": 50,
                  "visible": false,
                  "sortable": false,
                  "className": "text-center",
                  "render": function ( data, type, row, meta ) {
                       var id = btoa(row[0]);
                       return '<a href="#" onClick="delete_file('+a+",'"+row[0]+"'"+')" class="btn-sx red" title="Delete file"><i class="icon-cancel-square2"></i></a> ';
                      
                   }
              }
              
          ]
      });
}

$(function() {

  $('.datatable').DataTable({

        "processing": true,

        "serverSide": true, 

        "order": [],

        "ajax": {

            "url": url+'get/',

            "type": "POST"

        },

        "columns": [
            {
                "data": null,
                "width": 30,
                "sortable": false,
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data": 1,width:'auto'},
            {"data": 5,width: 200, className: 'center'},
            { 
                "data": 7,
                "width": 50,
                "sortable": true,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[7] == 'on' ){
                        return "<i class=\"icon-check green\"></i>";
                       } else {
                          return '';
                       }  
                   }
            },
            { 
                "data": null,
                "width": 50,
                "sortable": false,
                  "className": "center",
                  "render": function ( data, type, row, meta ) {
                       if(row[4] == 1 ){
                        return "<a href=\"#\" onClick=\"showdoc(1,'"+row[0]+"','"+row[3]+"')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_form\" title=\"View Dokumen\"><i class=\"icon-images2 grey\"></i></a> ";
                          
                       } else {
                          return '';
                       }  
                   }
            },
            {"data": 8,width:'auto'},
            {

                "data": null,

                "width": 50,

                "sortable": false,

                "className": "center",

                "render": function ( data, type, row, meta ) {

                     return '<input type="radio" class="switch" name="pilihberita" onclick="saveselect('+"'"+row[0]+"'"+')"  data-on-text="On" data-off-text="Off" data-on-color="success" data-off-color="default">';

                 }

            } 
        ]

    });

  });
</script>