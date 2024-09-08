<?= $this->include("head") ?>
<style>
    .page-body-wrapper {
        min-height: calc(100vh - 70px);
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        flex-direction: row;
        padding-left: 234px;
        padding-right: 0px;
        padding-top: 70px;
        width: 100%;
    }
</style>
<?php $session = \Config\Services::session(); ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch">

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <?php if ($session->get('login')): ?>
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="<?= base_url() ?>logo/icon-admin.png" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">Admin</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('index.php/logout') ?>">
                                <i class="mdi mdi-logout mr-2 text-primary"></i>
                                Signout
                            </a>
                        </div>
                    <?php else: ?>
                <li class="nav-item d-none d-lg-block full-screen-link">
                    <a href="<?= base_url('index.php/login') ?>" class="nav-link">
                        <i class="mdi mdi-home" id=""></i>Login
                    </a>
                </li>
            <?php endif; ?>
            </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        <div class="main-panel">
            <div class="content-wrapper">
                <?= $this->renderSection('content') ?>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date('y') ?> <a href="" # target="_blank"><?= getenv('app_owner') ?></a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<?= $this->include("script") ?>