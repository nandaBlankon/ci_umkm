<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h4 mb-0 text-gray-800">
		<?=$title?>
		<span class="float-right">
			<a href="<?=site_url('dashboard/tambahpertanyaan')?>" class="btn btn-primary btn-circle">
            	<i class="fas fa-plus"></i>
          	</a>
		</span>
	</h1>
</div>

<!-- Content Row -->
<div class="row">
	<?php $this->view('messages')?>
	<?php if ($row->num_rows() < 1) { ?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
								Belum ada data
								<span class="float-right dropdown no-arrow">
									<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
										<div class="dropdown-header"><a href="">Edit</a></div>
										<div class="dropdown-header"><a href="">Hapus</a></div>
									</div>
								</span> 
								<hr>
							</div>
							
							<a href="<?=base_url('kategori/tambah')?>" class="btn btn-primary btn-icon-split btn-sm">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-plus"></i>
			                    </span>
			                    <span class="text">Tambah</span>
			                </a>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php 
		} else {

		 $no=1; foreach($row->result() as $data) :
	?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
								Pertanyaan no <?=$no++?>
								<span class="float-right dropdown no-arrow">
									<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
										<div class="dropdown-header"><a href="<?=site_url('dashboard/editpertanyaan/'.$data->id)?>">Edit</a></div>
										<div class="dropdown-header"><a href="<?=site_url('dashboard/hapuspertanyaan/'.$data->id)?>">Hapus</a></div>
									</div>
								</span> 
								<hr>
							</div>
							<p>
								<?=$data->pertanyaan?> ?
							</p>
							<p class="text-justify text-xs">
							<ol>
								<li><?=$data->isi1?></li>
								<li><?=$data->isi2?></li>
								<li><?=$data->isi3?></li>
								<li><?=$data->isi4?></li>
							</ol>
							</p>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?> <?php } ?>

</div>		
