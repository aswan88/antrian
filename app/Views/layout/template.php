<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/mycss/style.css'); ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/sb_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/sb_admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('/assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/bootstrap.min.js'); ?>"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/sb_admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/sb_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/sb_admin/js/sb-admin-2.min.js"></script>
    <!-- my js -->
    <script src="<?= base_url(); ?>/assets/my.js"></script>
    <script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>

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