<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <?php if ($page == 'tambah') : ?>
        <div class="card mb-4 border-left-primary border-bottom-primary">
            <div class="card-body text-justify">
                <?= $this->fungsi->user_login()->jekel == 'L' ? 'Pak' : 'Ibu' ?> <?= ucfirst($this->fungsi->user_login()->nama); ?>, kami senang anda mau memasarkan produk-produk usaha anda bersama kami di sini.
                Selangkah lagi, anda dapat memposting produk anda kapanpun, dan dimanapun.
                Silakan isi seluruh informasi tentang usaha anda dibawah, kemudian klik tombol "Simpan" untuk menyelesaikan prosesnya.
            </div>
        </div>
    <?php endif ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Form <?= $page == 'tambah' ? 'Input' : $page; ?> informasi usaha anda
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <p class="text-center">
                <a href="<?= $page == 'tambah' ? site_url('dashboard') : site_url('usaha/usahaSaya') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Batal <?= $page == 'tambah' ? 'Membuka' : 'Edit'; ?> Usaha</a>
            </p>
            <form action="<?= site_url('usaha/proses') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?= $this->fungsi->user_login()->user_id; ?>">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="id_usaha">ID Usaha Anda</label>
                            <input type="text" name="id_usaha" class="form-control" value="<?= $page == 'tambah' ? $idusaha : $row->id_usaha ?>" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group <?= form_error('nama_usaha') ? 'has-error' : null ?>">
                            <label for="nama_usaha">Nama Usaha Anda*</label>
                            <input type="text" name="nama_usaha" class="form-control" value="<?= $page == 'tambah' ? set_value('nama_usaha') : $row->nama_usaha ?>" autofocus placeholder="Tuliskan nama usaha anda" style="text-transform: uppercase;">
                            <?= form_error('nama_usaha') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group <?= form_error('alamat_usaha') ? 'has-error' : null ?>">
                            <label for="alamat_usaha">Alamat Usaha Anda*</label>
                            <input type="text" name="alamat_usaha" class="form-control" value="<?= $page == 'tambah' ? set_value('alamat_usaha') : $row->alamat_usaha ?>" placeholder="Tuliskan alamat lengkap usaha anda" style="text-transform: uppercase;">
                            <small>Misal: Jl. Jhon Doe, No 12.</small>
                            <?= form_error('alamat_usaha') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group <?= form_error('desa') ? 'has-error' : null ?>">
                            <label for="desa">Desa*</label>
                            <input type="text" name="desa" class="form-control" value="<?= $page == 'tambah' ? set_value('desa') : $row->desa ?>" placeholder="Tuliskan di desa mana usaha anda berada" style="text-transform: uppercase;">
                            <small>Misal: Suka Maju</small>
                            <?= form_error('desa') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group <?= form_error('kecamatan') ? 'has-error' : null ?>">
                            <label for="kecamatan">Kecamatan*</label>
                            <input type="text" name="kecamatan" class="form-control" value="<?= $page == 'tambah' ? set_value('kecamatan') : $row->kecamatan ?>" placeholder="Tuliskan di kecamatan mana usaha anda berada" style="text-transform: uppercase;">
                            <small>Misal: Delima</small>
                            <?= form_error('kecamatan') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group <?= form_error('kabupaten') ? 'has-error' : null ?>">
                            <label for="kabupaten">Kabupaten*</label>
                            <input type="text" name="kabupaten" class="form-control" value="<?= $page == 'tambah' ? set_value('kabupaten') : $row->kabupaten ?>" placeholder="Tuliskan di kabupaten mana usaha anda berada" style="text-transform: uppercase;">
                            <small>Misal: Pidie</small>
                            <?= form_error('kabupaten') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group <?= form_error('no_hp') ? 'has-error' : null ?>">
                            <label for="no_hp">No Hp/WA*</label>
                            <input type="number" name="no_hp" class="form-control" value="<?= $page == 'tambah' ? set_value('no_hp') : $row->no_hp ?>" placeholder="TULISKAN NOMOR HP ATAU WHATSAPP">
                            <small>Misal: 082131415161</small>
                            <?= form_error('no_hp') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group <?= form_error('jenis_usaha') ? 'has-error' : null ?>">
                            <label for="jenis_usaha">Jenis Usaha*</label>
                            <select name="jenis_usaha" class="form-control">
                                <option value="none">-Pilih-</option>
                                <option value="UMKM" <?= $row->jenis_usaha == 'UMKM' ? "selected" : null; ?>>UMKM</option>
                                <option value="Home Industri" <?= $row->jenis_usaha == 'Home Industri' ? "selected" : null; ?>>Home Industri</option>
                            </select>
                            <?= form_error('jenis_usaha') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group <?= form_error('keterangan') ? 'has-error' : null ?>">
                    <label for="keterangan">Keterangan*</label>
                    <textarea name="keterangan" class="form-control form-control-sm" id="" placeholder="Tuliskan sedikit informasi lainnya mengenai usaha anda untuk pelanggan"><?= $page == 'tambah' ? set_value('keterangan') : $row->keterangan ?></textarea>
                    <?= form_error('keterangan') ?>
                </div>

                <button type="submit" name="<?= $page; ?>" class="btn btn-facebook btn-block btn-sm"><i class="fa fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-google btn-block btn-sm"><i class="fa fa-remove-format"></i> Reset</button>
            </form>
        </div>
    </div>

</div>