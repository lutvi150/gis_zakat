<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="row">

</div>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span>
        Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Dana Zakat
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?= number_format($total_dana) ?></h2>
                <h6 class="card-text">Total Dana Zakat yang sudah terkumpul</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total disalurkan
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?= number_format($total_disalurkan) ?></h2>
                <h6 class="card-text">Total Dana Zakat yang sudah disalurkan</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <h1>Selamat Datang di Sistem Pengelolaan Zakat Baitulmal Kabupaten Aceh Tengah</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>