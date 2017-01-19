<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Edit Data Pengguna</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>data_mahasiswa/update_data">
			<?php  echo form_hidden('id',$id); ?>
			<fieldset class="content-group">
				<div class="form-group">
					<label class="control-label col-lg-3">NPM <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="npm" value="<?php echo $npm; ?>" class="form-control" required="required" placeholder="NPM">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Nama <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="nama" value="<?php echo $nama_mahasiswa; ?>" class="form-control" required="required" placeholder="Nama">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Jurusan <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<select name="jurusan" class="form-control" required="required">
						    <?php 
						    	$x = $this->db->query("SELECT * FROM `t_jurusan` WHERE id = '$jurusan_id'")->result();
						    	foreach ($x as $key) {
						    		?>
						    		<option selected="selected" value="<?php echo $key->id; ?>" ><?php echo $key->nama_jurusan; ?></option>
						    		<?php
						    	}
						     ?>
						    <?php 
						    	$x = $this->db->query("SELECT * FROM `t_jurusan` ")->result();
						    	foreach ($x as $key) {
						    		?>
						    		<option value="<?php echo $key->id; ?>"><?php echo $key->nama_jurusan; ?></option>
						    		<?php
						    	}
						     ?>
						</select>	
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3">Kelas <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<select name="kelas" class="form-control" required="required">
						    <?php 
						    	$x = $this->db->query("SELECT * FROM `t_kelas` WHERE id = '$kelas_id'")->result();
						    	foreach ($x as $key) {
						    		?>
						    		<option selected="selected" value="<?php echo $key->id; ?>" ><?php echo $key->nama_kelas; ?></option>
						    		<?php
						    	}
						     ?>
						    <?php 
						    	$x = $this->db->query("SELECT * FROM `t_kelas` ")->result();
						    	foreach ($x as $key) {
						    		?>
						    		<option value="<?php echo $key->id; ?>"><?php echo $key->nama_kelas; ?></option>
						    		<?php
						    	}
						     ?>
						</select>	
					</div>
				</div>
			</fieldset>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
			</div>
		</form>
	</div>
</div>