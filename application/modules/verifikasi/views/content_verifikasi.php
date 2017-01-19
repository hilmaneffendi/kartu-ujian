<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Daftar Hadir</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>
	<div class="panel-body">
	<button type="button" data-toggle="modal" data-target="#modal_theme_success" class="btn bg-teal-400 btn-labeled"><b><i class="icon-image-compare"></i></b> Scan Kartu</button>
		 <table class="table table-bordered table-hover datatable-highlight">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">NPM</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Jurusan</th>
				<th class="text-center">Kelas</th>
				<th class="text-center">Absensi</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i = 0;
			foreach ($verifikasi as $key) {
			$i++;	
				?>
				<tr>
					<td align="center"><?php echo $i; ?></td>
					<td align="left"><?php echo $key->npm; ?></td>
					<td align="left"><?php echo $key->nama_mahasiswa; ?></td>
					<td align="left"><?php echo $key->jurusan; ?></td>
					<td align="left"><?php echo $key->kelas; ?></td>
					<td class="text-center">
						<span  class="label label-warning">Menunggu</span>
					</td>
				</tr>
				<?php
			}
		 ?>
		</tbody>
	</table>
	</div>
</div>
<div id="modal_theme_success" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-teal-400">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">SCAN QRCODE</h6>
			</div>
			<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div id="reader" style="width:560px;height:500px"></div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form method="post" action="verifikasi/cek_cipher">
						<input type="text" id="example" class="form-control" name="cip" required="required" align="center">
				</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Cek Kartu</button>
					</form>
			</div>
		</div>
	</div>
</div>