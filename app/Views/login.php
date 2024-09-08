<?= $this->include('head') ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <img src="<?= base_url('logo/logo.png') ?>">
                            </div>
                            <h4><?= getenv('satker') ?></h4>
                            <h6 class="font-weight-light">Login Ke Sistem</h6>
                            <form class="pt-3" id="loginForm" method="post" action="">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email">
                                    <span class="text-error e-email"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                    <span class="text-error e-password"></span>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" onclick="login()">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <?= $this->include('script') ?>
    <script>
        var wage = document.getElementById("loginForm");
        wage.addEventListener("keydown", function(e) {
            if (e.code === "Enter") {
                login();
            }
        });

        login = () => {
            $(".text-error").text("");
            $("#loginForm").ajaxForm({
                type: "POST",
                url: url + "login",
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'validation_failed') {
                        $.each(response.message, function(index, array) {
                            $(".e-" + index).text(array);
                        });
                    } else if (response.status == 'success') {
                        swal({
                            title: "Berhasil!",
                            text: "Login Ke Aplikasi Berhasil",
                            icon: "success",
                        })
                        setInterval(() => {
                            window.location.reload();
                        }, 1000);
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

    <!-- endinject -->
</body>

</html>