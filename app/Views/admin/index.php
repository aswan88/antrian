<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row mb-4">

        <div class="col-md-4 col-sm-3 mb-2">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pasien</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-danger">
                                        <?= $dataPasien; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-3 mb-2">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Dokter</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-danger">
                                        <?= $dataDokter; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <img src="<?= base_url(); ?>/gambar/dok.png" alt="Card image cap" width="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-3 mb-2">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Antrian</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-danger">
                                        <?= $dataAntrian; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-3x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-3 mb-2">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Riwayat</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-danger">
                                        <?= $dataRiwayat; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-3 mb-2">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Admin</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h2 mb-0 mr-3 font-weight-bold text-danger">
                                        <?= $dataAdmin; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?= $this->endSection(); ?>