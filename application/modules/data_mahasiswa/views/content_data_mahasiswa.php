<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Data Mahasiswa</h5>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
	<button type="button" onclick="window.location.href='<?php echo base_url();?>data_mahasiswa/form_add'" class="btn bg-teal-400 btn-labeled"><b><i class="icon-user-plus"></i></b> Tambah Data</button>
		 <table class="table table-bordered table-hover datatable-highlight">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">NPM</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Jurusan</th>
				<th class="text-center">Kelas</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i = 0;
			foreach ($data_mahasiswa as $key) {
			$i++;	
				?>
				<tr>
					<td align="center"><?php echo $i; ?></td>
					<td align="left"><?php echo $key->npm; ?></td>
					<td align="left"><?php echo $key->nama_mahasiswa; ?></td>
					<td align="left"><?php echo $key->jurusan; ?></td>
					<td align="left"><?php echo $key->kelas; ?></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="<?php echo base_url(); ?>data_mahasiswa/edit/<?php echo $key->id; ?>"><i class="icon-database-edit2"></i> Edit</a></li>
									<li><a href="<?php echo base_url(); ?>data_mahasiswa/hapus/<?php echo $key->id; ?>"><i class="icon-trash-alt"></i> Hapus</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<?php
			}

		 ?>
			
		</tbody>
	</table>


		
	</div>
</div>