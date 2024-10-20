<script src="<?= base_url() ?>assets/js/vendor.bundle.base.js"></script>
<script src="<?= base_url() ?>assets/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/js/misc.js"></script>
<script src="<?= base_url() ?>assets/js/file-upload.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="<?= base_url('assets/form-master/dist/jquery.form.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/notiflix-Notiflix/dist/notiflix-3.2.7.min.js"></script>
<script>
    let url = "<?= base_url('index.php/') ?>";
</script>
<?= $this->renderSection('script') ?>