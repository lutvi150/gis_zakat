<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Data Kecamatan
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kecamatan</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('index.php/admin/zakat/add') ?>" class="btn btn-outline-success btn-sm"><i class="mdi mdi-plus-circle"></i>Tambah Data Kecamatan</a>
                    <table class="table table-bordered" id="data-zakat">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Nama Kecamatan
                                </th>
                                <th>
                                    Email Admin
                                </th>
                                <th>
                                    Sebaran Penerima
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    new DataTable('#data-zakat');
</script>
<?= $this->endSection() ?>