<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user-plus"></i></a></li>
        <li class="active">Edit Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Edit User</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-success btn-block btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?=$row->user_id?>">
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?>">
                            <label for="nama">Nama*</label>
                            <input type="text" name="nama" class="form-control" value="<?=$this->input->post('nama') ?? $row->nama?>">
                            <span class="help-block"><?=form_error('nama')?></span>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                            <label for="username">Username*</label>
                            <input type="text" name="username" class="form-control" value="<?=$this->input->post('username') ?? $row->username?>">
                            <span class="help-block"><?=form_error('username')?></span>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                            <label for="password">Password</label> <small>(Kosongkan jika tidak ingin dirubah.)</small>
                            <input type="password" name="password" class="form-control" value="<?=$this->input->post('password')?>">
                            <span class="help-block"><?=form_error('password')?></span>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                            <label for="passconf">Ulangi Password</label>
                            <input type="password" name="passconf" class="form-control" value="<?=$this->input->post('passconf')?>">
                            <span class="help-block"><?=form_error('passconf')?></span>
                        </div>
                        <div class="form-group <?=form_error('alamat') ? 'has-error' : null?>">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control"><?=$this->input->post('alamat') ?? $row->alamat?></textarea>
                            <span class="help-block"><?=form_error('alamat')?></span>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                            <label for="level">Level*</label>
                            <select name="level" class="form-control">
                                <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>
                                <option value="1">Admin</option>
                                <option value="2" <?=$level == 2 ? "selected" : null;?> >Karyawan</option>
                            </select>
                            <span class="help-block"><?=form_error('level')?></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block btn-flat" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>
                            <button class="btn btn-danger btn-block btn-flat mt-2" type="reset"><i class="fa fa-remove"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>