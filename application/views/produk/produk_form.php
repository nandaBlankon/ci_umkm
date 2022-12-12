<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Tambah Produk Baru
            </h6>
        </div>
        <div class="card-body">
            <?php $this->view('messages') ?>
            <p class="text-center">
                <a href="<?= site_url('usaha/usahaSaya') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a>
            </p>
            <form action="<?= site_url('produk/proses') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?= $row->id_produk ?>">
                <input type="hidden" name="id_usaha" value="<?= $page == 'tambah' ? $usahaSaya->id_usaha : $row->id_usaha ?>">

                <div class="form-group <?= form_error('id_kategori') ? 'has-error' : null ?>">
                    <label for="id_kategori">Kategori Produk*</label>
                    <?php echo form_dropdown('id_kategori', $kategori, $selectedkategori, ['class' => 'form-control', 'id' => 'id_kategori']); ?>
                </div>

                <div class="form-group <?= form_error('judul') ? 'has-error' : null ?>">
                    <label for="id_produk">Judul/Nama Produk*</label>
                    <input type="text" name="judul" id="forslug" class="form-control" value="<?= $page == 'tambah' ? set_value('judul') : $row->judul ?>">
                    <?= form_error('judul') ?>
                </div>

                <div class="form-group">
                    <label for="slug">Slug URL</label>
                    <input type="text" name="slug" id="slug" readonly class="form-control" value="<?= $page == 'tambah' ? set_value('slug') : $row->slug_produk ?>">
                </div>

                <div class="form-group <?= form_error('deskripsi') ? 'has-error' : null ?>">
                    <label for="deskripsi">Deskripsi Produk*</label>
                    <textarea name="deskripsi" class="form-control" id=""><?= $page == 'tambah' ? set_value('deskripsi') : $row->deskripsi ?></textarea>
                    <?= form_error('deskripsi') ?>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group <?= form_error('harga') ? 'has-error' : null ?>">
                            <label for="harga">Harga*</label>
                            <small>(misal: 12000)</small>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" name="harga" id="harga" class="form-control" value="<?= $page == 'tambah' ? set_value('harga') : $row->harga ?>">
                            </div>
                            <?= form_error('harga') ?>
                        </div>

                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="form-group <?= form_error('stok') ? 'has-error' : null ?>">
                            <label for="stok">Stok*</label>
                            <input type="number" name="stok" id="stok" class="form-control" value="<?= $page == 'tambah' ? set_value('stok') : $row->stok ?>">
                            <?= form_error('stok') ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group <?= form_error('satuan') ? 'has-error' : null ?>">
                            <label for="satuan">Satuan</label>
                            <select name="satuan" class="form-control">
                                <option value="none">-Pilih-</option>
                                <option value="Paket" <?= $row->satuan == 'Paket' ? "selected" : null; ?>>Paket</option>
                                <option value="Pcs" <?= $row->satuan == 'Pcs' ? "selected" : null; ?>>Pcs</option>
                                <option value="Buah" <?= $row->satuan == 'Buah' ? "selected" : null; ?>>Buah</option>
                            </select>
                            <?= form_error('satuan') ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group <?= form_error('kondisi') ? 'has-error' : null ?>">
                            <label for="kondisi">Kondisi</label>
                            <select name="kondisi" class="form-control">
                                <option value="none">-Pilih-</option>
                                <option value="Baru" <?= $row->kondisi == 'Baru' ? "selected" : null; ?>>Baru</option>
                                <option value="Bekas" <?= $row->kondisi == 'Bekas' ? "selected" : null; ?>>Bekas</option>
                            </select>
                            <?= form_error('kondisi') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group <?= form_error('berat') ? 'has-error' : null ?>">
                            <label for="berat">Berat</label>
                            <small>(misal: 1000 gr)</small>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="number" name="berat" id="berat" class="form-control" value="<?= $page == 'tambah' ? set_value('berat') : $row->berat ?>">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Gr</div>
                                </div>
                            </div>
                            <?= form_error('berat') ?>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group <?= form_error('warna') ? 'has-error' : null ?>">
                            <label for="warna">Warna Produk</label>
                            <select class="form-control" name="warna[]" multiple="multiple" data-placeholder="Pilih warna">
                                <?php foreach ($warna->result() as $val) : ?>
                                    <!-- EDITED -->
                                    <?php
                                    $selected = "";
                                    if ($this->router->fetch_method() == "edit") {
                                        $id_produk = $this->uri->segment(3);
                                        $warnaterpilih = $this->model_produk->warnaTerpilih($id_produk, $val->id_warna)->result_array();
                                        if (count($warnaterpilih) == 0) {
                                            $selected = "";
                                        } else {
                                            $selected = "selected";
                                        }
                                    }
                                    ?>
                                    <option value="<?= $val->id_warna ?>" <?php echo $selected; ?>><?= $val->warna ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('warna') ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group <?= form_error('ukuran') ? 'has-error' : null ?>">
                            <label for="ukuran">Ukuran Produk</label>
                            <select class="form-control select2" name="ukuran[]" multiple="multiple" data-placeholder="Pilih ukuran">
                                <?php foreach ($size->result() as $valSize) : ?>
                                    <!-- EDITED -->
                                    <?php
                                    $selectedSize = "";
                                    if ($this->router->fetch_method() == "edit") {
                                        $id_produk = $this->uri->segment(3);
                                        $sizeterpilih = $this->model_produk->sizeTerpilih($id_produk, $valSize->id_ukuran)->result_array();
                                        if (count($sizeterpilih) == 0) {
                                            $selectedSize = "";
                                        } else {
                                            $selectedSize = "selected";
                                        }
                                    }
                                    ?>
                                    <option value="<?= $valSize->id_ukuran ?>" <?php echo $selectedSize; ?>><?= $valSize->ukuran ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('ukuran') ?>
                        </div>
                    </div>
                </div>

                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                    <button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>