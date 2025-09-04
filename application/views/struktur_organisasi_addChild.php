<?php include('header.php'); ?>
<!-- Page header -->
<div class="page-header">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $data['breadcrumb1']; ?></span> - <?php echo $data['title'] ?></h4>
		</div>
		<?php // include('statistic.php'); ?>
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
			<form class="form-horizontal" action="<?php echo $data['curl']."savechild"; ?>" method="post">
				<fieldset class="content-group">

					<div class="form-group">
	                    <label class="control-label col-lg-2">Parent</label>
	                    <div class="col-lg-10">
	                    <select data-placeholder="Pilih parent" class="select" required="true" name="parent_id">
	                          <option></option>
	                          <?php foreach ($data['groups'] as $key => $pos) { echo "<option value=\"".$pos[0]."\" ".$pos[2].">".$pos[1]."</option>"."\n";} ?>
	                      </select>
	                    </div>
	                </div>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama Jabatan</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="nama_jabatan" >
						</div>
					</div>

					<div class="form-group">
	                    <label class="control-label col-lg-2">Nama Lengkap</label>
	                    <div class="col-lg-10">
	                     <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $value['nama_lengkap'] ?>">
	                    </div>
	                  </div>

	                  <div class="form-group">
	                    <label class="control-label col-lg-2">NRP/NIP</label>
	                    <div class="col-lg-10">
	                     <input type="text" class="form-control" name="nrp_nip" value="<?php echo $value['nrp_nip'] ?>">
	                    </div>
	                  </div>

					<div class="form-group">
                    <label class="control-label col-lg-2">Pangkat/Golongan</label>
                    <div class="col-lg-10">
                      <select  class="select" data-placeholder="Pilih pangkat"  name="pangkat" >
                      	<option></option>
                          <?php
                            $jp = count($data['pangkat']);
                            for ($i=0; $i < $jp; $i++) { 
                              $jk = count($data['pangkat'][$i]['pangkat']);
                              echo "<optgroup label=\"".$data['pangkat'][$i]['milpnsval']."\" class=\"text-size-lg\">";
                                for ($n=0; $n < $jk; $n++) { 
                                  echo "<option value=\"".$data['pangkat'][$i]['pangkat'][$n]['kd_pangkat']."\">".ucfirst($data['pangkat'][$i]['pangkat'][$n]['nm_pangkat'])."</option>"."\n";
                                }
                              echo "</optgroup>"."\n";
                            }
                          ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Korps</label>
                    <div class="col-lg-10">
                      <select data-placeholder="Pilih korps" class="select" name="korps">
                          <option></option>
                          <?php foreach ($data['korps'] as $key => $korps) { echo "<option value=\"".$korps[0]."\" ".$korps[2].">".$korps[1]."</option>"."\n";} ?>
                      </select>
                    </div>
                  </div>

					<div class="form-group">
						<label class="control-label col-lg-2">Keterangan</label>
						<div class="col-lg-10">
							<textarea rows="3" cols="5" name="keterangan" class="form-control text-capitalize" placeholder="Keterangan"></textarea>
						</div>
					</div>

				</fieldset>
				<div class="text-right">
					<a href="<?php echo $data['curl'] ?>" class="btn btn-danger btn-sx"><i class="icon-circle-left2 position-left"></i> Cancel</a> 
					<button type="submit" class="btn btn-primary">Submit <i class="icon-circle-right2 position-right"></i></button>
				</div>
			</form>
		</div>

		<?php include('footer.php'); ?>
