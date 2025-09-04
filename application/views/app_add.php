<?php  include_once('header.php'); ?>
              <!-- Page header -->
              <div class="page-header">
                <div class="page-header-content">
                  <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1'] ?></span> - <?php echo $data['title'] ?></h4>
                  </div>
                  <?php // include('statistic.php'); ?>
                  </div>

                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="<?php echo BASE_URL ?>apps/create_app"><?php echo $data['breadcrumb1'] ?></a></li>
                    <li class="active"><?php echo $data['title'] ?></li>
                  </ul>

                </div>
              </div>
              <!-- /page header -->

              <div class="content">


              <!-- Wizard with validation -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-circle-code position-left"></i> Create App </h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <form class="stepy-validation" action="<?php echo $data['curl'] ?>save" method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">Application detail</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Application Name: <span class="text-danger">*</span></label>
                                            <input type="text" name="app_name" placeholder="Application name" class="form-control required">
                                        </div>

                                        <div class="form-group">
                                            <label>Select project: <span class="text-danger">*</span></label>
                                            <select name="project" data-placeholder="Select project" class="select required" required>
                                                <option></option>
                                            <?php foreach ($data['project'] as $key => $value) { echo "<option value=\"".$value[0]."\">".$value[1]."</option>"."\n";} ?>
                                            </select>
                                            <!-- <select name="location" data-placeholder="Select project" class="select required">
                                                <option></option>
                                                <optgroup label="North America">
                                                    <option value="1">United States</option>
                                                    <option value="2">Canada</option>

                                                </optgroup>
                                            </select> -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Project type: <span class="text-danger">*</span></label>
                                                    <select name="apps_type" data-placeholder="Select apps type" class="select required">
                                                        <option></option>
                                                        <?php foreach ($data['apps_type'] as $key => $apps) { echo "<option value=\"".$apps[0]."\">".$apps[1]."</option>"."\n";} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <textarea name="description" rows="5" cols="4" placeholder="Application description here..." class="form-control"></textarea>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label>Logo:</label>
                                            <input type="file" class="file-input"  name="logo" data-show-upload="false" data-show-caption="true" data-show-preview="true">
                                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                                        </div> -->
                                    </div>
                                </div>

                                
                            </fieldset>

                            <fieldset title="2">
                                <legend class="text-semibold">Assign Team</legend>
                                
                                <div class="row">

                                    <!-- Select All and filtering options -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Team:  <span class="text-danger">*</span></label>
                                            <div class="multi-select-full">
                                                <select class="multiselect-select-all-filtering" multiple="multiple" name="team[]" required>
                                                    <?php foreach ($data['team'] as $key => $team) { echo "<option value=\"".$team[0]."\">".$team[1]."</option>"."\n";} ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /select All and filtering options -->

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>From:</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                            <input type="date" class="form-control" name="tanggal_mulai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label>To:</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                            <input type="date" class="form-control" name="tanggal_selesai">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <textarea name="description_team" rows="4" cols="4" placeholder="" class="form-control"></textarea>
                                        </div>
                                    </div> -->

                                </div>
                            </fieldset>

                            <fieldset title="3">
                                <legend class="text-semibold">Database configuration</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Host: <span class="text-danger">*</span></label>
                                            <input type="text" name="db_host" placeholder="localhost" class="form-control required" value="localhost" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Database name: <span class="text-danger">*</span></label>
                                            <input type="text" name="db_name" placeholder="db_name" class="form-control required" value="satudata_vdes" readonly required>
                                        </div>

                                        <div class="form-group">
                                            <label>Database user: <span class="text-danger">*</span></label>
                                            <input type="text" name="db_user" placeholder="user" class="form-control required" value="satudata_root" readonly required>
                                        </div>

                                        <div class="form-group">
                                            <label>Database password: </label>
                                            <input type="password" name="db_pass" placeholder="password" class="form-control" value="password123!@#" readonly>
                                        </div>       
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Table prefix: </label>
                                            <input type="text" name="tbl_prefix" placeholder="prefix_" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Security key: <span class="text-danger">*</span></label>
                                            <div class="label-indicator">
                                                <input type="text" name="security_key" class="form-control required shake" placeholder="Enter your security key" value="vta937iV99cqUgf" readonly required>
                                                <span class="label label-block password-indicator-label"></span>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-info generate-label" disabled="disabled">Generate security key</button>
                                        <!-- <div class="form-group">
                                            <label>Description:</label>
                                            <textarea name="db_description" rows="4" cols="4" placeholder="Database configuration" class="form-control"></textarea>
                                        </div> -->

                                        <!-- <div class="form-group">
                                            <label>Recommendations:</label>
                                            <input name="recommendations" type="file" class="file-styled">
                                            <span class="help-block">Accepted formats: jpg, jpeg, png. Max file size 2Mb</span>
                                        </div> -->
                                    </div>
                                </div>
                            </fieldset>

                            
                            <button type="submit" class="btn btn-primary stepy-finish">Create app <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /wizard with validation -->


    </div>

<?php  include_once('footer.php'); ?>

