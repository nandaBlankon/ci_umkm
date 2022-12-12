<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
				<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?=$title?>
				<small>Data pembeli</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php $this->view('messages')?>
			<div class="box">
				<div class="box-header text-center">
					Data pembeli/member yang terdaftar di marketplace ini
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                	<th>No</th>
			                	<th>ID Pembeli</th>
			                	<th>Nama lengkap</th>
			                	<th>Alamat</th>
			                	<th>No Telp</th>
			                	<th>Kode Pos</th>
			                	<th>Foto</th>					
			                </tr>
			            </thead>
			            <tbody>
			            	<?php $no=1; foreach($row->result() as $data) : ?>
			            	<tr>
			                	<td><?=$no++?></td>
			                	<td><?=$data->id_pembeli?></td>
			                	<td><?=ucwords($data->nama_pembeli)?></td>
			                	<td><?=ucwords($data->alamat_pembeli)?></td>
			                	<td><?=$data->telp_pembeli?></td>
			                	<td><?=$data->kode_pos?></td>
			                	<td>
			                		<img src="<?=base_url('uploads/pembeli/'.$data->image)?>" class="img-responsive thumbnail" width="80px">
			                	</td>
			                </tr>
			            	<?php endforeach ?>
			            </tbody>
			        </table>
				</div>
			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	