 <!-- Footer -->
 <!-- Footer-->
 <footer class="bg-dark mt-10  ">

     <!-- Footer socials-->
     <div class="bg-light py-4">
         <div class="container d-flex justify-content-center align-items-center py-2">
             <p class="lead fw-bolder mb-0 lh-1">Find us online</p>
             <ul class="list-unstyled d-flex justify-content-start align-items-center mb-0 ms-3 lh-1">
                 <li class="mx-1 mb-0 lh-1"><a class="text-muted text-decoration-none opacity-75-hover transition-all lh-1" href="#"><i class="ri-instagram-fill ri-xl lh-1"></i></a></li>
                 <li class="mx-1 mb-0 lh-1"><a class="text-muted text-decoration-none opacity-75-hover transition-all lh-1" href="#"><i class="ri-facebook-fill ri-xl lh-1"></i></a></li>
                 <li class="mx-1 mb-0 lh-1"><a class="text-muted text-decoration-none opacity-75-hover transition-all lh-1" href="#"><i class="ri-twitter-fill ri-xl lh-1"></i></a></li>
                 <li class="mx-1 mb-0 lh-1"><a class="text-muted text-decoration-none opacity-75-hover transition-all lh-1" href="#"><i class="ri-snapchat-fill ri-xl lh-1"></i></a></li>
             </ul>
         </div>
     </div>
     <!-- / Footer socials-->

     <!-- Menus & Newsletter-->
     <div class="border-top-white-opacity py-7 mt-7 text-white">
         <div class="container" data-aos="fade-in">

             <div class="border-top-white-opacity justify-content-between flex-column flex-md-row align-items-center d-flex pt-6 mt-6 px-0">
                 <p class="small opacity-75">&copy; <?= date('Y'); ?> <?php echo $this->config->item('nama_aplikasi'); ?> BY <?php echo $this->config->item('nama_mhs'); ?></p>
                 <nav>
                     <ul class="list-unstyled">
                         <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i class="pi pi-paypal pi-sm"></i></li>
                         <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i class="pi pi-mastercard pi-sm"></i>
                         </li>
                         <li class="d-inline-block me-1 bg-white rounded px-2 pt-1"><i class="pi pi-american-express pi-sm"></i></li>
                         <li class="d-inline-block bg-white rounded px-2 pt-1"><i class="pi pi-visa pi-sm"></i></li>
                     </ul>
                 </nav>
             </div>
         </div>
     </div>
     <!-- Menus & Newsletter-->

 </footer>
 <!-- / Footer-->
 <!-- Cart Offcanvas-->
 <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="offcanvasCart">
     <div class="offcanvas-header d-flex align-items-center">
         <h5 class="offcanvas-title" id="offcanvasCartLabel">Keranjang Anda</h5>
         <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
     </div>
     <div class="offcanvas-body">
         <?php
            $cart = $this->cart->contents();
            if (empty($cart)) {
            ?>
             <div class="d-flex flex-column justify-content-between w-100 h-100">
                 Keranjang belanja anda kosong.
             </div>
         <?php } else { ?>
             <div class="d-flex flex-column justify-content-between w-100 h-100">
                 <div>

                     <?php
                        $no = 1;
                        $grand_total = 0;
                        foreach ($cart as $item) :
                            $grand_total += $item['subtotal'];
                        ?>
                         <!-- Cart Product-->
                         <div class="row mx-0 pb-4 mb-4 border-bottom">
                             <div class="col-3">
                                 <picture class="d-block bg-light">
                                     <img class="img-fluid" src="<?= base_url('uploads/produk/' . $item['image']) ?>" alt="Bootstrap 5 Template by Pixel Rocket">
                                 </picture>
                             </div>
                             <div class="col-9">
                                 <div>
                                     <h6 class="justify-content-between d-flex align-items-start mb-2">
                                         <?= ucwords(str_replace('-', ' ', $item['name'])); ?>
                                         <a href="<?= site_url('welcome/hapus/' . $item['rowid']) ?>" title="Hapus"><i class="ri-close-line"></i></a>
                                     </h6>
                                     <?php if ($item['color'] != 0 || $item['color'] == true) : ?>
                                         <small class="d-block text-muted fw-bolder">Color: <?= $item['color']; ?></small>
                                     <?php endif ?>
                                     <?php if ($item['size'] != 0 || $item['size'] == true) : ?>
                                         <small class="d-block text-muted fw-bolder">Size: <?= $item['size']; ?></small>
                                     <?php endif ?>
                                     <small class="d-block text-muted fw-bolder">Price: <?= number_format($item['price'], 0, ",", ".") ?></small>
                                     <small class="d-block text-muted fw-bolder">Qty: <?= $item['qty']; ?></small>
                                 </div>
                                 <p class="fw-bolder text-end m-0"><?= number_format($item['subtotal'], 0, ",", ".") ?></p>
                             </div>
                         </div>
                     <?php endforeach ?>
                 </div>
                 <div class="border-top pt-3">
                     <div class="d-flex justify-content-between align-items-center">
                         <p class="m-0 fw-bolder">Subtotal</p>
                         <p class="m-0 fw-bolder"><?= number_format($this->cart->total(), 0, ",", "."); ?></p>
                     </div>
                     <a href="<?= site_url('checkout') ?>" class="btn btn-orange btn-orange-chunky mt-5 mb-2 d-block text-center">Checkout</a>
                     <a href="<?= site_url('view-cart') ?>" class="btn btn-dark fw-bolder d-block text-center transition-all opacity-50-hover">View Cart</a>
                 </div>
             </div>
         <?php } ?>
     </div>
 </div>
 <!-- Theme JS -->
 <!-- Vendor JS -->
 <script src="<?= base_url('assets/frontend/dist/'); ?>assets/js/vendor.bundle.js"></script>

 <!-- Theme JS -->
 <script src="<?= base_url('assets/frontend/dist/'); ?>assets/js/theme.bundle.js"></script>
 </body>

 </html>