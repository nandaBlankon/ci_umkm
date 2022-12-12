<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user-plus"></i></a></li>
        <li class="active">Tambah Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah User</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                
                    <form action="" method="post">
                        <div class="form-group <?=form_error('nama') ? 'has-error' : null?>">
                            <label for="nama">Nama*</label>
                            <input type="text" name="nama" class="form-control" value="<?=set_value('nama')?>">
                            <span class="help-block"><?=form_error('nama')?></span>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                            <label for="username">Username*</label>
                            <input type="text" name="username" class="form-control" value="<?=set_value('username')?>">
                            <span class="help-block"><?=form_error('username')?></span>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                            <label for="password">Password*</label>
                            <input type="password" name="password" class="form-control" value="<?=set_value('password')?>">
                            <span class="help-block"><?=form_error('password')?></span>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                            <label for="passconf">Ulangi Password*</label>
                            <input type="password" name="passconf" class="form-control" value="<?=set_value('passconf')?>">
                            <span class="help-block"><?=form_error('passconf')?></span>
                        </div>
                        <div class="form-group <?=form_error('alamat') ? 'has-error' : null?>">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control"> <?=set_value('alamat')?></textarea>
                            <span class="help-block"><?=form_error('alamat')?></span>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                            <label for="level">Level*</label>
                            <select name="level" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="1" <?=set_value('level') == 1 ? "selected" : null;?> >Admin</option>
                                <option value="2" <?=set_value('level') == 2 ? "selected" : null;?> >Karyawan</option>
                            </select>
                            <span class="help-block"><?=form_error('level')?></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>
                            <button class="btn btn-danger btn-flat" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>