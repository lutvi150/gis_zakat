<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Tambah Zakat
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Zakat</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="form-zakat">
                        <div class="form-group">
                            <label for="">Keterangan Sumber Dana Zakat</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4"></textarea>
                            <span class="text-error e-keterangan"></span>
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Tanggal Terima</label>
                            <input type="date" class="form-control" name="tanggal_terima" id="tanggal_terima" placeholder="Tanggal Terima">
                            <span class="text-error e-tanggal_terima"></span>
                        </div> -->
                        <div class="form-group">
                            <label for="">Total Dana</label>
                            <input type="text" class="form-control" id="total_dana" name="total_dana" placeholder="Total Dana">
                            <span class="text-error e-total_dana"></span>
                        </div>
                        <button type="button" class="btn btn-gradient-primary mr-2" onclick="store()">Simpan</button>
                        <a class="btn btn-light" href="<?= base_url('index.php/admin/kelola_zakat') ?>">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    store = () => {

        $(".text-error").text("");
        $("#form-zakat").ajaxForm({
            type: "POST",
            url: url + "admin/zakat/add",
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.message, function(index, array) {
                        $(".e-" + index).text(array);
                    });
                } else if (response.status == 'success') {
                    swal({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                    })
                    $("#form-zakat").trigger("reset");
                } else {
                    $(".e-email").text(response.message);
                }
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        }).submit();
    }
</script>
<?= $this->endSection() ?>