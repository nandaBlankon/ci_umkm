 <!-- Main Section-->
 <section class="mt-5 container ">
     <!-- Page Content Goes Here -->

     <h1 class="mb-6 display-5 fw-bold text-center">Keranjang Belanja Anda</h1>
     <?php
        $cart = $this->cart->contents();
        if (empty($cart)) {
        ?>
         <div class="d-flex flex-column justify-content-between w-100 h-100">
             Keranjang belanja anda kosong.
         </div>
     <?php } else { ?>
         <div class="row g-4 g-md-12">

             <!-- Cart Items -->
             <div class="col-12 col-md-12">
                 <div class="table-responsive">
                     <table class="table table-responsive">
                         <thead>
                             <tr>
                                 <th></th>
                                 <th>Details</th>
                                 <th>Jumlan Pesanan</th>
                                 <th>Harga Satuan</th>
                                 <th>Sub Total</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                $grand_total = 0;
                                foreach ($cart as $item) :
                                    $grand_total += $item['subtotal'];
                                    // Menampilkan detail barang
                                    $produk = $this->db->query("select * from tb_produk where id_produk='$item[id]'")->row();
                                ?>
                                 <tr>
                                     <!-- image -->
                                     <td>
                                         <picture class="d-block bg-light p-3 f-w-20">
                                             <img class="img-fluid" src="<?= base_url('uploads/produk/' . $item['image']) ?>" alt="">
                                         </picture>
                                     </td>
                                     <!-- image -->

                                     <!-- Details -->
                                     <td>
                                         <div>
                                             <h6 class="mb-2 fw-bolder">
                                                 <?= ucwords(str_replace('-', ' ', $item['name'])); ?>
                                             </h6>
                                             <small class="d-block text-muted">Harga = <?= number_format($item['price'], 0, ",", ".") ?> | Qty = <?= $item['qty']; ?></small>
                                         </div>
                                     </td>
                                     <!-- Details -->

                                     <!-- Qty -->
                                     <td>
                                         <div>
                                             <span class="small text-muted mt-1">
                                                 <form action="<?= site_url('welcome/update') ?>" method="POST">
                                                     <input type="hidden" name="rowid" value="<?= $item['rowid']; ?>">
                                                     <button class="p-0">
                                                         <input type="number" name="qty" value="<?= $item['qty']; ?>" style="width: 30%;">
                                                     </button>
                                                 </form>
                                             </span>
                                         </div>
                                     </td>
                                     <!-- /Qty -->

                                     <td>
                                         <?= number_format($item['price'], 0, ",", ".") ?>
                                     </td>

                                     <td>
                                         <p class="fw-bolder mt-3 m-sm-0"><?= number_format($item['subtotal'], 0, ",", ".") ?></p>
                                     </td>

                                     <!-- Actions -->
                                     <td class="f-h-0">
                                         <div class="d-flex justify-content-between flex-column align-items-end h-100">
                                             <a href="<?= site_url('welcome/hapus/' . $item['rowid']) ?>" title="Hapus"><i class="ri-close-circle-line ri-lg"></i></a>
                                         </div>
                                     </td>
                                     <!-- /Actions -->

                                 </tr>
                             <?php endforeach ?>
                             <tr>
                                 <td colspan="5">
                                     <a class="btn btn-outline-dark btn-sm" href="<?= site_url('checkout') ?>">Proses ke checkout</a>
                                     <a class="btn btn-outline-info btn-sm" href="<?= site_url('') ?>">Lanjut belanja</a>
                                 </td>
                                 <td align="right">
                                     <form method="post" action="<?php echo base_url('welcome/hapus/all') ?>">
                                         <button class="btn btn-outline-danger btn-sm" type="submit">Kosongkan Keranjang</button>
                                     </form>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <!-- /Cart Items -->
         </div>
     <?php } ?>
     <!-- /Page Content -->
 </section>
 <!-- / Main Section-->