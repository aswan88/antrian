<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/sb_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/sb_admin/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url(); ?>/sb_admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url(); ?>/sb_admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- <link href="<?= base_url(); ?>/node_modules/bootstrap4-toggle/css/bootstrap4-toggle.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->

    <script src="<?= base_url(); ?>/sb_admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/sb_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/sb_admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/sb_admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/sb_admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/sb_admin/js/demo/datatables-demo.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/assets/admin.js"></script>

    <script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- <script src="<?= base_url(); ?>/node_modules/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=1JQCQe4m"></script>
</head>

<body id="page-top" style="background-image: url('/gambar/web/19366.jpg');
    background-size: cover;" class="mt-5">
    <section id="loginAdmin" class="loginAdmin">
        <div class="row justify-content-center ">
            <div class="col-md-3 shadow-sm p-3 mb-5 mt-5 bg-white rounded">
                <h5 class="text-info">login Admin.!</h5>
                <hr>
                <!-- set flash data -->
                <?php if (session()->getFlashdata('pesanData')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesanData'); ?>
                    </div>
                <?php elseif (session()->getFlashdata('pesanError')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesanError'); ?>
                    </div>
                <?php endif; ?>
                <form action="/admin/loginProses" method="POST">
                    <div class="form-group">
                        <label for="username" class="float-left text-secondary">Username : </label>
                        <input type="username" class="form-control" id="username" name="username" placeholder="Masukan username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="float-left text-secondary">Password : </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" name="loginAdmin" class="btn btn-primary" style="width: 100%;">login.!</button>
                </form>
            </div>
        </div>
    </section>