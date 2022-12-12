<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h4 mb-0 text-gray-800">
		<?=$title?>
		<span class="float-right">
			<a href="<?=site_url('dashboard/datapertanyaan')?>" class="btn btn-primary btn-circle">
            	<i class="fas fa-undo"></i>
          	</a>
		</span>
	</h1>
</div>

<!-- Content Row -->
<div class="row">

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-3">
							<?=ucfirst($page)?> Pertanyaan
							<hr>
						</div>
						<?php $this->view('messages')?>
						<form action="<?=site_url('dashboard/prosespertanyaan')?>" method="post">
							<input type="text" name="id" value="<?=$row->id?>">
							<div class="form-group">
								<input type="text" class="form-control form-control-sm" name="pertanyaan" value="<?=$row->pertanyaan?>" required="" autofocus="" placeholder="Pertanyaan">
							</div>
							<div class="form-group">
								<input type="text" name="isi1" class="form-control form-control-sm" required="" placeholder="Isi Jawaban 1" value="<?=$row->isi1?>">
							</div>
							<div class="form-group">
								<input type="text" name="isi2" class="form-control form-control-sm" required="" placeholder="Isi Jawaban 2" value="<?=$row->isi2?>">
							</div>
							<div class="form-group">
								<input type="text" name="isi3" class="form-control form-control-sm" required="" placeholder="Isi Jawaban 3" value="<?=$row->isi3?>">
							</div>
							<div class="form-group">
								<input type="text" name="isi4" class="form-control form-control-sm" required="" placeholder="Isi Jawaban 4" value="<?=$row->isi4?>">
							</div>
							<button class="btn btn-primary btn-icon-split btn-sm" name="<?=$page?>" type="submit">
								<span class="icon text-white-50">
			                      <i class="fas fa-arrow-right"></i>
			                    </span>
			                    <span class="text">Simpan</span>
							</button>
							<a href="<?=base_url('dashboard/datapertanyaan')?>" class="btn btn-danger btn-icon-split btn-sm">
			                    <span class="icon text-white-50">
			                      <i class="fas fa-undo"></i>
			                    </span>
			                    <span class="text">Batal</span>
			                </a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
