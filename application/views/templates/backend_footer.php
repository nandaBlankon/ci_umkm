</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>COPYRIGHT &copy; <?php echo $this->config->item('nama_aplikasi'); ?> <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('keluar'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/backend/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/backend/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/backend/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/backend/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url('assets/backend/') ?>js/demo/datatables-demo.js"></script>

<!-- tinymce.min.js -->
<script src="https://cdn.tiny.cloud/1/rjp3pfjui73wnbkonnvvinxjm37dxyj4i0ddwx8fk9brnyzw/tinymce/6/plugins.min.js" referrerpolicy="origin"></script>
<script src="<?= base_url('assets/backend/') ?>js/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea#editor',
        skin: 'bootstrap',
        plugins: 'lists, link, image, media',
        toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
        menubar: false,
    });
</script>

<script type="text/javascript">
    var slug = function(str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }
    $('#forslug').on('keyup', function() {
        $('#slug').val(slug($(this).val()));
    });
</script>

</body>

</html>