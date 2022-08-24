<?= $this->extend('admin/adm_template/template'); ?>

<?= $this->section('adm_content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pasien</h1>
    </div>

    <div class="row">
        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-8">

                <!-- Illustrations -->
                <div class="card shadow mb-4" style="min-width:80vw;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Pasien</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-md-2 float-left">
                            <img src="/gambar/user.png" width="100" alt="..." class="border border-info rounded-circle">
                        </div>
                        <div class="col-md-6 float-left">
                            <h2><?= $dataPasien['nama']; ?></h2>

                            <div class="row">
                                <a href="" class="btn btn-warning mr-3">Edit</a>
                                <a href="" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">

            <div class="col-lg-12 mb-8">

                <!-- Illustrations -->
                <div class="card shadow mb-4" style="min-width:80vw;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bio Pasien</h6>
                    </div>
                    <div class="card mb-12">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="..." class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td><?= $dataPasien['nik']; ?></td>
                                            </tr>
                                        </li>
                                        <li class="list-group-item">
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><?= $dataPasien['nama']; ?></td>
                                            </tr>
                                        </li>
                                        <li class="list-group-item">
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td><?= $dataPasien['email']; ?></td>
                                            </tr>
                                        </li>
                                        <li class="list-group-item">
                                            <tr>
                                                <td>Waktu Daftar</td>
                                                <td>:</td>
                                                <td><?= date(' H:i  ,d F Y', strtotime($dataPasien['created_at'])); ?></td>
                                            </tr>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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