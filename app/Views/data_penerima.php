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
                    <a href="<?= base_url('index.php/admin/zakat-add-data') ?>" class="btn btn-outline-success btn-sm"><i class="mdi mdi-plus-circle"></i>Tambah Penerima Bantuan</a>
                    <table class="table table-bordered" id="data-zakat">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>Golongan</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Identitas</th>
                                <th>Estimasi Di Terima</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penerima as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->nama ?></td>
                                    <td><?= $value->peruntukan ?></td>
                                    <td><?= $value->jenis_kelamin ?></td>
                                    <td><?= $value->nomor_identitas ?></td>
                                    <td><?= number_format($value->jumlah_zakat, 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/zakat-edit-data/' . $value->id_usul) ?>" class="btn btn-outline-warning btn-sm"><i class="mdi mdi-pencil"></i> Detail Penerima</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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