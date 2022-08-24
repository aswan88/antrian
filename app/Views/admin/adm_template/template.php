<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - kelolah antrian -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/antrian">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Kelolah Antrian</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - data pasien -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/pasien">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pasien</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - data dokter -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/dokter">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Dokter</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - data dokter -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/riwayat">
                    <i class="fa fa-fw fa-tasks"></i>
                    <span>Data Riwayat Antrian</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - data dokter -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/viewAdmin">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Admin</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - login -->

            <li class="nav-item">
                <a class="nav-link" href="logoutAdmin">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Log Out</span></a>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="mx-3 text-bold">KLINIK DAN APOTEK<span> EVANGELINE BOOTH</span></div>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item no-arrow">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                            <img class="img-profile rounded-circle" src="/gambar/user.png" width="20">
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- content -->
                <?= $this->renderSection('adm_content'); ?>
                <!-- content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->


        <script>
            setInterval(function() {
                $.ajax({
                    type: "get",
                    url: "/admin/cekEventBuka",
                    success: function(response) {
                        if (response != '') {
                            alert(response);
                            location.reload()
                        } else {
                            console.log('pantau')
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                    }

                });

                $.ajax({
                    type: "get",
                    url: "/admin/cekEventTutup",
                    success: function(response) {
                        if (response != '') {
                            alert(response);
                            location.reload()
                        } else {
                            console.log('pantau')
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + '\n' + xhr.responseText + '\n' + throwError);
                    }

                });
            }, 1000);
        </script>

</body>

</html>