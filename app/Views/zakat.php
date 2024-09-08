<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Data Pengelolaan Zakat
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pengelolaan Zakat</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('index.php/admin/zakat/add') ?>" class="btn btn-outline-success btn-sm"><i class="mdi mdi-plus-circle"></i>Tambah Zakat Masuk</a>
                    <a href="<?= base_url('index.php/admin/zakat/salurkan') ?>" type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-plus-circle"></i>Salurkan Zakat</a>
                    <table class="table table-bordered" id="data-zakat">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Keterangan
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Saldo Akhir
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($zakat as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <button class="btn btn-<?= $value['status'] == 'D' ? 'danger' : 'success' ?> btn-sm"><?= $value['status'] == 'D' ? "Debit" : "Kredit" ?></button>

                                    </td>
                                    <td><?= $value['keterangan'] ?></td>
                                    <td><?= number_format($value['total']) ?></td>
                                    <td><?= number_format($value['saldo_akhir']) ?></td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm"><i class="mdi mdi-pencil"></i></button>
                                        <button class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                                        <button class="btn btn-outline-info btn-sm"><i class="mdi mdi-map"></i></button>
                                    </td>
                                <?php endforeach ?>
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